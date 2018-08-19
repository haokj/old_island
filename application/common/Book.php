<?php
/*
 * 书籍方法逻辑类
* @date: 2018年8月17日 上午12:03:49
* @author: hkj
*/
namespace app\common;

use think\Log;
use app\common\exception\DoubanException;
use app\index\model\UserPraise;
use app\index\model\ShortComment;
use app\index\model\UserComment;
use think\Db;
use app\index\model\HotKeyword;

class Book
{
    //获取热门书籍
    public function getHotList($user)
    {
        $rst = Util::http(config('douban.hot_list'), 'GET');
        $rst = json_decode($rst, true);
        if (array_key_exists('books', $rst)) {
            return $this->installData($rst['books'], $user);
        } else {
            Log::write($rst, 'error');
            throw new DoubanException();
        }
    }
    
    //整合数据
    private function installData($book_data_list, $user)
    {
        $datas = []; //存放图书数据
        $ids = [];  //图书id数组
        foreach ($book_data_list as $key => $item) {
            $datas[] = $this->oneListData($item);
            array_push($ids, $item['id']);
        }
        $bookPraise = $this->bookPraise($ids);
        $bookPraiseByMe = $this->bookPraiseByMe($ids, $user->id);
//         dump(collection($bookPraiseByMe)->toArray());die;
        foreach ($datas as $k => &$data) {
            foreach ($bookPraise as $v1) {
                if ($v1['art_id'] == $data['id']) {
                    $data['fav_nums'] = $v1['fav_nums'];
                    break;
                }
            }
            foreach ($bookPraiseByMe as $v2) {
                if ($v2['art_id'] == $data['id']) {
                    $data['like_status'] = 1;
                    break;
                }
            }
        }
        return $datas;
    }
    
    //根据图书id查询点赞表
    private function bookPraise($ids)
    {
        $praise = UserPraise::where('art_id', 'in', $ids)->where('type', 400)
            ->field('art_id,count(art_id) as fav_nums')
            ->group('art_id')->select();
        return $praise;
    }
    
    //获取本人点赞的图书
    private function bookPraiseByMe($ids, $user_id)
    {
        $praise = UserPraise::where('art_id', 'in', $ids)->where('type', 400)->where('user_id', $user_id)
            ->field('art_id,user_id')
            ->group('art_id')->select();
        return $praise;
    }
    
    //期望返回的数据
    private function oneListData($book_data)
    {
        $data = [
            'author' => '', //作者
            'fav_nums' => 0,    //点赞数
            'id' => -1,
            'image' => '',  //图书照片
            'like_status' => 0, //我是否点过赞
            'title' => '',  //书籍题目
        ];
        $data['author'] = implode(' ', $book_data['author']);
        $data['id'] = $book_data['id'];
        $data['image'] = $book_data['images']['large'];
        $data['title'] = $book_data['title'];
        return $data;
    }
    
    //获取书籍短评
    public function getShortComment($book_id)
    {
        $lists = ShortComment::where('book_id', $book_id)->select();
        $data = [
            'comment' => [],
            'book_id' => $book_id
        ];
        foreach ($lists as $list) {
            array_push($data['comment'], [
                'content' => $list['content'],
                'nums' => $list['num']
            ]);
        }
        return $data;
    }
    
    //获取我喜欢的书籍的数量
    public function getFavorCount($user)
    {
        $count = UserPraise::where('user_id', $user->id)->where('type', 400)->count();
        return ['count' => $count];
    }
    
    //获取书籍点赞情况
    public function getBookFavor($user, $book_id)
    {
        $userIds = UserPraise::where('art_id', $book_id)->where('type', 400)->column('user_id');
        return [
            'fav_nums' => count($userIds),
            'id' => $book_id,
            'like_status' => in_array($user->id, $userIds) ? 1 : 0
        ];
    }
    
    //新增短评
    //先去豆瓣请求查看是否存在此id书籍，再做添加操作
    public function addShortComment($user, $data)
    {
        //
        $this->checkDoubanHasBood($data['book_id']);
        Db::startTrans();
        try {
            //短评表更新或添加数据
            $shortCommentModel = ShortComment::where(['book_id'=>$data['book_id'], 'content'=>$data['content']])->find();
            if ($shortCommentModel) {
                ShortComment::where('id', $shortCommentModel->id)->setInc('num');
            } else {
                $shortCommentModel = new ShortComment();
                $shortCommentModel->book_id = $data['book_id'];
                $shortCommentModel->content = $data['content'];
                $shortCommentModel->num = 1;
                $shortCommentModel->save();
            }
            //短评与用户中间表添加数据
            $rst = UserComment::where('com_id', $shortCommentModel->id)->where('user_id', $user->id)->find();
            if (!$rst) {
                $middleModel = new UserComment();
                $middleModel->user_id = $user->id;
                $middleModel->com_id = $shortCommentModel->id;
                $middleModel->save();
            }
            Db::commit();
            return true;
        } catch (\Exception $e) {
            Db::rollback();
            return false;
        }
    }
    //查询豆瓣是否有此书id
    public function checkDoubanHasBood($id, $return = false)
    {
        $rst = Util::http(sprintf(config('douban.the_book'), $id), 'GET');
        $rst = json_decode($rst, true);
        if (array_key_exists('code', $rst) && $rst['code'] == 6000) {
            throw new DoubanException([
                'code' => 404,
                'error_code' => 4001,
                'msg' => '豆瓣处此图书id不存在'
            ]);
        }
        if ($return) {
            return $rst;
        }
    }
    
    //获取热搜关键字
    public function getHotKeyword()
    {
        $data = ['hot' => []];
        $words = HotKeyword::column('name');
        foreach ($words as $word) {
            array_push($data['hot'], $word);
        }
        return $data;
    }
    
    //搜索图书
    public function getSearchBook($param)
    {
        
        $start = isset($param['start']) ? $param['start'] : 0;
        $count = (isset($param['count']) && $param['count']<20) ? $param['count'] : 20;
        $summary = isset($param['summary']) ? $param['summary'] : 0;
        
        $url = config('douban.search_book').'?start='.$start.'&count='.$count.'&q='.$param['q'];
        $rst = Util::http($url, 'GET');
        $rst = json_decode($rst, true);
        if (array_key_exists('books', $rst)) {
            return $this->installSearchData($rst, $summary, $start, $count);
        } else {
            Log::write($rst, 'error');
            throw new DoubanException();
        }
    }
    //返回数据
    private function installSearchData($book_datas, $summary, $start, $count)
    {
        //返回的数据格式
        $data = [
            'books' => [],
            'count' => $count,
            'start' => $start,
            'total' => $book_datas['total']
        ];
        if ($summary == 0) {
            $data['books'] = $book_datas['books'];
        } else {
            foreach ($book_datas['books'] as $list) {
                $rst = $this->summaryBookData($list);
                array_push($data['books'], $rst);
            }
        }
        return $data;
    }
    //summary=1 时简要数据
    private function summaryBookData($list)
    {
        $data = [
            'author' => $list['author'],
            'id' => $list['id'],
            'image' => $list['images']['small'],
            'isbn' => $list['isbn10'],
            'price' => $list['price'],
            'title' => $list['title']
        ];
        return $data;
    }
    
    //获取某一个书籍详细信息
    public function getBookDetail($book_id)
    {
        $book = $this->checkDoubanHasBood($book_id, true);
        return $book;
    }
}

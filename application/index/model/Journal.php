<?php
/*
 * 期刊模型
* @date: 2018年8月14日 下午10:51:38
* @author: hkj
*/
namespace app\index\model;

use think\Model;
use app\common\exception\JournalException;

class Journal extends Model
{

    //获取最新一期期刊
    public function getNew($user)
    {
        $rst = $this->order('index', 'desc')->find(); 
        //查看用户是否点赞过
        //此处必须用数组形式取数据，ORM模型中会自带type对象，$rst->type并不能取到数据
        $rst->like_status = (new UserPraise())->likeStatus($user->id, $rst->id, $rst['type']);
        return $rst['type'] == 200? $rst : $rst->hidden(['url']);
    }
    
    //获取下一期 或 下一期
    public function getNextOrPrev($user, $index, $type = 'next')
    {
        if ($type == 'next') {
            $rst = $this->where('index', ($index + 1))->find();
        } else {
            $rst = $this->where('index', ($index - 1))->find();
        }
        if ($rst) {
            $rst->like_status = (new UserPraise())->likeStatus($user->id, $rst->id, $rst['type']);
            return $rst['type'] == 200? $rst : $rst->hidden(['url']);
        }
        return false;
    }
    
    //获取详细信息
    public function getDetail($user, $id, $type)
    {
        $rst = $this->where('id', $id)->where('type', $type)->find();
        if ($rst) {
            $rst->like_status = (new UserPraise())->likeStatus($user->id, $rst->id, $rst['type']);
            return $rst['type'] == 200? $rst : $rst->hidden(['url']);
        }
        return false;
    }
    
    //获取期刊或图书的点赞信息
    public function getFavor($user, $id, $type)
    {
        //图书信息我用的是豆瓣api信息
        //100,200,300查询journal期刊表，400查询user_praise用户点赞表，里面art_id可存放图书id
        if ($type == 400) {
            $favNums = UserPraise::where('art_id', $id)->where('type', 400)->count();
        } else {
            $jorunal = $this->where('id', $id)->where('type', $type)->find();
            if ($jorunal) {
                $favNums = $jorunal->fav_nums;
            } else {
                throw new JournalException();
            }
        }
        $likeStatus = (new UserPraise())->likeStatus($user->id, $id, $type);
        return [
            'fav_nums' => $favNums,
            'id' => $id,
            'like_status' => $likeStatus
        ];
    }
    
    //获取我喜欢额书刊列表
    public function getFavorList($user, $start, $count)
    {
        $count = $count > 20 ? 20 :$count;
        $rst = $this->alias('a')->join('user_praise b', 'a.id = b.art_id')
            ->where('b.user_id', $user->id)->where('b.type', '<>', 400)->field('a.*')
            ->limit(($start-1)*$count, $count)->select();
        foreach ($rst as &$val) {
            $val = $val['type'] == 200 ? $val : $val->hidden(['url']);
        }
        return $rst;
    }
    
    
}

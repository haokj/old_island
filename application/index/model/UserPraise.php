<?php
/*
* 用户点赞模型 
* @date: 2018年8月16日 下午8:40:14
* @author: hkj
*/
namespace app\index\model;

use think\Model;
use app\common\Book;
use app\common\exception\JournalException;

class UserPraise extends Model
{
    /**
     * 判断用户是否点过赞
     * @param int $user_id 用户id
     * @param int $art_id 期刊表id或者图书id
     * @param int $type 类型
     * @return boolean
     */
    public function likeStatus($user_id, $art_id, $type)
    {
        $where['user_id'] = $user_id;
        $where['art_id'] = $art_id;
        $where['type'] = $type;  
        $praise = $this->where($where)->find();
        return $praise ? 1 : 0;
    }
    
    //点赞
    public function postLike($user, $param)
    {
        $this->checkArt($param['art_id'], $param['type']);
        $rst = $this->likeStatus($user->id, $param['art_id'], $param['type']);
        if ($rst) {
            return false;
        } else {
            $model = new self([
                'user_id' => $user->id,
                'art_id' => $param['art_id'],
                'type' => $param['type']
            ]);
            $model->save();
            return true;
        }
    }
    
    //取消点赞
    public function cancelLike($user, $param)
    {
        $this->checkArt($param['art_id'], $param['type']);
        $rst = $this->likeStatus($user->id, $param['art_id'], $param['type']);
        if ($rst) {
            self::where([
                'user_id' => $user->id,
                'art_id' => $param['art_id'],
                'type' => $param['type']
            ])->delete();
            return true;
        } else {
            return false;
        }
    }
    
    //点赞或取消点赞前 检测是否存在这个数据
    private function checkArt($art_id, $type)
    {
        if ($type == 400){
            $book = new Book();
            $book->checkDoubanHasBood($art_id);
        } else {
            $rst = Journal::where('id', $art_id)->where('type', $type)->find();
            if (!$rst) {
                throw new JournalException();
            }
        }
    }
}

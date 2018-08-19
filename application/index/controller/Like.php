<?php
/*
 * 点赞控制器
* @date: 2018年8月18日 下午7:31:50
* @author: hkj
*/
namespace app\index\controller;

use app\common\validate\LikeValidate;
use app\index\model\UserPraise;
use app\common\exception\SuccessException;
use app\common\exception\ErrorException;

class Like extends BaseController
{
    /**
     * 进行点赞
     */
    public function postLike()
    {
        (new LikeValidate())->goCheck();
        $like = new UserPraise();
        $rst = $like->postLike($this->user, input('param.'));
        if ($rst) {
            throw new SuccessException();
        } else {
            throw new ErrorException(['error_code' => 1002, 'msg' => '你已经点过赞了']);
        }
    }
    
    /**
     * 取消点赞
     */
    public function cancelLike()
    {
        (new LikeValidate())->goCheck();
        $like = new UserPraise();
        $rst = $like->cancelLike($this->user, input('param.'));
        if ($rst) {
            throw new SuccessException();
        } else {
            throw new ErrorException(['error_code' => 1003, 'msg' => '你还未点赞']);
        }
    }
}
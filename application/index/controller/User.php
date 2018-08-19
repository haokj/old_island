<?php
/*
 * 用户信息控制器
* @date: 2018年8月18日 下午9:31:23
* @author: hkj
*/
namespace app\index\controller;

use app\index\model\User as UserModel;
use app\common\exception\SuccessException;
use app\common\exception\ErrorException;

class User extends BaseController
{
    public function saveInfo()
    {
        $user = new UserModel();
        $rst = $user->saveInfo($this->user, input('param.userinfo/a'));
        if ($rst) {
            throw new SuccessException();
        } else {
            throw new ErrorException(['msg' => '已经保存过信息了']);
        }
    }
}
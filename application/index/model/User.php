<?php
/*
* 用户模型表 
* @date: 2018年8月15日 下午9:24:59
* @author: hkj
*/
namespace app\index\model;

use think\Model;

class User extends Model
{
    //保存用户微信基本信息
    public function saveInfo($user, $param)
    {
        $num = $this->save([
            'avatar_url' => $param['avatarUrl'],
            'nick_name' => $param['nickName'],
            'city' => $param['city'],
            'country' => $param['country'],
            'gender' => $param['gender'],
            'province' => $param['province']
        ], ['id' => $user->id]);
        if ($num) {
            return true;
        } else {
            return false;
        }
    }
}

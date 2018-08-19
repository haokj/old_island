<?php
/*
* 用户登录，获取令牌控制器
* @date: 2018年8月15日 下午8:30:02
* @author: hkj
*/
namespace app\index\controller;

use think\Controller;
use app\common\validate\CodeValidate;
use app\common\Token;
use app\common\validate\TokenValidate;

class Login extends Controller
{
    /**
     * 根据code获取openid,并生成token令牌
     * @return token
     */
    public function Login()
    {
        (new CodeValidate())->goCheck();
        $token = (new Token())->getToken(input('get.code'));
        return json(['token' => $token]);
    }
    
    /**
     * 检查令牌是否过期
     * @return boolen true过期 false没过期
     */
    public function checkToken()
    {
        (new TokenValidate())->goCheck();
        $rst = (new Token())->checkToken(input('get.token'));
        return json(['isexpire' => !$rst]);
    }
}

<?php
/*
* 验证令牌基础类
* @date: 2018年8月15日 下午11:02:58
* @author: hkj
*/
namespace app\index\controller;

use think\Controller;
use think\Cache;
use app\index\model\User;
use app\common\exception\TokenExpireException;

class BaseController extends Controller
{
    protected $user;    //用户信息
    
    public function __construct()
    {
        $token = input('param.token', '');
        $rst = Cache::get($token);
        if ($rst) {
            $rst = json_decode($rst, true);
            $user = User::where('id', $rst['id'])->find();
            if ($user) {
                $this->user = $user;
            } else {
                throw new TokenExpireException();
            }
        } else {
            throw new TokenExpireException();
        }
        parent::__construct();
    }
}

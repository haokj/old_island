<?php
/*
* 令牌相关操作类
* @date: 2018年8月15日 下午8:41:16
* @author: hkj
*/
namespace app\common;

use app\common\exception\CodeException;
use app\index\model\User;
use think\Cache;
use app\common\exception\CacheException;

class Token
{
    /**
     * 生成令牌
     * @param unknown $code
     */
    public function getToken($code)
    {
        if ($code) {
            $url = sprintf(config('mini.get_openid_url'), config('mini.appid'), config('mini.appsecrte'), $code);
            $rst = Util::http($url, 'GET'); //请求微信服务器获取openid
            $rst = json_decode($rst, true);
            if (array_key_exists('errcode', $rst)) {
                throw new CodeException();
            }
            //返回正确openid，存入数据库
            if (array_key_exists('openid', $rst)) {
                return $this->openidToDB($rst);
            }
            return false;
        }
    }
    
    /**
     * 检测令牌是否过期
     */
    public function checkToken($token)
    {
        $rst = Cache::get($token);
        if (!$rst) {
            return false;
        }
        return true;
    }
    
    //openid入库
    private function openidToDB($param)
    {
        $user = new User();
        $rst = $user->where('openid', $param['openid'])->find();
        if ($rst) {    //数据库中有此用户
            $id = $rst->id;
        } else {
            $user->openid = $param['openid'];
            $user->save();
            $id = $user->id;
        }
        $data = [
            'openid' => $param['openid'],
            'id' => $id
        ];
        return $this->createToken($data);
    }
    
    //生成令牌
    private function createToken($data)
    {
        $token = md5(config('mini.salt').$data['openid'].time());
        $rst = Cache::set($token, json_encode($data), config('cache.expire'));
        if ($rst) {
            return $token;
        } else {
            throw new CacheException();
        }
    }
    
    
}

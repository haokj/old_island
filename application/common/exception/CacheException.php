<?php
/*
* 缓存出错返回信息 
* @date: 2018年8月15日 下午9:40:34
* @author: hkj
*/
namespace app\common\exception;

class CacheException extends BaseException
{
    public $error_code = 2001;  
    public $msg = '令牌缓存出错';
    public $code = 400;
}

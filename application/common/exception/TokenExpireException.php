<?php
/*
* 令牌过期错误信息 
* @date: 2018年8月15日 下午11:11:32
* @author: hkj
*/
namespace app\common\exception;

class TokenExpireException extends BaseException
{
    public $error_code = 2002;  //默认参数错误
    public $msg = '令牌过期';
    public $code = 401;
}

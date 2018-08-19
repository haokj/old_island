<?php
/*
* code换取openid错误返回 
* @date: 2018年8月15日 下午9:16:11
* @author: hkj
*/
namespace app\common\exception;

class CodeException extends BaseException
{
    public $error_code = 2000;  
    public $msg = 'code码换取openid时出错';
    public $code = 400;
}

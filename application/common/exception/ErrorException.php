<?php
/*
 * 操作失败时范湖数据
* @date: 2018年8月18日 下午7:41:26
* @author: hkj
*/
namespace app\common\exception;

class ErrorException extends BaseException
{
    public $error_code = 1000;  
    public $msg = 'fail';
    public $code = 400;
}
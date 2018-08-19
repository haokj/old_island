<?php
/*
* @date: 2018年8月14日 下午8:47:54
* @author: hkj
*/
namespace app\common\exception;

class ParametersException extends BaseException
{
    public $error_code = 1000;  //默认参数错
    public $msg = '参数错误';
    public $code = 400;
}

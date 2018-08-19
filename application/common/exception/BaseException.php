<?php
/**
* 规定验证参数错误成员属性 
* @date: 2018年8月13日 下午9:50:16
* @author: hkj
*/
namespace app\common\exception;

use think\exception\ValidateException;

class BaseException extends ValidateException
{
    public $error_code = 1000;  //默认参数错误
    public $msg = '';
    public $code = 400;
    
    public function __construct($param = [])
    {
        if (array_key_exists('error_code', $param)) {
            $this->error_code = $param['error_code'];
        }
        if (array_key_exists('msg', $param)) {
            $this->msg = $param['msg'];
        }
        if (array_key_exists('code', $param)) {
            $this->code = $param['code'];
        }
    }
}
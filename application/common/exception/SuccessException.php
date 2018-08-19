<?php
/*
 * 操作成功后返回的信息，操作一般包括添加、删除等操作
* @date: 2018年8月18日 下午3:24:42
* @author: hkj
*/
namespace app\common\exception;

class SuccessException extends BaseException
{
    public $error_code = 0;  
    public $msg = 'ok';
    public $code = 201; //默认是创建成功
}

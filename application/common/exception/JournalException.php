<?php
/*
 * 期刊内容不存在错误信息
* @date: 2018年8月16日 下午9:45:25
* @author: hkj
*/
namespace app\common\exception;

class JournalException extends BaseException
{
    public $error_code = 3000;  
    public $msg = '期刊内容不存在';
    public $code = 404;
}

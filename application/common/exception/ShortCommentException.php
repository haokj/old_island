<?php
/*
 * 操作短评失败返回信息 如添加、更新、删除等
* @date: 2018年8月18日 下午3:27:57
* @author: hkj
*/
namespace app\common\exception;

class ShortCommentException extends BaseException
{
    public $error_code = 1001; 
    public $msg = '添加短评失败';
    public $code = 400;
}

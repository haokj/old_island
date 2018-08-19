<?php
/*
 * 获取豆瓣数据错误
* @date: 2018年8月17日 上午12:18:44
* @author: hkj
*/
namespace app\common\exception;

use app\common\exception\BaseException;

class DoubanException extends BaseException
{
    public $error_code = 4000;  
    public $msg = '获取豆瓣api数据出错';
    public $code = 400;
}

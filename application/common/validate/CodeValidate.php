<?php
/*
* 微信登录code码验证
* @date: 2018年8月15日 下午8:33:32
* @author: hkj
*/
namespace app\common\validate;

class CodeValidate extends BaseValidate
{
    protected $rule = [
        'code' => 'require'
    ];
    
    protected $message = [
        'code.require' => 'code参数不能为空'
    ];
}

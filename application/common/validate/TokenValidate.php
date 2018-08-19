<?php
/*
* 令牌token检测 
* @date: 2018年8月15日 下午10:45:48
* @author: hkj
*/
namespace app\common\validate;

class TokenValidate extends BaseValidate
{
    protected $rule = [
        'token' => 'require'
    ];
    
    protected $message = [
        'token.require' => 'token参数必传'
    ];
}

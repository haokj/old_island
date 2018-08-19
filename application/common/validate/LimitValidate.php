<?php
/*
 * 分页参数校验
* @date: 2018年8月16日 下午11:09:27
* @author: hkj
*/
namespace app\common\validate;

class LimitValidate extends BaseValidate
{
    protected $rule = [
        'start' => 'checkInt',
        'count' => 'checkInt'
    ];
    
    protected $message = [
        'start.checkInt' => '页码参数必须是正整数',
        'count.checkInt' => '内容条数必须是正整数'
    ];
}

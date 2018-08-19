<?php
/*
 * 搜索图书参数校验
* @date: 2018年8月18日 下午6:31:53
* @author: hkj
*/
namespace app\common\validate;

class SearchBookValidate extends BaseValidate
{
    protected $rule = [
        'start' => 'checkLgtZero',
        'count' => 'checkLgtZero',
        'summary' => 'in:0,1',
        'q' => 'require'
    ];
    
    protected $message = [
        'start.checkLgtZero' => 'start必须是大于等于0的整数',
        'count.checkLgtZero' => 'count须是大于等于0的整数'
    ];
}

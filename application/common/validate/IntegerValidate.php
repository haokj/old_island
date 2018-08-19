<?php
/*
* @date: 2018年8月14日 下午8:26:23
* @author: hkj
*/
namespace app\common\validate;

class IndexValidate extends BaseValidate
{
    protected $rule = [
        'index' => [
            'require', 'between'=>'1,10', 'checkInt'
        ],
        'age' => [
            'between'=>'1,10','require'
        ]
    ];
    
    protected $message = [
        'index.require' => 'index参数必填',
        'index.checkInt' => 'index参数必须是正整数',
        'age.between' => '数值范围必须在1-10间'
    ];
    
}

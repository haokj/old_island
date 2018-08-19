<?php
/*
 * 期刊号index参数校验
* @date: 2018年8月16日 下午9:07:22
* @author: hkj
*/
namespace app\common\validate;

class IndexValidate extends BaseValidate
{
    protected $rule = [
        'index' => 'require|checkInt'
    ];
    
    protected $message = [
        'index.require' => '期刊号index必传',
        'index.checkInt' => '期刊号index必须是正整数'
    ];
}

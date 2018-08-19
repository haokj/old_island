<?php
/*
 * 获取点赞信息参数校验
* @date: 2018年8月16日 下午10:44:18
* @author: hkj
*/
namespace app\common\validate;

class FavorValidate extends BaseValidate
{
    protected $rule = [
        'id' => 'require|checkInt',
        'type' => 'require|in:100,200,300,400'
    ];
    
    protected $message = [
        'id.require' => 'id参数必传',
        'id.checkInt' => 'id参数必须是正整数',
        'type.require' => 'type参数必传',
        'type.in' => 'type数值为100,200,300,400一种'
    ];
}

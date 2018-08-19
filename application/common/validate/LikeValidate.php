<?php
/*
 * 点赞参数校验
* @date: 2018年8月18日 下午7:35:11
* @author: hkj
*/
namespace app\common\validate;

class LikeValidate extends BaseValidate
{
    protected $rule = [
        'art_id' => 'require|checkInt',
        'type' => 'require|in:100,200,300,400'
    ];
    
    protected $message = [
        'art_id.checkInt' => 'art_id必须是正整数'
    ];
}
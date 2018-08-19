<?php
/*
 * 增加短评数据校验
* @date: 2018年8月18日 下午2:57:23
* @author: hkj
*/
namespace app\common\validate;

class AddCommentValidate extends BaseValidate
{
    protected $rule = [
        'book_id' => 'require|checkInt',
        'content' => 'require|length:1,12'
    ];
    protected $message = [
        'content.length' => '评论内容必须是1-12字之间'
    ];
}

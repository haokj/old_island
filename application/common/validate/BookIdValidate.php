<?php
/*
 * 书籍id参数校验
* @date: 2018年8月18日 下午1:30:59
* @author: hkj
*/
namespace app\common\validate;

use app\common\validate\BaseValidate;

class BookIdValidate extends BaseValidate
{
    protected $rule = [
        'book_id' => 'require|checkInt'
    ];
    
    protected $message = [
        'book_id.require' => 'book_id参数必传',
        'book_id.checkInt' => 'book_id必须是正整数'
    ];
}

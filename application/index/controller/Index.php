<?php
namespace app\index\controller;

use app\common\validate\BaseException;
use think\Validate;
use app\common\validate\IntegerValidate;

class Index
{
    public function index()
    {
        echo '旧岛项目';
//         throw new BaseException([
//             'error_code' => 1001,
//             'msg' => '测试'
//         ]);
    }
}

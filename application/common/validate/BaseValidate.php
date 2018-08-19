<?php
/*
* 基础验证类 
* @date: 2018年8月14日 下午8:40:06
* @author: hkj
*/
namespace app\common\validate;

use think\Validate;
use app\common\exception\ParametersException;

class BaseValidate extends Validate
{
    protected $message = [];
    protected $rule = [];
    protected $sigleRole = [];

    public function goCheck()
    {
//         $validate = new self($this->rule, $this->message);
//         dump($validate);die;
        $rst = $this->batch()->check(input('param.'));
        if (!$rst) {
            throw new ParametersException([
                'msg' => implode(';', $this->getError())
            ]);
        }
    }
    //正整数
    protected function checkInt($value, $rule, $data)
    {
        if (is_numeric($value) && ($value+0)>0 && is_int($value+0)) {
            return true;
        } 
        return false;
    }
    //大于等于0的整数
    protected function checkLgtZero($value, $rule, $data)
    {
        if (is_numeric($value) && ($value+0)>=0 && is_int($value+0)) {
            return true;
        }
        return false;
    }
    
}

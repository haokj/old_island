<?php
/**
 * http请求异常处理
 * @date: 2018年8月13日 下午9:32:33
 * @author: hkj
 */
namespace app\common\exception;

use think\exception\Handle;
use think\exception\ValidateException;
use think\Request;
use think\exception\HttpException;
use think\Exception;
use think\exception\ErrorException;
use think\Log;

class Http extends Handle
{
    public function render(\Exception $e)
    {
        $request = Request::instance();
        if ($e instanceof ValidateException) {  //传参错误
            $error_code = $e->error_code;
            $msg = $e->msg;
            $code = $e->code;
        } elseif ($e instanceof HttpException) {
            $error_code = 999;
            $msg = $e->getMessage();
            $code = $e->getStatusCode();
        } else {
            $this->errorToLog($e);
            $error_code = 888;
            $msg = '后台出错了！';
            $code = 500;
        }
//         return parent::render($e);
        return json([
            'error_code' => $error_code,
            'msg' => $msg,
            'request' => $request->method().' '.$request->baseUrl()
        ], $code);
    }
    
    /**
     * 将系统代码错误记录日志中
     * @param ErrorException $e
     */
    private function errorToLog($e)
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  APP_PATH.'../runtime/error_log/'
        ]);
        Log::write(date('Y-m-d H:i:s').' 错误文件：'.$e->getFile().' 错误行数：'.$e->getLine().' 错误信息：'.$e->getMessage());
    }
}

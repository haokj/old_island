<?php
/*
 * 基础类库
* @date: 2018年8月17日 上午12:05:37
* @author: hkj
*/
namespace app\common;

class Util
{
    //curl请求
    public static function http($url, $method = 'POST', $data = [], $check = false)
    {
        if (stripos($url, 'http://') !== 0 && stripos($url, 'https://') !== 0) {
            return '';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        if (!$check) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            if (!empty($data))
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $rst = curl_exec($ch);
        curl_close($ch);
        return $rst;
    }
}
<?php
/*
* 小程序配置文件 
* @date: 2018年8月15日 下午8:39:24
* @author: hkj
*/
return [
    'appid' => 'wxa15cafd3feadd6e2',
    'appsecrte' => '494a14a5541ff7789d9adbaf8ded8115',
    //获取openid的url
    'get_openid_url' => 'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code',
    //生成令牌的盐
    'salt' => 'haokuangjie'
];

<?php
use think\Route;

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];

//令牌相关路由
Route::group('login', [
    'login' => ['index/login/login', ['method' => 'get']],  //获取令牌
    'check' => ['index/login/checkToken', ['method' => 'get']],  //检查令牌是否过期
]);

Route::post('save/user_info', 'index/user/saveInfo'); //保存用户基本信息

//期刊路由
Route::group('classic', [
    'latest' => ['index/journal/new'], //获取最新一期期刊
    ':index/next' => ['index/journal/next'],   //获取当前一期下一期刊
    ':index/previous' => ['index/journal/previous'],   //获取当前一期上一期刊
    ':type/:id$' => ['index/journal/detail'],   //获取某一期详细信息
    ':type/:id/favor' => ['index/journal/favor'],   //获取某一期刊或图书点赞信息
    'favor' => ['index/journal/favorList'],   //获取我喜欢的期刊列表
],['method' => 'get']);

//图书路由
Route::group('book', [
    'hot_list' => ['index/book/hotList', ['method' => 'get']],   //热门书籍
    ':book_id/short_comment' => ['index/book/shortComment', ['method' => 'get']],   //书籍短评
    'favor/count' => ['index/book/favorCount', ['method' => 'get']],   //我喜欢书籍数量
    ':book_id/favor' => ['index/book/bookFavor', ['method' => 'get']],   //书籍点赞情况
    'add/short_comment' => ['index/book/addShortComment', ['method' => 'post']],   //新增短评
    'hot_keyword' => ['index/book/hotKeyword', ['method' => 'get']],   //热搜关键字
    'search' => ['index/book/search', ['method' => 'get']],   //热搜关键字
    ':book_id/detail' => ['index/book/bookDetail', ['method' => 'get']],   //热搜关键字
]);

//点赞路由
Route::group('like', [
    'cancel' => ['index/like/cancelLike', ['method' => 'post']],   //取消点赞
    '' => ['index/like/postLike', ['method' => 'post']],   //点赞
]);

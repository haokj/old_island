<?php
/*
 * 豆瓣api接口配置
* @date: 2018年8月17日 上午12:09:33
* @author: hkj
*/
return [
    //热门书籍url
    'hot_list' => 'https://api.douban.com/v2/book/search?q=推荐',
    //某一图书信息url
    'the_book' => 'https://api.douban.com/v2/book/%s',
    //搜索图书url
    'search_book' => 'https://api.douban.com/v2/book/search',
];
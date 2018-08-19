<?php
/*
 * 图书控制器
* @date: 2018年8月17日 上午12:01:00
* @author: hkj
*/
namespace app\index\controller;

use app\common\Book as BookService;
use app\common\validate\BookIdValidate;
use app\common\validate\AddCommentValidate;
use app\common\exception\SuccessException;
use app\common\exception\ShortCommentException;
use app\common\validate\SearchBookValidate;

class Book extends BaseController
{
    /**
     * 获取热门书籍
     */
    public function hotList()
    {
        $bookserve = new BookService(); 
        $rst = $bookserve->getHotList($this->user);
        return json($rst);
    }
    
    /**
     * 获取书籍短评
     */
    public function shortComment()
    {
        (new BookIdValidate())->goCheck();
        $bookserve = new BookService();
        $rst = $bookserve->getShortComment(input('param.book_id'));
        return json($rst);
    }
    
    /**
     * 获取我喜欢的书籍数量
     */
    public function favorCount()
    {
        $bookserve = new BookService();
        $rst = $bookserve->getFavorCount($this->user);
        return json($rst);
    }
    
    /**
     * 获取书籍点赞情况
     */
    public function bookFavor()
    {
        $bookserve = new BookService();
        $rst = $bookserve->getBookFavor($this->user, input('param.book_id'));
        return json($rst);
    }
    
    /**
     * 新增短评
     */
    public function addShortComment()
    {
        (new AddCommentValidate())->goCheck();
        $bookserve = new BookService();
        $rst = $bookserve->addShortComment($this->user, input('param.'));
        if ($rst) {
            throw new SuccessException(['code' => 201]);
        } else {
            throw new ShortCommentException(['error_code' => 1001, 'msg' => '添加短评失败，请稍后重试']);
        }
    }
    
    /**
     * 获取热搜关键字
     */
    public function hotKeyword()
    {
        $bookserve = new BookService();
        $rst = $bookserve->getHotKeyword();
        return json($rst);
    }
    
    /**
     * 搜索图书
     */
    public function search()
    {
        (new SearchBookValidate())->goCheck();
        $bookserve = new BookService();
        $rst = $bookserve->getSearchBook(input('param.'));
        return json($rst);
    }
    
    /**
     * 获取某一个图书详细信息
     */
    public function bookDetail()
    {
        (new BookIdValidate())->goCheck();
        $bookserve = new BookService();
        $rst = $bookserve->getBookDetail(input('param.book_id'));
        return json($rst);
    }
    
}

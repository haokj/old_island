<?php
/*
* 期刊控制器 
* @date: 2018年8月14日 下午10:43:40
* @author: hkj
*/
namespace app\index\controller;

use think\Controller;
use app\index\model\Journal as JournalModel;
use app\common\validate\IndexValidate;
use app\common\exception\JournalException;
use app\common\validate\DetailJouranlValidate;
use app\common\validate\FavorValidate;
use app\common\validate\LimitValidate;

class Journal extends BaseController
{
    /**
     * 获取最新一期期刊
     * @return json
     */
    public function new()
    {
        $journal = new JournalModel();
        $rst = $journal->getNew($this->user);
        return json($rst, 200);
    }
    
    /**
     * 获取当前一期下一期刊
     */
    public function next()
    {
        (new IndexValidate())->goCheck();
        $journal = new JournalModel();
        $rst = $journal->getNextOrPrev($this->user, input('param.index'));
        if ($rst) {
            return json($rst);
        } else {
            throw new JournalException();
        }
    }
    
    /**
     * 获取当前一期的上一期刊
     */
    public function previous()
    {
        (new IndexValidate())->goCheck();
        $journal = new JournalModel();
        $rst = $journal->getNextOrPrev($this->user, input('param.index'), 'prev');
        if ($rst) {
            return json($rst);
        } else {
            throw new JournalException();
        }
    }
    
    /**
     * 获取某一期详细信息
     */
    public function detail()
    {
        (new DetailJouranlValidate())->goCheck();
        $journal = new JournalModel();
        $rst = $journal->getDetail($this->user, input('param.id'), input('param.type'));
        if ($rst) {
            return json($rst);
        } else {
            throw new JournalException();
        }
    }
    
    /**
     * 获取期刊或图书的点赞信息
     */
    public function favor()
    {
        (new FavorValidate())->goCheck();
        $journal = new JournalModel();
        $rst = $journal->getFavor($this->user, input('param.id'), input('param.type'));
        return json($rst);
    }
    
    /**
     * 获取我喜欢的期刊列表
     */
    public function favorList()
    {
        (new LimitValidate())->goCheck();
        $journal = new JournalModel();
        $rst = $journal->getFavorList($this->user, input('get.start', 1), input('get.count', 20));
        return json($rst);
    }
}

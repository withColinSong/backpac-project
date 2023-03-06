<?php

namespace entity;

class Page {

    private $totalColumn;       // 총 컬럼 수
    private $nowPage;           // 현재 페이지
    private $pageNum;           // 한 페이지 컬럼 수
    private $blockNum;          // 판 페이지의 블럭 수

    private $totalPage;         // 총 페이지
    private $totalBlock;        // 총 블럭
    private $nowBlock;          // 현재 페이지의 블럭
    private $startPage;         // 가져올 페이지의 시작번호
    private $lastPage;          // 가져올 마지막 페이지 번호
    private $prevPage;          // 이전 블럭 이동시 첫 페이지
    private $nextPage;          // 다음 블럭 이동시 첫 페이지

    public function __construct() { }

    function setPaging($totalCol, $nowPage, $pageNum, $blockNum) {

        $this->totalColumn  = $totalCol;
        $this->nowPage      = $nowPage;
        $this->pageNum      = $pageNum;
        $this->blockNum     = $blockNum;

        $this->init();
        return $this->value();
    }

    protected function value() {
        $arr = array(
                    "page" =>
                        array(
                            "totalPage" => $this->totalPage,
                            "totalBlock" => $this->totalBlock,
                            "nowBlock" => $this->nowBlock,
                            "startPage" => $this->startPage,
                            "lastPage" => $this->lastPage,
                            "prevPage" => $this->prevPage,
                            "nextPage" => $this->nextPage,
                        ),
                );

        return $arr;
    }

    protected function init() {
        $this->totalPage    = ceil($this->totalColumn / $this-> pageNum);
        $this->totalBlock   = ceil($this->totalPage / $this->blockNum);
        $this->nowBlock     = ceil($this->nowPage / $this->blockNum);
        $this->startPage    = ($this->nowBlock * $this->blockNum) - ($this->blockNum - 1);
        $this->lastPage     = ($this->nowBlock * $this->blockNum);
        $this->prevPage     = ($this->nowBlock * $this->blockNum) - $this->blockNum;
        $this->nextPage     = ($this->nowBlock * $this->blockNum) + 1;
    }

}
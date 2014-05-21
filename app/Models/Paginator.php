<?php

namespace Models;

define('ITEMS_PER_PAGE', 9);

class Paginator extends \Wee\Model {
    
    protected $current;
    protected $count;
    protected $perpage;
    protected $pages;
    
    public function __construct() {
        
    }
    
    public function getCurrent() {
        return $this->current;
    }

    public function getCount() {
        return $this->count;
    }

    public function getPerpage() {
        return $this->perpage;
    }
    
    public function getPages() {
        return $this->pages;
    }

    public function setCurrent($current) {
        $this->current = $current;
    }
    
    public function setCount($count) {
        $this->count = $count;
    }

    public function setPerpage() {
        $this->perpage = ITEMS_PER_PAGE;
    }

    public function setPages() {
        if ($this->getCount() % $this->getPerpage() == 0) {
            $this->pages = $this->getCount() / $this->getPerpage();
        }
        else {
            $this->pages = intval($this->getCount() / $this->getPerpage()) + 1;
        }
    }

}


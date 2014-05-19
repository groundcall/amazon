<?php

namespace Models;

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

    public function setCount($type) {
        if ($type == 'Product') {
            $productDao = \Wee\DaoFactory::getDao('Product');
            $numberOfProducts = $productDao->getProductCount();
            $this->count = $numberOfProducts;
        }
        if ($type == 'User') {
            $userDao = \Wee\DaoFactory::getDao('User');
            $numberOfUsers = $userDao->getUserCount();
            $this->count = $numberOfUsers;
        }
    }
    
    public function setItemsCount($number) {
        $this->count = $number;
    }

    public function setPerpage($type) {
        if ($type == 'Product') {
            $this->perpage = 10;
        }
        if ($type == 'User') {
            $this->perpage = 2;
        }
    }
    
    public function setItemsPerpage() {
        $this->perpage = 3;
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


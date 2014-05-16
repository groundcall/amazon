<?php

namespace Helpers;

trait ApplicationHelper {

    //use UserHelper;
    //use ProfileHelper;
    public function errorFor($object, $name) {
        if ($object->hasError($name)) {
            return implode(", ", $object->getError($name));
        }
        return '';
    }
    
    public function getCategories() {
        $categoryDao = \Wee\DaoFactory::getDao('Category');
        $categories = $categoryDao->getAllCategories();
        return $categories;
    }
    
    public function numberOfProducts() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $numberOfProducts = $productDao->getProductCount();
        return $numberOfProducts;
    }
    
    public function numberOfProductPages() {
        $productPerPage = 10;
        if ($this->numberOfProducts() % $productPerPage == 0) {
            $numberOfPages = $this->numberOfProducts() / $productPerPage;
        }
        else {
            $numberOfPages = intval($this->numberOfProducts() / $productPerPage) + 1;
        }
        return $numberOfPages;
    }
    
    public function numberOfUsers() {
        $userDao = \Wee\DaoFactory::getDao('User');
        $numberOfUsers = $userDao->getUserCount();
        return $numberOfUsers;
    }
    
    public function numberOfUserPages() {
        $userPerPage = 2;
        if ($this->numberOfUsers() % $userPerPage == 0) {
            $numberOfPages = $this->numberOfUsers() / $userPerPage;
        }
        else {
            $numberOfPages = intval($numberOfPages = $this->numberOfUsers() / $userPerPage) + 1;
        }
        return $numberOfPages;
    }
}

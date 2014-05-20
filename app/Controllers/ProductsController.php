<?php

namespace Controllers;

class ProductsController extends \Wee\Controller {

    public function index() {
        $this->render('users/homepage');
    }

    public function category() {
        $categoryDao = \Wee\DaoFactory::getDao('Category');
        $category = $categoryDao->getCategoryById($_GET['category']);
        $this->render('users/category', array('category'=>$category));
    }

    public function search() {
        $this->render('users/search');
    }
}

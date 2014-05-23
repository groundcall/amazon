<?php

namespace Controllers;

class CartController extends \Wee\Controller {

    public function index() {
        $this->render('users/cart');
    }
     public function addCartItemToCart(){

//        $this->redirect('products/show_products');
//        var_dump($_POST);
//     die();   
    }
}


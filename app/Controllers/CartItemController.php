<?php

namespace Controllers;

class CartItemController extends \Wee\Controller {

    public function index() {
        $this->render('users/cart');
    }
}
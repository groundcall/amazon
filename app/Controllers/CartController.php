<?php

namespace Controllers;

class CartController extends \Wee\Controller {

    public function index() {
        $this->render('users/cart');
    }
}


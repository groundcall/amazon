<?php

namespace Controllers;

class CheckoutController extends \Wee\Controller {

    public function index() {
        $userDao = \Wee\DaoFactory::getDao('User');
        $user = $userDao->getUserById($_SESSION['id']);
        $this->render('users/checkout_billing', array('user' => $user));
    }
    
    public function add() {
        var_dump($_POST); die();
    }
}


<?php

namespace Controllers;

class DashboardController extends \Wee\Controller {

    public function index() {
        $this->redirect('dashboard/account_dashboard');
    }

    public function accountDashboard() {

        $userDao = \Wee\DaoFactory::getDao('User');
        $user = $userDao->getUserById($_SESSION['id']);
        
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartById($_SESSION['cart_id']);
        
        $user->setCart($cart);
        
        $this->render('users/dashboard', array('user' => $user));
    }
    
    public function accountInformation(){
        
    }
    
    public function myOrders(){
        
    }

    public function billingAddress(){
        
    }
    
    public function shippingAddress(){
        
    }
}

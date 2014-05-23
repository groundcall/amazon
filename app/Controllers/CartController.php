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
    
    public function showCart() {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartByUserId($_SESSION['id']);
        $cartItems = $cart->getCart_item();
        $this->render('users/cart', array('cartItems' => $cartItems));
    }
    
    public function manageCart() {
        if (isset($_POST['empty_cart'])) {
            $this->clearCart();
        }
    }
    
    private function clearCart() {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartByUserId($_SESSION['id']);
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->removeAllCartItemsByCartId($cart->getId());
        $this->render('users/cart');
    }
}


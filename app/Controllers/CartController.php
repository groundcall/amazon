<?php

namespace Controllers;

class CartController extends \Wee\Controller {

    public function index() {
        $this->render('users/cart');
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

    public function addCartItemToCart() {
        $product_id = $_POST['product_id'];
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartByUserId($_SESSION['id']);

        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->addCartItemToCart($product_id, $cart->getId());

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function deleteCartItemFromCart() {
        $cart_item_id = $_GET['cart_item_id'];
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartByUserId($_SESSION['id']);

        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->deleteCartItemFromCart($cart_item_id);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

}

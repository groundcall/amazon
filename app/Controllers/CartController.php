<?php

namespace Controllers;

class CartController extends \Wee\Controller {

    public function initialize() {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        if (empty($_SESSION['cart_id'])) {
            $this->cart = new \Models\Cart();
            if (isset($_SESSION['id'])) {
                $cartDao->addCart($_SESSION['id']);
            } else {
                $cartDao->addCart(0);
            }
            $_SESSION['cart_id'] = $cartDao->getLastInsertedCart();
        }
        $this->cart = $this->getCartById($_SESSION['cart_id']);
    }

    public function index() {
        
        $this->render('users/cart');
    }

    private function getCartById($cart_id) {
        
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartById($cart_id);
        return $cart;
    }

    public function showCart() {

        $cart = $this->getCartById($_SESSION['cart_id']);
        $this->render('users/cart', array('cart' => $cart));
    }

    public function manageCart() {
        
        if (isset($_POST['empty_cart'])) {
            $this->clearCart();
        }
        if (isset($_POST['remove'])) {
            $this->removeCartItem();
        }
        if (isset($_POST['update_qty'])) {
            $this->updateCart();
        }
    }

    private function clearCart() {
        
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->removeAllCartItemsByCartId($this->cart->getId());
        $this->cart->calculateTotal();
        $_SESSION['updated_qty'] = 1;
        $this->redirect('cart/show_cart');
    }

    private function removeCartItem() {
        
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->removeCartItemById($_POST['remove'], $cart->getId());
        $this->cart->calculateTotal();
        $_SESSION['updated_qty'] = 1;
        $this->showCart();
    }

    private function updateCart() {

        $cartItems = $this->cart->getCart_item();
        $quantities = $_POST['cart'];
        $items = $this->cart->updateQuantities($cartItems, $quantities);
        $this->cart->calculateTotal();
        $this->cart->setCart_items($items);
        $this->render('users/cart', array('cart' => $this->cart));
    }

    public function addItem() {
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
        $this->cart->addCartItem($_POST['product_id'], $quantity);
        $this->redirectToUrl($_SERVER['HTTP_REFERER']);
    }

    public function deleteCartItemFromCart() {
        
        $cart_item_id = $_GET['cart_item_id'];
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->deleteCartItemFromCart($cart_item_id, $this->cart->getId());
        $this->redirectToUrl($_SERVER['HTTP_REFERER']);
    }

}

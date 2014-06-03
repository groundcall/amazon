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
        $this->cart = $cartDao->getCartById($_SESSION['cart_id']);
    }

    public function index() {
        $this->render('users/cart');
    }

    public function showCart() {        
        if (isset($_GET['cart_id'])) {
            $_SESSION['cart_id'] = $_GET['cart_id'];
            $cartDao = \Wee\DaoFactory::getDao('Cart');
            $cartDao->activateCart($_GET['cart_id'], $_SESSION['id']);
        }
        $this->initialize();

        $this->render('users/cart', array('cart' => $this->cart));
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
        $this->cart->removeCartItems();

        $_SESSION['updated_qty'] = 1;
        $this->redirect('cart/show_cart');
    }

    private function removeCartItem() {
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->removeCartItemById($_POST['remove'], $this->cart->getId());
        $this->cart->calculateTotal();
        $_SESSION['updated_qty'] = 1;
        $this->redirectToUrl($_SERVER['HTTP_REFERER']);
    }

    private function updateCart() {
        $quantities = $_POST['cart'];
        $this->cart->updateQuantities($this->cart, $_POST['cart']);
        $this->render('users/cart', array('cart' => $this->cart));
    }

    public function addItem() {
        $this->cart->addCartItem($_POST['product_id'], 1);
        $this->redirectToUrl($_SERVER['HTTP_REFERER']);
    }

    public function addItemQuantity() {
        $_SESSION['previous_url'] = $_SERVER['HTTP_REFERER'];

        $this->cart->addCartItem($_POST['product_id'], $_POST['quantity']);

        $productDao = \Wee\DaoFactory::getDao('Product');
        $product = $productDao->getProductById($_POST['product_id']);
        $randomProducts = $productDao->getRandomProducts($_POST['product_id'], 4);

        $this->render('users/product_detail', array('product' => $product, 'randomProducts' => $randomProducts, 'cart' => $this->cart));
    }

    public function deleteCartItemFromCart() {
        $cart_item_id = $_GET['cart_item_id'];
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->deleteCartItemFromCart($cart_item_id, $this->cart->getId());
        $this->redirectToUrl($_SESSION['previous_url']);
    }

    public function activateCart() {
        $cart_id = $_POST['cart_id'];
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cartDao->activateCart($cart_id, $_SESSION['id']);

        $_SESSION['cart_id'] = $cart_id;

        $this->redirectToUrl($_SERVER['HTTP_REFERER']);
    }

    public function deleteCart() {
        $cart_id = $_POST['cart_id'];
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cartDao->deleteCartById($cart_id);
        $this->redirectToUrl($_SERVER['HTTP_REFERER']);
    }

}

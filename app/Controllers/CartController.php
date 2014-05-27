<?php

namespace Controllers;

class CartController extends \Wee\Controller {

    public function index() {
        $this->createCartIfNoCart();
        $this->render('users/cart');
    }

    private function getCartById($cart_id) {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartById($cart_id);
        return $cart;
    }

    public function showCart() {

        $this->createCartIfNoCart();
        $cart = $this->getCartById($_SESSION['cart_id']);
        $cartItems = $cart->getCart_item();
        $this->render('users/cart', array('cartItems' => $cartItems));
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
        $cart = $this->getCartById($_SESSION['cart_id']);
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->removeAllCartItemsByCartId($cart->getId());
        $cartDao = $cartItemDao = \Wee\DaoFactory::getDao('Cart');
        $cartDao->setCartTotalByCartId($cart->getId(), 0);
        $_SESSION['updated_qty'] = 1;
        $this->render('users/cart');
    }

    private function removeCartItem() {
        $cart = $this->getCartById($_SESSION['cart_id']);
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->removeCartItemById($_POST['cart_item_id'], $cart->getId());
        $cartDao = $cartItemDao = \Wee\DaoFactory::getDao('Cart');
        $cartDao->calculateCartTotal($cart->getId());
        $_SESSION['updated_qty'] = 1;
        $this->showCart();
    }

    private function updateCart() {
        $items = array();
        $_SESSION['updated_qty'] = 0;
        $cart = $this->getCartById($_SESSION['cart_id']);
        $cartDao = $cartItemDao = \Wee\DaoFactory::getDao('Cart');
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItems = $cartItemDao->getAllCartItemsByCartId($cart->getId());
        foreach ($cartItems as $cartItem) {
            $cartItem->setQuantity($_POST['cart'][$cartItem->getId()]);
            if ($cartItem->isValid()) {
                $cartItemDao->updateCartItem($cartItem);
                $items[] = $cartItemDao->getCartItemById($cartItem->getId());
                $_SESSION['updated_qty'] = 1;
            } else {
                $items[] = $cartItem;
            }
        }
        $cartDao->calculateCartTotal($cart->getId());
        $this->render('users/cart', array('cartItems' => $items));
    }

    public function addCartItemToCart() {

        $cartItem = new \Models\CartItem();
        isset($_POST['quantity']) ? $quantity = $_POST['quantity'] : $quantity = 1;

        $cartItem->setQuantity($quantity);
        $cartItem->setProduct($_POST['product_id']);

        $cartDao = \Wee\DaoFactory::getDao('Cart');
//        $cart = $cartDao->getCartById($_SESSION['id']);
        $cart = $cartDao->getCartById($_SESSION['cart_id']);
        $cartItem->setCart($cart->getId());

        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
//        $item = $cartItemDao->getCartItemByProductId($cartItem->getProduct_id());
        $item = $cartItemDao->getCartItemByProductIdAndCartId($cartItem->getProduct_id(), $_SESSION['cart_id']);

        if ($item) {

            $cartItem->setQuantity($item->getQuantity() + $quantity);
            $cartItem->setId($item->getId());
            if ($cartItem->isValid()) {
                $cartItemDao->updateCartItem($cartItem);
                $_SESSION['add_status'] = 'ok';
            } else {

                $_SESSION['add_status'] = $cartItem->getError('quantity');
            }
        } else {

            if ($cartItem->isValid()) {
                $cartItemDao->addCartItemToCart($cartItem);
                $_SESSION['add_status'] = 'ok';
            } else {
                $_SESSION['add_status'] = $cartItem->getError('quantity');
            }
        }
        $cartDao->calculateCartTotal($cart->getId());
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function deleteCartItemFromCart() {
        $cart_item_id = $_GET['cart_item_id'];
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartById($_SESSION['cart_id']);

        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->deleteCartItemFromCart($cart_item_id);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function createCartIfNoCart() {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        if ($_SESSION['cart_id'] == null) {
            $cart = new \Models\Cart();
            if (isset($_SESSION['user_id'])) {
                $query_id = $cartDao->addCart($_SESSION['id']);
            } else {
                $query_id = $cartDao->addCart(0);
            }
            $_SESSION['cart_id'] = $cartDao->getLastInsertedCart();
        }
    }

}

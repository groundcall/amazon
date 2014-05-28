<?php

namespace Controllers;

class CartController extends \Wee\Controller {

    public function initialize() {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        if (empty($_SESSION['cart_id'])) {
            $cart = new \Models\Cart();
            if (isset($_SESSION['id'])) {
                $cartDao->addCart($_SESSION['id']);
            } else {
                $cartDao->addCart(0);
            }
            $_SESSION['cart_id'] = $cartDao->getLastInsertedCart();
        }
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
        $cart = $this->getCartById($_SESSION['cart_id']);
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->removeAllCartItemsByCartId($cart->getId());
        $cart->calculateTotal();
        $_SESSION['updated_qty'] = 1;
        $this->redirect('cart/show_cart');
    }

    private function removeCartItem() {
        $cart = $this->getCartById($_SESSION['cart_id']);
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->removeCartItemById($_POST['remove'], $cart->getId());
        $cart->calculateTotal();
        $_SESSION['updated_qty'] = 1;
        $this->showCart();
    }

    private function updateCart() {
        
        $cart = $this->getCartById($_SESSION['cart_id']);
        $cartItems = $cart->getCart_item();
        $quantities = $_POST['cart'];
        
        $items = $cart->updateQuantities($cartItems, $quantities);
        
        $cart->calculateTotal();
        $cart->setCart_items($items);
        $this->render('users/cart', array('cart' => $cart));
    }

    public function addItem() {
        $cartItem = new \Models\CartItem();
        isset($_POST['quantity']) ? $quantity = $_POST['quantity'] : $quantity = 1;

        $cartItem->setQuantity($quantity);
        $cartItem->setProduct($_POST['product_id']);

        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartById($_SESSION['cart_id']);
        $cartItem->setCart($cart->getId());

        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $item = $cartItemDao->getCartItemByProductIdAndCartId($cartItem->getProduct_id(), $_SESSION['cart_id']);

        if ($item) {
            $cartItem->setQuantity($item->getQuantity() + $quantity );
//            ($quantity) ? $cartItem->setQuantity($quantity) : $cartItem->setQuantity($item->getQuantity() + $quantity );
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
        $cart->calculateTotal();
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
        $this->redirectToUrl($_SERVER['HTTP_REFERER']);
    }

    public function deleteCartItemFromCart() {
        $cart_item_id = $_GET['cart_item_id'];
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartById($_SESSION['cart_id']);

        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $cartItemDao->deleteCartItemFromCart($cart_item_id);

        //header('Location: ' . $_SERVER['HTTP_REFERER']);
        $this->redirectToUrl($_SERVER['HTTP_REFERER']);
    }

}

<?php

namespace Models;

class Cart extends \Wee\Model {

    protected $id;
    protected $user_id;
    protected $date;
    protected $active;
    protected $total;
    protected $cart_item;

    public function __construct() {
        $this->setAttrAccessible(array('user_id', 'date', 'active', 'total'));
    }

    public function getId() {
        return $this->id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getActive() {
        return $this->active;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function getCart_item() {
        return $this->cart_item;
    }

    public function setCart_item() {
        $cart_itemDao = \Wee\DaoFactory::getDao('CartItem');
        $this->cart_item = $cart_itemDao->getAllCartItemsByCartId($this->id);
    }

    public function setCart_items($cart_items) {
        $this->cart_item = $cart_items;
    }

    public function calculateTotal() {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $this->setTotal($cartDao->calculateCartTotal($this->getId()));
    }

    public function updateQuantities($cartItems, $quantities) {
        $_SESSION['updated_qty'] = 1;
        $items = array();
        $quantities = array_values($quantities);
        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');

        for ($i = 0; $i <= sizeof($cartItems) - 1; $i++) {
            $cartItems[$i]->setQuantity($quantities[$i]);
            if ($cartItems[$i]->isValid()) {
                $cartItemDao->updateCartItem($cartItems[$i]);
                $items[] = $cartItemDao->getCartItemById($cartItems[$i]->getId());
            } else {
                $items[] = $cartItems[$i];
                $_SESSION['updated_qty'] = 0;
            }
        }

        return $items;
    }

    public function addCartItem($product_id, $quantity) {
        

        $cartItem = new \Models\CartItem();

        $cartItemDao = \Wee\DaoFactory::getDao('CartItem');
        $oldCartItem = $cartItemDao->getCartItemByProductIdAndCartId($product_id, $this->getId());
        $cartItem->setProduct($product_id);
        $cartItem->setCart_id($this->getId());
        $cartItem->setQuantity($quantity);

        if ($oldCartItem) {
            $cartItem->setQuantity($oldCartItem->getQuantity() + $quantity);
            $cartItem->setId($oldCartItem->getId());
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
        $this->calculateTotal();
    }

}

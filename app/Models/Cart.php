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
}
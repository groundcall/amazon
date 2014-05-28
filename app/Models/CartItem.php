<?php

namespace Models;

class CartItem extends \Wee\Model {
    
    use \Validators\CartItemValidator;
    
    protected $id;
    protected $cart_id;
    protected $product_id;
    protected $title;
    protected $quantity;
    protected $price;
    
//    protected $cart;
    protected $product;

    public function __construct() {
        $this->setAttrAccessible(array('title', 'quantity', 'price'));

        $this->validateQuantity();
        $this->validateQuantityInStock();
        $this->validateQuantityIsNumeric();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getCart_id() {
        return $this->cart_id;
    }

    public function getProduct_id() {
        return $this->product_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCart_id() {
        $this->cart_id = $this->cart->getId();
    }

    public function setProduct_id($product_id) {
        $this->product_id = $product_id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
    
    public function getCart() {
        return $this->cart;
    }

    public function getProduct() {
        return $this->product;
    }

    public function setCart($cart_id) {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartById($cart_id);
        $this->cart = $cart;
        $this->cart_id = $cart_id;
    }

    public function setProduct($product_id) {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $product = $productDao->getProductById($product_id);
        $this->product = $product;
        $this->product_id = $product_id;
    }
}

    
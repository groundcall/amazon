<?php

namespace Models;

class Order extends \Wee\Model {
    
    protected $id;
    protected $user_id;
    protected $billing_address_id;
    protected $shipping_address_id;
    protected $cart_id;
    protected $total;
    protected $date;
    protected $state_id;
    protected $shipping_method_id;
    protected $payment_method_id;
    
    protected $user;
    protected $billing_address;
    protected $shipping_address;
    protected $cart;
    protected $state;
    protected $shipping_method;
    protected $payment_method;
    
    public function __construct() {
        $this->setAttrAccessible(array('user_id', 'billing_address_id', 'shipping_address_id',
            'cart_id', 'total', 'date', 'state_id', 'shipping_method_id', 'payment_method_id'));
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getBilling_address_id() {
        return $this->billing_address_id;
    }

    public function getShipping_address_id() {
        return $this->shipping_address_id;
    }

    public function getCart_id() {
        return $this->cart_id;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getDate() {
        return $this->date;
    }

    public function getState_id() {
        return $this->state_id;
    }

    public function getShipping_method_id() {
        return $this->shipping_method_id;
    }

    public function getPayment_method_id() {
        return $this->payment_method_id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getBilling_address() {
        return $this->billing_address;
    }

    public function getShipping_address() {
        return $this->shipping_address;
    }

    public function getCart() {
        return $this->cart;
    }

    public function getState() {
        return $this->state;
    }

    public function getShipping_method() {
        return $this->shipping_method;
    }

    public function getPayment_method() {
        return $this->payment_method;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
        $userDao = \Wee\DaoFactory::getDao('User');
        $user = $userDao->getUserById($user_id);
        $this->user = $user;
    }

    public function setBilling_address_id($billing_address_id) {
        $this->billing_address_id = $billing_address_id;
    }

    public function setShipping_address_id($shipping_address_id) {
        $this->shipping_address_id = $shipping_address_id;
    }

    public function setCart_id() {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartByUserId($this->user_id);
        $this->cart_id = $cart->getId();
        $this->cart = $cart;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setState_id($state_id) {
        $this->state_id = $state_id;
        $stateDao = \Wee\DaoFactory::getDao('State');
        $state = $stateDao->getStateById($state_id);
        $this->state = $state;
    }

    public function setShipping_method_id($shipping_method_id) {
        $shippingMethodDao = \Wee\DaoFactory::getDao('ShippingMethod');
        $shippingMethod = $shippingMethodDao->getShippingMethodById($shipping_method_id);
        $this->shipping_method_id = $shipping_method_id;
        $this->shipping_method = $shippingMethod;
    }

    public function setPayment_method_id($payment_method_id) {
        $paymentMethodDao = \Wee\DaoFactory::getDao('PaymentMethod');
        $paymentMethod = $paymentMethodDao->getPaymentMethodById($payment_method_id);
        $this->payment_method_id = $payment_method_id;
        $this->payment_method = $paymentMethod;
    }

    public function setUser($user_id) {
        $this->user_id = $user_id;
        $userDao = \Wee\DaoFactory::getDao('User');
        $user = $userDao->getUserById($user_id);
        $this->user = $user;
        $this->setState_id(0);
        $this->setShipping_method_id(1);
        $this->setPayment_method_id(1);
        $orderDao = \Wee\DaoFactory::getDao('Order');
        $orderDao->addOrder($this);
    }

    public function setBilling_address() {
        $this->billing_address = new \Models\Address();
        if ($this->user->getBilling_address_id() != null) {
            $addressDao = \Wee\DaoFactory::getDao('Address');
            $address = $addressDao->getAddressById($this->user->getBilling_address_id());
            $this->billing_address = $address;
            $this->billing_address_id = $address->getId();
        }
        else {
            $this->billing_address->setFirstname($this->user->getFirstname());
            $this->billing_address->setLastname($this->user->getLastname());
            $this->billing_address->setEmail($this->user->getEmail());
        }
    }
    
    public function updateBillingAddress($billing_address) {
        $this->billing_address = $billing_address;
    }

    public function setShipping_address($shipping_address) {
        $this->shipping_address = $shipping_address;
    }

    public function setCart() {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartByUserId($this->user_id);
        $this->cart_id = $cart->getId();
        $this->cart = $cart;
    }

    public function setState($state_id) {
        $this->state_id = $state_id;
        $stateDao = \Wee\DaoFactory::getDao('State');
        $state = $stateDao->getStateById($state_id);
        $this->state = $state;
    }

    public function setShipping_method($shipping_method_id) {
        $shippingMethodDao = \Wee\DaoFactory::getDao('ShippingMethod');
        $shippingMethod = $shippingMethodDao->getShippingMethodById($shipping_method_id);
        $this->shipping_method_id = $shipping_method_id;
        $this->shipping_method = $shippingMethod;
    }

    public function setPayment_method($payment_method_id) {
        $paymentMethodDao = \Wee\DaoFactory::getDao('PaymentMethod');
        $paymentMethod = $paymentMethodDao->getPaymentMethodById($payment_method_id);
        $this->payment_method_id = $payment_method_id;
        $this->payment_method = $paymentMethod;
    }

}

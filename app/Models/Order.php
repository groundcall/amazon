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
    }

    public function setBilling_address_id($billing_address_id) {
        $this->billing_address_id = $billing_address_id;
    }

    public function setShipping_address_id($shipping_address_id) {
        $this->shipping_address_id = $shipping_address_id;
    }

    public function setCart_id($cart_id) {;
        $this->cart_id = $cart_id;
    }

    public function setTotal() {
        if ($this->cart != null && $this->shipping_method != null) {
            $this->total = $this->cart->getTotal() + $this->getShipping_method()->getPrice();
        }
        else {
            $this->total = 0;
        }
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setState_id($state_id) {
        $this->state_id = $state_id;
        $stateDao = \Wee\DaoFactory::getDao('State');
        $state = $stateDao->getStateById($state_id);
        $this->state = $state;
        $orderDao = \Wee\DaoFactory::getDao('Order');
        $orderDao->updateOrderState($this);
    }

    public function setShipping_method_id($shipping_method_id) {
        $this->shipping_method_id = $shipping_method_id;
    }

    public function setPayment_method_id($payment_method_id) {
        $this->payment_method_id = $payment_method_id;
    }
    
    public function setUser($user) {
        $this->user = $user;
    }

    public function createUser($user_id) {
        $this->user_id = $user_id;
        $userDao = \Wee\DaoFactory::getDao('User');
        $user = $userDao->getUserById($user_id);
        $this->user = $user;
    }

    public function createBilling_address() {
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
    
    public function setBilling_address($billing_address) {
        $this->billing_address = $billing_address;
    }
    
    public function setShipping_address($shipping_address) {
        $this->shipping_address = $shipping_address;
    }
    
    public function updateBillingAddress($billing_address) {
        $address = new \Models\Address();
        $addr = strip_tags(trim($billing_address['street1'])) . ' ' . strip_tags(trim($billing_address['street2']));
        $address->setAddress($addr);
        $address->updateAttributes($billing_address);
        $address->setCountry($billing_address['country_id']);
        $this->setBilling_address($address);
        if ($this->getBilling_address()->isValid()) {
            $addressDao = \Wee\DaoFactory::getDao('Address');
            $userDao = \Wee\DaoFactory::getDao('User');
            if ($this->user->getBilling_address_id() != null) {
                $addressDao->updateAddress($this->user->getBilling_address_id(), $address);
                $this->billing_address_id = $this->user->getBilling_address_id();
            }
            else {
                $addressDao->addAddress($address);
                $this->billing_address_id = $addressDao->getLastInsertedAddressId();
                $userDao->updateBillingAddress($this->user_id, $this->billing_address_id);
            }
            $orderDao = \Wee\DaoFactory::getDao('Order');
            $orderDao->updateBillingAddress($this);
            if ($billing_address['use_for_shipping'] != null && $billing_address['use_for_shipping'] == 1) {
                $this->updateShippingAddress($billing_address);
                $orderDao->updateShippingAddressId($this, $this->getBilling_address_id());
            } 
        }
    }

    public function createShipping_address() {
        $this->shipping_address = new \Models\Address();
        if ($this->user->getShipping_address_id() != null) {
            $addressDao = \Wee\DaoFactory::getDao('Address');
            $address = $addressDao->getAddressById($this->user->getShipping_address_id());
            $this->shipping_address = $address;
            $this->shipping_address_id = $address->getId();
        }
        else {
            $this->shipping_address->setFirstname($this->user->getFirstname());
            $this->shipping_address->setLastname($this->user->getLastname());
            $this->shipping_address->setEmail($this->user->getEmail());
        }
    }
    
    public function updateShippingAddress($shipping_address) {
        $address = new \Models\Address();
        $addr = strip_tags(trim($shipping_address['street1'])) . ' ' . strip_tags(trim($shipping_address['street2']));
        $address->setAddress($addr);
        $address->setCountry($shipping_address['country_id']);
        $address->updateAttributes($shipping_address);
        $this->setShipping_address($address);
        $addressDao = \Wee\DaoFactory::getDao('Address');
        $userDao = \Wee\DaoFactory::getDao('User');
        $orderDao = \Wee\DaoFactory::getDao('Order');
        if (isset($shipping_address['same_as_billing']) && $shipping_address['same_as_billing'] == 1) {
            $this->setShipping_address($this->getBilling_address());
        }
        if ($this->getShipping_address()->isValid()) {
            
            if ($this->user->getShipping_address_id() != null) {
                $addressDao->updateAddress($this->user->getShipping_address_id(), $address);
                $this->shipping_address_id = $this->user->getShipping_address_id();
            }
            else {
                $addressDao->addAddress($address);
                $this->shipping_address_id = $addressDao->getLastInsertedAddressId();
                $userDao->updateShippingAddress($this->user_id, $this->shipping_address_id);
            }
            $orderDao->updateShippingAddress($this);
            if (isset($shipping_address['same_as_billing']) && $shipping_address['same_as_billing'] == 1) {
                $addressDao->updateAddress($this->user->getShipping_address_id(), $this->getBilling_address());
                $orderDao->updateShippingAddressId($this, $this->getBilling_address_id());
            }
        }
    }

    public function createCart($cart_id) {
        $this->cart_id = $cart_id;
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartById($cart_id);
        $this->cart = $cart;
    }
    
    public function get_Cart($cart_id) {
        $this->cart_id = $cart_id;
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartByIdNotActive($cart_id);
        $this->cart = $cart;
    }

    public function setState($state_id) {
        $this->state_id = $state_id;
        $stateDao = \Wee\DaoFactory::getDao('State');
        $state = $stateDao->getStateById($state_id);
        $this->state = $state;
    }

    public function createShipping_method() {
        $shippingMethodDao = \Wee\DaoFactory::getDao('ShippingMethod');
        $shippingMethod = $shippingMethodDao->getShippingMethodById($this->shipping_method_id);
        $this->shipping_method = $shippingMethod;
    }
    
    public function updateShippingMethod($shipping_method_id) {
        $this->shipping_method_id = $shipping_method_id;
        $orderDao = \Wee\DaoFactory::getDao('Order');
        $orderDao->updateShippingMethod($this);
    }

    public function createPayment_method() {
        $paymentMethodDao = \Wee\DaoFactory::getDao('PaymentMethod');
        $paymentMethod = $paymentMethodDao->getPaymentMethodById($this->payment_method_id);
        $this->payment_method = $paymentMethod;
    }

    public function updatePaymentMethod($payment_method_id) {
        $this->payment_method_id = $payment_method_id;
        $orderDao = \Wee\DaoFactory::getDao('Order');
        $orderDao->updatePaymentMethod($this);
    }
    
    public function updateTotal() {
        $this->setTotal();
        $orderDao = \Wee\DaoFactory::getDao('Order');
        $orderDao->updateTotal($this);
    }
}

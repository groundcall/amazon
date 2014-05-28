<?php

namespace Controllers;

class CheckoutController extends \Wee\Controller {
    
    public function initialize() {
        //unset($_SESSION['order_id']); die();
        if (!empty($_SESSION['id'])) {
            $orderDao = \Wee\DaoFactory::getDao('Order');
            if (empty($_SESSION['order_id'])) {
                $this->order = new \Models\Order();
                $this->order->setUser($_SESSION['id']);
                $this->order->setCart($_SESSION['cart_id']);
                $orderDao->addOrder($this->order);
                $_SESSION['order_id'] = $orderDao->getLastInsertedOrderId();
            }
            $this->order = $orderDao->getOrderById($_SESSION['order_id']);
            $this->order->updateTotal();
        }
        else {
            $this->redirect('users/show_login_form');
        }
    }
    
    public function index() {
        $this->redirect('checkout/show_billing_address');
    }
    
    public function showBillingAddress() {
        $address = $this->order->getBilling_address();
        $this->render('users/checkout_billing', array('address' => $address));
    }

    public function addBillingAddress() {
        $address = new \Models\Address();
        $addr = $_POST['billing']['street1'] . ' ' . $_POST['billing']['street2'];
        $address->updateAttributes($_POST['billing']);
        $address->setCountry($_POST['billing']['country_id']);
        $address->setAddress($addr);
        if ($address->isValid()) {
            $this->order->updateBillingAddress($address);
            if (!empty($_POST['billing']['use_for_shipping']) && $_POST['billing']['use_for_shipping'] == 1) {
                $this->order->updateShippingAddress($address);
                $this->redirect('checkout/show_shipping_method');
            }
            else {
                $this->redirect('checkout/show_shipping_address');
            }
        } 
        else {
            $this->render('users/checkout_billing', array('address' => $address));
        }
    }
    
    public function showShippingAddress() {
        $address = $this->order->getShipping_address();
        $this->render('users/checkout_shipping', array('address' => $address));
    }
    
    public function addShippingAddress() {
        $address = new \Models\Address();
        $addr = $_POST['shipping']['street1'] . ' ' . $_POST['shipping']['street2'];
        $address->updateAttributes($_POST['shipping']);
        $address->setCountry($_POST['shipping']['country_id']);
        $address->setAddress($addr);
        if (!empty($_POST['shipping']['same_as_billing']) && $_POST['shipping']['same_as_billing'] == 1) {
            $this->order->updateShippingAddress($this->order->getBilling_address());
            $this->redirect('checkout/show_shipping_method');
        }
        else {
            if ($address->isValid()) {
                $this->order->updateShippingAddress($address);
                $this->redirect('checkout/show_shipping_method');
            }
            else {
                $this->render('users/checkout_shipping', array('address' => $address));
            }
        }
    }
    
    public function showShippingMethod() {
        $shipping = $this->order->getShipping_method();
        $this->render('users/checkout_shipping_method', array('shipping' => $shipping));
    }
    
    public function selectShippingMethod() {
        $this->order->updateShippingMethod($_POST['shipping']);
        $this->redirect('checkout/show_payment_method');
    }
    
    public function showPaymentMethod() {
        $payment = $this->order->getPayment_method();
        $this->render('users/checkout_payment_method', array('payment' => $payment));
    }
    
    public function selectPaymentMethod() {
        $this->order->updatePaymentMethod($_POST['payment']);
        $this->redirect('checkout/show_order_review');
    }
    
    public function showOrderReview() {
        $this->render('users/checkout_review', array('order' => $this->order));
    }
}

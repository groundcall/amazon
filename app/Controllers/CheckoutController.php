<?php

namespace Controllers;

class CheckoutController extends \Wee\Controller {
    
    public function initialize() {
        //unset($_SESSION['cart_id']);
        //unset($_SESSION['order_id']); die();
        if (empty($_SESSION['cart_id'])) {
            $this->redirect('products/');
        }
        if (!empty($_SESSION['id'])) {
            $orderDao = \Wee\DaoFactory::getDao('Order');
            if (empty($_SESSION['order_id'])) {
                $this->order = new \Models\Order();
                $this->order->createUser($_SESSION['id']);
                $this->order->setCart_id($_SESSION['cart_id']);
                $orderDao->addOrder($this->order);
                $_SESSION['order_id'] = $orderDao->getLastInsertedOrderId();
            }
            $this->order = $orderDao->getOrderById($_SESSION['order_id']);
            //var_dump($this->order);
            $this->order->createCart($_SESSION['cart_id']);
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
    
    public function showOrderConfirmation() {
        $is_in_stock = TRUE;
        foreach ($this->order->getCart()->getCart_item() as $item) {
            if ($item->getQuantity() > $item->getProduct()->getStock()) {
                $is_in_stock = FALSE;
            }
        }
        if ($is_in_stock == TRUE) {
            $mail = new \Models\Email();
            $mail->sendOrderEmail($this->order);
            $this->order->setState_id(1);
            $this->order->getCart()->clearCart();
            $this->order->getCart()->makeInactive();
            unset($_SESSION['cart_id']);
            unset($_SESSION['order_id']);
            $this->render('users/checkout_final', array('order' => $this->order));
        }
        else {
            $this->redirect('cart/show_cart');
        }
    }
    
    public function orderConfirmation() {
        if (!empty($_GET['order_id'])) {
            $orderDao = \Wee\DaoFactory::getDao('Order');
            $order = $orderDao->getOrderByIdAndUser($_GET['order_id'], $_SESSION['id']);
            $order->get_Cart($order->getCart_id());
            $this->render('users/checkout_confirm', array('order' => $order));
        }
        else {
            $this->redirect('products/');
        }
    }
}

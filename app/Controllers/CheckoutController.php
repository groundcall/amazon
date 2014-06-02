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
        $this->render('users/checkout_billing', array('order' => $this->order));
    }

    public function addBillingAddress() {
        $this->order->updateBillingAddress($_POST);
        if ($this->order->getBilling_address()->isValid()) {
            if (!empty($_POST['use_for_shipping']) && $_POST['use_for_shipping'] == 1) {
                $this->redirect('checkout/show_shipping_method');
            }
            else {
                $this->redirect('checkout/show_shipping_address');
            }
        }
        else {
            $this->render('users/checkout_billing', array('order' => $this->order));
        }
    }
    
    public function showShippingAddress() {
        $this->render('users/checkout_shipping', array('order' => $this->order));
    }
    
    public function addShippingAddress() {
        $this->order->updateShippingAddress($_POST);
        if ($this->order->getShipping_address()->isValid()) {
            $this->redirect('checkout/show_shipping_method');
        }
        else {
            $this->render('users/checkout_shipping', array('order' => $this->order));
        }
    }
    
    public function showShippingMethod() {
        $this->render('users/checkout_shipping_method', array('order' => $this->order));
    }
    
    public function selectShippingMethod() {
        $this->order->updateShippingMethod($_POST['shipping']);
        $this->redirect('checkout/show_payment_method');
    }
    
    public function showPaymentMethod() {
        $this->render('users/checkout_payment_method', array('order' => $this->order));
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
    
    public function showOrder() {
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

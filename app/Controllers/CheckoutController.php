<?php

namespace Controllers;

class CheckoutController extends \Wee\Controller {
    
    public function index() {
        $this->redirect('checkout/show_billing_address');
    }
    
    public function showBillingAddress() {
        $address = new \Models\Address();
        $userDao = \Wee\DaoFactory::getDao('User');
        $user = $userDao->getUserById($_SESSION['id']);
        $address->setFirstname($user->getFirstname());
        $address->setLastname($user->getLastname());
        $address->setEmail($user->getEmail());
        var_dump($user); die();
        if ($user->getBilling_address() != null) {
            $address->setAddress($user->getBilling_address()->getAddress());
            $address->setCity($user->getBilling_address()->getCity());
            $address->setCountry($user->getBilling_address()->getCountry_id());
        }
        $this->render('users/checkout_billing', array('address' => $address));
    }

    public function addBillingAddress() {
        $address = new \Models\Address();
        $addr = $_POST['billing']['street1'] . ' ' . $_POST['billing']['street2'];
        $address->updateAttributes($_POST['billing']);
        $address->setCountry($_POST['billing']['country_id']);
        $address->setAddress($addr);
        
        
        var_dump($address); die();
        if ($address->isValid()) {
            $addressDao = \Wee\DaoFactory::getDao('Address');
            $addressDao->addAddress($address);
            $address_id = $addressDao->getLastInsertedAddressId();
            $address->setId($address_id);
            $userDao = \Wee\DaoFactory::getDao('User');
            $userDao->updateBillingAddress($_SESSION['id'], $address_id);
            if ($_POST['billing']['use_for_shipping'] == 1) {
                $userDao->updateShippingAddress($_SESSION['id'], $address_id);
                $this->render('users/checkout_shipping_method');
            }
            else {
                $this->render('users/checkout_shipping', array('address' => $address));
            }
        } 
        else {
            $this->render('users/checkout_billing', array('address' => $address));
        }
    }
    
    public function addShippingAddress() {
        $userDao = \Wee\DaoFactory::getDao('User');
        if (isset($_POST['shipping']['same_as_billing'])) {
            $userDao->updateShippingAddress($_SESSION['id'], $_POST['shipping']['address_id']);
            $this->render('users/checkout_shipping_method');
        }
        else {
            $address = new \Models\Address();
            $address->updateAttributes($_POST['shipping']);
            $address->setCountry($_POST['shipping']['country_id']);
            $addr = $_POST['shipping']['street1'] . $_POST['shipping']['street2'];
            $address->setAddress($addr);
            if ($address->isValid()) {
                $addressDao = \Wee\DaoFactory::getDao('Address');
                $addressDao->addAddress($address);
                $address_id = $addressDao->getLastInsertedAddressId();
                $userDao->updateShippingAddress($_SESSION['id'], $address_id);
                $this->render('users/checkout_shipping_method');
            } else {
                $this->render('users/checkout_shipping', array('address' => $address));
            }
        }
    }
    
    public function selectShippingMethod() {

        $shipping_method = $_POST['shipping'];
        $this->render('users/checkout_payment_method');
    }
    
    public function selectPaymentMethod() {

        $payment_method = $_POST['payment'];
        $this->render('users/checkout_payment_method');
    }
}

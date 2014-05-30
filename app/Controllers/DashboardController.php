<?php

namespace Controllers;

class DashboardController extends \Wee\Controller {

    public function initialize() {
        if (empty($_SESSION['id'])) {
            $this->redirect('users/show_login_form');
        }
        else {
            $userDao = \Wee\DaoFactory::getDao('User');
            $this->user = $userDao->getUserById($_SESSION['id']);
            $this->user->setBilling_address($this->user->getBilling_address_id());
            $this->user->setShipping_address($this->user->getShipping_address_id());

            $cartDao = \Wee\DaoFactory::getDao('Cart');
            $this->cart = $cartDao->getCartById($_SESSION['cart_id']);
            $this->user->setCart($this->cart);
        }
    }

    public function index() {
        $this->redirect('dashboard/show_account_dashboard');
    }


    public function accountDashboard() {
        $this->render('users/dashboard', array('user' => $this->user));
    }

    public function accountInformation() {
        
    }

    public function myOrders() {
        
    }

    public function billingAddress() {

        $address = $this->user->getBilling_address();
        if (isset($_POST['billing'])) {
            $addr = $_POST['billing']['street1'] . ' ' . $_POST['billing']['street2'];
            $address->updateAttributes($_POST['billing']);
            $address->setCountry($_POST['billing']['country_id']);
            $address->setAddress($addr);
            if ($address->isValid()) {
                $addressDao = \Wee\DaoFactory::getDao('Address');
                $addressDao->updateAddress($address->getId(), $address);
                $this->user->setBilling_address($address->getId());
                $_SESSION['update_status']='ok';
            }
        }
        $this->render('users/dashboard_edit_billing_address', array('user' => $this->user, 'address' => $address));
    }

    public function shippingAddress() {
        
        $address = $this->user->getShipping_address();
        if (isset($_POST['shipping'])) {
            $addr = $_POST['shipping']['street1'] . ' ' . $_POST['shipping']['street2'];
            $address->updateAttributes($_POST['shipping']);
            $address->setCountry($_POST['shipping']['country_id']);
            $address->setAddress($addr);
            if ($address->isValid()) {
                $addressDao = \Wee\DaoFactory::getDao('Address');
                $addressDao->updateAddress($address->getId(), $address);
                $this->user->setShipping_address($address->getId());
                $_SESSION['update_status']='ok';
            }
        }
        $this->render('users/dashboard_edit_shipping_address', array('user' => $this->user, 'address'=>$address));
    }
}

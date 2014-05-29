<?php

namespace Controllers;

class DashboardController extends \Wee\Controller {

    public function initialize() {

        $userDao = \Wee\DaoFactory::getDao('User');
        $this->user = $userDao->getUserById($_SESSION['id']);
        $this->user->setBilling_address($this->user->getBilling_address_id());
        $this->user->setShipping_address($this->user->getShipping_address_id());

        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $this->cart = $cartDao->getCartById($_SESSION['cart_id']);
        $this->user->setCart($this->cart);
    }

    public function index() {

        $this->redirect('dashboard/account_dashboard');
    }

    public function accountDashboard() {

//        var_dump($this->user);

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
                $address = $addressDao->updateAddress($address->getId(), $address);
            }
            $this->user->setBilling_address($this->user->getBilling_address_id());
        }

        var_dump($this->user->getBilling_address());
        $this->render('users/dashboard_edit_billing_address', array('user' => $this->user));
    }

    public function shippingAddress() {

        $this->render('users/dashboard_edit_shipping_address', array('user' => $this->user));
    }

}

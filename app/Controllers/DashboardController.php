<?php

namespace Controllers;

class DashboardController extends \Wee\Controller {

    public function initialize() {
        if (empty($_SESSION['id'])) {
            $this->redirect('users/show_login_form');
        } else {
            $userDao = \Wee\DaoFactory::getDao('User');
            $this->user = $userDao->getUserById($_SESSION['id']);
            $this->user->createBillingAddress($this->user->getBilling_address_id());
            $this->user->createShippingAddress($this->user->getShipping_address_id());

            $cartDao = \Wee\DaoFactory::getDao('Cart');
            $this->cart = $cartDao->getCartById($_SESSION['cart_id']);
            $this->user->setCart($this->cart);
        }
    }

    public function index() {
        $this->redirect('dashboard/account_dashboard');
    }

    public function accountDashboard() {
        $this->render('users/dashboard', array('user' => $this->user));
    }

    public function accountInformation() {

        if (!isset($_POST['edit_account_info'])) {
            $this->render('users/dashboard_view_account_information', array('user' => $this->user));
        } else {

            if (!empty($_POST['data'])) {
                $this->user->updateAttributes($_POST['data']);
                $this->user->setEducation_id($_POST['data']['education']);

                if ($this->user->isValid()) {
                    $userDao = \Wee\DaoFactory::getDao('User');
                    $userDao->updateUser($this->user);
                    $_SESSION['update_status'] = 'ok';
                }
            }

            $this->render('users/dashboard_edit_account_information', array('user' => $this->user));
        }
    }

    public function billingAddress() {

        if ($this->user->getBilling_address()) {
            $address = $this->user->getBilling_address();
        } else {
            $address = new \Models\Address();
        }
        if (isset($_POST['billing'])) {
            $addr = $_POST['billing']['street1'] . ' ' . $_POST['billing']['street2'];
            $address->updateAttributes($_POST['billing']);
            $address->setCountry($_POST['billing']['country_id']);
            $address->setAddress($addr);
            $address->addAddress();
            $this->user->createBillingAddress($address->getId());
            $this->user->updateUser($this->user);
        }
        $this->render('users/dashboard_edit_billing_address', array('user' => $this->user, 'address' => $address));
    }

    public function shippingAddress() {

        if ($this->user->getShipping_address()) {
            $address = $this->user->getShipping_address();
        } else {
            $address = new \Models\Address();
        }
        if (isset($_POST['shipping'])) {
            $addr = $_POST['shipping']['street1'] . ' ' . $_POST['shipping']['street2'];
            $address->updateAttributes($_POST['shipping']);
            $address->setCountry($_POST['shipping']['country_id']);
            $address->setAddress($addr);
            $address->addAddress();
            $this->user->createShippingAddress($address->getId());
            $this->user->updateUser($this->user);
        }
        $this->render('users/dashboard_edit_shipping_address', array('user' => $this->user, 'address' => $address));
    }

    public function cartHistory() {

        $allcarts = $this->user->getAllCartsByUserId();

        $this->render('users/dashboard_view_cart_history', array('user' => $this->user, 'allcarts' => $allcarts));
    }

    public function showOrderDetails() {
        if (!empty($_GET['order_id'])) {
            $orderDao = \Wee\DaoFactory::getDao('Order');
            $order = $orderDao->getOrderByIdAndUser($_GET['order_id'], $_SESSION['id']);
            $order->get_Cart($order->getCart_id());
            $this->render('users/dashboard_show_order', array('order' => $order));
        } else {
            $this->redirect('products/');
        }
    }

    public function showAllOrders() {
        $paginator = new \Models\Paginator();
        $orderDao = \Wee\DaoFactory::getDao('Order');
        $paginator->setCount($orderDao->getOrdersCount($_SESSION['id']));
        $paginator->setPerpage();
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $paginator->setCurrent($_GET['page']);
        } else {
            $paginator->setCurrent(1);
        }
        $paginator->setPages();
        $start = ($paginator->getCurrent() - 1) * $paginator->getPerpage();
        $limit = $paginator->getPerpage();
        $orders = $orderDao->getAllOrdersByUser($_SESSION['id'], $start, $limit);
        $this->render('users/dashboard_show_orders', array('orders' => $orders, 'paginator' => $paginator));
    }

}

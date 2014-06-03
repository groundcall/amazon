<?php

namespace Controllers;

class AdminOrdersController extends \Wee\Controller {

    public function initialize() {
        if (empty($_SESSION) || $_SESSION['is_admin'] != 1) {
            $this->redirect('products/');
        }
    }

    public function index() {
        if (isset($_GET['username']) || isset($_GET['state']) || isset($_GET['time'])) {
            $this->filterOrders();
        } else {
            $this->showAllOrders();
        }
    }

    public function showAllOrders() {
        $paginator = new \Models\Paginator();
        $orderDao = \Wee\DaoFactory::getDao('Order');
        $paginator->setCount($orderDao->getOrderCount());
        $paginator->setPerpage();
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $paginator->setCurrent($_GET['page']);
        } else {
            $paginator->setCurrent(1);
        }
        $paginator->setPages();
        $start = ($paginator->getCurrent() - 1) * $paginator->getPerpage();
        $limit = $paginator->getPerpage();
        $orders = $orderDao->getAllOrders($start, $limit);
        $this->render('admin/list_orders', array('orders' => $orders, 'paginator' => $paginator));
    }

    public function filterOrders() {
        $paginator = new \Models\Paginator();
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $paginator->setCurrent($_GET['page']);
        } else {
            $paginator->setCurrent(1);
        }
        $paginator->setPerpage();
        $start = ($paginator->getCurrent() - 1) * $paginator->getPerpage();
        $limit = $paginator->getPerpage();
        $orderDao = \Wee\DaoFactory::getDao('Order');
        $paginator->setCount($orderDao->getFilteredOrdersCount($_GET['username'], $_GET['state'], $_GET['time']));
        $paginator->setPages();
        $orders = $orderDao->getFilterOrders($_GET['username'], $_GET['state'], $_GET['time'], $start, $limit);
        $this->render('admin/list_orders', array('orders' => $orders, 'paginator' => $paginator));
    }
    
    public function deleteOrder(){ 
         $orderDao = \Wee\DaoFactory::getDao('Order');
         $orderDao->deleteOrderById($_POST['order_id']);
         $this->redirectToUrl($_SERVER['HTTP_REFERER']);
    }
    
    public function updateOrderStatus(){
         $orderDao = \Wee\DaoFactory::getDao('Order');
         $order = $orderDao->getOrderById($_POST['order_id']);
         $order->setState($_POST['state']);
         $orderDao->updateOrderState($order);
         $this->redirectToUrl($_SERVER['HTTP_REFERER']);
    }

    public function viewOrder() {
        $orderDao = \Wee\DaoFactory::getDao('Order');
        $order = $orderDao->getOrderById($_GET['order_id']);
        if ($order != null) {
            $this->render('admin/view_order', array('order' => $order));
        }
        else {
            $this->redirect('admin_orders/');
        }
    }
}

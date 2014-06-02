<?php

namespace Controllers;

class AdminOrdersController extends \Wee\Controller {

    public function initialize() {
        if (empty($_SESSION) || $_SESSION['is_admin'] != 1) {
            $this->redirect('products/');
        }
    }

    public function index() {
//        if (isset($_GET['product_name']) || isset($_GET['category']) || isset($_GET['stock'])) {
//            $this->filterProducts();
//        } else {
//            $this->showAllProducts();
//        }
        $this->showAllOrders();
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
        var_dump($_GET['username']);
        $start = ($paginator->getCurrent() - 1) * $paginator->getPerpage();
        $limit = $paginator->getPerpage();
        $orderDao = \Wee\DaoFactory::getDao('Order');
//        $paginator->setCount($orderDao->getFilteredOrderCount($_GET['username'], $_GET['state'], $time));
        $paginator->setCount(10);
        $paginator->setPages();
        $orders = $orderDao->getFilterOrders($_GET['username'], $_GET['state'], $_GET['time'], $start, $limit);
        $this->render('admin/list_orders', array('orders' => $orders, 'paginator' => $paginator));
    }
    
    public function deleteOrder(){ 
         $orderDao = \Wee\DaoFactory::getDao('Order');
         $orderDao->deleteOrderById($_POST['order_id']);
         $this->redirectToUrl($_SERVER['HTTP_REFERER']);
    }
//
//    public function deleteProduct() {
//        $productDao = \Wee\DaoFactory::getDao('Product');
//        $productDao->deleteProduct($_POST['product_id']);
//        $imageDao = \Wee\DaoFactory::getDao('Image');
//        $image = $imageDao->getImageByProductId($_POST['product_id']);
//        $image->deleteImage();
//        $imageDao->deleteImage($_POST['product_id']);
//        $this->redirect('admin_products');
//    }
//
//    public function showEditProduct() {
//        $productDao = \Wee\DaoFactory::getDao('Product');
//        if (!$productDao->getProductById($_GET['product_id'])) {
//            $this->redirect('admin_products/index');
//        }
//        $product = $productDao->getProductById($_GET['product_id']);
//        $this->render('admin/edit_product', array('product' => $product));
//    }
//
//    public function activateProduct() {
//        $productDao = \Wee\DaoFactory::getDao('Product');
//        $productDao->setProductActivity($_POST['product_id'], 1);
//        $this->redirect('admin_products');
//    }
//
//    public function deactivateProduct() {
//        $productDao = \Wee\DaoFactory::getDao('Product');
//        $productDao->setProductActivity($_POST['product_id'], 0);
//        $this->redirect('admin_products');
//    }
//
//    public function showProductForm() {
//        $this->render('admin/add_product', array('product' => null));
//    }
//
//    public function addProduct() {
//        $product = null;
//        if (!empty($_POST['data']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
//            $product = new \Models\Product();
//            $product->updateAttributes($_POST['data']);
//
//            $product->createImage($_FILES['image']['tmp_name'], $_FILES['image']['name'], $_FILES['image']['type'], $_FILES['image']['tmp_name']);
//
//            if ($product->isValid()) {
//                $productDao = \Wee\DaoFactory::getDao('Product');
//                $productDao->addProduct($product);
//                $product->getImage()->setProduct_id($productDao->getLastInsertedProduct());
//                $product->getImage()->saveImage();
//                $this->showProductForm();
//            } else {
//                $this->render('admin/add_product', array('product' => $product));
//            }
//        } else {
//            $this->redirect('products/');
//        }
//    }
//
//    public function editProduct() {
//        $product = null;
//        if (!empty($_POST['data']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
//            $productDao = \Wee\DaoFactory::getDao('Product');
//            $product = $productDao->getProductById($_POST['data']['id']);
//            $imageDao = \Wee\DaoFactory::getDao('Image');
//            $image = $imageDao->getImageByProductId($_POST['data']['id']);
//            $product->setImage($image);
//
//
//            if (!empty($_FILES['image']['name'])) {
//                $product->createImage($_FILES['image']['tmp_name'], $_FILES['image']['name'], $_FILES['image']['type'], $_FILES['image']['tmp_name']);
//            }
//
//            if ($product->isValid()) {
//                $productDao = \Wee\DaoFactory::getDao('Product');
//                $productDao->updateProduct($product);
//                if (!empty($_FILES['image']['name'])) {
//                    $image->deleteImage();
//                    $product->getImage()->setProduct_id($_POST['data']['id']);
//                    $product->getImage()->updateImage();
//                }
//                $this->redirect('admin_products');
//            }
//        } else {
//            $this->redirect('products/');
//        }
//    }
}

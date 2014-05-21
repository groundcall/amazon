<?php

namespace Controllers;

class ProductsController extends \Wee\Controller {

    public function index() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $products = $productDao->getLastProducts(6);
        $this->render('users/homepage', array('products' => $products));
    }
    
    public function showDetails() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        if (!$productDao->getProductById($_GET['product_id'])){
            $this->redirect('products/index');
        }
        $product = $productDao->getProductById($_GET['product_id']);
        $randomProducts = $productDao->getRandomProducts($_GET['product_id'], 4);
        $this->render('users/product_detail', array('product' => $product, 'randomProducts' => $randomProducts));
    }

    public function category() {
        $categoryDao = \Wee\DaoFactory::getDao('Category');
        if (!$categoryDao->getCategoryById($_GET['category'])){
            $this->redirect('products/index');
        }
        $category = $categoryDao->getCategoryById($_GET['category']);
        $this->render('users/category', array('category'=>$category));
    }

    public function search() {
        $paginator = new \Models\Paginator();
        $productDao = \Wee\DaoFactory::getDao('Product');
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $paginator->setCurrent($_GET['page']);
        } else {
            $paginator->setCurrent(1);
        }
        $paginator->setPerpage();
        $start = ($paginator->getCurrent() - 1) * $paginator->getPerpage();
        $limit = $paginator->getPerpage();
        $paginator->setCount($productDao->searchProductTitleCount($_GET['title']));
        $paginator->setPages();
        $products = $productDao->searchProductTitle($_GET['title'], $start, $limit);
        $this->render('users/search', array('title' => $_GET['title'], 'products' => $products, 'paginator' => $paginator));
    }
    
    public function sort() {
        $orderBy = $_GET['by'];
        $order = $_GET['order'];
        var_dump($order, $orderBy); die();
    }
}

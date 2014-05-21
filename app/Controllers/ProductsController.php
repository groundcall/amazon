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
        if (!$productDao->getProductById($_GET['product_id'])) {
            $this->redirect('products/index');
        }
        $product = $productDao->getProductById($_GET['product_id']);
        $randomProducts = $productDao->getRandomProducts($_GET['product_id'], 4);
        $this->render('users/product_detail', array('product' => $product, 'randomProducts' => $randomProducts));
    }

    public function showProducts() {
        var_dump($_GET);
        if (isset($_GET)) {
            if (isset($_GET['category'])) {

                $categoryDao = \Wee\DaoFactory::getDao('Category');
                $category = $categoryDao->getCategoryById($_GET['category']);

                $filtering = new \Models\Filtering();
                
                
//                $filtering->updateAttributes($_GET);
                
                if (isset($_GET['order'])) {
                    $filtering->setOrder($_GET['order']);
                } 
                else {
                    $filtering->setOrder('ASC');
                }

                if (isset($_GET['sort'])) {
                    $filtering->setSort($_GET['sort']);
                } 
                else {
                    $filtering->setSort('title');
                }
                
                if (isset($_GET['stock'])){
                    if ($_GET['stock'] == 0){
                        $filtering->setStock(0);
                    }
                    if ($_GET['stock'] == 1){
                        $filtering->setStock(1);
                    }
                }
                else{
                    $filtering->setStock(0);
                }
                
                if (isset($_GET['price'])){
                    if ($_GET['price']==1){
                    $filtering->setPrice_min('0');
                    $filtering->setPrice_max('49.99');
                    }
                    if ($_GET['price']==2){
                    $filtering->setPrice_min('49.99');
                    $filtering->setPrice_max('99.99');
                    }
                    if ($_GET['price']==3){
                    $filtering->setPrice_min('99.99');
                    $filtering->setPrice_max('1000000');
                    }
                }
                else {
                     $filtering->setPrice_min('0');
                    $filtering->setPrice_max('7000000');
                }
                


                var_dump($filtering);
                $productDao = \Wee\DaoFactory::getDao('Product');
                $products = $productDao->getFilterProducts2($filtering);
                $this->render('users/show_products', array('products' => $products, 'filtering' => $filtering, 'category' => $category));

//                $productDao = \Wee\DaoFactory::getDao('Product');
//                $products = $productDao->getProductsByCategoryId($_GET['category']);
//                $this->render('users/show_products', array('products' => $products, 'category' => $category, 'filtering' => null));
            }
        }
        $this->index();
    }

    public function category() {


        $categoryDao = \Wee\DaoFactory::getDao('Category');
        if (!$categoryDao->getCategoryById($_GET['category'])) {
            $this->redirect('products/index');
        }
        $category = $categoryDao->getCategoryById($_GET['category']);
        $this->render('users/category', array('category' => $category));
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

}

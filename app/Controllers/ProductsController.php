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
        $product = $productDao->getProductById($_GET['product_id']);
        $randomProducts = $productDao->getRandomProducts($_GET['product_id'], 4);
        $this->render('users/product_detail', array('product' => $product, 'randomProducts' => $randomProducts));
    }

}

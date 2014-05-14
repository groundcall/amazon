<?php

namespace Controllers;

/**
 * The default controller
 */
class AdminProductsController extends \Wee\Controller {

    /**
     * The default action
     */
    public function index() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $products = $productDao->getAllProducts();
        $this->render('admin/list_products', array('products' => $products));
    }
    
    public function deleteProduct() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $productDao->deleteProduct($_POST['product_id']);
        $this->redirect('admin_products');
    }
    
    public function showEditProduct() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $product = $productDao->getProductById($_GET['product_id']);
        $this->render('admin/edit_product', array('product' => $product));
    }

    public function activateProduct() {
        if (isset($_POST['activate'])) {
            $active = 1;
        }
        if (isset($_POST['deactivate'])) {
            $active = 0;
        }
        $productDao = \Wee\DaoFactory::getDao('Product');
        $productDao->setProductActivity($_POST['product_id'], $active);
        $this->redirect('admin_products');
    }
    
    public function filterProducts() {
        if (!isset($_GET['stock'])) {
            $stock = 0;
        }
        else {
            $stock = 1;
        }
        $productDao = \Wee\DaoFactory::getDao('Product');
        $products = $productDao->getFilterProducts($_GET['product_name'], $_GET['category'], $stock);
        $this->render('admin/list_products', array('products' => $products));
    }
}

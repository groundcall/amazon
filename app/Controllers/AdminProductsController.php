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
        } else {
            $stock = 1;
        }
        $productDao = \Wee\DaoFactory::getDao('Product');
        $products = $productDao->getFilterProducts($_GET['product_name'], $_GET['category'], $stock);
        $this->render('admin/list_products', array('products' => $products));
    }

    public function showProductForm() {
        $this->render('admin/add_product', array('product' => null, 'image' => null));
    }

    public function addProduct() {
        $product = null;
        $image = null;
        if (!empty($_POST['data'])) {

            $product = new \Models\Product();
            $product->updateAttributes($_POST['data']);
            $product->productTitleNotExists();

            $image = new \Models\Image();
            $image->setPath($_FILES['image']['tmp_name']);
            $image->setFilename($_FILES['image']['name']);
            $image->setType($_FILES['image']['type']);
            $image->setSize($_FILES['image']['size']);
            if ($product->isValid() && $image->isValid()) {
                $productDao = \Wee\DaoFactory::getDao('Product');
                $productDao->addProduct($product);
                $image->setProduct_id($productDao->getLastInsertedProduct());
                $image->saveImage();
                $this->showProductForm();
            }
            else {
                $this->render('admin/add_product', array('product' => $product, 'image' => $image));
            }
        }
    }

}
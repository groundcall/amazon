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
        $productPerPage = 10;
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $page = $_GET['page'];
        }
        else {
            $page = 1;
        }
        $start = ($page - 1) * $productPerPage;
        $limit = $productPerPage;
        $productDao = \Wee\DaoFactory::getDao('Product');
        $products = $productDao->getAllProducts($start, $limit);
        $this->render('admin/list_products', array('products' => $products, 'page' => $page));
    }

    public function deleteProduct() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $productDao->deleteProduct($_POST['product_id']);
        $imageDao = \Wee\DaoFactory::getDao('Image');
        $image = $imageDao->getImageNameByProductId($_POST['product_id']);
        unlink($image);
        $imageDao->deleteImage($_POST['product_id']);
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
        $productPerPage = 10;
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $page = $_GET['page'];
        }
        else {
            $page = 1;
        }
        $start = ($page - 1) * $productPerPage;
        $limit = $productPerPage;
        if (!isset($_GET['stock'])) {
            $stock = 0;
        } else {
            $stock = 1;
        }
        $productDao = \Wee\DaoFactory::getDao('Product');
        $products = $productDao->getFilterProducts($_GET['product_name'], $_GET['category'], $stock, $start, $limit);
        $this->render('admin/list_products', array('products' => $products, 'page' => $page));
    }

    public function showProductForm() {
        $this->render('admin/add_product', array('product' => null));
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
            $product->setImage($image);
            $product->validateProductImageType();
            $product->validateProductImageSize();
            
            if ($product->isValid()) {
                $productDao = \Wee\DaoFactory::getDao('Product');
                $productDao->addProduct($product);
                $image->setProduct_id($productDao->getLastInsertedProduct());
                $image->saveImage();
                $product->setImage($image);
                $this->showProductForm();
            }
            else {
                $this->render('admin/add_product', array('product' => $product));
            }
        }
    }
    
    public function editProduct() {
        $product = null;
        $image = null;
        if (!empty($_POST['data'])) {
            $productDao = \Wee\DaoFactory::getDao('Product');
            $old_product = $productDao->getProductById($_POST['data']['id']);
            $product = new \Models\Product();
            $product->updateAttributes($_POST['data']);
            
            if ($product->getTitle() != $old_product->getTitle()) {
                $product->productTitleNotExists();
            }
            
            if (!empty($_FILES['image']['name'])) {
                $image = new \Models\Image();
                $image->setPath($_FILES['image']['tmp_name']);
                $image->setFilename($_FILES['image']['name']);
                $image->setType($_FILES['image']['type']);
                $image->setSize($_FILES['image']['size']);
                $product->setImage($image);
                $product->validateProductImageType();
                $product->validateProductImageSize();
                
            }
            
            if ($product->isValid()) {
                $productDao = \Wee\DaoFactory::getDao('Product');
                $productDao->updateProduct($product);
                if (!empty($_FILES['image']['name'])) {
                    $imageDao = \Wee\DaoFactory::getDao('Image');
                    $old_image = $imageDao->getImageNameByProductId($old_product->getId());
                    unlink($old_image); 
                    $image->setProduct_id($old_product->getId());
                    $image->updateImage();
                    $product->setImage($image);
                }
                $this->redirect('admin_products');
            }
        }
        $this->render('admin/edit_product', array('product' => $product));
    }

}

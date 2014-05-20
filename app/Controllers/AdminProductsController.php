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
        if (isset($_GET['product_name']) || isset($_GET['category']) || isset($_GET['stock'])) {
            $this->filterProducts();
        } else {
            $this->showAllProducts();
        }
    }

    public function showAllProducts() {
        $paginator = new \Models\Paginator();
        $productDao = \Wee\DaoFactory::getDao('Product');
        $paginator->setCount($productDao->getProductCount());
        $paginator->setPerpage();
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $paginator->setCurrent($_GET['page']);
        } else {
            $paginator->setCurrent(1);
        }
        $paginator->setPages();
        $start = ($paginator->getCurrent() - 1) * $paginator->getPerpage();
        $limit = $paginator->getPerpage();
        $products = $productDao->getAllProducts($start, $limit);
        $this->render('admin/list_products', array('products' => $products, 'paginator' => $paginator));
    }

    public function filterProducts() {
        $paginator = new \Models\Paginator();
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $paginator->setCurrent($_GET['page']);
        } else {
            $paginator->setCurrent(1);
        }
        $paginator->setPerpage();
        if (!isset($_GET['stock']) || $_GET['stock'] == 0) {
            $stock = 0;
        } 
        else {
            $stock = 1;
        }
        $start = ($paginator->getCurrent() - 1) * $paginator->getPerpage();
        $limit = $paginator->getPerpage();
        $productDao = \Wee\DaoFactory::getDao('Product');
        $paginator->setCount($productDao->getFilteredProductCount($_GET['product_name'], $_GET['category'], $stock));
        $paginator->setPages();
        $products = $productDao->getFilterProducts($_GET['product_name'], $_GET['category'], $stock, $start, $limit);
        $this->render('admin/list_products', array('products' => $products, 'paginator' => $paginator));
    }

    public function deleteProduct() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $productDao->deleteProduct($_POST['product_id']);
        $imageDao = \Wee\DaoFactory::getDao('Image');
        $image = $imageDao->getImageByProductId($_POST['product_id']);
        $image->deleteImage();
        $imageDao->deleteImage($_POST['product_id']);
        $this->redirect('admin_products');
    }

    public function showEditProduct() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $product = $productDao->getProductById($_GET['product_id']);
        $this->render('admin/edit_product', array('product' => $product));
    }

    public function activateProduct() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $productDao->setProductActivity($_POST['product_id'], 1);
        $this->redirect('admin_products');
    }
    
    public function deactivateProduct() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $productDao->setProductActivity($_POST['product_id'], 0);
        $this->redirect('admin_products');
    }

    public function showProductForm() {
        $this->render('admin/add_product', array('product' => null));
    }

    public function addProduct() {
        $product = null;
        if (!empty($_POST['data'])) {
            $product = new \Models\Product();
            $product->updateAttributes($_POST['data']);
            
            $product->createImage($_FILES['image']['tmp_name'], $_FILES['image']['name'], $_FILES['image']['type'], $_FILES['image']['tmp_name']);
            
            if ($product->isValid()) {
                $productDao = \Wee\DaoFactory::getDao('Product');
                $productDao->addProduct($product);
                $product->getImage()->setProduct_id($productDao->getLastInsertedProduct());
                $product->getImage()->saveImage();
                $this->showProductForm();
            } else {
                $this->render('admin/add_product', array('product' => $product));
            }
        }
    }

    public function editProduct() {
        $product = null;
        if (!empty($_POST['data'])) {
            $productDao = \Wee\DaoFactory::getDao('Product');
            $product = $productDao->getProductById($_POST['data']['id']);
            $imageDao = \Wee\DaoFactory::getDao('Image');
            $image = $imageDao->getImageByProductId($_POST['data']['id']);
            $product->setImage($image);
            

            if (!empty($_FILES['image']['name'])) {
                $product->createImage($_FILES['image']['tmp_name'], $_FILES['image']['name'], $_FILES['image']['type'], $_FILES['image']['tmp_name']);
            }

            if ($product->isValid()) {
                $productDao = \Wee\DaoFactory::getDao('Product');
                $productDao->updateProduct($product);
                if (!empty($_FILES['image']['name'])) {
                    $image->deleteImage();
                    $product->getImage()->setProduct_id($_POST['data']['id']);
                    $product->getImage()->updateImage();
                }
                $this->redirect('admin_products');
            }
        }
        $this->render('admin/edit_product', array('product' => $product));
    }
}

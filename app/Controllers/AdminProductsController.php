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
        $paginator->setCount('Product');
        $paginator->setPerpage('Product');
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $paginator->setCurrent($_GET['page']);
        } else {
            $paginator->setCurrent(1);
        }
        $paginator->setPages();
        $start = ($paginator->getCurrent() - 1) * $paginator->getPerpage();
        $limit = $paginator->getPerpage();
        $productDao = \Wee\DaoFactory::getDao('Product');
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
        $paginator->setItemsPerpage();
        if (!isset($_GET['stock']) || $_GET['stock'] == 0) {
            $stock = 0;
        } 
        else {
            $stock = 1;
        }
        $start = ($paginator->getCurrent() - 1) * $paginator->getPerpage();
        $limit = $paginator->getPerpage();
        $productDao = \Wee\DaoFactory::getDao('Product');
        $paginator->setItemsCount($productDao->getFilteredProductCount($_GET['product_name'], $_GET['category'], $stock));
        $paginator->setPages();
        $products = $productDao->getFilterProducts($_GET['product_name'], $_GET['category'], $stock, $start, $limit);
        $this->render('admin/list_products', array('products' => $products, 'paginator' => $paginator));
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
            } else {
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

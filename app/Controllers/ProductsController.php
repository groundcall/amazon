<?php

namespace Controllers;

class ProductsController extends \Wee\Controller {
    
    public function initialize() {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        if (empty($_SESSION['cart_id'])) {
            $this->cart = new \Models\Cart();
            if (isset($_SESSION['id'])) {
                $cartDao->addCart($_SESSION['id']);
            } else {
                $cartDao->addCart(0);
            }
            $_SESSION['cart_id'] = $cartDao->getLastInsertedCart();
        }
        $this->cart = $cartDao->getCartById($_SESSION['cart_id']);
    }
    
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
        $this->render('users/product_detail', array('product' => $product, 'randomProducts' => $randomProducts, 'cart' => $this->cart));
    }

    public function showProducts() {
        $paginator = new \Models\Paginator();
        $filtering = new \Models\Filtering();
        
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
            $paginator->setCurrent($_GET['page']);
        } else {
            $paginator->setCurrent(1);
        }
        if (isset($_GET)) {
            if (isset($_GET['category'])) {
                $categoryDao = \Wee\DaoFactory::getDao('Category');
                if ($categoryDao->getCategoryById($_GET['category'])) {
                    $filtering->setCategory_id($_GET['category']);
                }
            } else {
                $filtering->setCategory_id('0');
            }
            if (isset($_GET['order'])) {
                $filtering->setOrder($_GET['order']);
            }
            if (isset($_GET['sort'])) {
                $filtering->setSort($_GET['sort']);
            }
            if (isset($_GET['stock'])) {
                $filtering->setStock($_GET['stock']);
            }
            if (isset($_GET['price'])) {
                $filtering->setPrice($_GET['price']);
            }
            if (isset($_GET['title'])) {
                $filtering->setTitle($_GET['title']);
            }
            $productDao = \Wee\DaoFactory::getDao('Product');
            $numberOfProducts = $productDao->getFilterProducts3($filtering, 'count');
            $paginator->setPerpage();
            $start = ($paginator->getCurrent() - 1) * $paginator->getPerpage();
            $filtering->setStart($start);
            $limit = $paginator->getPerpage();
            $filtering->setLimit($limit);
            if ($filtering->getLimit() == NULL) {
                $filtering->setLimit($paginator->getPerpage());
            }
            $paginator->setCount($numberOfProducts);
            $paginator->setPages();

            $products = $productDao->getFilterProducts3($filtering, 'no count');
            $this->render('users/show_products', array('products' => $products, 'filtering' => $filtering, 'paginator' => $paginator, 'cart' => $this->cart));
        }
    }
}

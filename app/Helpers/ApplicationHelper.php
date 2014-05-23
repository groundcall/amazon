<?php

namespace Helpers;

trait ApplicationHelper {

    //use UserHelper;
    //use ProfileHelper;
    public function errorFor($object, $name) {
        if ($object->hasError($name)) {
            return implode(", ", $object->getError($name));
        }
        return '';
    }

    public function getCategories() {
        $categoryDao = \Wee\DaoFactory::getDao('Category');
        $categories = $categoryDao->getAllCategories();
        return $categories;
    }

//    public function numberOfProducts() {
//        $productDao = \Wee\DaoFactory::getDao('Product');
//        $numberOfProducts = $productDao->getProductCount();
//        return $numberOfProducts;
//    }
//    
//    public function numberOfProductPages() {
//        $productPerPage = 10;
//        if ($this->numberOfProducts() % $productPerPage == 0) {
//            $numberOfPages = $this->numberOfProducts() / $productPerPage;
//        }
//        else {
//            $numberOfPages = intval($this->numberOfProducts() / $productPerPage) + 1;
//        }
//        return $numberOfPages;
//    }
//    
//    public function numberOfUsers() {
//        $userDao = \Wee\DaoFactory::getDao('User');
//        $numberOfUsers = $userDao->getUserCount();
//        return $numberOfUsers;
//    }
//    
//    public function numberOfUserPages() {
//        $userPerPage = 2;
//        if ($this->numberOfUsers() % $userPerPage == 0) {
//            $numberOfPages = $this->numberOfUsers() / $userPerPage;
//        }
//        else {
//            $numberOfPages = intval($numberOfPages = $this->numberOfUsers() / $userPerPage) + 1;
//        }
//        return $numberOfPages;
//    }


    public function getLastSixProducts() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $products = $productDao->getLastProducts(6);
        return $products;
    }

    public function getProductsByCategory($category) {
//        var_dump($category->getId()); 


        $productDao = \Wee\DaoFactory::getDao('Product');
        $products = $productDao->getProductsByCategoryId($category->getId());

        return $products;

//        $sql = 'SELECT * FROM products WHERE category_id = :categoy_id';
//        $stmt = $this->getConnection()->prepare($sql);
//        $stmt->bindValue(':category_id', $category->getId());
//        $result=getProducts($stmt);
//        
//        return $result;
    }

    public function getCategoryLabelById($category_id) {
        $categoryDao = \Wee\DaoFactory::getDao('Category');
        $category = $categoryDao->getCategoryById($category_id);

        return $category->getLabel();
    }

    public function getEducations() {
        $educationDao = \Wee\DaoFactory::getDao('Education');
        $education = $educationDao->getAllEducations();
        return $education;
    }

    function getNumberOfProductsInCategory($filtering, $category_id) {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $filtering->setCategory_id($category_id);
        $result = $productDao->getFilterProducts3($filtering, 'count');
        
        return $result;
    }
}

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

    public function getLastSixProducts() {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $products = $productDao->getLastProducts(6);
        return $products;
    }

    public function getProductsByCategory($category) {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $products = $productDao->getProductsByCategoryId($category->getId());

        return $products;
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
        $filtering->setStart(null);
        $filtering->setLimit(null);
        $result = $productDao->getFilterProducts3($filtering, 'count');
        
        return $result;
    }
}

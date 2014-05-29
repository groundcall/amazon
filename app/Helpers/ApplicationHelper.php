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

    public function getNumberOfProductsInCategory($filtering, $category_id) {
        $productDao = \Wee\DaoFactory::getDao('Product');
        $filtering->setCategory_id($category_id);
        $filtering->setStart(null);
        $filtering->setLimit(null);
        $result = $productDao->getFilterProducts3($filtering, 'count');

        return $result;
    }

    public function calculateCartTotal($cart_id) {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $total = $cartDao->calculateCartTotal($cart_id);

        return $total;
    }

    public function getNumberOfItemsInCart($cart_id) {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $total = $cartDao->getNumberOfItemsInCart($cart_id);
        return $total;
    }

    public function getCountries() {
        $countryDao = \Wee\DaoFactory::getDao('Country');
        $countries = $countryDao->getAllCountries();
        return $countries;
    }

    public function getShippingMethods() {
        $shippingMethodDao = \Wee\DaoFactory::getDao('ShippingMethod');
        $shippingMethods = $shippingMethodDao->getAllShippingMethods();
        return $shippingMethods;
    }

    public function getPaymentMethods() {
        $paymentMethodDao = \Wee\DaoFactory::getDao('PaymentMethod');
        $paymentMethods = $paymentMethodDao->getAllPaymentMethods();
        return $paymentMethods;
    }

    public function checkQuantity($cart, $product) {
        $cartitem = $cart->getCartItemByProductId($product->getId());
        if ($cartitem){
            $quantity = $cartitem->getQuantity() + 1;
        }
        else{
            $quantity = 1;
        }
        if ($product->getStock() >= $quantity){
            return true;
        }
    }
    
    public function getCartById($cart_id){
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartById($cart_id);
        return $cart;
    }
}

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
        if ($cartitem) {
            $quantity = $cartitem->getQuantity() + 1;
        } else {
            $quantity = 1;
        }
        if ($product->getStock() >= $quantity) {
            return true;
        }
    }

    public function getCartById($cart_id) {
        $cartDao = \Wee\DaoFactory::getDao('Cart');
        $cart = $cartDao->getCartById($cart_id);
        return $cart;
    }

    public function getLastOrdersByUser($user) {
        $orderDao = \Wee\DaoFactory::getDao('Order');
        $orders = $orderDao->getLastOrdersByUser($user);
        return $orders;
    }

    public function getStates() {
        $stateDao = \Wee\DaoFactory::getDao('State');
        $states = $stateDao->getAllStates();
        return $states;
    }

    public function getAvailableStates($state) {
        $stateDao = \Wee\DaoFactory::getDao('State');
        $states = array();

        if ($state->getId() == 0) {
            $states[] = $stateDao->getStateById(0);
            $states[] = $stateDao->getStateById(1);
            $states[] = $stateDao->getStateById(3);
        }

        if ($state->getId() == 1) {
            $states[] = $stateDao->getStateById(1);
            $states[] = $stateDao->getStateById(2);
            $states[] = $stateDao->getStateById(3);
        }

        if ($state->getId() == 2) {
            $states[] = $stateDao->getStateById(2);
            $states[] = $stateDao->getStateById(3);
            $states[] = $stateDao->getStateById(4);
        }

        if ($state->getId() == 3) {
            $states[] = $stateDao->getStateById(3);
        }

        if ($state->getId() == 4) {
            $states[] = $stateDao->getStateById(4);
        }

        return $states;
    }

    public function getUserById($user_id) {
        $userDao = \Wee\DaoFactory::getDao('User');
        $user = $userDao->getUserById($user_id);
        if ($user != null) {
            return $user->getUsername();
        }
    }

}

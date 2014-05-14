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
}

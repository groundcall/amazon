<?php

namespace Validators;

trait CartItemValidator {

    public function validateQuantity() {
        $this->registerValidator(function($cartItem) {
            if ($cartItem->getQuantity() <= 0 || !is_numeric($cartItem->getQuantity())) {
                $cartItem->addError("quantity", "Invalid quantity!");
            }
        });
    }
    
    public function validateQuantityInStock() {
        $this->registerValidator(function($cartItem) {
//            var_dump($cartItem->getQuantity());
//            var_dump($cartItem->getProduct()->getStock()); die();
            if ($cartItem->getQuantity() > $cartItem->getProduct()->getStock()) {
                $cartItem->addError("quantity", "Selected quantity exceeds stock!");
            }
        });
    }
}
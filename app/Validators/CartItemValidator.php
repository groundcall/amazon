<?php

namespace Validators;

trait CartItemValidator {

    public function validateQuantity() {
        $this->registerValidator(function($cartItem) {
            if ($cartItem->getQuantity() <= 0) {
                $cartItem->addError("quantity", "Invalid quantity!");
            }
        });
    }
    
    public function validateQuantityInStock() {
        $this->registerValidator(function($cartItem) {
            if ($cartItem->getQuantity() > $cartItem->getProduct()->getStock()) {
                $cartItem->addError("quantity", "Selected quantity exceeds stock!");
            }
        });
    }
    
    public function validateQuantityIsNumeric() {
        $this->registerValidator(function($cartItem) {
            if (!is_numeric($cartItem->getQuantity())) {
                $cartItem->addError("quantity", "Quantity must be numeric!");
            }
        });
    }
}
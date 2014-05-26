<?php

namespace Validators;

trait CartItemValidator {

    public function validatePrice() {
        $this->registerValidator(function($cartItem) {
            if ($cartItem->getPrice() <= 0 || !is_numeric($cartItem->getPrice())) {
                $cartItem->addError("price", "Price must be a positive number.");
            }
        });
    }

    public function validateQuantity() {
        $this->registerValidator(function($cartItem) {
            if ($cartItem->getQuantity() < 0 || !is_numeric($cartItem->getQuantity())) {
                $cartItem->addError("quantity", "Quantity must be a positive number.");
            }
        });
    }
    
    public function validateProductQuantity() {
        $this->registerValidator(function($cartItem) {
            if ($cartItem->getQuantity() > $cartItem->getProduct()->getStock()) {
                $cartItem->addError("quantity", "Quantity too large.");
            }
        });
    }
}
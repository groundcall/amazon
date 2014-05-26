<?php

namespace Validators;

trait CartItemValidator {

    public function validateQuantity() {
        $this->registerValidator(function($cartItem) {
            if ($cartItem->getQuantity() <= 0 || !is_numeric($cartItem->getQuantity()) || $cartItem->getQuantity() > $cartItem->getProduct()->getStock()) {
                $cartItem->addError("quantity", "Incorrect quantity.");
            }
        });
    }
}
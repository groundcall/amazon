<?php

namespace Validators;

trait Base {

    public function validatesPresenceOf($attributeName, $message = "This is a required field") {
        $this->registerValidator(function($object) use ($attributeName, $message) {
            $value = $object->getAttribute($attributeName);

            if (empty($value)) {
                $object->addError($attributeName, $message);
            }
        });
    }
}

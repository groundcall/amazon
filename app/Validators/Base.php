<?php

namespace Validators;

trait Base {

    public function validatesPresenceOf($attributeName, $message = "This is a required field") {
        $this->validate(function($object) use ($attributeName, $message) {
            $value = $object->getAttribute($attributeName);

            if (empty($value)) {
                $this->addError($attributeName, $message);
            }
        });
    }
}

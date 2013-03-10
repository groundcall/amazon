<?php

namespace Wee\Traits;

trait ValidatesAssociated {

    public function validatesAssociated($attributeName, $as = 'default') {
        $validator = function($object) use ($attributeName, &$validator) {
            $attribute = $object->getAttribute($attributeName);

            if (method_exists($attribute, 'isValid')) {
                $valid = $attribute->isValid($as);
                $this->mergeValidationResult($valid);
            } elseif (is_array($object)) {
                foreach ($attribute as $item) {
                    $validator($item);
                }
            }
        };

        $this->validate($validator);
    }
}


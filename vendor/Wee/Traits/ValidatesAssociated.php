<?php

namespace Wee\Traits;

trait ValidatesAssociated {

    /**
     * Registers a validator that will check the given attribute name for errors.
     *
     * @param string $attributeName The name of the attribute to cascade validation to
     * @param [string] $as Only run this validator when isValid() is called with $as
     */
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

        $this->validate($as, $validator);
    }
}


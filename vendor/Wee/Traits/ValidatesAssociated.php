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
        $validator = function($object, $attribute = NULL) use ($attributeName, &$validator, $as) {
                    if ($attribute == null) {
                        $attribute = $object->getAttribute($attributeName);
                        $validator($object, $attribute);
                    } else {
                        if (method_exists($attribute, 'isValid')) {
                            $valid = $attribute->isValid($as);
                            $object->mergeValidationResult($valid);
                        } elseif (is_array($attribute)) {
                            foreach ($attribute as $item) {
                                $validator($object, $item);
                            }
                        }
                    }
                };

        $this->validate($as, $validator);
    }

}


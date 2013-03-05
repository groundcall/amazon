<?php

namespace Wee\Traits;

/**
 *
 */
trait Validation {

    protected $_validators = array('default' => array());
    protected $_errors = array();

    public function validate($as, $callable = null) {
        if (is_callable($as)) {
            $this->_validators['default'][] = $as;
        } else {
            $this->_validators[$as] = isset($this->_validators[$as]) ? $this->_validators[$as] : array();
            $this->_validators[$as][] = $callable;
        }
    }

    public function clearErrors() {
        $this->_errors = array();
    }

    public function getErrors() {
        return $this->_errors;
    }

    public function getError($name) {
        return $this->_errors[$name];
    }

    public function hasError($name) {
        return isset($this->_errors[$name]);
    }

    public function addError($key, $message) {
        isset($this->_errors[$key]) or $this->_errors[$key] = array();
        $this->_errors[$key][] = $message;
    }

    public function isValid($as = false) {
        $this->clearErrors();
        $valid = true;

        foreach (get_object_vars($this) as $property) {
            $r = $this->validProperty($property, $as);
            $valid = $valid && $r;
        }

        $validators = $this->_validators['default'];
        if ($as !== false) {
            $validators = array_merge($validators, $this->_validators[$as]);
        }

        foreach ($validators as $validator) {
            $validItem = call_user_func($validator, $this);
            $valid = $valid && $validItem;
        }

        return $valid;
    }

    private function validProperty($object, $as = false) {
        $result = true;

        if (method_exists($object, "isValid")) {
            $result = $object->isValid($as);
        } elseif (is_array($object)) {
            foreach ($object as $item) {
                $r = $this->validProperty($item, $as);
                $result = $result && $r;
            }
        }

        return $result;
    }

}


<?php

namespace Wee\Traits;

/**
 *
 */
trait Validation {

    protected $_validators = array('default' => array());
    protected $_errors = array();
    protected $_valid = true;

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
        $this->_valid = true;
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
        $this->_valid = false;
    }

    public function isValid($as = false) {
        $this->clearErrors();

        $validators = $this->_validators['default'];
        if ($as !== false) {
            $validators = array_merge($validators, $this->_validators[$as]);
        }

        foreach ($validators as $validator) {
            call_user_func($validator, $this);
        }

        return $this->_valid;
    }

    public function mergeValidationResult($valid) {
        $this->_valid = $this->_valid && $valid;
    }
}


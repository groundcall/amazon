<?php

namespace Wee\Traits;

/**
 *
 */
trait Validation {

    protected $_validators = array();
    protected $_errors = array();
    protected $_valid = true;

    /**
     * Register a validator for this object.
     *
     * @param callable the validator to add to the list of validators
     */
    public function registerValidator($callable = null) {
        $this->_validators[] = $callable;
    }


    /**
     * Clears the validation erros and resets the object to true
     */
    public function clearErrors() {
        $this->_errors = array();
        $this->_valid = true;
    }

    /**
     * Gets all the validation errors for this object.
     * @return array
     */
    public function getErrors() {
        return $this->_errors;
    }

    /**
     * Gets the error messages for a single property
     * @param $name the property name to retrieve errors for
     * @return array
     */
    public function getError($name) {
        return $this->_errors[$name];
    }

    /**
     * Checks if this object has any errors on a given property
     * @param string $name the name of the property to check for errors
     * @return boolean
     */
    public function hasError($name) {
        return isset($this->_errors[$name]);
    }

    /**
     * Adds an error message to a property namespace
     * @param string $key the property name to add an error message to
     * @param string $message the error message
     */
    public function addError($key, $message) {
        isset($this->_errors[$key]) or $this->_errors[$key] = array();
        $this->_errors[$key][] = $message;
        $this->_valid = false;
    }

    /**
     * Checks if this object is valid.
     * - this function will clear the existing errors and re-run all the registered validators.
     *
     * @return boolean
     */
    public function isValid() {
        $this->clearErrors();

        $validators = $this->_validators;

        foreach ($validators as $validator) {
            call_user_func($validator, $this);
        }

        return $this->_valid;
    }
    
    /**
     * Sets a validation error unless there already is one.
     *
     * @param boolean $valid the partial validation result to merge.
     */
    public function mergeValidationResult($valid) {
        $this->_valid = $this->_valid && $valid;
    }
}


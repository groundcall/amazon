<?php

namespace Validators;

trait AddressValidator {

    public function validateFirstname() {
        $this->registerValidator(function($address) {
            if (!preg_match("/^[a-zA-Z\s]+$/", $address->getFirstname())) {
                $address->addError("firstname", "Name must contain only letters.");
            }
        });
    }

    public function validateLastname() {
        $this->registerValidator(function($address) {
            if (!preg_match("/^[a-zA-Z\s]+$/", $address->getLastname())) {
                $address->addError("lastname", "LastName must contain only letters.");
            }
        });
    }
    
    public function validateEmail() {
        $this->registerValidator(function($address) {
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $address->getEmail())) {
                $address->addError("email", "Email format incorrect.");
            }
        });
    }
    
    public function validateAddress() {
        $this->registerValidator(function($address) {
            if (strlen(trim($address->getAddress())) < 5) {
                $address->addError("address", "Address must contain at least 5 characters.");
            }
        });
    }
    
    public function validateCity() {
        $this->registerValidator(function($address) {
            if (strlen(trim($address->getCity())) <= 0 || is_numeric($address->getCity())) {
                $address->addError("city", "Incorrect city name.");
            }
        });
    }
}


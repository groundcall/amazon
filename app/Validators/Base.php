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
    
    public function userNotExists($attributeName = 'username', $message = 'Username already exists.') {
        $this->registerValidator(function($object) use ($attributeName, $message) {
            if (\Wee\DaoFactory::getDao('User')->getUserByUsername($object) != null) {
                $object->addError($attributeName, $message);
            }
        });
    }

    public function emailNotExists($attributeName = 'email', $message = 'Email already exists.') {
        $this->registerValidator(function($object) use ($attributeName, $message) {
            if (\Wee\DaoFactory::getDao('User')->getUserByEmail($object) != null) {
                $object->addError($attributeName, $message);
            }
        });
    }
    
    public function verifyPassword($attributeName = 'password', $message = 'Password must have at least 6 characters.') {
        $this->registerValidator(function($object) use ($attributeName, $message) {
            if (strlen($object->getPassword()) < 6) {
                $object->addError($attributeName, $message);
            }
        });
    }
    
    public function verifyPasswordsMatch($attributeName = 'password2', $message = "Passwords don't match.") {
        $this->registerValidator(function($object) use ($attributeName, $message) {
            if ($object->getPassword() != $object->getPassword2()) {
                $object->addError($attributeName, $message);
            }
        });
    }
//            if ($user->getPassword() == $user->getPassword2()) {
//                $user->addError("password2", "Passwords don't match.");
//            }
//            
}

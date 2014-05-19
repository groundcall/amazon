<?php

namespace Validators;

trait UserValidator {

    public function validateUserFirstname() {
        $this->registerValidator(function($user) {
            if (!preg_match("/^[a-zA-Z\s]+$/", $user->getFirstname())) {
                $user->addError("firstname", "Name must contain only letters.");
            }
        });
    }

    public function validateUserLastname() {
        $this->registerValidator(function($user) {
            if (!preg_match("/^[a-zA-Z\s]+$/", $user->getLastname())) {
                $user->addError("lastname", "LastName must contain only letters.");
            }
        });
    }

    public function validateUserUsername() {
        $this->registerValidator(function($user) {
            if (!preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $user->getUsername())) {
                $user->addError("username", "Username format incorrect");
            }
        });
    }

    public function validateUserPhone() {
        $this->registerValidator(function($user) {
            if (strlen($user->getPhone()) != 10 || !is_numeric($user->getPhone())) {
                $user->addError("phone", "Phone number must contain 10 digits.");
            }
        });
    }

    public function validateUserGender() {
        $this->registerValidator(function($user) {
            if (!($user->getGender() == "M" || $user->getGender() == "F")) {
                $user->addError("gender", "Please select a gender.");
            }
        });
    }

    public function validateUserEmail() {
        $this->registerValidator(function($user) {
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $user->getEmail())) {
                $user->addError("email", "Email format incorrect.");
            }
        });
    }

    public function usernameNotExists($attributeName = 'username', $message = 'Username already exists.') {
        $this->registerValidator(function($object) use ($attributeName, $message) {
            if ((\Wee\DaoFactory::getDao('User')->getUserByUsername($object) != null) && !(\Wee\DaoFactory::getDao('User')->pairUsernameIdExists($object))) {
                $object->addError($attributeName, $message);
            }
        });
    }

    public function emailNotExists($attributeName = 'email', $message = 'Email already exists.') {
        $this->registerValidator(function($object) use ($attributeName, $message) {
            if ((\Wee\DaoFactory::getDao('User')->getUserByEmail($object) != null) && !(\Wee\DaoFactory::getDao('User')->pairEmailIdExists($object))) {
                $object->addError($attributeName, $message);
            }
        });
    }

    public function verifyPassword($attributeName = 'password', $message = 'Password must have at least 6 characters.') {
        $this->registerValidator(function($object) use ($attributeName, $message) {

            if ($object->getId()) {
                if ($object->getPassword() != '' && strlen($object->getPassword()) < 6) {

                    $object->addError($attributeName, $message);
                }
            } else {
                if (strlen($object->getPassword()) < 6) {
                    $object->addError($attributeName, $message);
                }
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

}

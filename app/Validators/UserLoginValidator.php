<?php

namespace Validators;

trait UserLoginValidator {

    public function valiateUserLoginEmailNotEmpty() {
        $this->registerValidator(function($userLogin) {
            if (strlen($userLogin->getEmail()) == 0) {
                $userLogin->addError('email', 'Email is required.');
            }
        });
    }
    
    public function validateUserLoginEmailFormat() {
        $this->registerValidator(function($userLogin) {
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $userLogin->getEmail())) {
                $userLogin->addError('email', 'Email format incorrect.');
            }
        });
    }
    
    public function valiateUserLoginEmailExists() {
        $this->registerValidator(function($userLogin) {
            $userDao = \Wee\DaoFactory::getDao('User');
            if ($userDao->getUserByEmailAddress($userLogin->getEmail()) == NULL) {
                $userLogin->addError('email', 'Email not found in database.');
            }
        });
    }
    
    public function valiateUserLoginPasswordFormat() {
        $this->registerValidator(function($userLogin) {
            if (strlen($userLogin->getPassword()) < 6) {
                $userLogin->addError('password', 'Password format incorrect.');
            }
        });
    }
    
    public function valiateUserLoginEmailPasswordPair() {
        $this->registerValidator(function($userLogin) {
            $userDao = \Wee\DaoFactory::getDao('User');
            if ($userDao->getUserByEmailAndPassword($userLogin->getEmail(), $userLogin->getPassword()) == NULL) {
                $userLogin->addError('email', 'Email or password is incorrect.');
            }
        });
    }
    
    public function valiateUserLoginStatus() {
        $this->registerValidator(function($userLogin) {
            $userDao = \Wee\DaoFactory::getDao('User');
            $user = $userDao->getUserByEmailAndPassword($userLogin->getEmail(), $userLogin->getPassword());
            if ($user && $user->getActivated() == 0) {
                $userLogin->addError('email', 'This account is inactive.');
            }
        });
    }
}
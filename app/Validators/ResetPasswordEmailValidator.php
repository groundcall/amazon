<?php 

namespace Validators;

trait ResetPasswordEmailValidator {
    
    public function validateEmailFormat() {
        $this->registerValidator(function($ressetPassword) {
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $ressetPassword->getEmail())) {
                $ressetPassword->addError('email', 'Email format incorrect.');
            }
        });
    }
    
    public function valiateEmailExists() {
        $this->registerValidator(function($ressetPassword) {
            $userDao = \Wee\DaoFactory::getDao('User');
            if ($userDao->getUserByEmailAddress($ressetPassword->getEmail()) == NULL) {
                $ressetPassword->addError('email', 'Email not found in database.');
            }
        });
    }
    
    public function validateUserStatus() {
        $this->registerValidator(function($ressetPassword) {
            $userDao = \Wee\DaoFactory::getDao('User');
            $user = $userDao->getUserByEmailAddress($ressetPassword->getEmail());
            if ($user != NULL) {
                if ($user->getActivated() == 0) {
                    $ressetPassword->addError('email', 'This account is inactive.');
                }
            }
        });
    }
}
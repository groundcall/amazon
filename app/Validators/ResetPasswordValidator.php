<?php

namespace Validators;

trait ResetPasswordValidator {
    
    public function valiatePasswordFormat() {
        $this->registerValidator(function($ressetPassword) {
            if (strlen($ressetPassword->getPassword()) < 6) {
                $ressetPassword->addError('password', 'Password format incorrect.');
            }
        });
    }
    
    public function valiateConfirmPasswordFormat() {
        $this->registerValidator(function($ressetPassword) {
            if (strlen($ressetPassword->getPassword2()) < 6) {
                $ressetPassword->addError('password2', 'Password format incorrect.');
            }
        });
    }
    
    public function validatePasswordsMatch() {
        $this->registerValidator(function($ressetPassword) {
            if ($ressetPassword->getPassword() != $ressetPassword->getPassword2()) {
                $ressetPassword->addError('password2', "Passwords don't match.");
            }
        });
    }
}


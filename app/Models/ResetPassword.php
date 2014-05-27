<?php

namespace Models;

class ResetPassword extends \Wee\Model {
    
    use \Validators\ResetPasswordValidator;
    
    protected $password;
    protected $password2;
            
    function __construct() {
        $this->setAttrAccessible(array('password', 'password2'));
    
        $this->valiatePasswordFormat();
        $this->valiateConfirmPasswordFormat();
        $this->validatePasswordsMatch();
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPassword2() {
        return $this->password2;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setPassword2($password2) {
        $this->password2 = $password2;
    }
}
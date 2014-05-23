<?php

namespace Models;

class ResetPassword extends \Wee\Model {
    
    use \Validators\ResetPasswordValidator;
    
    protected $email;
    protected $password;
    protected $password2;
            
    function __construct() {
        $this->setAttrAccessible(array('email', 'password', 'password2'));
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPassword2() {
        return $this->password2;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setPassword2($password2) {
        $this->password2 = $password2;
    }
}
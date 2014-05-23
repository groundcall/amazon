<?php

namespace Models;

class UserLogin extends \Wee\Model {
    
    use \Validators\UserLoginValidator;

    protected $email;
    protected $password;
    
    function __construct() {
        $this->valiateUserLoginEmailNotEmpty();
        $this->validateUserLoginEmailFormat();
        $this->valiateUserLoginEmailExists();
        $this->valiateUserLoginPasswordFormat();
        $this->valiateUserLoginEmailPasswordPair();
        $this->valiateUserLoginStatus();
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}

    
<?php

namespace Models;

class ResetPasswordEmail extends \Wee\Model {

    use \Validators\ResetPasswordEmailValidator;
    
    protected $email;

    public function __construct() {
        $this->setAttrAccessible(array('email'));
        
        $this->validateEmailFormat();
        $this->valiateEmailExists();
        $this->validateUserStatus();
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
}
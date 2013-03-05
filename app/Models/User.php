<?php
namespace Models;

/**
 * User model
 */
class User extends \Wee\Model {

    protected $firstName;
    protected $lastName;
    protected $email;

    /**
     *
     */
    public function __construct() {
        $this->setAttrAccessible(array('firstName', 'lastName', 'email'));

        $this->validate(function($user){
            if (strlen($user->getFirstName()) < 2) {
                $user->addError("firstName", "At least 2 characters please");
                return false;
            }
            return true;
        });

        $this->validate(function($user){
            if (strlen($user->getLastName()) < 2) {
                $user->addError("lastName", "At least 2 characters please");
                return false;
            }
            return true;
        });

        $this->validate(function($user){
            if (strlen($user->getEmail()) < 2) {
                $user->addError("email", "At least 2 characters please");
                return false;
            }
            return true;
        });
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getEmail() {
        return $this->email;
    }
}

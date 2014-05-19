<?php

namespace Models;

class User extends \Wee\Model {
    
    use \Validators\UserValidator;

    protected $id;
    protected $username;
    protected $password;
    protected $password2;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $phone;
    protected $gender;
    protected $role_id;
    protected $activated;
    protected $activation_key;
    protected $billing_address_id;
    protected $shipping_address_id;
    protected $created_at;

    function __construct() {
        $this->setAttrAccessible(array('username', 'password', 'password2', 'firstname', 'lastname', 'email', 'phone', 'gender', 'activated', 'role_id', 'activation_key',
            'billing_address_id', 'shipping_address_id', 'created_at'));
        
        $this->validateUserFirstname();
        $this->validateUserLastname();
        $this->validateUserUsername();
        $this->validateUserEmail();
        $this->validateUserPhone();
        $this->validateUserGender();
        
        $this->usernameNotExists();
        $this->emailNotExists();
        $this->verifyPassword();
        $this->verifyPasswordsMatch();

    }

    public function __destruct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getRole_id() {
        return $this->role_id;
    }

    public function getActivated() {
        return $this->activated;
    }

    public function getActivation_key() {
        return $this->activation_key;
    }

    public function getBilling_address_id() {
        return $this->billing_address_id;
    }

    public function getShipping_address_id() {
        return $this->shipping_address_id;
    }

    public function getCreated_at() {
        return $this->created_at;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function setRole_id($role_id) {
        $this->role_id = $role_id;
    }

    public function setActivated($activated) {
        $this->activated = $activated;
    }

    public function setActivation_key($activation_key) {
        $this->activation_key = $activation_key;
    }

    public function setBilling_address_id($billing_address_id) {
        $this->billing_address_id = $billing_address_id;
    }

    public function setShipping_address_id($shipping_address_id) {
        $this->shipping_address_id = $shipping_address_id;
    }

    public function setCreated_at($created_at) {
        $this->created_at = $created_at;
    }

    public function getPassword2() {
        return $this->password2;
    }

    public function setPassword2($password2) {
        $this->password2 = $password2;
    }

}

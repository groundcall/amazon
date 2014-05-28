<?php

namespace Models;

class Address extends \Wee\Model {
        
    use \Validators\AddressValidator;
    
    protected $id;
    protected $address;
    protected $city;
    protected $country_id;
    protected $firstname;
    protected $lastname;
    protected $email;
    
    protected $country;
    
    public function __construct() {
        $this->setAttrAccessible(array('address', 'city', 'firstname', 'lastname', 'email', 'country_id'));
        
        $this->validateAddress();
        $this->validateCity();
        $this->validateFirstname();
        $this->validateLastname();
        $this->validateEmail();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCity() {
        return $this->city;
    }

    public function getCountry_id() {
        return $this->country_id;
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

    public function getCountry() {
        return $this->country;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setCity($city) {
        $this->city = $city;
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

    public function setCountry($country_id) {
        $this->country_id = $country_id;
        $countryDao = \Wee\DaoFactory::getDao('Country');
        $country = $countryDao->getCountryById($country_id);
        $this->country = $country;
    }
}
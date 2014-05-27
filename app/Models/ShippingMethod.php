<?php

namespace Models;

class ShippingMethod extends \Wee\Model {
            
    protected $id;
    protected $name;
    protected $price;
    
    public function __construct() {
        $this->setAttrAccessible(array('name', 'price'));
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
}
<?php

namespace Models;

class PaymentMethod extends \Wee\Model {
            
    protected $id;
    protected $name;
    
    public function __construct() {
        $this->setAttrAccessible(array('name'));
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }
}
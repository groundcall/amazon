<?php

namespace Models;

class Country extends \Wee\Model {
        
    protected $id;
    protected $code;
    protected $name;
    
    public function __construct() {
        $this->setAttrAccessible(array('code', 'name'));
    }
    
    public function getId() {
        return $this->id;
    }

    public function getCode() {
        return $this->code;
    }

    public function getName() {
        return $this->name;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setName($name) {
        $this->name = $name;
    }
}


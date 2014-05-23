<?php

namespace Models;

class Education extends \Wee\Model {
    
    protected $id;
    protected $description;
    
    public function __construct() {
        $this->setAttrAccessible(array('description'));
    }
    
    public function getId() {
        return $this->id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLabel($desctiption) {
        $this->description = $desctiption;
    }
}
<?php

namespace Models;

class State extends \Wee\Model {
    
    protected $id;
    protected $label;
    
    public function __construct() {
        $this->setAttrAccessible(array('label'));
    }
    
    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

}


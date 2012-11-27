<?php

namespace Wee\Traits;

trait Attributes {
    protected $attributes = array();

    public function updateAttributes($array) {
        foreach ($array as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                throw new \Exception("No such attribute {$key} for class " . get_class($this));
            }
        }
    }

    public function getAttributes() {
        $r = array();

        foreach ($this->attributes as $key) {
            if (!$this->isReservedAttributeName($key)) {
                $r[$key] = $this->$key;
            }
        }

        return $r;
    }

}


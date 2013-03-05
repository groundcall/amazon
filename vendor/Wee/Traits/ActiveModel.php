<?php

namespace Wee\Traits;

/**
 * Provides methods for serializing an object to and from a storage
 *
 * Persistence is not handled by this class.
 */
trait ActiveModel {

    protected $_attr_accessible = array();

    /**
     * Returns the name of this Model
     */
    public function getModelName() {
        return \Wee\Utils\Utils::demodulize(get_class($this));
    }

    public function setAttrAccessible($array) {
        $that = $this;
        array_map(function($value) use ($that) {
                    if (!property_exists($that, $value)) {
                        throw new \Exception("No such attibute '{$value}'");
                    }
                }, $array);

        $this->_attr_accessible = $array;
    }

    public function updateAttributes($attributes) {
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key) && in_array($key, $this->_attr_accessible)) {
                if (method_exists($this->$key, 'update_attributes')) {
                    call_user_func(array($this->$key, 'update_attributes'), $value);
                } else {
                    $this->$key = $value;
                }
            }
        }
    }

    /**
     * Updates all the properties of this object from $array
     *
     * @param mixed $array an array of values with the array keys corresponding to properties on this object
     * @return throws \Exception if a key is found that is not a property of this object
     */
    public function updateAllAttributes($array) {
        foreach ($array as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                throw new \Exception("No such attribute {$key} for class " . get_class($this));
            }
        }
    }

    /**
     * Retrieves the values of the properties of this object defined in $this->attributes
     *
     * @return mixed
     * @see loadFieldNames
     * @see isReservedAttributeName
     */
    public function getAttributes() {
        $r = array();

        foreach (get_object_vars($this) as $key => $value) {
            if (!$this->isReservedAttributeName($key)) {
                $r[$key] = $value;
            }
        }

        return $r;
    }

    /**
     * Return if $name is a reserved attribute
     *
     * @internal
     */
    private function isReservedAttributeName($name) {
        return $name == 'id' || $name[0] == '_';
    }

    /**
     * Creates an object from an array of field values
     *
     * @param mixed $values The field values
     * @param string $klass the class to create
     * @return An instance of the new class populated with the values from the
     * database
     */
    public static function hydrate($values, $klass = null) {
        $klass = is_null($klass) ? get_called_class() : $klass;
        $instance = new $klass();
        $instance->updateAllAttributes($values);

        return $instance;
    }

}


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

    /**
     * Updates the attributes of this object present in $attributes
     *
     * This funciton will ingore keys:
     * - not declared with setAttrAccessible
     * - not a property on the object
     *
     * @param array $attributes array of values
     */
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
     * Retrieves the attributes for this object.
     *
     * @return array
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
     * Retrieves the value of a given attribute
     * @param string $attributeName the name of the attribute to retrieve
     * @return mixed the value
     */
    public function getAttribute($attributeName) {
        return $this->$attributeName;
    }

    /**
     * Return if $name is a reserved attribute
     *
     * @internal
     */
    private function isReservedAttributeName($name) {
        return $name[0] == '_';
    }

    /**
     * Updates all the properties of this object from $array
     *
     * @param mixed $array an array of values with the array keys corresponding to properties on this object
     * @return throws \Exception if a key is found that is not a property of this object
     * @see hydrate
     */
    private function updateAllAttributes($array) {
        foreach ($array as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                throw new \Exception("No such attribute {$key} for class " . get_class($this));
            }
        }
    }

    /**
     * Creates an object from an array of field values
     *
     * @param mixed $values The field values
     * @param string $klass the class to create
     * @return object a new instance of $klass populated with the values from the array
     */
    public static function hydrate($values, $klass = null) {
        $klass = is_null($klass) ? get_called_class() : $klass;
        $instance = new $klass();
        $instance->updateAllAttributes($values);

        return $instance;
    }
}


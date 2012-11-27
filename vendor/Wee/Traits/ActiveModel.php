<?php

namespace Wee\Traits;

trait ActiveModel {

    public function __construct() {
        $this->loadFieldNames();
        $this->validateProperties();
    }

    /**
     * Returns the name of this Model
     */
    public function getModelName() {
        return self::modelFromClass(get_class($this));
    }


    public static function modelFromClass($klass) {
        return @end(explode('\\', strtolower($klass)));
    }

    /**
     * Updates the row in the database
     *
     * @throws \Exception If the object is new
     */
    public function update() {
        if ($this->isNew()) {
            throw new \Exception("I can't update this object!");
        } else {
            $attributes = $this->getAttributes();
            $this->updateRecord($this->id, $attributes, $this->getModelName());
        }
    }

    /**
     * Returns if this object is new
     * An object is new if there is no primary key set(id)
     *
     * @return boolean
     */
    public function isNew() {
        return !is_numeric($this->id);
    }

    /**
     * Persists this object in the database
     * After saving the object, the primary key will be populated with the
     * value form the database.
     *
     * @throws \Exception If the object is not new
     */
    public function insert() {
        if (!$this->isNew()) {
            throw new \Exception("Can't insert existing record");
        } else {
            $attributes = $this->getAttributes();
            $this->id = $this->insertRecord($attributes, $this->getModelName());
        }
    }

    /**
     * Find an object by ID
     * @param integer $id The id of the object
     * @return Model
     */
    public static function findById($id) {
        $klass = get_called_class();

        $values = self::selectById($id, self::modelFromClass($klass));

        return self::hydrate($values[0], $klass);
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
        $instance->updateAttributes($values);

        return $instance;
    }

    protected function loadFieldNames() {
        $this->attributes = \Wee\Model::getFieldNamesForTable($this->getTableName());
    }

    protected function validateProperties() {
        $vars = get_object_vars($this);

        foreach ($this->attributes as $databaseColumn) {
            if (!array_key_exists($databaseColumn, $vars)) {
                throw new \Exception("Missing property {$databaseColumn} for " . $this->getModelName());
            }
        }
    }

}


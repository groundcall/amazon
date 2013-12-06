<?php

namespace Wee;

class Dao {
    protected $connection;

    private function __construct($connection) {
        $this->connection = $connection;
    }

    public static function create($connection) {
        $klass = get_called_class();
        return new $klass($connection);
    }

    public function getConnection() {
        return $this->connection;
    }
}

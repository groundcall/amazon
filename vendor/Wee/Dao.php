<?php

namespace Wee;

class Dao {
    protected $connection;

    private function __construct($connection) {
        $this->connection = $connection;
    }

    public static function create($connection) {
        return new Dao($connection);
    }
}

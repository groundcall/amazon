<?php

namespace Wee\Traits;

trait Database {

    public static function logSql($sql) {
        error_log($sql, 0);
    }

    /**
     * Returns a string with the table name in the database for this model
     */
    public function getTableName() {
        return strtolower($this->getModelName());
    }

    /**
     * Returns a list of field names for the table in the database
     */
    public static function getFieldNamesForTable($tableName) {
        $db = \Wee\Database::sharedInstance();
        $sql = "show fields from {$tableName}";
        self::logSql($sql);

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $fields = $stmt->fetchAll();

        return array_map(function($e) {
            return $e["Field"];
        }, $fields);
    }

    public static function updateRecord($id, $values, $tableName) {
        $db = \Wee\Database::sharedInstance();

        $set = implode('=?, ', array_keys($values));
        $sql = "UPDATE {$tableName} SET {$set} =? WHERE id=?";
        self::logSql($sql);

        $stmt = $db->prepare($sql);

        $parameters = array_values($values);
        $parameters[] = $id;

        if ($stmt->execute(array_values($parameters)) === false) {
            throw new \Exception("update failed");
        }
    }

    public static function insertRecord($values, $tableName) {
        $db = \Wee\Database::sharedInstance();
        $values = array_filter($values);

        $questionmarks = sizeof($values) > 0 ? implode(', ', array_fill(0, sizeof($values), '?')) : '';
        $sql = "insert into {$tableName} (" . implode(', ', array_keys($values)) . ") values ({$questionmarks})";
        self::logSql($sql);

        $stmt = $db->prepare($sql);

        if ($stmt->execute(array_values($values)) === false) {
            throw new \Exception("insert failed ");
        } else {
            return $db->lastInsertId();
        }
    }

    public function isReservedAttributeName($name) {
        return $name == 'id';
    }

    public static function selectById($id, $table) {
        $db = \Wee\Database::sharedInstance();

        $sql = "SELECT * FROM {$table} WHERE id = ? ";
        self::logSql($sql);

        $stmt = $db->prepare($sql);
        if ($stmt->execute(array($id)) === false) {
            throw new \Exception("Can't find object {$id}");
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}


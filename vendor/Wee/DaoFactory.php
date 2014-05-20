<?php

namespace Wee;

class DaoFactory {

    static private $connection = null;

    /**
     * @return \PDO
     */
    private static function getSharedConnection() {
        if (is_null(self::$connection)) {
            self::$connection = new \PDO(sprintf("%s:host=%s;dbname=%s", DB_TYPE, DB_HOST, DB_NAME), DB_USER, DB_PASS);
            self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$connection->exec('set names utf8');
        }

        return self::$connection;
    }

    /**
     * @return \PDO
     */
    public static function getDao($daoFactoryName) {
        $klassName = \Wee\Utils\Utils::daoClass($daoFactoryName);

        return call_user_func_array(array($klassName, 'create'), array(self::getSharedConnection()));
    }

}

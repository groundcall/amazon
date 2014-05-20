<?php

namespace Wee\Utils;

class Utils {
    const DAO_CLASS = '\Wee\Dao';

    /**
     * Returns a celized string from a lowe case and underscored string by upper-casing the first and each letter preceded by an underscore
     */
    static function classify($string) {
        return @preg_replace(array('#/(.?)#e', '/(^|_)(.)/e'), array("'::'.strtoupper('\\1')", "strtoupper('\\2')"), $string);
    }

    /**
     * Returns a camelized string from a lower case and underscored string by upper-casing each letter preceded by an underscore.
     */
    static function camelize($string) {
        return @preg_replace(array('/(_)(.)/e'), array("strtoupper('\\2')"), $string);
    }

    static function underscore($string) {
        $tmp = preg_replace(array('/([A-Z]+)([A-Z][a-z])/', '/([a-z\d])([A-Z])/'), array('\\1_\\2', '\\1_\\2'), $string);

        return strtolower($tmp);
    }

    static function demodulize($klass) {
        return @end(explode('\\', $klass));
    }

    static function tableNameFromModel($klass) {
        return self::underscore(self::demodulize($klass));
    }

    static function controllerClass($string) {
        $class = self::classify($string);

        $className = "\\Controllers\\{$class}Controller";
        self::assertClassExists($className);

        return $className;
    }

    static function assertClassExists($name) {
        if (!class_exists($name)) {
            die("What is $name?");
        }
    }

    static function assertInstanceOf($klassName, $parent) {
        $klass = new \ReflectionClass($klassName);
        if (!$klass->isSubclassOf($parent)) {
            die("{$klassName} must extend $parent");
        }
    }

    static function daoClass($name) {
        $class = self::classify($name);

        $className = "\\Dao\\{$class}Dao";
        self::assertClassExists($className);
        self::assertInstanceOf($className, self::DAO_CLASS);

        return $className;
    }
}

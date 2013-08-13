<?php

namespace Wee\Utils;

class Utils {

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

        return "\\Controllers\\{$class}Controller";
    }

}

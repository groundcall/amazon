<?php

namespace Wee;

class Utils {

    static function classify($string) {
        return ucfirst($string);
    }

    static function controllerClass($string) {
        $class = self::classify($string);

        return "\\Controllers\\{$class}Controller";
    }
}

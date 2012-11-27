<?php

namespace Wee;

class NameValidator {
    public static function validateAsController($controller) {
        return class_exists(\Wee\Utils::controllerClass($controller));
    }

    public static function validateAsControllerAction($controller, $action) {
        if (!strlen($controller) || !strlen($action)) {
            return false;
        }

        $klass = new \ReflectionClass(\Wee\Utils::controllerClass($controller));

        foreach ($klass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->name == $action) {
                return true;
            }
        }

        return false;
    }
}

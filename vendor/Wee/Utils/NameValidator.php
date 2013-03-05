<?php

namespace Wee\Utils;

use \Wee\Utils\Utils;

class NameValidator {

    public static function validateAsController($controller) {
        return class_exists(Utils::controllerClass($controller));
    }

    public static function validateAsControllerAction($controller, $action) {
        $action = Utils::camelize($action);

        if (!strlen($controller) || !strlen($action)) {
            return false;
        }

        $klass = new \ReflectionClass(Utils::controllerClass($controller));

        foreach ($klass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->name == $action) {
                return true;
            }
        }

        return false;
    }

}

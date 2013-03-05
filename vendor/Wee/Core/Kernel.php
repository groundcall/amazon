<?php

namespace Wee\Core;

use \Wee\Utils\Utils;

define("DEFAULT_CONTROLLER", 'default');
define("DEFAULT_ACTION", 'index');

class Kernel {

    public function run() {
        $url = isset($_GET['url']) && strlen($_GET['url']) > 0 ? $_GET['url'] : DEFAULT_CONTROLLER;
        $url = explode('/', trim($url, '/'));

        // Controller
        $controllerName = Utils::classify($url[0]);
        array_shift($url);

        $controllerClass = Utils::controllerClass($controllerName);
        $controllerInstance = new $controllerClass();

        if (count($url)) {
            $actionName = Utils::camelize($url[0]);
            array_shift($url);
        } else {
            $actionName = DEFAULT_ACTION;
        }

        if (method_exists($controllerInstance, $actionName)) {
            $controllerInstance->$actionName();
        } else {
            throw new \Exception("No such action $actionName in $controllerClass");
        }
    }

}

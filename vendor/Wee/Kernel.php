<?php
namespace Wee;

define("DEFAULT_CONTROLLER", 'test');
define("DEFAULT_ACTION", 'index');

class Kernel {
    public function run() {
        $url = isset($_GET['url']) ? $_GET['url'] : DEFAULT_CONTROLLER;
        $url = explode('/', trim($url, '/'));

        // Controller
        $controllerName = $this->classify($url[0]);
        array_shift($url);

        $controllerClass = \Wee\Utils::controllerClass($controllerName);
        $controllerInstance = new $controllerClass();

        if (count($url)) {
            $actionName = $url[0];
            array_shift($url);
        } else {
            $actionName = DEFAULT_ACTION;
        }

        if (method_exists($controllerInstance, $actionName)) {
            $controllerInstance->$actionName();
        }
    }

    public function classify($string) {
        return ucfirst($string);
    }
}

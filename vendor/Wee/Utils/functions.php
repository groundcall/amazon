<?php

/**
 * Generates a url
 *
 * Ex:
 *  url('test/login') => "/index.php?url=test/login"
 *  url('test/index', array('id' => 1)) => "/index.php?url=test/index&id=1"
 *  url('user/list', array('sort' => "username", 'direction" => 'up')) => "/index.php?url=test/index&sort=username&direction=up"
 *
 * @param string $url a valid controller/action pair
 * @param mixed $params an optional list of extra parameters to include in the generated url
 * @return string the generated URL
 */
function url($url, $params = array()) {
    $url = explode('/', $url);
    $controller = isset($url[0]) ? $url[0] : '';
    $action = isset($url[1]) ? $url[1] : DEFAULT_ACTION;

    if (!\Wee\Utils\NameValidator::validateAsControllerAction($controller, $action)) {
        throw new Exception("Not a valid controller/action pair");
    }

    $path = "/{$controller}/{$action}";

    $x = array();
    foreach ($params as $k => $v) {
        $x[] = "$k=$v";
    }

    $variables = implode('&', $x);
    if (strlen($variables) > 0) {
        $path .= '?';
        $path .= $variables;
    }

    return $path;
}

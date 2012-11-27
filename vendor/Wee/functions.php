<?php

function url($url, $params = array()) {
    $url = explode('/', $url);
    $controller = isset($url[0]) ? $url[0] : '';
    $action = isset($url[1]) ? $url[1] : DEFAULT_ACTION;

    if (!\Wee\NameValidator::validateAsControllerAction($controller, $action)) {
        throw new Exception("Not a valid controller/action pair");
    }

    $path = "/index.php?url={$controller}/{$action}";

    $x = array();
    foreach ($params as $k => $v) {
        $x[] = "$k=$v";
    }

    $variables = implode('&', $x);
    if (strlen($variables) > 0) {
        $path .= "&" . $variables;
    }

    return $path;
}

function render($file, $params = array()) {
    $file .= '.php';

    $module = dirname($file);
    if (!strlen($module)) {
        throw new Exception("$file needs a module name");
    }

    $dir = APP_DIR . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $module;
    if (!is_dir($dir)) {
        throw new Exception("No such directory $dir");
    }

    $fileName = $dir .DIRECTORY_SEPARATOR . basename($file);
    if (!file_exists($fileName)) {
        throw new Exception("Can't read file $fileName");
    }

    extract($params, EXTR_SKIP);
    ob_start();
    include $fileName;
    return ob_get_clean();
}

<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

DEFINE("WEB_DIR", dirname(__FILE__));
DEFINE("ROOT_DIR", realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'));
DEFINE("VENDOR_DIR", ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor');
DEFINE("CONFIG_DIR", ROOT_DIR . DIRECTORY_SEPARATOR . 'config');
DEFINE("APP_DIR", ROOT_DIR . DIRECTORY_SEPARATOR . 'app');

if (!file_exists(CONFIG_DIR . '/database.php')) {
    echo "Error: config/database.php not found! <br> <br>";
    echo "Copy the example config by running: <b>cp ". ROOT_DIR . "/config/database.php{.example,}</b> ";
    die();
}

require CONFIG_DIR . '/config.php';
require VENDOR_DIR . '/Wee/Utils/ClassLoader.php';
require VENDOR_DIR . '/Wee/Utils/functions.php';

$loader = new \Wee\Utils\ClassLoader();
$loader->add('Wee', VENDOR_DIR);
$loader->add('', ROOT_DIR . DIRECTORY_SEPARATOR . 'app');
$loader->register();

$kernel = new \Wee\Core\Kernel();
$kernel->run();

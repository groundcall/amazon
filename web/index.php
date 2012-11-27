<?php

DEFINE("WEB_DIR", dirname(__FILE__));
DEFINE("ROOT_DIR", realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR. '..'));
DEFINE("VENDOR_DIR", ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor');
DEFINE("APP_DIR", ROOT_DIR . DIRECTORY_SEPARATOR . 'app');

require VENDOR_DIR . '/Wee/ClassLoader.php';
require VENDOR_DIR . '/Wee/functions.php';

$loader = new \Wee\Autoload\ClassLoader();
$loader->add('Wee', VENDOR_DIR);
$loader->add('Controllers', ROOT_DIR . DIRECTORY_SEPARATOR . 'app');
$loader->add('Models', ROOT_DIR . DIRECTORY_SEPARATOR . 'app');
$loader->register();

$kernel = new \Wee\Kernel();
$kernel->run();


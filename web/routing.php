<?php

if (file_exists(__DIR__ . '/' . $_SERVER['REQUEST_URI'])) {
    return false; // serve the requested resource as-is.
} else {
    $_GET['url'] = @$_SERVER['PATH_INFO'];

    include_once 'index.php';
}

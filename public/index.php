<?php

namespace Core;

foreach (['config', 'classes'] as $type) {
    foreach (glob('../' . $type . '/*.php') as $filename) {
        include $filename;
    }
}

require DIR_CONTROL . 'controller.php';

$endpoint = explode('/', $_SERVER['REQUEST_URI'])[1];

//TODO: investigate autoloading to replace this
// check the model exists and load it
if (file_exists(DIR_MODEL . $endpoint . '.php')) {
    include_once(DIR_MODEL . $endpoint . '.php');
}
// check the controller exists and load it
if (file_exists(DIR_CONTROL . $endpoint . '.php')) {
    include_once(DIR_CONTROL . $endpoint . '.php');
}

$classname = 'Core\\' . ucwords($endpoint);
if (class_exists($classname)) {
    $class = new $classname();
}

Controller::getinstance()->send();

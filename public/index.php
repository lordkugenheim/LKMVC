<?php

use Core;

require __DIR__ . '/../config/config.php';
require DIR_ROOT . 'vendor\autoload.php';
require DIR_CONTROL . 'controller.php';

$endpoint_name = explode('/', $_SERVER['REQUEST_URI'])[1];

if (Controller::endpointExists($endpoint)) {
    $endpoint = Controller::getEndpoint($endpoint);
    if ($endpoint->isvalidRoute()) {
        $endpoint->go();
    }
}

//TODO: investigate autoloading to replace this
// check the model exists and load it
if (file_exists(DIR_MODEL . $endpoint . '.php')) {
    include_once(DIR_MODEL . $endpoint . '.php');
}
// check the controller exists and load it
if (file_exists(DIR_CONTROL . $endpoint . '.php')) {
    include_once(DIR_CONTROL . $endpoint . '.php');
}

Controller::getinstance()->send();

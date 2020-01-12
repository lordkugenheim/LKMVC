<?php

use Core;

require __DIR__ . '/../config/config.php';
require DIR_ROOT . 'vendor\autoload.php';
require DIR_CONTROL . 'controller.php';

$endpoint_name = explode('/', $_SERVER['REQUEST_URI'])[1];

if (Controller::isvalidEndpoint($endpoint)) {
    $endpoint = Controller::getEndpoint($endpoint);
    if ($endpoint->isvalidRoute()) {
        $endpoint->go();
    } else {
        // Send invalid route error
    }
} else {
    // Send invalid endpoint error
}

Controller::getinstance()->send();

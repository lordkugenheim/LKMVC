<?php

namespace Core;

require __DIR__ . '/../config/config.php';
require DIR_ROOT . 'vendor\autoload.php';

$endpoint_name = explode('/', $_SERVER['REQUEST_URI'])[1];

if (class_exists($endpoint_name)) {
    $endpoint = new $endpoint_name;

    var_dump($endpoint);
}

if (Controller::isvalidEndpoint($endpoint_name)) {
    
    if ($endpoint->isvalidRoute()) {
        $endpoint->go();
    } else {
        // Send invalid route error
    }
} else {
    // Send invalid endpoint error
}

Controller::getinstance()->sendAll();

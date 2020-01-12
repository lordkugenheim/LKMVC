<?php

use Core;

require __DIR__ . '/../config/config.php';
require DIR_ROOT . 'vendor\autoload.php';
require DIR_CONTROL . 'controller.php';

$endpoint_name = explode('/', $_SERVER['REQUEST_URI'])[1];

if (Controller::isvalidEndpoint($endpoint_name)) {
    $endpoint = Controller::getEndpoint($endpoint_name);
    if ($endpoint->isvalidRoute()) {
        $endpoint->go();
    } else {
        // Send invalid route error
    }
} else {
    // Send invalid endpoint error
}

http_response_code(Controller::getinstance()->getHttpCode());
Controller::getinstance()->sendHeaders();
echo Controller::getinstance()->getBody();

<?php

namespace Core;

require '../app/config/core.php';
require DIR_APP . 'bootstrap.php';

$controller = new Controller();

/*

$endpoint_name = explode('/', $_SERVER['REQUEST_URI'])[1];

if (Controller::isvalidEndpoint($endpoint_name)) {
    $endpoint = Controller::getEndpoint($endpoint_name);
    if ($endpoint->isvalidMethod()) {
        $endpoint->dobyMethod();
    } else {
        Controller::getInstance()->setbyConst(UNACCEPTIBLE_ROUTE);
    }
} else {
    Controller::getInstance()->setbyConst(INVALID_ENDPOINT);
}

Controller::getinstance()->sendAll();
*/

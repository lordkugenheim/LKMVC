<?php

foreach (['config', 'classes'] as $type) {
    foreach (glob('../' . $type . '/*.php') as $filename) {
        include $filename;
    }
}

// block requests not in the allowed_methods
if (!in_array($_SERVER['REQUEST_METHOD'], ALLOWED_METHODS)) {
    $header = 'Allow: ' . implode(',', ALLOWED_METHODS);
    $output = 'Invalid request method. Allowed methods are ' . implode(', ', ALLOWED_METHODS);
    Controller::getinstance()->addHeader($header);
    Controller::getinstance()->addOutput(['message' => $output]);
    Controller::getinstance()->setHttpCode(405);
    Controller::getinstance()->send();
}

// get our vars from the url
$vars = explode('/', $_SERVER['REQUEST_URI']);
$params = array_slice($vars, 2);

// check the controller exists and load it
if (file_exists(DIR_CONTROL . $vars[1] . '.php')) {
    include_once(DIR_CONTROL . $vars[1] . '.php');
}

Controller::getinstance()->ssend();

<?php

foreach (['config', 'classes'] as $type) {
    foreach (glob('../' . $type . '/*.php') as $filename) {
        include $filename;
    }
}

include DIR_CONTROL . 'controller.php';

// block requests not in the allowed_methods
if (!in_array($_SERVER['REQUEST_METHOD'], ALLOWED_METHODS)) {
    $header = 'Allow: ' . implode(',', ALLOWED_METHODS);
    $output = 'Invalid request method. Allowed methods are ' . implode(', ', ALLOWED_METHODS);
    Core\Controller::getinstance()->addHeader($header);
    Core\Controller::getinstance()->addOutput(['message' => $output]);
    Core\Controller::getinstance()->setHttpCode(405);
    Core\Controller::getinstance()->send();
}

 $vars = explode('/', $_SERVER['REQUEST_URI']);
 
// check the controller exists and load it
if (file_exists(DIR_CONTROL . $vars[1] . '.php')) {
    include_once(DIR_CONTROL . $vars[1] . '.php');
}
// check the model exists and load it
if (file_exists(DIR_MODEL . $vars[1] . '.php')) {
    include_once(DIR_MODEL . $vars[1] . '.php');
}

// send our response
Core\Controller::getinstance()->send();

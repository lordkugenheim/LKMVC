<?php

include('../config/config.php');

$allowed_methods = [
    'GET',
    'POST',
    'PUT',
    'DELETE',
];

// block requests not in the allowed_methods
if (!in_array($_SERVER['REQUEST_METHOD'], $allowed_methods)) {
    die;
}

// get our vars from the url
$vars = explode('/', $_SERVER['REQUEST_URI']);
$params = array_slice($vars, 2);

// check the controller exists and load it
if (file_exists(DIR_ROOT . $vars[1])) {
    include_once(DIR_ROOT . $vars[1]);
}

if (isset($return)) {
    echo json_encode($return);
}

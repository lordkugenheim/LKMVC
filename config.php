<?php

define('DIR_ROOT', '../');
define('DIR_CLASS', DIR_ROOT . 'classes/');
define('DIR_CONFIG', DIR_ROOT . 'config/');
define('DIR_CONTROL', DIR_ROOT . 'controllers/');
define('DIR_MODEL', DIR_ROOT . 'models/');

define('INVALID_PARAMETER', [
    'message' => 'invalid or missing parameter supplied',
    'httpcode' => 400
]);
define('INVALID_ENDPOINT', [
    'message' => 'invalid endpoint requested',
    'httpcode' => 404
]);
define('UNACCEPTIBLE_ROUTE', [
    'message' => 'Method not allowed',
    'httpcode' => 405
]);

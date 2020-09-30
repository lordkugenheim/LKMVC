<?php

define('DIR_ROOT', dirname(__DIR__, 2) . '/');
define('DIR_APP', DIR_ROOT . 'app/');
define('DIR_CONFIG', DIR_APP . 'config/');
define('DIR_CONTROL', DIR_APP . 'controllers/');
define('DIR_FUNC', DIR_APP. 'functions/');
define('DIR_LIB', DIR_APP . 'lib/');
define('DIR_MODEL', DIR_APP . 'models/');
define('DIR_TRAIT', DIR_APP . 'traits/');

/*
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
*/
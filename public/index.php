<?php

require '../app/Bootstrap.php';

$app = new Core();
if (!$app->initialise()) {
    Controller::loadView('json', [
        'data' => 'endpoint not recognised',
        'status' => 'error',
        'http_status' => 404,
    ]);
}

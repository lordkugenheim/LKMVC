<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $output = trim($_POST['message']);
        Core\Controller::getinstance()->addOutput(['message' => $output]);
        Core\Controller::getinstance()->setHttpCode(200);
        break;
    default:
        $header = 'Allow: POST';
        $output = 'Invalid request method. Allowed methods are POST';
        Core\Controller::getinstance()->addHeader($header);
        Core\Controller::getinstance()->addOutput(['message' => $output]);
        Core\Controller::getinstance()->setHttpCode(405);
        break;
}

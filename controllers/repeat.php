<?php

namespace Core;

class Repeat extends RepeatModel // implements ControllerInterface
{
    use MasterController;

    const ALLOWED_METHODS = [
        'POST',
    ];

    public function __construct()
    {
        $message = Controller::getParameter('message');

        if ($message && Controller::getinstance()->allowedMethod()) {
            $output = $message;
            Controller::getinstance()->setHttpCode(200);
        } elseif (!Controller::getinstance()->allowedMethod(self::ALLOWED_METHODS)) {
            $header = 'Allow: POST';
            $output = 'Invalid request method. Allowed methods are POST';
            Controller::getinstance()->addHeader($header);
            Controller::getinstance()->setHttpCode(405);
        } elseif (!$message) {
            $output = 'Malformed request';
            Controller::getinstance()->setHttpCode(400);
        }
        
        Controller::getinstance()->addOutput(['message' => $output]);
    }

    public function go()
    {

    }


}

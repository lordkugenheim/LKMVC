<?php

namespace Core;

class Repeat extends Controller
{
    const ALLOWED_METHODS = [
        'POST',
    ];

    public function __construct()
    {
        if ($this->allowedMethod()) {
            $this->repeatMessage();
        } else {
            // TODO Reusable Responses
            $header = 'Allow: POST';
            $output = 'Invalid request method. Allowed methods are POST';
            Core\Controller::getinstance()->addHeader($header);
            Core\Controller::getinstance()->setHttpCode(405);
        }
    }

    private function repeatMessage()
    {
        $message = Controller::getParameter('message');
        Controller::getinstance()->addOutput(['message' => $message]);
        Controller::getinstance()->setHttpCode(200);
    }
}

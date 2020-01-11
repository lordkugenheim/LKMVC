<?php

namespace Core;

class Repeat extends RepeatModel
{
    const ALLOWED_METHODS = [
        'POST',
    ];

    public function __construct()
    {
        if (Controller::getinstance()->allowedMethod()) {
            $this->repeatMessage();
        } else {
            // TODO Reusable Responses
            $header = 'Allow: POST';
            $output = 'Invalid request method. Allowed methods are POST';
            Controller::getinstance()->addHeader($header);
            Controller::getinstance()->setHttpCode(405);
        }
    }
}

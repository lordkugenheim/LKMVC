<?php

namespace Core;

class RepeatModel
{
    public function repeatMessage()
    {
        $message = Controller::getParameter('message');
        Controller::getinstance()->addOutput(['message' => $message]);
        Controller::getinstance()->setHttpCode(200);
    }
}

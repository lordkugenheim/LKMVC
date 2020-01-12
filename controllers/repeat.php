<?php

namespace Core;

class Repeat extends RepeatModel // implements ControllerInterface
{
    use ControllerTrait;

    const ALLOWED_METHODS = [
        'POST',
    ];

    public function post()
    {
        $message = $this->getParameter('message');
        $this->repeatMessage($message);
        return true;
    }
}

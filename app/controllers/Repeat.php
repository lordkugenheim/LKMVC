<?php

class Repeat extends Controller
{
    public function post()
    {
        $message = $this->getParameter('message');
        $this->repeatMessage($message);
        return true;
    }
}

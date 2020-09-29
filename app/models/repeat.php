<?php

namespace Core;

class RepeatModel // extends Database implements ModelInterface 
{
    // use ModelTrait;

    public function repeatMessage($message)
    {
        if ($message) {
            Controller::getInstance()->addOutput('message', $message);
            Controller::getInstance()->addOutput('method', $_SERVER['REQUEST_METHOD']);
            Controller::getInstance()->setHttpCode(200);
        } else {
            Controller::getInstance()->setbyConst(INVALID_PARAMETER);
        }
    }
}

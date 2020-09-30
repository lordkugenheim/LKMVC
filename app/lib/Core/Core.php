<?php

namespace Core;

class Core
{
    private $controller;

    public function __construct()
    {
        $request = new Request();

        if ($this->startController($request->controller)) {

        }

    }

    private function startController($controller)
    {
        if (file_exists(DIR_CONTROL . $controller)) {
            $this->controller = new $controller();
            return true;
        }
        return false;
    }
}

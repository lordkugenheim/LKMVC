<?php

class Core
{
    private $controller;

    public function __construct()
    {
        if ($this->startController(Request::controller())) {
            if (method_exists($this->controller, Request::method())) {
                $this->requestMethod(Request::method());
            }
        }
    }

    private function startController($controller)
    {
        if (file_exists(DIR_CONTROL . $controller . '.php')) {
            $this->controller = new $controller();
            return true;
        }
        return false;
    }

    private function requestMethod($method)
    {
        if (get_class($this->controller) && method_exists($this->controller, $method)) {
            $this->controller->$method();
        }
    }
}

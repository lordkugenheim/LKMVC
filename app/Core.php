<?php

class Core
{
    private $controller;

    public function initialise()
    {
        if ($this->callController(Request::controller())) {
            if (method_exists($this->controller, Request::method())) {
                $this->callMethod(Request::method());
                return true;
            }
        }
        return false;
    }

    private function callController($controller)
    {
        if (file_exists(DIR_CONTROL . $controller . '.php')) {
            $this->controller = new $controller();
            return true;
        }
        return false;
    }

    private function callMethod($method)
    {
        if (get_class($this->controller) && method_exists($this->controller, $method)) {
            $this->controller->$method();
        }
    }
}

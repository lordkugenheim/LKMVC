<?php

class Core
{
    private $controller;

    public function __construct()
    {
        $request = new Request();

        if ($this->startController($request->controller)) {
            if ($request->include_method && method_exists($controller, $request->method)) {
                $this->requestMethod($request->method);
            }
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

    private function requestMethod($method)
    {
        if (get_class($controller) && method_exists($controller, $method)) {
            $controller->$method();
        }
    }
}

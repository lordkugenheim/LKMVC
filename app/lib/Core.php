<?php

class Core
{
    private $controller;

    public function __construct()
    {
        $request = new Request();

        if ($this->startController($request->controller)) {
            if ($request->include_method && method_exists($this->controller, $request->method)) {
                $this->requestMethod($request->method);
            } else {
                $this->requestMethod('http' . $request->http_request_method);
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

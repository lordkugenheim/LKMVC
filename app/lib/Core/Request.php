<?php

namespace Core;

class Request
{
    private $controller;
    private $include_method = true;
    private $method;
    private $http_request_method = 'GET';
    private $other_parameters = [];

    public function __construct()
    {
        $this->getParams();
        $this->getController();
        if ($this->include_method) {
            $this->getMethod();
        }
        $this->getHttpMethod();
        $this->getOtherParams();
    }

    public function __get($property)
    {
        if (isset($this->$property)) {
            return $this->$property;
        } else {
            return false;
        }
    }

    private function getParams()
    {
        if (isset($_GET['params']) && $_GET['params'] != '') {
            $url = filter_var(rtrim($_GET['params'], '/'), FILTER_SANITIZE_URL);
        } else {
            $url = false;
        }
        return $url ? explode('/', $url) : [];
    }

    private function getController()
    {
        $this->controller = $this->url_parts[2];
    }

    private function getMethod()
    {

    }

    private function getHttpMethod()
    {

    }

    private function getOtherParams()
    {

    }
}

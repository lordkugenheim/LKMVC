<?php

namespace Core;

class Request
{
    private $controller;
    private $include_method = true;
    private $method;
    private $http_request_method;
    private $other_parameters = [];

    public function __construct()
    {
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
        $url = false;
        if (isset($_GET['params']) && $_GET['params'] != '') {
            $url = filter_var(rtrim($_GET['params'], '/'), FILTER_SANITIZE_URL);
        }
        return $url ? explode('/', $url) : [];
    }

    private function getController()
    {
        $this->controller = uc_words($this->getValatIndex(0));
    }

    private function getMethod()
    {
        $this->method = $this->getValatIndex(1);
    }

    private function getHttpMethod()
    {
        $this->http_request_method = $_SERVER['REQUEST_METHOD'];
    }

    private function getOtherParams()
    {
        $offset = $this->include_method ? 2 : 1;
        $this->other_parameters = array_slice($this->getParams(), $offset);
    }

    private function getValatIndex($index)
    {
        if (array_key_exists($index, $this->getParams())) {
            return $this->getParams()[$index];
        }
        return false;
    }
}

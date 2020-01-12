<?php

namespace Core;

class Controller
{
    public static $instance;

    private $httpCode;

    const ALLOWED_METHODS = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
    ];

    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function isvalidEndpoint($endpoint_name)
    {
        if (file_exists(DIR_CONTROL . $endpoint_name) && file_exists(DIR_MODEL . $endpoint_name)) {
            return true;
        }
        return false;
    }

    public static function getEndpoint($endpoint_name)
    {
        if (Controller::isvalidEndpoint($endpoint_name)) {
            include_once(DIR_CONTROL . $endpoint_name);
            include_once(DIR_MODEL . $endpoint_name);
            if (function_exists($endpoint_name::getinstance())) {
                return $endpoint_name::getinstance();
            }
        }
        return false;
    }

    public function setHttpCode($httpCode)
    {
        if (is_numeric($httpCode)) {
            $this->httpCode = $httpCode;
            return true;
        }
        return false;
    }

    public function setHeader($header)
    {
        $this->headers[] = $header;
    }

    public static function getParameter($parameter)
    {
        if (isset($_REQUEST[$parameter])) {
            return trim($_REQUEST[$parameter]);
        }
        return false;
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function isvalidRoute($allowed_methods = self::ALLOWED_METHODS)
    {
        if (in_array($_SERVER['REQUEST_METHOD'], $allowed_methods)) {
            return true;
        }
        return false;
    }

    private function getBody($output = false)
    {
        if (!$output) {
            // Get output from the response object
        }
        return json_encode($this->output);
        // Todo move to the output object
        // $this->addOutput(['status' => $this->status ? 'success' : 'error']);
    }

    private function sendHeaders()
    {
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        foreach ($this->headers as $header) {
            header($header);
        }
    }

    public function sendAll()
    {
        http_response_code(Controller::getinstance()->getHttpCode());
        Controller::getinstance()->sendHeaders();
        echo Controller::getinstance()->getBody();
    }
}

<?php

namespace Core;

class Controller
{
    public static $instance;

    private $httpCode = 400;
    private $status = false;
    private $output = [];
    private $headers = [];

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

    public function allowedMethod()
    {
        if (in_array($_SERVER['REQUEST_METHOD'], static::ALLOWED_METHODS)) {
            return self::ALLOWED_METHODS;
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

    public function addHeader($header)
    {
        $this->headers[] = $header;
    }

    public function addOutput($output)
    {
        if (is_array($output)) {
            foreach ($output as $key => $value) {
                $this->output[$key] = $value;
            }
        }
    }

    // TODO - change this to set based on the response code
    public function setSuccess($success = true)
    {
        $this->status = (bool)$success;
    }

    public function send()
    {
        $this->sendHeaders();
        http_response_code($this->getHttpCode());
        echo $this->buildResponse();
        die;
    }

    private function buildResponse()
    {
        if (empty($this->output)) {
            $this->addOutput(['message'=>'Requested endpoint is unavailable']);
        }
        $this->addOutput(['status' => $this->status ? 'success' : 'error']);
        return json_encode($this->output);
    }

    private function sendHeaders()
    {
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        foreach ($this->headers as $header) {
            header($header);
        }
    }
}

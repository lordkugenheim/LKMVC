<?php

namespace Core;

class Controller
{
    public static $instance;

    private $httpCode = 400;
    private $status = false;
    private $output = [];
    private $headers = [];

    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function setHttpCode($httpCode)
    {
        if (is_numeric($httpCode)) {
            $this->httpCode = $httpCode;
            return true;
        }
        return false;
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

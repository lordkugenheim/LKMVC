<?php

namespace Core;

class Response
{
    public static $instance;

    private $httpCode = 400;
    private $status = false;
    private $output = [];

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

    public function buildResponse()
    {
        if (empty($this->output)) {
            $this->addOutput(['message'=>'Requested endpoint is unavailable']);
        }
        $this->addOutput(['Status' => $this->status ? 'success' : 'error']);
        return json_encode($this->output);
    }

    public function send()
    {
        header('Content-Type: application/json');
        http_response_code($this->getHttpCode());
        echo $this->buildResponse();
        die;
    }
}

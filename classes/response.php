<?php

namespace Core;

class Response
{
    public static $instance;

    private $httpCode = 200;
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

    public function buildResponse()
    {
        return json_encode($this->output);
    }
}

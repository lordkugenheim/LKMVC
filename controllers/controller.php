<?php

namespace Core;

class Controller
{
    private static $instance;

    private $output = [];
    private $headers = [];
    private $httpCode;

    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function isvalidEndpoint($endpoint_name)
    {
        $filename = $endpoint_name . '.php';
        if (!$endpoint_name || !file_exists(DIR_CONTROL . $filename) || !file_exists(DIR_MODEL . $filename)) {
            return false;
        }
        return true;
    }

    public static function getEndpoint($endpoint_name)
    {
        $endpoint_name = "Core\\" . ucwords($endpoint_name);
        return new $endpoint_name;
    }

    public function gethttpCode()
    {
        return $this->httpCode;
    }

    public function sethttpCode($httpCode)
    {
        if (is_numeric($httpCode)) {
            $this->httpCode = $httpCode;
            return true;
        }
        return false;
    }

    public function setSuccess()
    {
        if (strpos($this->httpCode, '2') === 0) {
            return true;
        }
        return false;
    }

    public function setbyConst($const)
    {
        if (array_key_exists('header', $const)) {
            $this->addHeader($const['header']);
        }
        if (array_key_exists('message', $const)) {
            $this->addOutput('message', $const['message']);
        }
        if (array_key_exists('httpcode', $const)) {
            $this->sethttpCode($const['httpcode']);
        }
    }

    public function addHeader($header)
    {
        $this->headers[] = $header;
    }
    
    public function addOutput($type, $message)
    {
        $this->output[$type] = $message;
    }
    
    private function getBody($output = false)
    {
        $output = $this->output;
        $output['success'] = $this->setSuccess();
        return json_encode($output);
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
        http_response_code($this->httpCode);
        $this->sendHeaders();
        echo $this->getBody();
    }
}

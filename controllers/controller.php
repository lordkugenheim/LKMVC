<?php

namespace Core;

class Controller
{
    private $httpCode;
    private $headers = [];

    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function isvalidEndpoint($endpoint_name)
    {
        if (!$endpoint_name || !file_exists(DIR_CONTROL . $endpoint_name) || !file_exists(DIR_MODEL . $endpoint_name)) {
            return false;
        }
        return true;
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

    private function getBody($output = false)
    {
        if (!$output) {
            // Get output from the response object
        }
        return json_encode($output);
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

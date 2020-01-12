<?php

namespace Core;

class Controller
{
    private static $instance;

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
        $filename = $endpoint_name . '.php';
        if (!$endpoint_name || !file_exists(DIR_CONTROL . $filename) || !file_exists(DIR_MODEL . $filename)) {
            return false;
        }
        return true;
    }

    public static function getEndpoint($endpoint_name)
    {
        $endpoint_name = "Core\\" . ucwords($endpoint_name);
        return $endpoint_name::getInstance();
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

    // public function sendAll()
    // {
    //     http_response_code(Controller::getinstance()->getHttpCode());
    //     Controller::getinstance()->sendHeaders();
    //     echo Controller::getinstance()->getBody();
    // }
}

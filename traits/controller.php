<?php

namespace Core;

trait Controller
{
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
}

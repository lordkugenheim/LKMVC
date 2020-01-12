<?php

namespace Core;

trait ControllerTrait
{

    private static $instance;

    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function isvalidRoute($allowed_methods = self::ALLOWED_METHODS)
    {
        if (in_array($_SERVER['REQUEST_METHOD'], $allowed_methods)) {
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
}

<?php

namespace Core;

trait ControllerTrait
{
    public function dobyMethod()
    {
        $function_name = strtolower($_SERVER['REQUEST_METHOD']);
        if (function_exists()) {
            return $this->$function_name();
        }
        return false;
    }

    public function isvalidMethod($allowed_methods = self::ALLOWED_METHODS)
    {
        if (in_array($_SERVER['REQUEST_METHOD'], $allowed_methods)) {
            return true;
        }
        return false;
    }

    public function getParameter($parameter)
    {
        if (isset($_REQUEST[$parameter])) {
            return trim($_REQUEST[$parameter]);
        }
        return false;
    }
}

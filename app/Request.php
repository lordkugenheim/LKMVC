<?php

class Request
{

    private function __construct()
    {
        return false;
    }

    public static function controller()
    {
        return ucwords(self::getValatIndex(0));
    }

    public static function method()
    {
        if (SECOND_PARAM_METHOD) {
            return ucwords(self::getValatIndex(1));
        } else {
            return 'http' . ucwords($_SERVER['REQUEST_METHOD']);
        }
    }

    public static function otherParameters()
    {
        $offset = SECOND_PARAM_METHOD ? 2 : 1;
        return array_slice(self::getParams(), $offset);
    }

    private static function getValatIndex($index)
    {
        if (array_key_exists($index, self::getParams())) {
            return self::getParams()[$index];
        }
        return false;
    }

    private static function getParams()
    {
        if (isset($_GET['params']) && $_GET['params'] != '') {
            $url = filter_var(rtrim($_GET['params'], '/'), FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}

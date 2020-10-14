<?php

/**
 * Helper class to interpret HTTP requests
 *
 * Determines the requested endpoint and
 * parameters based on the http request
 *
 * Class is static and should not be instantiated
 *
 * @author Ben Taylor-Wilson <ben@ben-taylor.co.uk>
 * @see http://www.ben-taylor.co.uk/LKMVC
 */
class Request
{

    // prevent class instantiation
    private function __construct()
    {
        return false;
    }

    /**
     * Returns controller
     * for example, the url 'http://www.ben.taylor.co.uk/test/param'
     * would return 'test' as a string
     */
    public static function controller()
    {
        return ucwords(self::getValatIndex(0));
    }

    /**
     * Returns method based on SECOND_PARAM_METHOD setting (see config/core.php)
     * Method is either the second url parameter ('param' in the example above)
     * or the string http + http request method. i.e. httpGET or httpPOST
     * @return string
     */
    public static function method()
    {
        if (SECOND_PARAM_METHOD) {
            return ucwords(self::getValatIndex(1));
        } else {
            return 'http' . ucwords($_SERVER['REQUEST_METHOD']);
        }
    }

    /**
     * Returns the rest of the url parameters and any POST vars as an array
     * @return array
     */
    public static function otherParameters()
    {
        $offset = SECOND_PARAM_METHOD ? 2 : 1;
        $vars = array_slice(self::getParams(), $offset);
        if (!empty($_POST)) {
            $vars = array_merge($vars, $_POST);
        }
        return $vars;
    }

    /**
     * Return a parameter from the url at a specific index
     * @param index int
     * @return mixed - array on success, false on failure
     */
    private static function getValatIndex($index)
    {
        if (array_key_exists($index, self::getParams())) {
            return self::getParams()[$index];
        }
        return false;
    }

    /**
     * Get the url parameters as array
     * This works in combination with .htaccess
     * @return array
     */
    private static function getParams()
    {
        if (isset($_GET['params']) && $_GET['params'] != '') {
            $url = filter_var(rtrim($_GET['params'], '/'), FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}

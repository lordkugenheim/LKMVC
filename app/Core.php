<?php

/**
 * Core class for LKMVC Framework
 *
 * This class begins the application by determining the
 * requested endpoint and loading the associated controller
 *
 * @author Ben Taylor-Wilson <ben@ben-taylor.co.uk>
 * @see http://www.ben-taylor.co.uk/LKMVC
 */
class Core
{
    private $controller;

    /**
     * Determines controller and method
     * to load and then calls them
     * @return bool
     */
    public function initialise()
    {
        if ($this->callController(Request::controller())) {
            if (method_exists($this->controller, Request::method())) {
                $this->callMethod(Request::method());
                return true;
            }
        }
        return false;
    }

    /**
     * Check a particular controller's class' file
     * exists and instantiate it into $this->controller
     * @param $controller string name of controller to instantiate
     */
    private function callController($controller)
    {
        if (file_exists(DIR_CONTROL . $controller . '.php')) {
            $this->controller = new $controller();
            return true;
        }
        return false;
    }

    /**
     * Check a particular method exists in the
     * loaded controller and then call it
     * @param $method string name of the method to access
     */
    private function callMethod($method)
    {
        if (get_class($this->controller) && method_exists($this->controller, $method)) {
            $this->controller->$method();
        }
    }
}

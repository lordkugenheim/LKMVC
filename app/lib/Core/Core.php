<?php

namespace Core;

class Core
{
    public function __construct()
    {
        $request = new Request();
        $controller = ucwords($request->controller);
        if (file_exists(DIR_CONTROL . $controller)) {
            $controller = new $controller();
        }
    }
}
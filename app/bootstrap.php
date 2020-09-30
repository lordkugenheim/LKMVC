<?php

    spl_autoload_register(function ($class) {
        require_once DIR_LIB . str_replace('\\', '/', $class) . '.php';
    });
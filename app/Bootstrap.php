<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    foreach ([DIR_LIB, DIR_CONTROL, DIR_MODEL] as $folder) {
        if (file_exists($folder . $class . '.php')) {
            require_once $folder . $class . '.php';
        }
    }
});

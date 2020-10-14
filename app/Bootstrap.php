<?php

// load any php file inside the /config folder
foreach (scandir('../config') as $filename) {
    if (strpos($filename, 'php') !== false) {
        require_once '../config/' . $filename;
    }
}

// Autoloader for core App, Controller and Model classes
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    foreach ([DIR_APP, DIR_CONTROL, DIR_MODEL] as $folder) {
        if (file_exists($folder . $class . '.php')) {
            require_once $folder . $class . '.php';
        }
    }
});

<?php

function autoloader($class) {

    $dirs = ['system', 'controller', 'model'];

    foreach ($dirs as $dir) {

        $file = __DIR__ . '/'. $dir . '/' . $class . '.php';

        if (file_exists($file)) {
            require_once($file);
            break;
        }
    }
}

spl_autoload_register('autoloader');
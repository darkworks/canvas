<?php

function autoloader($class) {
    $find = false;

    $dirs = ['system', 'controller', 'model'];

    foreach ($dirs as $dir) {

        $file = SYSPATH . $dir . '/' . $class . '.php';

        if (file_exists($file)) {
            require_once($file);
            $find = true;
            break;
        }
    }

    if (!$find) {
        throw new Exception('Class #' . $class . '# not found!');
    }
}

spl_autoload_register('autoloader');
<?php

function autoloader($class) {
    include APP . DS . 'core' . DS . strtolower($class) . '.class.php';
}

spl_autoload_register('autoloader');



?>
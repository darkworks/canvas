<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('APP', ROOT . DS . 'application');

require_once (APP . DS . 'bootstrap.php');

print_r('<pre>'. print_r($_SERVER, true). '</pre>');
print_r('<pre>'. print_r(parse_url($_SERVER['REQUEST_URI']), true). '</pre>');


// require_once(APP . DS . 'core/request.class.php');

$request = new Request();

print_r('<pre>'. print_r($request->output(), true). '</pre>');


?>



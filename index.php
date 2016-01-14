<?php

define('SYSPATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

session_start();

$config = require_once(__DIR__ . '/config.php');

require_once __DIR__ . '/bootstrap.php';

Database::init($config);

// var_dump(User::find('test'));
// die();

$router = new Router($config['routes']);

list($controllerName, $action) = $router->resolve();

$controller = new $controllerName();
$controller->init($config);

$content = $controller->runAction($action);

$responce = new Responce(200, $content);
$responce->returnPage();
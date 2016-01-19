<?php

define('SYSPATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

session_start();

$config = require_once(__DIR__ . '/configs/config.php');

require_once __DIR__ . '/system/autoload.php';

if (empty($config)) {
    throw new Exception('Config not found');
}

System::init($config['system']);
DefaultModel::init($config['db']);
die();

$router = new Router($config['routes']);

list($controllerName, $action) = $router->resolve();

$controller = new $controllerName();
$controller->init($config);

$content = $controller->runAction($action);

$responce = new Responce(200, $content);
$responce->returnPage();
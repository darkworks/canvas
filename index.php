<?php

error_reporting(E_ALL);

$site_path = realpath(dirname(__FILE__));
define ('SYSPATH', $site_path);
define ('APPPATH', SYSPATH . '/application');

require_once SYSPATH . '/system/core.php';

$registry->router = new Router($registry);
$registry->router->setPath(APPPATH . '/controller');
$registry->template = new Template($registry);
$registry->router->loader();

?>

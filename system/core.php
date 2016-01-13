<?php

require_once SYSPATH . '/system/controller.class.php';
require_once SYSPATH . '/system/registry.class.php';
require_once SYSPATH . '/system/router.class.php';
require_once SYSPATH . '/system/template.class.php';

function __autoload($class_name) {

    $filename = strtolower($class_name) . '.class.php';

    $file = APPPATH . '/core/' . $filename;

    if (file_exists($file) == false)
    {
        return false;
    }

    require_once ($file);
}

$registry = new Registry();

// $registry->db = DB::getInstance();
?>

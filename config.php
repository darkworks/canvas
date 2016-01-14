<?php

return [
    'db' => [
        'server' => '127.0.0.1',
        'dbname' => 'canvas',
        'username' => 'canvas',
        'password' => 'mycanvas'

    ],
    'routes' => [
        '#\/user/(\d+)#' => ['UserController', 'show'],
        '#\/user#' => ['UserController', 'index'],
        '#\/#' => ['DefaultController', 'index']
    ]
];
<?php

return [
    'sail' => '9SH1Wgez',
    'controller' => [
        'pagination' => [
            'count_items_on_page' => 7
        ]
    ],
    'db' => [
        'server' => '127.0.0.1',
        'dbname' => 'canvas',
        'username' => 'canvas',
        'password' => 'mycanvas'

    ],
    'routes' => [
        '#\/user/(\d+)#' => ['UserController', 'show'],
        '#\/user#' => ['UserController', 'index'],
        '#\/save#' => ['DefaultController', 'save'],
        '#\/access#' => ['DefaultController', 'access'],
        '#\/getimages#' => ['DefaultController', 'getimages'],
        '#^\/$#' => ['DefaultController', 'index']
    ]
];
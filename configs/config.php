<?php

return [
    'system' => [
        'sail' => 'sLovSQ9DFlNXF6fn6fhStN'
        ],
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
        '#\/save#' => ['MainController', 'save'],
        '#\/access#' => ['MainController', 'access'],
        '#\/getimages#' => ['MainController', 'getimages'],
        '#^\/$#' => ['MainController', 'index']
    ]
];
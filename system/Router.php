<?php

class Router
{
    private $routes = [];

    function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function resolve()
    {
        $uri = $_SERVER['REQUEST_URI'];
        // $uri = '/user';

        foreach ($this->routes as $rule => $action) {

            $match = preg_match_all($rule, $uri, $matches);

            // var_dump('Match - ' . $match . ' rule - ' . $rule);

            if ($match) {
                // var_dump('Action - ' . print_r($action, true));
                return $action; // ['UserController', 'index']
            }
        }

        return ['DefaultController', 'error404'];
    }
}

<?php

class Router
{
    /**
     * Array of site routers
     * @var array
     */
    private $routes = [];

    /**
     * Constructor routers
     * @param array $routes site routers
     * @return void
     */
    function __construct($routes)
    {
        $this->routes = $routes;
    }

    /**
    * Comparison a url with an array of routers
    * @return array return array controller and action
    */
    public function resolve()
    {
        $uri = $_SERVER['REQUEST_URI'];
        // $uri = '/';

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

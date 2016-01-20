<?php
/**
 * Designed to redirect
 */
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
        if (empty($routes)) {
            throw new Exception('Config routes is empty');
        }

        $this->routes = $routes;
    }

    /**
    * Comparison a url with an array of routers
    * @return array return array controller and action
    */
    public function resolve()
    {
        $uri = $_SERVER['REQUEST_URI'];

        foreach ($this->routes as $rule => $action) {

            $match = preg_match_all($rule, $uri, $matches);

            if ($match) {
                return $action; // ['UserController', 'index']
            }
        }

        return ['DefaultController', 'error404'];
    }
}

<?php

namespace Core;

use Core\Exceptions\MethodNotFoundException;
use Core\Exceptions\RouteNotFoundException;

class Router
{
    /**
     * All registered routes
     *
     * @var array
     */
    public $routes = array(
        'GET' => array(),
        'POST' => array()
    );

    /**
     * This method build up application
     * Make instance, require file which register routes, return object
     *
     * @param string $file
     * @return Router
     */
    public static function load(string $file)
    {
        $router = new self();

        require $file;

        return $router;
    }

    /**
     * Register GET routes
     *
     * @param $uri
     * @param $controller
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Register POST routes
     *
     * @param $uri
     * @param $controller
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Direct request based on current URL and request method
     *
     * @param $uri
     * @param $requestType
     * @return mixed
     * @throws MethodNotFoundException
     * @throws RouteNotFoundException
     */
    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {

            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );

        }

        throw new RouteNotFoundException();
    }

    /**
     * Make controller instance based on route
     *
     * @param $controller
     * @param $action
     * @return mixed
     * @throws MethodNotFoundException
     */
    protected function callAction($controller, $action)
    {
        $controller = '\\App\\Controllers\\' . $controller;

        $instance = new $controller;

        if (!method_exists($instance, $action)) {
            throw new MethodNotFoundException();
        }

        return $instance->$action();

    }

}

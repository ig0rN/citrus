<?php

namespace Core;

use Core\Exceptions\MethodNotFoundException;
use Core\Exceptions\RouteNotFoundException;

class Router {

    public $routes = array(
        'GET' => array(),
        'POST' => array()
    );

    public static function load(string $file)
    {
        $router = new self();

        require $file;

        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {

            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );

        }

        throw new RouteNotFoundException();
    }

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

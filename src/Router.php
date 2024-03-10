<?php

namespace Hannan\ProductReview;

use Closure;
use Exception;

class Router
{
    public array $routes = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][trim($uri, '/')] = $action;
    }

    public function post($uri, $action)
    {
        $this->routes['POST'][trim($uri, '/')] = $action;
    }

    public function dispatch(Request $request): Response
    {
        $uri = $request->uri;
        $method = $request->method;
        $routes = app('router')->routes;
        $action = $routes[$method][$uri] ?? false;
        if (!$action) {
            return new Response('Page not found', 404);
        }

        return $this->callAction($action);
    }

    protected function callAction(string|array|Closure $action): Response
    {
        // check if the action is string and contains @
        if (is_string($action)) {
            $action = explode('@', $action);
            $controller = "App\\Http\\Controllers\\{$action[0]}";
            if (!class_exists($controller)) {
                return new Response("Controller $controller Not found", 404);
            }
            if (!method_exists($controller, $action[1])) {
                return new Response("Method $action[1] Not found", 404);
            }
            $controller = new $controller;
            $data = $controller->{$action[1]}();
            return new Response($data);
        } else if (is_callable($action)) {
            return new Response($action());
        } else if (is_array($action)) {
            $controller = $action[0];
            $method = $action[1];
            $controller = new $controller;
            $data = $controller->{$method}();
            return new Response($data);
        }
        throw new Exception('Invalid route action');
    }
}
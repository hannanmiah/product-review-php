<?php

namespace Hannan\ProductReview;

use Closure;
use Exception;
use Hannan\ProductReview\Exceptions\RouteNotFoundException;
use Hannan\ProductReview\Exceptions\Routing\InvalidActionException;

class Router
{
    public array $routes = [];

    public function __call(string $name, array $arguments)
    {
        if (in_array($name, ['get', 'post', 'put', 'delete'])) {
            $method = strtoupper($name);
            $this->push($method, $arguments[0], $arguments[1]);
        } else throw new Exception("Method $name not found", 404);
    }

    protected function push(string $method, string $route, string|array|Closure $action): void
    {
        $route = trim($route, '/');

        $this->routes[$method][$route] = [
            'action' => $action,
            'pattern' => $this->getPattern($route)
        ];
    }

    private function getPattern(int|string $route): string
    {
        $pattern = preg_replace('/{.*?}/', '([^/]+)', $route);
        $pattern = str_replace('/', '\/', $pattern);
        return "/^{$pattern}$/";
    }

    public function dispatch(Request $request): Response
    {
        $uri = $request->uri;
        $method = $request->method;
        $routes = app('router')->routes;
        try {
            $action = $this->getAction($routes, $uri, $method);
            return $this->resolveRouteAction($action['action'], $action['params']);
        } catch (RouteNotFoundException $e) {
            return (new Response)->json(['message' => 'Route not found'], 404);
        } catch (InvalidActionException $e) {
            return (new Response)->json(['message' => 'Invalid action'], 500);
        } catch (Exception $e) {
            return (new Response)->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    private function getAction($routes, string $uri, mixed $method): array
    {
        foreach ($routes[$method] as $route => $options) {
            if ($this->isRouteMatch($options, $uri)) {
                if ($this->isDynamicRoute($route)) {
                    return $this->getDynamicRouteAction($route, $options, $uri);
                }
                return $this->getStaticRouteAction($options);
            }
        }

        throw new RouteNotFoundException();
    }

    private function isRouteMatch(array $route, string $uri): false|int
    {
        return preg_match($route['pattern'], $uri);
    }

    private function isDynamicRoute(string $route): false|int
    {
        return preg_match('/{.*}/', $route);
    }

    private function getDynamicRouteAction($route, $options, $uri): array
    {
        $params = $this->getParams($route, $uri);
        return ['action' => $options['action'], 'params' => [...$params, new Request()]];
    }

    private function getParams(string $route, string $uri): array
    {
        $routeParts = explode('/', $route);
        $uriParts = explode('/', $uri);
        $params = [];
        foreach ($routeParts as $key => $part) {
            if (preg_match('/{.*}/', $part)) {
                $params[] = $uriParts[$key];
            }
        }
        return $params;
    }

    private function getStaticRouteAction(array $options): array
    {
        return ['action' => $options['action'], 'params' => [new Request()]];
    }

    private function resolveRouteAction(mixed $action, array $params): Response
    {
        if (is_string($action)) {
            $action = explode('@', $action);
            $controller = "App\\Http\\Controllers\\{$action[0]}";
            if (!class_exists($controller)) {
                throw new Exception("Controller $controller Not found", 404);
            }
            if (!method_exists($controller, $action[1])) {
                throw new Exception("Method $action[1] Not found", 404);
            }
            $controller = new $controller;
            $data = $controller->{$action[1]}(...$params);
            return $this->process($data);
        } else if (is_callable($action)) {
            return $this->process($action(...$params));
        } else if (is_array($action)) {
            $controller = $action[0];
            $method = $action[1];
            $controller = new $controller;
            return $this->process($controller->{$method}(...$params));
        }
        throw new InvalidActionException();
    }

    private function process(mixed $data): Response
    {
        if (is_array($data)) {
            return (new Response)->json($data);
        } else if (is_string($data)) {
            return (new Response)->plain($data);
        } else if ($data instanceof Response) {
            return $data;
        }
        return (new Response)->json($data);
    }
}
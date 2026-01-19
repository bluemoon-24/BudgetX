<?php

namespace App\Core;

class Router
{
    protected $routes = [];

    public function add($method, $path, $controller, $action)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch($uri, $method)
    {
        // Simple router logic
        $uri = parse_url($uri, PHP_URL_PATH);
        // Remove base path and trailing slashes
        $basePath = '/BudgetX/public';
        $clientPath = str_replace($basePath, '', $uri);
        $clientPath = rtrim($clientPath, '/');

        if ($clientPath === '') {
            $clientPath = '/';
        }

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $clientPath) {
                $controllerClass = "App\\Controllers\\" . $route['controller'];
                $controller = new $controllerClass();
                $action = $route['action'];
                $controller->$action();
                return;
            }
        }

        echo "404 Not Found";
    }
}

<?php

$url = $_GET['url'] ?? 'inicio';
$url = rtrim($url, '/');
$method = $_SERVER['REQUEST_METHOD'];

$routes = require __DIR__ . '/../config/routes.php';

function matchRoute($routePattern, $url) {
    $pattern = preg_replace('/:(\w+)/', '(?P<$1>[^/]+)', $routePattern);
    $pattern = "@^" . $pattern . "$@D";
    
    if (preg_match($pattern, $url, $matches)) {
        return array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
    }
    return false;
}

function handleRoute($handler, $params) {
    list($controllerName, $method) = explode('@', $handler);
    $controllerPath = "../app/controllers/{$controllerName}.php";
    
    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        $controller = new $controllerName();
        
        $reflection = new ReflectionMethod($controllerName, $method);
        $orderedParams = [];
        foreach ($reflection->getParameters() as $param) {
            $orderedParams[] = $params[$param->name] ?? null;
        }
        
        call_user_func_array([$controller, $method], $orderedParams);
        return true;
    }
    return false;
}

foreach ($routes as $route => $routeConfig) {
    // Si es una ruta simple (string)
    if (is_string($routeConfig)) {
        if ($route === $url) {
            $params = [];
            handleRoute($routeConfig, $params);
            exit;
        } else {
            $params = matchRoute($route, $url);
            if ($params !== false) {
                handleRoute($routeConfig, $params);
                exit;
            }
        }
    } 
    // Si es una ruta de API con métodos HTTP
    elseif (is_array($routeConfig)) {
        $params = matchRoute($route, $url);
        if ($params !== false && isset($routeConfig[$method])) {
            handleRoute($routeConfig[$method], $params);
            exit;
        }
    }
}

http_response_code(404);
include "../app/views/404.php";
<?php

$url = $_GET['url'] ?? 'inicio';
$url = rtrim($url, '/');

$routes = require __DIR__ . '/../config/routes.php';

function matchRoute($routePattern, $url) {
    $pattern = preg_replace('/:(\w+)/', '(?P<$1>[^/]+)', $routePattern);
    $pattern = "@^" . $pattern . "$@D";
    
    if (preg_match($pattern, $url, $matches)) {
        return array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
    }
    return false;
}

foreach ($routes as $route => $handler) {
    if ($route === $url) {
        $params = [];
    } else {
        $params = matchRoute($route, $url);
    }

    if ($params !== false) {
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
            exit;
        }
    }
}

http_response_code(404);
echo "Página no encontrada";
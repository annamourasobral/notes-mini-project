<?php

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        require base_path($routes[$uri]);
    } else {
        abort();
    }
}

function abort($code = \Core\Response::NOT_FOUND) {
    http_response_code($code);

    require base_path("views/http-response-code/{$code}.php");

    die();
}

$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

routeToController($uri, $routes);
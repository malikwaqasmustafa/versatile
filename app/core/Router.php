<?php
require_once 'ErrorHandler.php';

class Router {
    private $routes = [];

    public function add($route, $callback) {
        $this->routes[$route] = $callback;
    }

    public function dispatch($url) {
        if (array_key_exists($url, $this->routes)) {
            return call_user_func($this->routes[$url]);
        } else {
            ErrorHandler::routeNotFound($url);
        }
    }
}

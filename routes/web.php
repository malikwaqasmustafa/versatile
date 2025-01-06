<?php

// Web routes
return function (Router $router) {
    $router->add('/', [new HomeController(), 'index']);
    $router->add('/about', [new HomeController(), 'about']);
};




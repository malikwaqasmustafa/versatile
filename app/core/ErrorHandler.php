<?php
class ErrorHandler {
    public static function handle($type, $message, $file, $line) {
        echo "<h1>Error: $type</h1>";
        echo "<p>$message</p>";
        echo "<p>In file: $file on line $line</p>";
    }

    public static function viewNotFound($view) {
        http_response_code(404);
        if (file_exists("../app/views/errors/404.php")) {
            require "../app/views/errors/404.php";
        } else {
            echo "<h1>404 - View Not Found</h1>";
            echo "<p>The requested view <strong>'$view'</strong> does not exist.</p>";
        }
    }

    public static function routeNotFound($route) {
        http_response_code(404);
        if (file_exists("../app/views/errors/404.php")) {
            require "../app/views/errors/404.php";
        } else {
            echo "<h1>404 - Route Not Found</h1>";
            echo "<p>The route <strong>'$route'</strong> is not defined.</p>";
        }
    }

    public static function modelNotFound($model) {
        http_response_code(500);
        if (file_exists("../app/views/errors/500.php")) {
            require "../app/views/errors/500.php";
        } else {
            echo "<h1>500 - Model Not Found</h1>";
            echo "<p>The requested model <strong>'$model'</strong> could not be loaded.</p>";
        }
    }

}

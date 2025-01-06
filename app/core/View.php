<?php
class View {
    public static function render($view, $data = []) {
        extract($data);
        require "../app/views/$view.php";
    }
}

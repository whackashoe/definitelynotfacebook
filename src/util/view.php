<?php

class View {
    public static function render($file, array $vars = []) {
        extract($vars);
        ob_start();
        include $_SERVER['DOCUMENT_ROOT'] . "/../src/views/$file.php";
        return ob_get_clean();
    }
}

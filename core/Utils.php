<?php

namespace Core;

class Utils
{
    public static function render(string $path, $variables)
    {
        extract($variables);
        ob_start();
        require('templates/' . $path . '.html.php');
        $pageContent = ob_get_clean();
        require('templates/layout.html.php');
    }

    public static function http(string $url)
    {
        header("Location: $url");
        exit();
    }
}

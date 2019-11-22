<?php

namespace Core;

class Application
{
    public static function process()
    {
        $controllerName = 'Article';
        $task = 'index';

        if (!empty($_GET['controller'])) {
            $controllerName = ucfirst($_GET['controller']);
        }
        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        }
        $controllerName = "\Controllers\\" . $controllerName;

        $className = new $controllerName();
        $className->$task();
    }
}

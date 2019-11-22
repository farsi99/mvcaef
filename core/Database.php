<?php

namespace Core;

class Database
{
    private static $instance = null;
    //Cette méthode statique nous permet de se connecter à la bse de données
    public static function getpdo()
    {
        if (self::$instance == null) {
            $pdo = new \PDO('mysql:host=localhost;dbname=observia;charset=utf8', 'root', '', [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
            return $pdo;
        } else {
            return self::$instance;
        }
    }
}

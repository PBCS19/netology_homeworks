<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

class Di {
    static $di = null;
    
    public static function get()
    {
        if (! self::$di) {
            self::$di = new Di();
        }
        return self::$di;
    }
    
    public function db()
    {
        $config = require 'config.php';
        try {
            $db = new PDO(
                'mysql:host='.$config['host'].';dbname='.$config['dbname'].';charset=utf8',
                $config['user'],
                $config['pass']
            );
        } catch (PDOException $e) {
            die('Database error: '.$e->getMessage().'<br/>');
        }
        return $db;
    }
}

function redirect($location) {
    header("Location: $location");
    exit();
}

//$sth = Di::get()->db()->prepare("SELECT id FROM user");
//$sth->execute();
//var_dump($sth->fetch());
include 'router/router.php';

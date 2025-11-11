<?php
namespace App\Core;
use PDO;
class DB {
    private static $pdo;
    public static function init($cfg){
        $dsn = "mysql:host={$cfg['host']};dbname={$cfg['db']};charset=utf8mb4";
        self::$pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public static function pdo(){ return self::$pdo; }
}

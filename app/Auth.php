<?php
namespace App;
use App\Core\DB;
class Auth {
    public static function init(){ if (session_status()===PHP_SESSION_NONE) session_start(); }
    public static function attempt($username,$password){
        $stmt = DB::pdo()->prepare('SELECT * FROM users WHERE username = :u');
        $stmt->execute(['u'=>$username]); $user = $stmt->fetch();
        if ($user && $password === $user['password']) {
            $_SESSION['user'] = $user; return true;
        }
        return false;
    }
    public static function check(){ return !empty($_SESSION['user']); }
    public static function user(){ return $_SESSION['user'] ?? null; }
    public static function logout(){ session_destroy(); }
}

<?php
namespace App\Controllers;
use App\Auth;
class AuthController {
    public function showLogin(){ require __DIR__ . '/../../views/login.php'; }
    public function login(){
        $u = $_POST['username'] ?? ''; $p = $_POST['password'] ?? '';
        if (Auth::attempt($u,$p)) header('Location: /');
        else { $error='Invalid credentials'; require __DIR__ . '/../../views/login.php'; }
    }
    public function logout(){ Auth::logout(); header('Location: /login'); }
}

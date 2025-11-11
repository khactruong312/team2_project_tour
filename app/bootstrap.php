<?php
spl_autoload_register(function($class){
    $base = __DIR__ . '/';
    $class = str_replace('\\', '/', $class);
    $file = $base . $class . '.php';
    if (file_exists($file)) require $file;
});

$config = require __DIR__ . '/configs/env.php';
App\Core\DB::init($config);
App\Auth::init(); 

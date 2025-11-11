<?php
require_once __DIR__ . '/../app/bootstrap.php';
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\TourController;
use App\Controllers\BookingController;
use App\Controllers\ScheduleController;
use App\Controllers\GuideController;

$path = $_GET['url'] ?? '/';
session_start();

function route($p, $fn) {
    global $path;
    if ($path === $p) $fn();
}

route('/', function(){
    if (!\App\Auth::check()) header('Location: /login');
    $c = new DashboardController(); $c->index();
});

route('/login', function(){
    $c = new AuthController();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') $c->login();
    else $c->showLogin();
});

route('/logout', function(){ $c = new AuthController(); $c->logout(); });

// tours
route('/tours', function(){ if (!\App\Auth::check()) header('Location: /login'); $c = new TourController(); $c->index(); });
route('/tours/create', function(){ $c = new TourController(); if ($_SERVER['REQUEST_METHOD']==='POST') $c->store(); else $c->create(); });
route('/tours/edit', function(){ $c = new TourController(); if ($_SERVER['REQUEST_METHOD']==='POST') $c->update(); else $c->edit(); });
route('/tours/delete', function(){ $c = new TourController(); $c->delete(); });

// bookings
route('/bookings', function(){ $c = new BookingController(); $c->index(); });
route('/bookings/create', function(){ $c = new BookingController(); if ($_SERVER['REQUEST_METHOD']==='POST') $c->store(); else $c->create(); });

// schedule
route('/schedules', function(){ $c = new ScheduleController(); $c->index(); });
route('/schedules/assign', function(){ $c = new ScheduleController(); if ($_SERVER['REQUEST_METHOD']==='POST') $c->assign(); else $c->create(); });

// guide view
route('/guides/my', function(){ $c = new GuideController(); $c->mySchedules(); });

echo '404 Not Found';

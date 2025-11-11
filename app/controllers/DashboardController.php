<?php
namespace App\Controllers;
use App\Auth;
use App\Models\Tour;
use App\Models\Booking;
use App\Models\Schedule;
class DashboardController {
    public function index(){
        $t = new Tour(); $b = new Booking(); $s = new Schedule();
        $tours = $t->all(); $bookings = $b->all(); $schedules = $s->all();
        require __DIR__ . '/../../views/admin/dashboard.php';
    }
}

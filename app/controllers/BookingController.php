<?php
namespace App\Controllers;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\BookingCustomer;
class BookingController {
    public function index(){ $m=new Booking(); $bookings=$m->all(); require __DIR__ . '/../../views/admin/bookings/index.php'; }
    public function create(){ $t = new Tour(); $tours = $t->all(); require __DIR__ . '/../../views/admin/bookings/create.php'; }
    public function store(){
        $m = new Booking(); $bc = new BookingCustomer();
        // basic validation omitted for brevity
        $code = 'BKG-' . strtoupper(uniqid());
        $amount = $_POST['total_amount'] ?? 0;
        $created_by = $_SESSION['user']['user_id'] ?? null;
        $booking_id = $m->create(['tour'=>$_POST['tour_id'],'code'=>$code,'amount'=>$amount,'status'=>'Booked','created_by'=>$created_by]);
        $bc->create(['booking_id'=>$booking_id,'full_name'=>$_POST['full_name'],'phone'=>$_POST['phone'],'email'=>$_POST['email'],'note'=>$_POST['note']]);
        header('Location: /bookings');
    }
}

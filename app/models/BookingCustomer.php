<?php
namespace App\Models;
class BookingCustomer extends BaseModel {
    public function findByBooking($booking_id){ $stmt=$this->pdo->prepare('SELECT * FROM booking_customers WHERE booking_id=:b'); $stmt->execute(['b'=>$booking_id]); return $stmt->fetchAll(); }
    public function create($data){ $stmt=$this->pdo->prepare('INSERT INTO booking_customers (booking_id,full_name,phone,email,note) VALUES (:booking_id,:full_name,:phone,:email,:note)'); $stmt->execute($data); }
}

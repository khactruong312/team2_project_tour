<?php
namespace App\Models;
class Booking extends BaseModel {
    public function all(){ return $this->pdo->query('SELECT b.*, t.name as tour_name FROM bookings b LEFT JOIN tours t ON b.tour_id=t.tour_id ORDER BY b.created_at DESC')->fetchAll(); }
    public function find($id){ $stmt=$this->pdo->prepare('SELECT * FROM bookings WHERE booking_id=:id'); $stmt->execute(['id'=>$id]); return $stmt->fetch(); }
    public function create($data){ $stmt=$this->pdo->prepare('INSERT INTO bookings (tour_id,booking_code,total_amount,status,created_by) VALUES (:tour,:code,:amount,:status,:created_by)'); $stmt->execute($data); return $this->pdo->lastInsertId(); }
}

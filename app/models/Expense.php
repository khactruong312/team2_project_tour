<?php
namespace App\Models;
class Expense extends BaseModel {
    public function forTour($tour_id){ $stmt=$this->pdo->prepare('SELECT * FROM expenses WHERE tour_id=:t ORDER BY date DESC'); $stmt->execute(['t'=>$tour_id]); return $stmt->fetchAll(); }
    public function create($data){ $stmt=$this->pdo->prepare('INSERT INTO expenses (tour_id,type,amount,date,note) VALUES (:tour_id,:type,:amount,:date,:note)'); $stmt->execute($data); }
}

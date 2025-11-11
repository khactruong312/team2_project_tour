<?php
namespace App\Models;
class TourDestination extends BaseModel {
    public function forTour($tour_id){ $stmt=$this->pdo->prepare('SELECT * FROM tour_destinations WHERE tour_id=:t ORDER BY order_no'); $stmt->execute(['t'=>$tour_id]); return $stmt->fetchAll(); }
}

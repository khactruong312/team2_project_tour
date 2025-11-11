<?php
namespace App\Models;
class Checkpoint extends BaseModel {
    public function forSchedule($schedule_id){ $stmt=$this->pdo->prepare('SELECT c.*, d.name as destination_name FROM tour_checkpoints c LEFT JOIN tour_destinations d ON c.destination_id=d.destination_id WHERE schedule_id=:s ORDER BY c.checkpoint_id'); $stmt->execute(['s'=>$schedule_id]); return $stmt->fetchAll(); }
    public function record($data){ $stmt=$this->pdo->prepare('INSERT INTO tour_checkpoints (schedule_id,destination_id,actual_checkin,actual_checkout,checkin_location,checkout_location,note,status) VALUES (:schedule_id,:destination_id,:actual_checkin,:actual_checkout,:checkin_location,:checkout_location,:note,:status)'); $stmt->execute($data); }
}

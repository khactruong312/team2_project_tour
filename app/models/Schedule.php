<?php
namespace App\Models;
class Schedule extends BaseModel {
    public function all(){ return $this->pdo->query('SELECT s.*, t.name as tour_name, g.full_name as guide_name FROM tour_schedule s LEFT JOIN tours t ON s.tour_id=t.tour_id LEFT JOIN guides g ON s.guide_id=g.guide_id ORDER BY s.start_date DESC')->fetchAll(); }
    public function create($data){ $stmt=$this->pdo->prepare('INSERT INTO tour_schedule (tour_id,guide_id,start_date,end_date,vehicle,hotel,status) VALUES (:tour_id,:guide_id,:start_date,:end_date,:vehicle,:hotel,:status)'); $stmt->execute($data); return $this->pdo->lastInsertId(); }
}

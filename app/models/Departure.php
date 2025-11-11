<?php
namespace App\Models;
class Departure extends BaseModel {
    public function all(){ return $this->pdo->query('SELECT d.*, t.name as tour_name, g.full_name as guide_name FROM departures d LEFT JOIN tours t ON d.tour_id=t.tour_id LEFT JOIN guides g ON d.guide_id=g.guide_id ORDER BY d.created_at DESC')->fetchAll(); }
    public function create($data){ $stmt=$this->pdo->prepare('INSERT INTO departures (tour_id,guide_id,actual_start,actual_end,notes) VALUES (:tour_id,:guide_id,:actual_start,:actual_end,:notes)'); $stmt->execute($data); }
}

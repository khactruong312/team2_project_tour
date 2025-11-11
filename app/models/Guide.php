<?php
namespace App\Models;
class Guide extends BaseModel {
    public function all(){ return $this->pdo->query('SELECT * FROM guides')->fetchAll(); }
    public function find($id){ $stmt=$this->pdo->prepare('SELECT * FROM guides WHERE guide_id=:id'); $stmt->execute(['id'=>$id]); return $stmt->fetch(); }
}

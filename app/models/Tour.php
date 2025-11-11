<?php
namespace App\Models;
class Tour extends BaseModel {
    public function all(){ return $this->pdo->query('SELECT * FROM tours ORDER BY created_at DESC')->fetchAll(); }
    public function find($id){ $stmt=$this->pdo->prepare('SELECT * FROM tours WHERE tour_id=:id'); $stmt->execute(['id'=>$id]); return $stmt->fetch(); }
    public function create($data){ $stmt = $this->pdo->prepare('INSERT INTO tours (name,type,price,duration_days,description,status) VALUES (:n,:t,:p,:d,:desc,:s)'); $stmt->execute($data); return $this->pdo->lastInsertId(); }
    public function update($id,$data){ $data['id']=$id; $stmt=$this->pdo->prepare('UPDATE tours SET name=:n,type=:t,price=:p,duration_days=:d,description=:desc,status=:s WHERE tour_id=:id'); $stmt->execute($data); }
    public function delete($id){ $stmt=$this->pdo->prepare('DELETE FROM tours WHERE tour_id=:id'); $stmt->execute(['id'=>$id]); }
}

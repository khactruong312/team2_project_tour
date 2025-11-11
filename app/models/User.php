<?php
namespace App\Models;
class User extends BaseModel {
    public function findByUsername($username){
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = :u');
        $stmt->execute(['u'=>$username]); return $stmt->fetch();
    }
    public function find($id){ $stmt = $this->pdo->prepare('SELECT * FROM users WHERE user_id = :id'); $stmt->execute(['id'=>$id]); return $stmt->fetch(); }
}

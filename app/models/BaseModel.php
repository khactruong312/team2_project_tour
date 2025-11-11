<?php
namespace App\Models;
use App\Core\DB;
class BaseModel {
    protected $pdo;
    public function __construct(){ $this->pdo = DB::pdo(); }
}

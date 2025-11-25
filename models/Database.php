<?php
class Database {
    protected $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=tour_ops;charset=utf8", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }
}

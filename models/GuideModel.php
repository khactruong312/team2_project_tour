<?php
class GuideModel{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAll()
    {
        $sql = "SELECT * FROM tours ORDER BY tour_id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();

    }
}
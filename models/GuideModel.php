<?php
<<<<<<< HEAD
class GuideModel {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // Lấy danh sách tất cả hướng dẫn viên
    public function getAll() {
        $sql = "SELECT * FROM guides ORDER BY guide_id DESC";
        return $this->conn->query($sql)->fetchAll();
    }

    public function find($id) {
        $sql = "SELECT * FROM guides WHERE guide_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
=======
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
>>>>>>> 7f09fbac89bb469c8cbf47e6f3d3d7ef8d9fc46c

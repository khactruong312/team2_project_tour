<?php

class GuideModel {
    public $conn;

    public function __construct() {
        // Giả sử connectDB() trả về đối tượng kết nối PDO
        $this->conn = connectDB(); 
    }

    // Lấy danh sách tất cả hướng dẫn viên
    public function getAll() {
        $sql = "SELECT * FROM guides ORDER BY guide_id DESC";
        return $this->conn->query($sql)->fetchAll();
    }

    // Lấy chi tiết 1 hướng dẫn viên theo ID
    public function find($id) {
        $sql = "SELECT * FROM guides WHERE guide_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // 🔥 Thêm mới — Lấy hướng dẫn viên theo user_id (dùng khi login)
    public function getByUserId($user_id) {
        $sql = "SELECT * FROM guides WHERE user_id = :user_id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách tour theo Guide ID
    public function getToursByGuideId($guideId) {
        $sql = "SELECT 
                    ts.schedule_id, 
                    ts.start_date, 
                    ts.end_date, 
                    ts.status AS schedule_status,
                    t.tour_id, 
                    t.name, 
                    t.image, 
                    t.status AS tour_status,
                    g.full_name AS guide_name
                FROM tour_schedule ts
                JOIN tours t ON ts.tour_id = t.tour_id
                JOIN guides g ON ts.guide_id = g.guide_id
                WHERE ts.guide_id = ? 
                ORDER BY ts.start_date DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$guideId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getScheduleDetail($scheduleId) {
    // PHIÊN BẢN ĐƠN GIẢN HÓA: Chỉ lấy các cột chắc chắn tồn tại
    $sql = "SELECT 
                ts.schedule_id, 
                ts.start_date, 
                ts.end_date, 
                ts.status AS schedule_status,
                t.tour_id, 
                t.name AS tour_name, 
                t.image AS tour_image, 
                g.full_name AS guide_name
            FROM tour_schedule ts
            JOIN tours t ON ts.tour_id = t.tour_id
            JOIN guides g ON ts.guide_id = g.guide_id
            -- Đã loại bỏ JOIN users u và các cột phức tạp khác
            WHERE ts.schedule_id = :schedule_id";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['schedule_id' => $scheduleId]);
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
    public function getCheckpointsByScheduleId($scheduleId) {
    $sql = "SELECT 
                *
            FROM tour_checkpoints 
            WHERE schedule_id = :schedule_id
            ORDER BY actual_checkin ASC"; 
        
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['schedule_id' => $scheduleId]);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}

<?php
class CheckpointModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllCheckpoints() {
    $sql = "SELECT c.*, d.name AS destination_name, s.schedule_id, t.name AS tour_name
            FROM tour_checkpoints c
            LEFT JOIN tour_destinations d ON c.destination_id = d.destination_id
            LEFT JOIN tour_schedule s ON c.schedule_id = s.schedule_id
            LEFT JOIN tours t ON s.tour_id = t.tour_id
            ORDER BY c.checkpoint_id DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // Lấy danh sách checkpoint theo schedule
    public function getBySchedule($schedule_id) {
        $sql = "SELECT c.*, d.name AS destination_name
                FROM tour_checkpoints c
                LEFT JOIN tour_destinations d ON c.destination_id = d.destination_id
                WHERE c.schedule_id = ?
                ORDER BY c.checkpoint_id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$schedule_id]);
        return $stmt->fetchAll();
    }

    // Check-in
    public function checkIn($checkpoint_id, $location) {
        $sql = "UPDATE tour_checkpoints
                SET actual_checkin = NOW(),
                    checkin_location = ?,
                    status = 'Đã check-in'
                WHERE checkpoint_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$location, $checkpoint_id]);
    }

    // Check-out
    public function checkOut($checkpoint_id, $location) {
        $sql = "UPDATE tour_checkpoints
                SET actual_checkout = NOW(),
                    checkout_location = ?,
                    status = 'Đã check-out'
                WHERE checkpoint_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$location, $checkpoint_id]);
    }

    public function createCheckpoint($schedule_id, $destination_id) {
    $sql = "INSERT INTO tour_checkpoints (schedule_id, destination_id, status)
            VALUES (?, ?, 'Chưa đến')";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$schedule_id, $destination_id]);
}
}

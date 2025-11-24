<?php
class ScheduleModel {
    public static function bookingCreate($data) {
        global $conn;
        $sql = "INSERT INTO tour_schedule(tour_id, guide_id, start_date, end_date, vehicle, hotel)
                VALUES (?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute($data);
    }

    public static function all() {
        global $conn;
        $sql = "SELECT s.*, t.name AS tour_name, g.full_name AS guide_name
                FROM tour_schedule s
                LEFT JOIN tours t ON s.tour_id = t.tour_id
                LEFT JOIN guides g ON s.guide_id = g.guide_id";
        return $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}

<?php

class ScheduleModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả lịch kèm tên tour + tên HDV
    public function getAll()
    {
        $sql = "SELECT s.*, t.name AS tour_name, g.full_name AS guide_name
                FROM tour_schedule s
                LEFT JOIN tours t ON s.tour_id = t.tour_id
                LEFT JOIN guides g ON s.guide_id = g.guide_id
                ORDER BY schedule_id DESC";

        return $this->conn->query($sql)->fetchAll();
    }

    // Thêm lịch mới
    public function create($tour_id, $guide_id, $start_date, $end_date, $vehicle, $hotel, $status)
    {
        $sql = "INSERT INTO tour_schedule (tour_id, guide_id, start_date, end_date, vehicle, hotel, status)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$tour_id, $guide_id, $start_date, $end_date, $vehicle, $hotel, $status]);
    }

    // Lấy chi tiết theo ID
    public function getById($id)
    {
        $sql = "SELECT * FROM tour_schedule WHERE schedule_id = ?";
        $st  = $this->conn->prepare($sql);
        $st->execute([$id]);
        return $st->fetch();
    }

    // Cập nhật lịch
    public function update($id, $tour_id, $guide_id, $start_date, $end_date, $vehicle, $hotel, $status)
    {
        $sql = "UPDATE tour_schedule 
                SET tour_id=?, guide_id=?, start_date=?, end_date=?, vehicle=?, hotel=?, status=?
                WHERE schedule_id=?";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$tour_id, $guide_id, $start_date, $end_date, $vehicle, $hotel, $status, $id]);
    }

    // Xoá lịch
    public function delete($id)
    {
        $sql = "DELETE FROM tour_schedule WHERE schedule_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    
public function getByTour($tour_id)
{
    $sql = "SELECT schedule_id, start_date, end_date 
            FROM tour_schedule 
            WHERE tour_id = ? 
            ORDER BY start_date ASC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$tour_id]);
    return $stmt->fetchAll();
}
public function getOne($schedule_id)
{
    $sql = "SELECT * FROM tour_schedule WHERE schedule_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$schedule_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function getAvailableVehicles()
    {
        $sql = "SELECT id, vehicle_type, capacity 
                FROM vehicles 
                WHERE status = 'Chưa khởi hành'"; // Lọc theo trạng thái sẵn sàng

        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hàm MỚI: Lấy danh sách khách sạn đang ở trạng thái 'Còn phòng'
    public function getAvailableHotels()
    {
        $sql = "SELECT id, name, address 
                FROM hotel 
                WHERE status = 'Còn phòng'"; // Lọc theo trạng thái sẵn sàng

        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }


}

?>

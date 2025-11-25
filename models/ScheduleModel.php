<?php
<<<<<<< HEAD
class ScheduleModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }


 public function getAll()
    {
        $sql = "SELECT s.*, t.name AS tour_name, g.full_name AS guide_name
                FROM tour_schedule s
                LEFT JOIN tours t ON s.tour_id = t.tour_id
                LEFT JOIN guides g ON s.guide_id = g.guide_id
                ORDER BY schedule_id DESC";

        return $this->conn->query($sql)->fetchAll();
    }

    public function create($tour_id, $guide_id, $start_date, $end_date, $vehicle, $hotel, $status)
    {
        $sql = "INSERT INTO tour_schedule (tour_id, guide_id, start_date, end_date, vehicle, hotel, status)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$tour_id, $guide_id, $start_date, $end_date, $vehicle, $hotel, $status]);
    }

     public function getById($id)
    {
        $sql = "SELECT * FROM tour_schedule WHERE schedule_id = ?";
        $st  = $this->conn->prepare($sql);
        $st->execute([$id]);
        return $st->fetch();
    }

    public function update($id, $tour_id, $guide_id, $start_date, $end_date, $vehicle, $hotel, $status)
    {
        $sql = "UPDATE tour_schedule 
                SET tour_id=?, guide_id=?, start_date=?, end_date=?, vehicle=?, hotel=?, status=?
                WHERE schedule_id=?";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$tour_id, $guide_id, $start_date, $end_date, $vehicle, $hotel, $status, $id]);
    }

     public function delete($id)
    {
        $sql = "DELETE FROM tour_schedule WHERE schedule_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
=======
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
>>>>>>> 7f09fbac89bb469c8cbf47e6f3d3d7ef8d9fc46c

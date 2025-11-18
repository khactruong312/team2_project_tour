<?php
class TourModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    //hiện thị tất cả 
    public function getAll()
    {
        $sql = "SELECT * FROM tours ORDER BY tour_id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();

    }

    //hàm đếm
    public function countTours(){
        $sql = 'SELECT COUNT(*) AS total FROM tours';
        $stmt = $this->conn->query($sql);
        return $stmt->fetch()['total'];
    }

    //lấy chi tiết tour
    public function getById($id){
        $sql = "SELECT * FROM tours WHERE tour_id = ?";
        $stmt = $this ->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($name, $type, $price, $duration)
{
    $sql = "INSERT INTO tours (name, type, price, duration_days) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$name, $type, $price, $duration]);
}


    public function update($id, $name, $type, $price, $duration)
{
    $sql = "UPDATE tours 
            SET name = ?, type = ?, price = ?, duration_days = ?
            WHERE tour_id = ?";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([$name, $type, $price, $duration, $id]);
}


    public function delete($id)
    {
        $sql = "DELETE FROM tours WHERE tour_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}

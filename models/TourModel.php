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

    public function create($name,$image, $type, $price, $duration, $description, $status,$created_at)
{
    $validStatus = ['active', 'Inactive'];

    if (!in_array($status, $validStatus)) {
        $status = 'active';
    }

    $created_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO tours (name,image, type, price, duration_days, description, status , created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$name, $image, $type, $price, $duration,$description,$status,$created_at]);
}


    public function update($id, $name, $image, $type, $price, $duration,$description, $status,$created_at)
{
    $validStatus = ['Active', 'Inactive']; 
    if (!in_array($status, $validStatus)) {
        
        $status = 'Inactive'; 
    }
    $created_at = date('Y-m-d H:i:s');
    $sql = "UPDATE tours 
            SET name = ?, image = ?, type = ?, price = ?, duration_days = ?, description = ?, status = ?, created_at=?
            WHERE tour_id = ?";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([$name, $image, $type, $price, $duration , $description, $status,$created_at, $id]);
}


    public function delete($id)
    {
        $sql = "DELETE FROM tours WHERE tour_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}

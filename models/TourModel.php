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

    //lấy chi tiết tour
    public function getById($id){
        $sql = "SELECT * FROM tours WHERE tour_id = ?";
        $stmt = $this ->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO tours (name, type, price, duration_days, description)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['type'],
            $data['price'],
            $data['duration_days'],
            $data['description']
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE tours 
                SET name = ?, type = ?, price = ?, duration_days = ?, description = ?
                WHERE tour_id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $data['name'],
            $data['type'],
            $data['price'],
            $data['duration_days'],
            $data['description'],
            $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM tours WHERE tour_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}

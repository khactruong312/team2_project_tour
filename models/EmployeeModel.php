<?php
require_once "Database.php";

class EmployeeModel extends Database {

    // Lấy danh sách từ bảng guides
    public function getAll() {
        $sql = "SELECT * FROM guides ORDER BY guide_id DESC";
        return $this->conn->query($sql)->fetchAll();
    }

    // Lấy 1 hướng dẫn viên theo ID
    public function find($id) {
        $sql = "SELECT * FROM guides WHERE guide_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Thêm mới (full_name, phone, status)
    public function insert($data) {
        $sql = "INSERT INTO guides (full_name, phone, status)
                VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['full_name'],
            $data['phone'],
            $data['status']
        ]);
    }

    // Cập nhật
    public function update($id, $data) {
        $sql = "UPDATE guides 
                SET full_name=?, phone=?, status=?
                WHERE guide_id=?";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['full_name'],
            $data['phone'],
            $data['status'],
            $id
        ]);
    }

    // Xóa
    public function delete($id) {
        $sql = "DELETE FROM guides WHERE guide_id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
    
}

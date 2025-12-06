<?php

require_once './commons/function.php';

class SettingModel {

    public function getAll() {
        $conn = connectDB();
        $sql = "SELECT id, username, fullname, role, created_at FROM users ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $conn = connectDB();
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function usernameExists($username, $exceptId = null) {
        $conn = connectDB();
        if ($exceptId !== null) {
            $sql = "SELECT COUNT(*) FROM users WHERE username = ? AND id != ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $exceptId]);
        } else {
            $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username]);
        }
        return $stmt->fetchColumn() > 0;
    }

    public function create($data) {
        $conn = connectDB();

        $sql = "INSERT INTO users (username, password, fullname, role, created_at) 
                VALUES (:username, :password, :fullname, :role, NOW())";

        $stmt = $conn->prepare($sql);

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $conn = connectDB();

        // Nếu có password mới
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $sql = "UPDATE users SET username=:username, fullname=:fullname, role=:role, password=:password WHERE id=:id";
        } else {
            unset($data['password']); // bỏ password khỏi array
            $sql = "UPDATE users SET username=:username, fullname=:fullname, role=:role WHERE id=:id";
        }

        $stmt = $conn->prepare($sql);
        $data['id'] = $id;

        return $stmt->execute($data);
    }

    public function delete($id) {
        $conn = connectDB();
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}

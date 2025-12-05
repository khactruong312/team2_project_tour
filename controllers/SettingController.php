<?php

require_once './models/SettingModel.php';
require_once './commons/function.php';

class SettingController {

    private $userModel;  

    public function __construct() {
        $this->userModel = new SettingModel();
    }

    // ⭐ Danh sách user
    public function listUsers() {
        requireRole('admin');

        $users = $this->userModel->getAll();

        require_once './views/admin/Setting/list.php';
    }

    // ⭐ Form tạo user
    public function createUser() {
        requireRole('admin');

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $fullname = trim($_POST['fullname']);
            $password = trim($_POST['password']);
            $role     = $_POST['role'];

            if (!$username) $errors[] = "Username không được để trống";
            if (!$password) $errors[] = "Password không được để trống";

            if ($this->userModel->usernameExists($username)) {
                $errors[] = "Username đã tồn tại";
            }

            if (empty($errors)) {
                $this->userModel->create([
                    'username' => $username,
                    'fullname' => $fullname,
                    'password' => $password,
                    'role'     => $role
                ]);

                header("Location: index.php?act=user-list&msg=created");
                exit;
            }

            $_SESSION['errors'] = $errors;
        }

        require './views/admin/Setting/create.php';
    }

    // ⭐ Form sửa user
    public function editUser() {
        requireRole('admin');

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?act=user-list&error=notfound");
            exit;
        }

        $user = $this->userModel->getById($id);
        if (!$user) {
            header("Location: index.php?act=user-list&error=notfound");
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $username = trim($_POST['username']);
            $fullname = trim($_POST['fullname']);
            $password = trim($_POST['password']); // optional
            $role     = $_POST['role'];

            if ($this->userModel->usernameExists($username, $id)) {
                $errors[] = "Username đã tồn tại!";
            }

            if (empty($errors)) {
                $this->userModel->update($id, [
                    'username' => $username,
                    'fullname' => $fullname,
                    'password' => $password, // nếu rỗng → không đổi
                    'role'     => $role
                ]);

                header("Location: index.php?act=user-list&msg=updated");
                exit;
            }

            $_SESSION['errors'] = $errors;
        }

        require './views/admin/Setting/edit.php';
    }

    // ⭐ Xóa user
    public function deleteUser() {
        requireRole('admin');

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?act=user-list&error=notfound");
            exit;
        }

        $this->userModel->delete($id);

        header("Location: index.php?act=user-list&msg=deleted");
        exit;
    }
    // ⭐ Xem chi tiết user
    public function viewUser() {
        requireRole('admin');

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?act=user-list&error=notfound");
            exit;
        }

        $user = $this->userModel->getById($id);
        if (!$user) {
            header("Location: index.php?act=user-list&error=notfound");
            exit;
        }

        require './views/admin/Setting/detail.php';
    }
}

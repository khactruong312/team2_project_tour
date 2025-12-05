<?php

require_once "./commons/function.php";
require_once "./models/EmployeeModel.php";

class EmployeeController
{
    public $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    // ⭐ Danh sách hướng dẫn viên
    public function index()
    {
        $listEmployees = $this->employeeModel->getAll();
        require_once "./views/admin/Employee/list.php";
    }

    // ⭐ Form thêm
    public function create()
    {
        require_once "./views/admin/Employee/create.php";
    }

    // ⭐ Lưu mới
    public function store()
    {
        $data = [
            'full_name' => $_POST['full_name'] ?? null,
            'phone' => $_POST['phone'] ?? null,
            'status' => $_POST['status'] ?? "Active"
        ];

        $this->employeeModel->insert($data);

        header("Location: index.php?act=employees-list");
        exit;
    }

    // ⭐ Form sửa
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: index.php?act=employees-list");
            return;
        }

        $employee = $this->employeeModel->find($id);

        require "./views/admin/Employee/edit.php";
    }

    // ⭐ Cập nhật
    public function update()
    {
        $id = $_POST['id'] ?? null;

        if (!$id) {
            header("Location: index.php?act=employees-list");
            return;
        }

        $data = [
            'full_name' => $_POST['full_name'] ?? null,
            'phone' => $_POST['phone'] ?? null,
            'status' => $_POST['status'] ?? "Active"
        ];

        $this->employeeModel->update($id, $data);

        header("Location: index.php?act=employees-list");
        exit;
    }

    // ⭐ Xóa
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->employeeModel->delete($id);
        }

        header("Location: index.php?act=employees-list");
        exit;
    }
}

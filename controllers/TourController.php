<?php
class TourController
{
    private $tourModel;

    public function __construct()
    {
        $this->tourModel = new TourModel();
    }

    // Trang chủ
    public function home()
    {
        $totalTours = $this->tourModel->countTours();
        require_once './views/trangchu.php';
    }


    public function list()
    {
        $tours = $this->tourModel->getAll();
        require_once './views/admin/list.php';
    }

    public function create()
    {
        require_once './views/admin/create.php';
    }


    public function store()
    {
        $name = $_POST['name'];
        $type = $_POST['type'];
        $price = $_POST['price'];
        $duration = $_POST['duration'];
        $description =$_POST['description'];
        $status =$_POST['status'];
        $created_at =$_POST['created_at'];
        $result = $this->tourModel->create($name, $type, $price, $duration, $description, $status, $created_at);

        if ($result) {
            $_SESSION['success'] = "Thêm tour thành công!";
        } else {
            $_SESSION['error'] = "Thêm tour thất bại!";
        }
        header("Location: index.php?act=tour-list");
        exit;
    }

    // Register
    public function edit()
    {
        $id = $_GET['id'];

        if (!$id) {
            $_SESSION['error'] = 'không tìm thấy id';
            header("Location: index.php?act=tour-list");
            exit;
        }
        $tour = $this->tourModel->getById($id);
        if (!$tour) {
            $_SESSION['error'] = "Tour không tồn tại!";
            header("Location: index.php?act=tour-list");
            exit;
        }

        require_once './views/admin/edit.php';
    }
    public function update()
    {

         $id = $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $duration = $_POST['duration_days'];
    $description =$_POST['description'];
        $status =$_POST['status'];
        $created_at =$_POST['created_at'];
        $result =$this->tourModel->update($id,$name,$type, $price, $duration,$description, $status, $created_at);
        if ($result) {
        $_SESSION['success'] = "Cập nhật tour thành công!";
    } else {
        $_SESSION['error'] = "Cập nhật thất bại!";
    }

        header("Location: index.php?act=tour-list");
    exit;
    }

    public function delete()
    {
        $id = $_GET['id'];
        $result = $this->tourModel->delete($id);

        if ($result) {
            $_SESSION['success'] = "Xóa tour thành công!";
        } else {
            $_SESSION['error'] = "Xóa tour thất bại!";
        }

        header("Location: index.php?act=tour-list");
    }
}

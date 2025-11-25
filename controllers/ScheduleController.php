<?php
require_once __DIR__ . '/../models/ScheduleModel.php';
require_once __DIR__ . '/../models/TourModel.php';
require_once __DIR__ . '/../models/GuideModel.php';
class ScheduleController
{
    private $scheduleModel;
    private $tourModel;
    private $guideModel;
    

    public function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
        $this->tourModel = new TourModel();
        $this->guideModel    = new GuideModel();
    }

    public function index()
    {
        $schedules = $this->scheduleModel->getAll();
        require_once "./views/admin/schedule/list.php";
    }

    public function create()
    {
        $tours = $this->tourModel->getAll();
        $guides = $this->guideModel->getAll();

        require_once './views/admin/schedule/create.php';
    }

    // Cần khai báo biến $allowed_status ở đầu lớp ScheduleController hoặc sử dụng hằng số.
// Ví dụ: private $allowed_status = ['Chưa khởi hành', 'Đang chạy', 'Hoàn thành'];

public function store()
{
    $tour_id = $_POST['tour_id'];
    $guide_id = $_POST['guide_id'] ?: null;
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $vehicle = $_POST['vehicle'];
    $hotel = $_POST['hotel'];
    
    $status = $_POST['status'];

    $allowed_status = ['Chưa khởi hành', 'Đang chạy', 'Hoàn thành']; 
    
    if (!in_array($status, $allowed_status)) {

        $status = 'Chưa khởi hành'; 
        
    }
    // ------------------------------------------------------------------------

    $result = $this->scheduleModel->create(
        $tour_id,
        $guide_id,
        $start_date,
        $end_date,
        $vehicle,
        $hotel,
        $status 
    );

    
    if ($result) {
        $_SESSION['success'] = "Thêm lịch thành công!";
    } else {
        $_SESSION['error'] = "Thêm lịch thất bại!";
    }

    header("Location: index.php?act=schedule-list");
    exit;
}


    public function edit()
    {
        $id = $_GET['id'];

        $schedule = $this->scheduleModel->getById($id);
        $tours = $this->tourModel->getAll();
        $guides = $this->guideModel->getAll();

        require_once './views/admin/schedule/edit.php';
    }

    // File: C:\laragon\www\project_dulich\controllers\ScheduleController.php

public function update()
{
    $id = $_POST['schedule_id'];
    $tour_id = $_POST['tour_id'];
    $guide_id = $_POST['guide_id'] ?: null;
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $vehicle = $_POST['vehicle'];
    $hotel = $_POST['hotel'];
    
    $status = $_POST['status'];


    $allowed_status = ['Chưa khởi hành', 'Đang chạy', 'Hoàn thành'];
    
    // Nếu giá trị không hợp lệ (như 'Active', 'Inactive'), ta ép về trạng thái hợp lệ
    if (!in_array($status, $allowed_status)) {

        if ($status === 'Active' || $status === 'Inactive') {
             $status = 'Đang chạy'; 
        } else {
     
            $status = 'Chưa khởi hành';
        }
    }
    // ------------------------------------

    $result = $this->scheduleModel->update(
        $id,
        $tour_id,
        $guide_id,
        $start_date,
        $end_date,
        $vehicle,
        $hotel,
        $status 
    );

    if ($result) {
        $_SESSION['success'] = "Cập nhật lịch thành công!";
    } else {
        $_SESSION['error'] = "Cập nhật thất bại!";
    }

    header("Location: index.php?act=schedule-list");
    exit;
}


    public function delete()
    {
        $id = $_GET['id'];

        $this->scheduleModel->delete($id);
        $_SESSION['success'] = "Xóa lịch khởi hành thành công!";

        header("Location: index.php?act=schedule-list");
        exit;
    }

}

?>
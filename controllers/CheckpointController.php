<?php
require_once './models/CheckpointModel.php';

class CheckpointController {

    public $checkpointModel;

    public function __construct() {
        $this->checkpointModel = new CheckpointModel();
    }

public function list() {

    // LUÔN khởi tạo biến để view không bị lỗi
    $checkpoints = [];

    // Nếu thiếu schedule_id, báo lỗi nhưng vẫn load view
    if (!isset($_GET['schedule_id']) || empty($_GET['schedule_id'])) {
        $error = "Thiếu schedule_id. Không thể hiển thị checkpoint!";
        require_once './views/guide/checkpoints/list.php';
        return;
    }

    $schedule_id = $_GET['schedule_id'];

    // Lấy danh sách checkpoint từ DB
    $checkpoints = $this->checkpointModel->getBySchedule($schedule_id);

    require_once './views/guide/checkpoints/list.php';
}
    public function checkIn() {
        $checkpoint_id = $_GET['id'];
        $location = $_POST['location'] ?? 'Không xác định';

        $this->checkpointModel->checkIn($checkpoint_id, $location);
        $_SESSION['success'] = "Check-in thành công!";
        header("Location: index.php?act=checkpoint-list&schedule_id=" . $_GET['schedule_id']);
    }

    public function checkOut() {
        $checkpoint_id = $_GET['id'];
        $location = $_POST['location'] ?? 'Không xác định';

        $this->checkpointModel->checkOut($checkpoint_id, $location);
        $_SESSION['success'] = "Check-out thành công!";
        header("Location: index.php?act=checkpoint-list&schedule_id=" . $_GET['schedule_id']);
    }

    public function listAll() {
    $checkpoints = $this->checkpointModel->getAllCheckpoints();
    require_once './views/guide/checkpoints/list-all.php';
}

    
}

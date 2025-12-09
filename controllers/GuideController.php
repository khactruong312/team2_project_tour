<?php
class GuideController {
    private $guideModel;

    public function __construct() {
        $this->guideModel = new GuideModel();
    }

    // Trang chủ dành cho hướng dẫn viên
    public function guideHome() {
        require_once './views/guide/trangchu.php';
    }

    // Danh sách tour của hướng dẫn viên đăng nhập
    public function list() {

        // Kiểm tra đăng nhập đúng role
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guide') {
            header("Location: index.php?controller=login&action=loginForm");
            exit();
        }

        // Lấy thông tin hướng dẫn viên qua user_id
        $user_id = $_SESSION['user_id'];
        $guide = $this->guideModel->getByUserId($user_id);

        if (!$guide) {
            die(" Không tìm thấy hướng dẫn viên cho user_id = $user_id");
        }

        $guideId = $guide['guide_id'];

        // Lấy danh sách tour theo guide_id
        $guides = $this->guideModel->getToursByGuideId($guideId);

        require_once './views/guide/list.php';
    }

    // Trang tiến trình tour
    public function progress() {

        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guide') {
            header("Location: index.php?controller=login&action=loginForm");
            exit();
        }

        // Lấy schedule_id từ URL
        $scheduleId = $_GET['id'] ?? null;

        if (!$scheduleId || !is_numeric($scheduleId)) {
            header("Location: index.php?act=guide-list");
            exit();
        }

        // Lấy chi tiết lịch trình
        $scheduleDetail = $this->guideModel->getScheduleDetail($scheduleId);

        if (!$scheduleDetail) {
            die("Không tìm thấy lịch trình tour ID: $scheduleId");
        }

        // Lấy danh sách checkpoint (đã sửa ORDER BY actual_checkin)
        $checkpoints = $this->guideModel->getCheckpointsByScheduleId($scheduleId);

        require_once './views/guide/progress.php';
    }

    // Trang báo cáo tour
    public function report() {

        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'guide') {
            header("Location: index.php?controller=login&action=loginForm");
            exit();
        }

        // Lấy schedule_id
        $scheduleId = $_GET['id'] ?? null;

        if (!$scheduleId || !is_numeric($scheduleId)) {
            header("Location: index.php?act=guide-list");
            exit();
        }

        // Lấy chi tiết lịch trình
        $scheduleDetail = $this->guideModel->getScheduleDetail($scheduleId);

        if (!$scheduleDetail) {
            die("Không tìm thấy lịch trình tour ID: $scheduleId");
        }

        require_once './views/guide/report.php';
    }
    
    public function submitReport() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die("Invalid request");
    }

    $scheduleId = $_POST['schedule_id'];
    $guideId = $_SESSION['guide_id'];
    $pax = $_POST['pax_count'];
    $extra = $_POST['extra_expenses'];
    $issues = $_POST['issues'];
    $notes = $_POST['guide_notes'];
    $rating = $_POST['rating'];

    $result = $this->guideModel->saveReport([
        'schedule_id' => $scheduleId,
        'guide_id' => $guideId,
        'pax_count' => $pax,
        'extra_expenses' => $extra,
        'issues' => $issues,
        'guide_notes' => $notes,
        'rating' => $rating
    ]);

    if ($result) {
        $_SESSION['success'] = "Báo cáo đã được gửi!";
    } else {
        $_SESSION['error'] = "Lỗi khi lưu báo cáo!";
    }

    header("Location: index.php?act=guide-tours");
    exit();
}
}

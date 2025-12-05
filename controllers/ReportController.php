<?php
// controllers/ReportController.php
require_once './models/ReportModel.php';

class ReportController {
    private $model;
    public function __construct() {
        $this->model = new ReportModel();
    }

    // Trang chọn loại báo cáo
    public function index() {
        require_once './views/admin/Report/list.php';
    }

    // Báo cáo theo tour
    public function tourReport() {
        $from = $_GET['from'] ?? date('Y-01-01');
        $to   = $_GET['to'] ?? date('Y-m-d');

        $data = $this->model->revenueByTour($from, $to);
        $totalRevenue = $this->model->totalRevenue($from, $to);
        $totalExpense = $this->model->totalExpense($from, $to);

        require_once './views/admin/Report/tour.php';
    }

    // Báo cáo theo thời gian (doanh thu theo tháng)
    public function timeReport() {
        $year = $_GET['year'] ?? date('Y');
        $data = $this->model->revenueByMonth($year);
        require_once './views/admin/Report/time.php';
    }

    // Báo cáo hiệu suất HDV
    public function guideReport() {
        $from = $_GET['from'] ?? date('Y-01-01');
        $to   = $_GET['to'] ?? date('Y-m-d');

        $data = $this->model->guidePerformance($from, $to);
        require_once './views/admin/Report/guide.php';
    }
}

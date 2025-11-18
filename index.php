<?php 
// Require file Common
require_once './commons/env.php';
require_once './commons/function.php';

// Require Controllers
require_once './controllers/TourController.php';

// Require Models
require_once './models/TourModel.php';

// Route
$act = $_GET['act'] ?? '/';

// Router sử dụng match
match ($act) {
    // Trang chủ
    '/'         => (new TourController())->home(),

    // Trang danh sách tour
    'tour-list' => (new TourController())->list(),

    // // Chi tiết tour
    // 'tour-detail' => (new TourController())->detail(),

    // // Login / Register
    // 'login'     => (new TourController())->login(),
    // 'register'  => (new TourController())->register(),

    // Admin CRUD TOUR
    'tour-create' => (new TourController())->create(),
    'tour-store'  => (new TourController())->store(),

    'tour-edit'   => (new TourController())->edit(),
    'tour-update' => (new TourController())->update(),

    'tour-delete' => (new TourController())->delete(),

    // Mặc định
    default     => (new TourController())->home(),
};

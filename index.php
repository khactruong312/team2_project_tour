<?php

require_once './commons/env.php';
require_once './commons/function.php';

// Controllers
require_once './controllers/LoginController.php';
require_once './controllers/TourController.php';
require_once './controllers/ScheduleController.php';
require_once './controllers/GuideController.php';
require_once './controllers/BookingController.php';

// Models
require_once './models/UserModel.php';
require_once './models/TourModel.php';
require_once './models/ScheduleModel.php';
require_once './models/GuideModel.php';
require_once './models/BookingModel.php';

$act = $_GET['act'] ?? '/';

// Khởi tạo controller
$login     = new LoginController;
$admin     = new TourController;
$schedule  = new ScheduleController;
$guide     = new GuideController;
$booking   = new BookingController;

match ($act) {

    /* =============================
     * LOGIN / LOGOUT
     * ============================= */
    '/'         => $login->showLogin(),
    'login'     => $login->showLogin(),
    'do-login'  => $login->login(),
    'logout'    => $login->logout(),

    /* =============================
     * TRANG ADMIN
     * ============================= */
    'admin-home' => $admin->adminHome(),

    /* =============================
     * CRUD TOUR
     * ============================= */
    'tour-list'     => $admin->list(),
    'tour-create'   => $admin->create(),
    'tour-store'    => $admin->store(),
    'tour-edit'     => $admin->edit(),
    'tour-update'   => $admin->update(),
    'tour-delete'   => $admin->delete(),

    /* =============================
     * QUẢN LÝ BOOKING
     * ============================= */
    'tour-booking'  => $booking->list(),
    'booking-create' => $booking->create(),
    'booking-store'  => $booking->store(),
    'booking-view'   => $booking->view(),
    'booking-status' => $booking->changeStatus(),

    /* =============================
     * TRANG HƯỚNG DẪN VIÊN
     * ============================= */
    'guide-home' => $guide->guideHome(),
    'guide-list' => $guide->list(),

    /* =============================
     * CRUD LỊCH KHỞI HÀNH
     * ============================= */
    'schedule-list'     => $schedule->index(),
    'schedule-create'   => $schedule->create(),
    'schedule-store' => $schedule->store(),
    'schedule-edit'     => $schedule->edit(),
    'schedule-update'   => $schedule->update(),
    'schedule-delete'   => $schedule->delete(),

    /* =============================
     * DEFAULT
     * ============================= */
    default => $login->showLogin(),
};

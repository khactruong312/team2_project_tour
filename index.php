<?php

require_once './commons/env.php';
require_once './commons/function.php';

// Controllers
require_once './controllers/LoginController.php';
require_once './controllers/TourController.php';
require_once './controllers/ScheduleController.php';

// Models
require_once './models/UserModel.php';
require_once './models/TourModel.php';
require_once './models/ScheduleModel.php';

// ROUTE
$act = $_GET['act'] ?? '/';

$login    = new LoginController;
$admin    = new TourController;
$schedule = new ScheduleController;

match ($act) {

    /* =============================
     * LOGIN / LOGOUT
     * ============================= */
    '/'         => $login->showLogin(),
    'login'     => $login->showLogin(),
    'do-login'  => $login->login(),
    'logout'    => $login->logout(),

    /* =============================
     *  TRANG ADMIN
     * ============================= */
    'admin-home' => $admin->adminHome(),

    /* =============================
     *  CRUD TOUR
     * ============================= */
    'tour-list'     => $admin->list(),
    'tour-create'   => $admin->create(),
    'tour-store'    => $admin->store(),
    'tour-edit'     => $admin->edit(),
    'tour-update'   => $admin->update(),
    'tour-delete'   => $admin->delete(),

    /* =============================
     *  CRUD LỊCH KHỞI HÀNH TOUR
     * ============================= */
    'schedule-list'     => $schedule->index(),
    'schedule-create'   => $schedule->create(),
    // 'schedule-store'    => $schedule->store(),
    'schedule-edit'     => $schedule->edit(),
    'schedule-update'   => $schedule->update(),
    'schedule-delete'   => $schedule->delete(),

    /* =============================
     * DEFAULT
     * ============================= */
    default => $login->showLogin(),
};

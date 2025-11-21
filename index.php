<?php

// session_start();

require_once './commons/env.php';
require_once './commons/function.php';

// Controllers
require_once './controllers/LoginController.php';
require_once './controllers/TourController.php';

// Models
require_once './models/UserModel.php';
require_once './models/TourModel.php';

// ROUTE
$act = $_GET['act'] ?? '/';

$login    = new LoginController;
$tour     = new TourController;

match ($act) {

    /* =============================
     * LOGIN / LOGOUT
     * ============================= */
    '/'         => $login->showLogin(),
    'login'     => $login->showLogin(),
    'do-login'  => $login->login(),
    'logout'    => $login->logout(),

    /* =============================
     *  TRANG ADMIN SAU LOGIN
     * ============================= */
    'admin-home' => $tour->adminHome(),

    /* =============================
     *  TRANG HƯỚNG DẪN VIÊN
     * ============================= */
    'guide-home' => $tour->guideHome(),

    /* =============================
     *  CRUD TOUR (CHỈ ADMIN)
     * ============================= */
    'tour-list'     => $tour->list(),
    'tour-create'   => $tour->create(),
    'tour-store'    => $tour->store(),
    'tour-edit'     => $tour->edit(),
    'tour-update'   => $tour->update(),
    'tour-delete'   => $tour->delete(),

    /* =============================
     * MẶC ĐỊNH
     * ============================= */
    default => $login->showLogin(),
};

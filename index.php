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
$admin     = new TourController;

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
    'admin-home' => $admin->adminHome(),

    /* =============================
     *  TRANG HƯỚNG DẪN VIÊN
     * ============================= */

    // 'guide-home' => $admin->guideHome(),

    /* =============================
     *  CRUD TOUR (CHỈ ADMIN)
     * ============================= */
    'tour-list'     => $admin->list(),
    'tour-create'   => $admin->create(),
    'tour-store'    => $admin->store(),
    'tour-edit'     => $admin->edit(),
    'tour-update'   => $admin->update(),
    'tour-delete'   => $admin->delete(),

    /* =============================
     * MẶC ĐỊNH
     * ============================= */
    default => $login->showLogin(),
};

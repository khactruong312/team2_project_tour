<?php

// session_start();

require_once './commons/env.php';
require_once './commons/function.php';

// Controllers
require_once './controllers/LoginController.php';
require_once './controllers/TourController.php';
require_once './controllers/GuideController.php';

// Models
require_once './models/UserModel.php';
require_once './models/TourModel.php';
require_once './models/GuideModel.php';

// ROUTE
$act = $_GET['act'] ?? '/';

$login    = new LoginController;
$admin     = new TourController;
$guide     = new GuideController;


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
     *  CRUD TOUR (CHỈ ADMIN)
     * ============================= */
    'tour-list'     => $admin->list(),
    'tour-create'   => $admin->create(),
    'tour-store'    => $admin->store(),
    'tour-edit'     => $admin->edit(),
    'tour-update'   => $admin->update(),
    'tour-delete'   => $admin->delete(),

/* =============================
     *  TRANG HƯỚNG DẪN VIÊN
     * ============================= */

    'guide-home' => $guide->guideHome(),



    /* =============================
     *  Huong dan vien
     * ============================= */
    'guide-list'     => $guide->list(),


    /* =============================
     * MẶC ĐỊNH
     * ============================= */
    default => $login->showLogin(),
};

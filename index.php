<?php

// session_start();

require_once './commons/env.php';
require_once './commons/function.php';

// Controllers
require_once './controllers/LoginController.php';
require_once './controllers/TourController.php';
require_once './controllers/GuideController.php';
require_once './controllers/BookingController.php';

// Models
require_once './models/UserModel.php';
require_once './models/TourModel.php';
require_once './models/GuideModel.php';
require_once './models/BookingModel.php';

//  $user_role = $_SESSION['role'] ?? null;

// Quyền admin
//  function isAdmin() {
//     return ($_SESSION['role'] ?? '') === 'admin';
// }

// // Quyền hướng dẫn viên
//  function isGuide() {
//     return ($_SESSION['role'] ?? '') === 'guide';
// }

// ROUTE
$act = $_GET['act'] ?? '/';

$login    = new LoginController;
$admin     = new TourController;
$guide     = new GuideController;
$booking   = new BookingController;



match ($act) {
    //phân role admin và guide
    



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
    /*
     *  QUẢN LÝ BOOKING (CHỈ ADMIN)
    */
    'tour-booking'  => $booking->list(),
    'booking-create' => $booking->create(),
    'booking-store'  => $booking->store(),
    'booking-view'   => $booking->view(),
    'booking-status' => $booking->changeStatus(),

    
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

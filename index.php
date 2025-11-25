<?php

require_once './commons/env.php';
require_once './commons/function.php';

// Controllers
require_once './controllers/LoginController.php';
require_once './controllers/TourController.php';
<<<<<<< HEAD
require_once './controllers/ScheduleController.php';
=======
require_once './controllers/GuideController.php';
require_once './controllers/BookingController.php';
>>>>>>> 7f09fbac89bb469c8cbf47e6f3d3d7ef8d9fc46c

// Models
require_once './models/UserModel.php';
require_once './models/TourModel.php';
<<<<<<< HEAD
require_once './models/ScheduleModel.php';
=======
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
>>>>>>> 7f09fbac89bb469c8cbf47e6f3d3d7ef8d9fc46c

// ROUTE
$act = $_GET['act'] ?? '/';

$login    = new LoginController;
<<<<<<< HEAD
$admin    = new TourController;
$schedule = new ScheduleController;
=======
$admin     = new TourController;
$guide     = new GuideController;
$booking   = new BookingController;


>>>>>>> 7f09fbac89bb469c8cbf47e6f3d3d7ef8d9fc46c

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
     *  TRANG ADMIN
     * ============================= */
    'admin-home' => $admin->adminHome(),

<<<<<<< HEAD
    /* =============================
     *  CRUD TOUR
=======
    

    /* =============================
     *  CRUD TOUR (CHỈ ADMIN)
>>>>>>> 7f09fbac89bb469c8cbf47e6f3d3d7ef8d9fc46c
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

<?php

require_once './commons/env.php';
require_once './commons/function.php';

// Controllers
require_once './controllers/LoginController.php';
require_once './controllers/TourController.php';
require_once './controllers/ScheduleController.php';
require_once './controllers/GuideController.php';
require_once './controllers/BookingController.php';
require_once './controllers/ExpenseController.php';
require_once './controllers/CustomerController.php';


// Models
require_once './models/UserModel.php';
require_once './models/TourModel.php';
require_once './models/ScheduleModel.php';
require_once './models/GuideModel.php';
require_once './models/BookingModel.php';
require_once './models/ExpenseModel.php';
require_once './models/CustomerModel.php';


$act = $_GET['act'] ?? '/';

// Khởi tạo controller
$login     = new LoginController;
$admin     = new TourController;
$schedule  = new ScheduleController;
$guide     = new GuideController;
$booking   = new BookingController;
$customer = new CustomerController;
$expense = new ExpenseController();



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
    'booking-delete' => $booking->delete(),
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
    /* API lấy lịch theo tour */
    'get-schedule-by-tour' => $schedule->getScheduleByTour(),

/* =============================
     * CRUD KHÁCH HÀNG (CUSTOMER)
     * ============================= */
    'customer-list'   => $customer->list(),
    'customer-create' => $customer->create(),
    'customer-store'  => $customer->store(),
    'customer-detail' => $customer->detail(),
    'customer-edit'   => $customer->edit(),
    'customer-update' => $customer->update(),
    'customer-delete' => $customer->delete(),

    //chi phí
     'expense-list'   => $expense->index(),
     'expense-create' => $expense->create(),
     'expense-store'  => $expense->store(),
     'expense-edit'   => $expense->edit(),
    'expense-update' => $expense->update(),

    'expense-delete' => $expense->delete(),

    /* =============================
     * DEFAULT
     * ============================= */
    default => $login->showLogin(),
};

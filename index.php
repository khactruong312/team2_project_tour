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
require_once './controllers/SettingController.php';
require_once './controllers/EmployeeController.php';
require_once './controllers/ReportController.php';
require_once './controllers/CheckpointController.php';


// Models
require_once './models/UserModel.php';
require_once './models/TourModel.php';
require_once './models/ScheduleModel.php';
require_once './models/GuideModel.php';
require_once './models/BookingModel.php';
require_once './models/ExpenseModel.php';
require_once './models/CustomerModel.php';
require_once './models/SettingModel.php';
require_once './models/EmployeeModel.php';
require_once './models/ReportModel.php';
require_once './models/CheckpointModel.php';


// ============= FIX QUAN TRỌNG =============
$act = $_GET['act'] ?? 'login';

// Khởi tạo controller
$login     = new LoginController;
$admin     = new TourController;
$schedule  = new ScheduleController;
$guide     = new GuideController;
$booking   = new BookingController;

$customer  = new CustomerController;


$customer = new CustomerController;

$setting   = new SettingController();
$employees = new EmployeeController();
$report    = new ReportController();

$checkpoint = new CheckpointController();




match ($act) {

    /* =============================
     * LOGIN / LOGOUT
     * ============================= */
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
    'tour-booking'   => $booking->list(),
    'booking-create' => $booking->create(),
    'booking-store'  => $booking->store(),
    'booking-view'   => $booking->view(),
    'booking-delete' => $booking->delete(),
    'booking-status' => $booking->changeStatus(),

     /* =============================
     * QUẢN LÝ Người Dùng
     * ============================= */

    'user-list'   => $setting->listUsers(),
    'user-detail' => $setting->viewUser(),
    'user-edit'   => $setting->editUser(),
    'user-delete' => $setting->deleteUser(),
    'user-create' => $setting->createUser(),

    /* =============================
     * QUẢN LÝ NHÂN SỰ
     * ============================= */
    'employees-list' => $employees->index(),
    'employees-create' => $employees->create(),
    'employees-edit' => $employees->edit(),
    'employees-store' =>$employees->store(),
    'employees-update'=>$employees->update(),
    'employees-delete' =>$employees->delete(),

    /* =============================
     * BÁO CÁO THỐNG KÊ
     * ============================= */
    'report-list' => $report->index(),
     'report-tour'  => $report->tourReport(),
    'report-time'  => $report->timeReport(),
    'report-guide' => $report->guideReport(),

    /* =============================
     * TRANG HƯỚNG DẪN VIÊN
     * ============================= */
    'guide-home' => $guide->guideHome(),
    'guide-list' => $guide->list(),
    'guide-progress' => $guide->progress(),
    'guide-report'   => $guide->report(),

    'guide-submit-report' => $guide->submitReport(),





    /* =============================
     * CRUD LỊCH KHỞI HÀNH
     * ============================= */
    'schedule-list'     => $schedule->index(),
    'schedule-create'   => $schedule->create(),
    'schedule-store'    => $schedule->store(),
    'schedule-edit'     => $schedule->edit(),
    'schedule-update'   => $schedule->update(),
    'schedule-delete'   => $schedule->delete(),
    'get-schedule-by-tour' => $schedule->getScheduleByTour(),
    'checkpoint-list'  => $checkpoint->list(), 
    'list-all'=>$checkpoint->listAll(),
    'checkpoint-checkin'  => $checkpoint->checkIn(),
    'checkpoint-checkout' => $checkpoint->checkOut(),


    /* =============================
     * CRUD KHÁCH HÀNG
     * ============================= */
    'customer-list'   => $customer->list(),
    'customer-create' => $customer->create(),
    'customer-store'  => $customer->store(),
    'customer-detail' => $customer->detail(),
    'customer-edit'   => $customer->edit(),
    'customer-update' => $customer->update(),
    'customer-delete' => $customer->delete(),

    /* =============================
     * CHI PHÍ TOUR
     * ============================= */
    // 'expense-list'   => $expense->index(),
    // 'expense-create' => $expense->create(),
    // 'expense-store'  => $expense->store(),
    // 'expense-edit'   => $expense->edit(),
    // 'expense-update' => $expense->update(),
    // 'expense-delete' => $expense->delete(),


    /* =============================
     * DEFAULT – QUAY VỀ LOGIN
     * ============================= */
    default => $login->showLogin(),
};

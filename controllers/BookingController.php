
<?php


class BookingController
{
    private $bookingModel;
    private $tourModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->tourModel = new TourModel(); 
    }

    // ⭐ Danh sách booking
    public function list()
    {
        $bookings = $this->bookingModel->getAll();

        require_once './views/admin/Booking/booking.php';
    }

    // ⭐ Form tạo booking
    public function create()
    {
        $tours = $this->tourModel->getAll();
        require_once './views/admin/Booking/create.php';
    }

    // ⭐ Lưu booking
    public function store()
    {
        $schedule_id = $_POST['schedule_id'] ?? null;

if (!$schedule_id) {
    $_SESSION['error'] = "Vui lòng chọn lịch khởi hành!";
    header("Location: index.php?act=booking-create");
    exit;
}
$scheduleModel = new ScheduleModel();
$schedule = $scheduleModel->getOne($schedule_id);

if (!$schedule) {
    $_SESSION['error'] = "Lịch khởi hành không tồn tại!";
    header("Location: index.php?act=booking-create");
    exit;
}

$start_date = $schedule['start_date'];
$end_date = $schedule['end_date'];
        $tour_id = $_POST['tour_id'];
        $payment_method = $_POST['payment_method'] ?? "Tiền mặt";
        $status = "Booked";
        $created_by = $_SESSION['user_id'] ?? 1;

        $cust_name  = $_POST['cust_name'] ?? [];
        $cust_phone = $_POST['cust_phone'] ?? [];
        $cust_email = $_POST['cust_email'] ?? [];
        $cust_address = $_POST['cust_address'] ?? [];

        if (empty($tour_id) || empty($cust_name)) {
            $_SESSION['error'] = "Vui lòng chọn tour và nhập thông tin khách hàng";
            header("Location: index.php?act=booking-create");
            exit;
        }

        $tour = $this->tourModel->getById($tour_id);
        if (!$tour) {
            $_SESSION['error'] = "Tour không tồn tại!";
            header("Location: index.php?act=booking-create");
            exit;
        }

        $total_amount = $tour['price'] * count($cust_name);

        $customers = [];
        for ($i = 0; $i < count($cust_name); $i++) {
            $customers[] = [
                'full_name' => $cust_name[$i],
                'phone' => $cust_phone[$i],
                'email' => $cust_email[$i],
                'address' => $cust_address[$i],

                'note' => null
            ];
        }

        $result = $this->bookingModel->createBooking(
    $tour_id,
    $total_amount,
    $status,
    $created_by,
    $customers,
    $start_date,
    $end_date
);

        if (isset($result['error'])) {
            $_SESSION['error'] = $result['error'];
            header("Location: index.php?act=booking-create");
            exit;
        }

        $_SESSION['success'] = "Tạo booking thành công!";
        header("Location: index.php?act=tour-booking");
        exit;
    }

    // ⭐ Xem chi tiết booking
    public function view()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = "Không tìm thấy booking!";
            header("Location: index.php?act=booking-list");
            exit;
        }

        $booking = $this->bookingModel->find($id);    
        $customers = $this->bookingModel->customers($id);

        require_once './views/admin/Booking/detail.php';
    }

    // ⭐ Cập nhật trạng thái booking
    public function changeStatus()
    {
        $id = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? null;

        if (!$id || !$status) {
            $_SESSION['error'] = "Thiếu tham số!";
            header("Location: index.php?act=tour-booking");
            exit;
        }

        $this->bookingModel->updateStatus($id, $status);

        $_SESSION['success'] = "Cập nhật trạng thái thành công!";
        header("Location: index.php?act=tour-booking");
    }

    // ⭐ Xóa booking + khách liên quan
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = "Không tìm thấy booking!";
            header("Location: index.php?act=tour-booking");
            exit;
        }

        $this->bookingModel->delete($id);

        $_SESSION['success'] = "Xóa booking thành công!";
        header("Location: index.php?act=tour-booking");
    }
}

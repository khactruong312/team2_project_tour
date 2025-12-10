
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

    // Load schedule
    $scheduleModel = new ScheduleModel();
    $schedule = $scheduleModel->getOne($schedule_id);

    if (!$schedule) {
        $_SESSION['error'] = "Lịch khởi hành không tồn tại!";
        header("Location: index.php?act=booking-create");
        exit;
    }

    $tour_id = $schedule['tour_id'];
    $start_date = $schedule['start_date'];
    $end_date = $schedule['end_date'];

    // Load tour
    $tour = $this->tourModel->getById($tour_id);
    if (!$tour) {
        $_SESSION['error'] = "Tour không tồn tại!";
        header("Location: index.php?act=booking-create");
        exit;
    }

    // Load khách từ form
    $cust_name  = $_POST['cust_name'] ?? [];
    $cust_phone = $_POST['cust_phone'] ?? [];
    $cust_email = $_POST['cust_email'] ?? [];
    $cust_address = $_POST['cust_address'] ?? [];
    $cust_type = $_POST['cust_type'] ?? [];

    $new_customer_count = count($cust_name);

    if ($new_customer_count == 0) {
        $_SESSION['error'] = "Vui lòng nhập thông tin khách hàng";
        header("Location: index.php?act=booking-create");
        exit;
    }

    // 🔥 KIỂM TRA BOOKING ĐÃ TỒN TẠI THEO TOUR
    $existing = $this->bookingModel->findBookingByTour($tour_id);
    $booking_id = null;

    if ($existing) {

        $booking_id = $existing['booking_id'];

        $current_count = $this->bookingModel->countCustomers($booking_id);

        $total_after_add = $current_count + $new_customer_count;

        if ($total_after_add > 30) {
            $_SESSION['error'] = "Tour này đã có $current_count khách. Không thể thêm $new_customer_count khách mới (tối đa 30).";
            header("Location: index.php?act=booking-create");
            exit;
        }

        // --------------------------
        // 🔥 SỬA LOGIC TRÙNG KHÁCH
        // --------------------------
        $added = 0;
        $duplicated = [];

        for ($i = 0; $i < count($cust_name); $i++) {

            // Chỉ kiểm tra trùng theo tour hiện tại
            if ($this->bookingModel->customerExistsInTour($tour_id, $cust_name[$i], $cust_phone[$i])) {
                $duplicated[] = $cust_name[$i];
                continue;
            }

            // Thêm khách mới
            $price = ($cust_type[$i] == "child") ? 0 : $tour['price'];

            $this->bookingModel->addSingleCustomer(
                $booking_id,
                $cust_name[$i],
                $cust_phone[$i],
                $cust_email[$i],
                $cust_address[$i],
                $cust_type[$i],
                $price
            );

            $added++;
        }

        // Cập nhật tổng tiền
        $this->bookingModel->updateTotalAmount($booking_id);

        $msg = "";

        if ($added > 0) {
            $msg .= "Đã thêm $added khách mới. ";
        }
        if (!empty($duplicated)) {
            $list = implode(", ", $duplicated);
            $msg .= "Không thêm các khách sau vì đã có trong booking tour này: $list.";
        }

        $_SESSION['success'] = $msg;
        header("Location: index.php?act=tour-booking");
        exit;

    } else {

        // ❇ BOOKING MỚI
        $created_by = $_SESSION['user_id'] ?? 1;
        $adult_price = $tour['price'];
        $total_amount = 0;
        $customers = [];

        for ($i = 0; $i < count($cust_name); $i++) {
            $price = ($cust_type[$i] == "child") ? 0 : $adult_price;
            $total_amount += $price;

            $customers[] = [
                'full_name' => $cust_name[$i],
                'phone' => $cust_phone[$i],
                'email' => $cust_email[$i],
                'address' => $cust_address[$i],
                'type' => $cust_type[$i],
                'price' => $price,
                'note' => null
            ];
        }

        $result = $this->bookingModel->createBooking(
            $tour_id,
            $total_amount,
            "Booked",
            $created_by,
            $customers,
            $start_date,
            $end_date
        );

        $_SESSION['success'] = "Tạo booking mới thành công!";
        header("Location: index.php?act=tour-booking");
        exit;
    }
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

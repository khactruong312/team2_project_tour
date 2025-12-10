<?php
require_once './models/Database.php';

class BookingModel extends Database
{
    public function __construct()
    {
        parent::__construct(); // KHÔNG CÓ DÒNG NÀY SẼ LỖI $this->conn = null
    }

    // ⭐ Lấy tất cả booking
    public function getAll()
    {
        $sql = "
            SELECT 
                b.booking_id,
                b.tour_id,
                b.total_amount,
                b.status,
                b.created_at,
                b.start_date,
                b.end_date,


                t.name AS tour_name
            FROM bookings b
            LEFT JOIN tours t ON b.tour_id = t.tour_id
            ORDER BY b.booking_id DESC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ⭐ Tìm booking theo ID
    public function find($id)
    {
        $sql = "
            SELECT 
                b.*,
                t.name AS tour_name,
                t.price AS tour_price
            FROM bookings b
            LEFT JOIN tours t ON b.tour_id = t.tour_id
            WHERE b.booking_id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ⭐ Lấy danh sách khách hàng theo booking
    public function customers($booking_id)
    {
        $sql = "
            SELECT * 
            FROM booking_customers
            WHERE booking_id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$booking_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ⭐ Tạo booking + thêm khách
   public function createBooking($tour_id, $total_amount, $status, $created_by, $customers, $start_date, $end_date)
{
    try {
        $this->conn->beginTransaction();

        // Tạo booking
        $sql = "
            INSERT INTO bookings (tour_id, total_amount, status, created_by, start_date, end_date)
            VALUES (?, ?, ?, ?, ?, ?)
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tour_id, $total_amount, $status, $created_by, $start_date, $end_date]);

        $booking_id = $this->conn->lastInsertId();

        // Thêm khách
        $sql_customer = "
            INSERT INTO booking_customers
            (booking_id, full_name, phone, email, address, type, price, note)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ";
        $stmt_customer = $this->conn->prepare($sql_customer);

        foreach ($customers as $c) {
            $stmt_customer->execute([
                $booking_id,
                $c['full_name'],
                $c['phone'],
                $c['email'],
                $c['address'],
                $c['type'],
                $c['price'],
                $c['note'] ?? null
            ]);
        }

        $this->conn->commit();
        return ["success" => true];

    } catch (Exception $e) {
        $this->conn->rollBack();
        return ["error" => $e->getMessage()];
    }
}


    // ⭐ Cập nhật trạng thái (Booked / Paid / Cancelled / Processing)
    public function updateStatus($booking_id, $status)
    {
        $sql = "UPDATE bookings SET status = ? WHERE booking_id = ?";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status, $booking_id]);
    }

    // ⭐ Xóa booking + khách liên quan
    public function delete($booking_id)
    {
        try {
            $this->conn->beginTransaction();

            // Xóa khách trước
            $sql1 = "DELETE FROM booking_customers WHERE booking_id = ?";
            $stmt1 = $this->conn->prepare($sql1);
            $stmt1->execute([$booking_id]);

            // Xóa booking
            $sql2 = "DELETE FROM bookings WHERE booking_id = ?";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->execute([$booking_id]);

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function findBookingByTour($tour_id)
{
    $sql = "SELECT * FROM bookings WHERE tour_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$tour_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function countCustomers($booking_id)
{
    $sql = "SELECT COUNT(*) FROM booking_customers WHERE booking_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$booking_id]);
    return $stmt->fetchColumn();
}

public function addCustomers(
    $booking_id, $names, $phones, $emails, 
    $addresses, $types, $price_per_adult
) {
    $insert_sql = "
        INSERT INTO booking_customers
        (booking_id, full_name, phone, email, address, type, price)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ";
    $insert_stmt = $this->conn->prepare($insert_sql);

    $check_sql = "
        SELECT COUNT(*) FROM booking_customers 
        WHERE booking_id = ? AND (phone = ? OR email = ?)
    ";
    $check_stmt = $this->conn->prepare($check_sql);

    $duplicated = [];
    $added_count = 0;

    for ($i = 0; $i < count($names); $i++) {

        $check_stmt->execute([$booking_id, $phones[$i], $emails[$i]]);
        $exists = $check_stmt->fetchColumn();

        if ($exists > 0) {
            $duplicated[] = $names[$i];
            continue; 
        }

        // ❗ Đây là lỗi khiến giá người lớn bị = 0
        $price = ($types[$i] == "child") ? 0 : $price_per_adult;

        // thêm khách
        $insert_stmt->execute([
            $booking_id,
            $names[$i],
            $phones[$i],
            $emails[$i],
            $addresses[$i],
            $types[$i],
            $price
        ]);

        $added_count++;
    }

    return [
        "added" => $added_count,
        "duplicated" => $duplicated
    ];
}


public function updateTotalAmount($booking_id)
{
    // Tính tổng tiền dựa trên bảng booking_customers
    $sql = "SELECT SUM(price) FROM booking_customers WHERE booking_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$booking_id]);
    $total = $stmt->fetchColumn();

    // Cập nhật vào bảng bookings
    $sql2 = "UPDATE bookings SET total_amount = ? WHERE booking_id = ?";
    $stmt2 = $this->conn->prepare($sql2);
    $stmt2->execute([$total, $booking_id]);
}

public function customerExistsInTour($tour_id, $full_name, $phone)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM booking_customers bc
        JOIN bookings b ON bc.booking_id = b.booking_id
        WHERE b.tour_id = ?
        AND bc.full_name = ?
        AND bc.phone = ?
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$tour_id, $full_name, $phone]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] > 0;
}

public function addSingleCustomer($booking_id, $name, $phone, $email, $address, $type, $price)
{
    $sql = "
        INSERT INTO booking_customers 
        (booking_id, full_name, phone, email, address, type, price)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$booking_id, $name, $phone, $email, $address, $type, $price]);
}



}

<?php

class CustomerModel {
    private $conn;

    public function __construct() {
        include_once __DIR__ . '/../commons/env.php';
        include_once __DIR__ . '/../commons/function.php';

        $this->conn = connectDB();
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }


    /* ============================
        Lấy danh sách khách hàng
        (Đã sửa: Truy vấn booking_customers và đặt ALIAS)
       ============================ */
    public function getAllCustomers() {
        try {
            // Sửa truy vấn: Đặt ALIAS cho id (hoặc customer_id) thành 'customer_id' để khớp với View
            $sql = "
                SELECT 
                    customer_id,      
                    full_name, 
                    email, 
                    phone, 
                    address, 
                    status, 
                    created_at 
                FROM booking_customers 
                ORDER BY customer_id DESC
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("CustomerModel->getAllCustomers: " . $e->getMessage());
            return [];
        }
    }

    /* ============================
    Lấy danh sách tour đã đặt theo customer_id
   ============================ */
public function getToursByCustomerId($customer_id) {
    try {
        $sql = "
            SELECT 
                b.booking_id,
                t.tour_id,
                t.tour_name,
                t.price,
                b.booking_date,
                b.status
            FROM bookings b
            JOIN tours t ON b.tour_id = t.tour_id
            WHERE b.customer_id = ?
            ORDER BY b.booking_id DESC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$customer_id]);
        return $stmt->fetchAll();

    } catch (Exception $e) {
        error_log('CustomerModel->getToursByCustomerId: ' . $e->getMessage());
        return [];
    }
}


    /* ============================
        Lấy khách theo ID
       ============================ */
    public function getCustomerById($customer_id) {
        try {
            // Đã sửa: Truy vấn bảng booking_customers
            $sql = "SELECT * FROM booking_customers WHERE customer_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$customer_id]);
            return $stmt->fetch() ?: null;
        } catch (Exception $e) {
            error_log("CustomerModel->getCustomerById: " . $e->getMessage());
            return null;
        }
    }

    /* ============================
        Thêm khách hàng
       ============================ */
    public function addCustomer($full_name, $email, $phone, $address, $status) {
        try {
            $sql = "INSERT INTO booking_customers (full_name, email, phone, address, status, created_at)
                    VALUES (?, ?, ?, ?, ?, NOW())";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$full_name, $email, $phone, $address, $status]);
        } catch (Exception $e) {
            error_log("CustomerModel->addCustomer: " . $e->getMessage());
            return false;
        }
    }

    /* ============================
        Cập nhật khách hàng
       ============================ */
    public function updateCustomer($customer_id, $full_name, $email, $phone, $address, $status) {
        try {
            $sql = "UPDATE booking_customers 
                    SET full_name = ?, email = ?, phone = ?, address = ?, status = ?
                    WHERE customer_id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$full_name, $email, $phone, $address, $status, $customer_id]);
        } catch (Exception $e) {
            error_log("CustomerModel->updateCustomer: " . $e->getMessage());
            return false;
        }
    }

    /* ============================
        Xóa khách
       ============================ */
    public function deleteCustomer($customer_id) {
        try {
            $sql = "DELETE FROM booking_customers WHERE customer_id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$customer_id]);
        } catch (Exception $e) {
            error_log("CustomerModel->deleteCustomer: " . $e->getMessage());
            return false;
        }
    }
}
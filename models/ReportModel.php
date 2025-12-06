<?php
// models/ReportModel.php
// Sử dụng connectDB() từ commons/function.php
require_once './commons/function.php';

class ReportModel {
    private $conn;
    public function __construct() {
        $this->conn = connectDB();
    }

    /**
     * Doanh thu + chi phí + lợi nhuận theo tour trong khoảng ngày (inclusive)
     * from, to: 'YYYY-MM-DD'
     */
    public function revenueByTour($from, $to) {
        $sql = "
            SELECT
                t.tour_id,
                t.name AS tour_name,
                IFNULL(SUM(b.total_amount),0) AS total_revenue,
                IFNULL((SELECT SUM(e.amount) FROM expenses e WHERE e.tour_id = t.tour_id AND e.date BETWEEN :from AND :to),0) AS total_expense,
                (IFNULL(SUM(b.total_amount),0) - IFNULL((SELECT SUM(e.amount) FROM expenses e WHERE e.tour_id = t.tour_id AND e.date BETWEEN :from AND :to),0)) AS profit
            FROM tours t
            LEFT JOIN bookings b ON b.tour_id = t.tour_id AND (b.created_at BETWEEN :from_dt AND :to_dt)
            GROUP BY t.tour_id
            ORDER BY total_revenue DESC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'from' => $from,
            'to' => $to,
            'from_dt' => $from . ' 00:00:00',
            'to_dt' => $to . ' 23:59:59'
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Doanh thu theo từng tháng trong 1 năm (trả về tháng 1..12)
     */
    public function revenueByMonth($year) {
        $sql = "
            SELECT
                m.month,
                IFNULL(SUM(b.total_amount),0) AS revenue,
                IFNULL((SELECT SUM(e.amount) FROM expenses e WHERE YEAR(e.date)=:year AND MONTH(e.date)=m.month),0) AS expense
            FROM (
                SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
                UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
            ) m
            LEFT JOIN bookings b ON MONTH(b.created_at) = m.month AND YEAR(b.created_at) = :year
            GROUP BY m.month
            ORDER BY m.month
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['year' => $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Tình trạng booking (tổng, paid, booked, cancelled) trong khoảng ngày
     */
    public function bookingStatusSummary($from, $to) {
        $sql = "
            SELECT
                COUNT(*) AS total,
                SUM(status = 'Paid') AS paid_count,
                SUM(status = 'Booked') AS booked_count,
                SUM(status = 'Cancelled') AS cancelled_count
            FROM bookings
            WHERE created_at BETWEEN :from_dt AND :to_dt
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['from_dt' => $from . ' 00:00:00', 'to_dt' => $to . ' 23:59:59']);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Hiệu suất HDV trong khoảng ngày:
     * Trả về: guide_id, full_name, schedules_count, revenue_managed, expense_managed, completed_count
     *
     * Lưu ý: logic tính chi phí theo tour (chi phí thực tế từ bảng expenses)
     */
    public function guidePerformance($from, $to) {
        $sql = "
            SELECT
                g.guide_id,
                g.full_name,
                COUNT(DISTINCT ts.schedule_id) AS schedules_count,
                IFNULL(SUM(b.total_amount),0) AS revenue_managed,
                IFNULL(SUM(e.amount),0) AS expense_managed,
                SUM(ts.status = 'Hoàn thành') AS completed_count
            FROM guides g
            LEFT JOIN tour_schedule ts ON ts.guide_id = g.guide_id AND (ts.start_date BETWEEN :from AND :to)
            LEFT JOIN tours t ON t.tour_id = ts.tour_id
            LEFT JOIN bookings b ON b.tour_id = t.tour_id AND (b.created_at BETWEEN :from_dt AND :to_dt)
            LEFT JOIN expenses e ON e.tour_id = t.tour_id AND (e.date BETWEEN :from AND :to)
            GROUP BY g.guide_id
            ORDER BY revenue_managed DESC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'from' => $from,
            'to' => $to,
            'from_dt' => $from . ' 00:00:00',
            'to_dt' => $to . ' 23:59:59'
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Helpers
    public function totalRevenue($from, $to) {
        $sql = "SELECT IFNULL(SUM(total_amount),0) AS total FROM bookings WHERE created_at BETWEEN :from_dt AND :to_dt";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['from_dt' => $from . ' 00:00:00', 'to_dt' => $to . ' 23:59:59']);
        return $stmt->fetchColumn() ?: 0;
    }

    public function totalExpense($from, $to) {
        $sql = "SELECT IFNULL(SUM(amount),0) AS total FROM expenses WHERE date BETWEEN :from AND :to";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['from' => $from, 'to' => $to]);
        return $stmt->fetchColumn() ?: 0;
    }
}

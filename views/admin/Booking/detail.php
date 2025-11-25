<?php
// views/admin/booking_view.php
// expects $booking and $customers
?>
<div class="container-fluid p-4">
    <h1 class="mt-4 mb-4 text-secondary"><i class="fas fa-eye me-2"></i> Chi tiết Booking</h1>

    <div class="card shadow">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Mã booking</dt><dd class="col-sm-9"><?= htmlspecialchars($booking['booking_code']) ?></dd>
                <dt class="col-sm-3">Tour</dt><dd class="col-sm-9"><?= htmlspecialchars($booking['tour_name']) ?></dd>
                <dt class="col-sm-3">Tổng tiền</dt><dd class="col-sm-9"><?= number_format($booking['total_amount']) ?> đ</dd>
                <dt class="col-sm-3">Trạng thái</dt><dd class="col-sm-9"><?= htmlspecialchars($booking['status']) ?></dd>
                <dt class="col-sm-3">Ngày tạo</dt><dd class="col-sm-9"><?= date('d/m/Y H:i', strtotime($booking['created_at'])) ?></dd>
            </dl>

            <h5>Khách</h5>
            <ul class="list-group mb-3">
                <?php foreach ($customers as $c): ?>
                    <li class="list-group-item"><?= htmlspecialchars($c['full_name']) ?> — <?= htmlspecialchars($c['phone']) ?> — <?= htmlspecialchars($c['email']) ?></li>
                <?php endforeach; ?>
            </ul>

            <a href="index.php?act=booking-list" class="btn btn-secondary">Trở về</a>
        </div>
    </div>
</div>

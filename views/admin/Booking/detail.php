
<?php
// views/admin/booking_view.php
// expects $booking and $customers
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">    
</head>
<style>
      body {
            background-color: #f8f9fa;
        }

        .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            color: #f8f9fa;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            transition: margin .25s ease-out;
            background-color: #343a40;
            color: #ffffff;
            position: fixed;
            z-index: 1030;
        }

        #page-content-wrapper {
            width: 100%;
            transition: padding-left .25s ease-out;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        #wrapper.toggled #page-content-wrapper {
            padding-left: 15rem;
        }

        .list-group-item {
            background-color: transparent;
            color: #adb5bd;
            border: none;
            padding: 1rem 1.25rem;
        }

        .list-group-item:hover,
        .list-group-item.active {
            background-color: #495057;
            color: #ffffff;
        }

        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                padding-left: 15rem;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: -15rem;
            }

            #wrapper.toggled #page-content-wrapper {
                padding-left: 0;
            }
        }
</style>

<body>
    <div class="d-flex" id="wrapper">
    <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom border-secondary">
                <i class="fas fa-plane-departure text-info"></i> Quản Lý
            </div>
            <div class="list-group list-group-flush">
                <a href="index.php?act=admin-home" class="list-group-item list-group-item-action ">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
                <a href="index.php?act=tour-list" class="list-group-item list-group-item-action ">
                    <i class="fas fa-list me-2"></i> Danh sách tour
                </a>
                <a href="index.php?act=schedule-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-road me-2"></i> Quản lý Tour
                </a>
                <a href="index.php?act=tour-booking" class="list-group-item list-group-item-action">
                    <i class="bi bi-bootstrap me-2"></i> Quản lý Booking
                </a>
                <a href="index.php?act=customer-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-users me-2"></i> Quản lý Khách hàng
                </a>
                <a href="index.php?act=employees-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-users me-2"></i> Quản lý Nhân Sự
                </a>

                <a href="index.php?act=report-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-chart-line me-2"></i> Báo Cáo Thống kê
                </a>
                <a href="index.php?act=user-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-cog me-2"></i> Cài đặt hệ thống
                </a>
                
            </div>
        </div>
  <div id="page-content-wrapper" class="mt-5">
        <h2 class="text-center mb-4 text-secondary">
            <i class="fas fa-eye me-2"></i> Chi tiết Booking
        </h2>

        <div class="info-box">

            <h5 class="mb-3">Thông tin Booking</h5>
            <hr>

            <dl class="row">
                <dt class="col-sm-3">Mã booking</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($booking['booking_code'] ?? 'N/A') ?></dd>

                <dt class="col-sm-3">Tên Tour</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($booking['tour_name']) ?></dd>

                <dt class="col-sm-3">Tổng tiền</dt>
                <dd class="col-sm-9 text-danger fw-semibold"><?= number_format($booking['total_amount']) ?> đ</dd>

                <dt class="col-sm-3">Trạng thái</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($booking['status']) ?></dd>

                <dt class="col-sm-3">Ngày tạo</dt>
                <dd class="col-sm-9">
                    <?= $booking['created_at'] ? date('d/m/Y H:i', strtotime($booking['created_at'])) : 'N/A' ?>
                </dd>
            </dl>

            <h5 class="mt-4">Danh sách khách</h5>
<hr>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-secondary">
            <tr>
                <th>Họ tên</th>
                <th>Điện thoại</th>
                <th>Email</th>
                <th>Loại</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['full_name']) ?></td>
                    <td><?= htmlspecialchars($c['phone']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>

                    <!-- HIỂN THỊ NGƯỜI LỚN / TRẺ EM -->
                    <td>
                        <?php if ($c['type'] === 'adult'): ?>
                            <span class="badge bg-primary">Người lớn</span>
                        <?php else: ?>
                            <span class="badge bg-success">Trẻ em</span>
                        <?php endif; ?>
                    </td>

                    <!-- HIỂN THỊ GIÁ -->
                    <td class="text-danger fw-semibold">
                        <?= number_format($c['price']) ?> đ
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<a href="index.php?act=tour-booking" class="btn btn-secondary mt-3">
    <i class="bi bi-arrow-left"></i> Trở về
</a>

        </div>
    </div>

</div>

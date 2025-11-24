<?php $bookingModel = new BookingModel(); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Quản Trị Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="./uploads/imgproduct/snapedit_1763494732485.png">


    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            /* Nền nhẹ nhàng */
        }

        /* Chiều rộng sidebar cố định và nền tối */
        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            /* Ẩn sidebar ban đầu */
            transition: margin .25s ease-out;
            background-color: #343a40;
            /* Màu nền tối */
            color: #ffffff;
            position: fixed;
            z-index: 1030;
            /* Đặt trên nội dung */
        }

        /* Hiển thị sidebar khi menu active */
        #page-content-wrapper {
            width: 100%;
            padding-left: 0;
            transition: padding-left .25s ease-out;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        #wrapper.toggled #page-content-wrapper {
            padding-left: 15rem;
        }

        /* Liên kết trong sidebar */
        .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            color: #f8f9fa;
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
            /* Hover */
            color: #ffffff;
        }
        .chart-container {
    height: 400px; 
    position: relative;
}

.chart-container canvas {
    height: 100% !important; 
    width: 100% !important;
}
    .shadow{
        height: 100%;
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
</head>

<body>

    <div class="d-flex" id="wrapper">

        <div class="bg-dark border-right" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom border-secondary">
                <i class="fas fa-plane-departure text-info"></i> Quản Lý Tour
            </div>
            <div class="list-group list-group-flush">
                <a href="index.php?act=admin-home" class="list-group-item list-group-item-action ">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
                <a href="index.php?act=tour-list" class="list-group-item list-group-item-action ">
                    <i class="fas fa-list me-2"></i> Danh sách tour
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-road me-2"></i> Quản lý Tour
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-users me-2"></i> Quản lý Khách hàng
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-clipboard-list me-2"></i> Đơn hàng
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-chart-line me-2"></i> Thống kê
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-cog me-2"></i> Cài đặt Chung
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-info-circle me-2"></i> Về Chúng Tôi (Sửa)
                </a>
            </div>
        </div>
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
                <button class="btn btn-outline-secondary ms-3" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse me-3">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#"><i class="fas fa-bell me-1"></i> Thông báo <span
                                    class="badge bg-danger">4</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> Admin Name
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Hồ sơ</a>
                                <a class="dropdown-item" href="#">Đổi mật khẩu</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="index.php?act=tour-logout">
                                    <i class="fas fa-sign-out-alt me-1"></i> Đăng xuất
                                                                                        </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid p-4">

    <h1 class="mt-4 mb-4 text-secondary">
        <i class="fas fa-route me-2"></i> Quản Lý Tour Của Hướng Dẫn Viên
    </h1>

    <!-- THỐNG KÊ -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-suitcase-rolling fa-2x"></i>
                        </div>
                        <div class="col">
                            <div class="text-uppercase fw-bold">Tour đang chạy</div>
                            <div class="h5 mb-0">1 Tour</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-warning text-dark shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                        <div class="col">
                            <div class="text-uppercase fw-bold">Tour sắp khởi hành</div>
                            <div class="h5 mb-0">2 Tour</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                        <div class="col">
                            <div class="text-uppercase fw-bold">Đã hoàn thành</div>
                            <div class="h5 mb-0">12 Tour</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="container-fluid p-4">

    <div class="container-fluid p-4">
    <h1 class="mt-4 mb-4 text-secondary"><i class="fas fa-file-invoice me-2"></i> Quản lý Booking</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="card shadow mb-4">
    <div class="card-header bg-primary text-white fw-bold">
        <i class="fas fa-list me-2"></i> Danh sách Booking
        <a href="index.php?act=booking-create" class="btn btn-light btn-sm float-end">
            <i class="fas fa-plus"></i> Tạo booking
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Mã booking</th>
                        <th>Tour</th>
                        <th>Khách</th>
                        <th>Ngày tạo</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th style="width: 170px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($bookings ?? [] as $b): ?>
                    <tr>
                        <td><?= $b['booking_id'] ?></td>

                        <!-- ✔ Mã booking tự sinh từ ID -->
                        <td>BK<?= str_pad($b['booking_id'], 5, '0', STR_PAD_LEFT) ?></td>

                        <td><?= htmlspecialchars($b['tour_name'] ?? '---') ?></td>

                        <td>
                            <?php
                                $custs = $bookingModel->customers($b['booking_id']);
                                foreach ($custs as $c) {
                                    echo "<strong>" . htmlspecialchars($c['full_name']) . "</strong>
                                          <br><small class='text-muted'>" . htmlspecialchars($c['phone']) . "</small><br>";
                                }
                            ?>
                        </td>

                        <td><?= date('d/m/Y H:i', strtotime($b['created_at'])) ?></td>

                        <td><?= number_format($b['total_amount'], 0, ',', '.') ?> đ</td>

                        <td>
                            <?php
                                $cls = 'badge bg-secondary';
                                if ($b['status'] == 'Booked') $cls = 'badge bg-warning text-dark';
                                if ($b['status'] == 'Paid') $cls = 'badge bg-success';
                                if ($b['status'] == 'Cancelled') $cls = 'badge bg-danger';
                            ?>
                            <span class="<?= $cls ?> p-2"><?= $b['status'] ?></span>
                        </td>

                        <td>
                            <a href="index.php?act=booking-view&id=<?= $b['booking_id'] ?>" 
                               class="btn btn-info btn-sm mb-1">
                                <i class="fas fa-eye"></i> Xem
                            </a>

                            <a href="index.php?act=booking-status&id=<?= $b['booking_id'] ?>&status=Paid" 
                               class="btn btn-success btn-sm mb-1">
                                Đã thanh toán
                            </a>

                            <a href="index.php?act=booking-status&id=<?= $b['booking_id'] ?>&status=Cancelled" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Hủy booking?')">
                                Hủy
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php if (empty($bookings)): ?>
                        <tr><td colspan="8" class="text-center">Chưa có booking nào.</td></tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>


</div>

        

                <script>
                    // Toggle Sidebar
                    document.getElementById("menu-toggle").onclick = function () {
                        document.getElementById("wrapper").classList.toggle("toggled");
                    };
                </script>

                <script src="./assets/js/main.js"></script>
</body>

</html>


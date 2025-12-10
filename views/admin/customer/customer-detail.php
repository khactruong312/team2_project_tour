<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$current_act = $_GET['act'] ?? 'customer-detail';
?>
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success auto-hide">
        <?= $_SESSION['success']; ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Khách Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
</head>

<body>
    <!-- SIDE BAR -->


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
                    <i class="fas fa-list me-2"></i> Danh Sách Tour
                </a>
             
                <a href="index.php?act=schedule-list" class="list-group-item list-group-item-action">
                     <i class="fas fa-road me-2"></i> Quản Lý Tour
                </a>
                <a href="index.php?act=tour-booking" class="list-group-item list-group-item-action ">
                    <i class="bi bi-bootstrap me-2"></i> Quản Lý Booking
                </a>
                <a href="index.php?act=customer-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-users me-2"></i> Quản Lý Khách Hàng
                </a>
                <a href="index.php?act=employees-list" class="list-group-item list-group-item-action">

                    <i class="fas fa-users me-2"></i> Quản Lý Nhân Sự
                </a>
                <a href="index.php?act=report-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-chart-line me-2"></i> Báo Cáo Thống Kê
                </a>
                <a href="index.php?act=user-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-cog me-2"></i> Quản Lý Tài Khoản
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

                <h2 class="mt-4 fw-bold text-secondary">
                    <i class="fas fa-info-circle me-2"></i> Chi Tiết Khách Hàng
                </h2>

                <?php
                if (!isset($customer) || empty($customer)):
                ?>
                    <div class="alert alert-danger mt-3">
                        Không tìm thấy thông tin khách hàng.
                    </div>
                    <a href="index.php?act=customer-list" class="btn btn-secondary mt-3">
                        <i class="fas fa-arrow-left me-1"></i> Quay lại Danh sách
                    </a>
                <?php
                else:
                ?>

                    <div class="row">
                        <div class="col-lg-8 col-md-10 mx-auto">
                            <div class="card shadow-lg border-0 mt-4">
                                <div class="card-header bg-dark text-white p-3">
                                    <h5 class="mb-0">
                                        <i class="fas fa-user-circle me-2"></i> Thông Tin Chi Tiết
                                    </h5>
                                </div>
                                <div class="card-body">

                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <strong class="text-muted"><i class="fas fa-id-badge me-2"></i> ID Khách hàng:</strong>
                                        <span><?= htmlspecialchars($customer['customer_id'] ?? 'N/A') ?></span>
                                    </div>

                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <strong class="text-muted"><i class="fas fa-user me-2"></i> Tên đầy đủ:</strong>
                                        <span><?= htmlspecialchars($customer['full_name'] ?? 'N/A') ?></span>
                                    </div>

                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <strong class="text-muted"><i class="fas fa-envelope me-2"></i> Email:</strong>
                                        <span><?= htmlspecialchars($customer['email'] ?? 'N/A') ?></span>
                                    </div>

                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <strong class="text-muted"><i class="fas fa-phone me-2"></i> Số điện thoại:</strong>
                                        <span><?= htmlspecialchars($customer['phone'] ?? 'N/A') ?></span>
                                    </div>

                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <strong class="text-muted"><i class="fas fa-location-dot me-2"></i> Địa chỉ:</strong>
                                        <span><?= htmlspecialchars($customer['address'] ?? 'N/A') ?></span>
                                    </div>

                                    <div class="d-flex justify-content-between py-2 border-bottom">
                                        <strong class="text-muted"><i class="fas fa-calendar-alt me-2"></i> Ngày đăng ký:</strong>
                                        <span><?= htmlspecialchars($customer['created_at'] ?? 'N/A') ?></span>
                                    </div>

                                    <div class="d-flex justify-content-between py-2">
                                        <strong class="text-muted"><i class="fas fa-check-circle me-2"></i> Trạng thái:</strong>
                                        <span>
                                            <?php if (($customer['status'] ?? 0) == 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Inactive</span>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-center">
                                <a href="index.php?act=customer-edit&id=<?= $customer['customer_id'] ?? '' ?>"
                                    class="btn btn-warning me-2">
                                    <i class="fas fa-edit me-1"></i> Sửa Thông Tin
                                </a>
                                <div class="card shadow-lg border-0 mt-4">
                                    <div class="card-header bg-info text-white p-3">
                                        <h5 class="mb-0"><i class="fas fa-suitcase-rolling me-2"></i> Tour Khách Hàng Đã Đặt</h5>
                                    </div>

                                    <div class="card-body p-0">

                                        <?php if (empty($bookings)): ?>
                                            <p class="p-3 text-muted">Khách hàng này chưa đặt tour nào.</p>

                                        <?php else: ?>

                                            <table class="table table-bordered mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Mã Booking</th>
                                                        <th>Tour</th>
                                                        <th>Giá</th>
                                                        <th>Ngày bắt đầu</th>
                                                        <th>Ngày kết thúc</th>
                                                        <th>Trạng thái</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($bookings as $b): ?>
                                                        <tr>
                                                            <!-- Mã booking -->
                                                            <td><?= htmlspecialchars($b['booking_code'] ?? 'N/A') ?></td>

                                                            <!-- Tên tour + ảnh -->
                                                            <td>
                                                                <strong><?= htmlspecialchars($b['tour_name'] ?? 'Không có dữ liệu') ?></strong><br>

                                                                <?php if (!empty($b['tour_image'])): ?>
                                                                    <img src="./uploads/imgproduct/<?= htmlspecialchars($b['tour_image']) ?>" width="80">
                                                                <?php else: ?>
                                                                    <span class="text-muted">Không có ảnh</span>
                                                                <?php endif; ?>
                                                            </td>

                                                            <!-- Giá -->
                                                            <td>
                                                                <?php
                                                                $price = $b['tour_price'] ?? 0;
                                                                echo number_format((float)$price) . " VNĐ";
                                                                ?>
                                                            </td>

                                                            <!-- Ngày bắt đầu -->
                                                            <td><?= date('d/m/Y', strtotime($b['start_date'])) ?? 'N/A' ?></td>

                                                            <!-- Ngày kết thúc -->
                                                            <td><?= date('d/m/Y', strtotime($b['end_date'])) ?? 'N/A' ?></td>

                                                            <!-- Trạng thái -->
                                                            <td>
                                                                <?php
                                                                $status = $b['booking_status'] ?? 'Booked';

                                                                if ($status === 'Paid') {
                                                                    echo '<span class="badge bg-success">Đã thanh toán</span>';
                                                                } elseif ($status === 'Cancelled') {
                                                                    echo '<span class="badge bg-danger">Đã hủy</span>';
                                                                } else {
                                                                    echo '<span class="badge bg-warning text-dark">Đã đặt</span>';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <a href="index.php?act=customer-list" class="btn btn-secondary mt-3">
                                    <i class="fas fa-arrow-left me-1"></i> Quay lại Danh sách
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar
        document.getElementById("menu-toggle").onclick = function() {
            document.getElementById("wrapper").classList.toggle("toggled");
        };

        setTimeout(function() {
            const alert = document.querySelector('.auto-hide');
            if (alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';

                setTimeout(() => alert.remove(), 500);
            }
        }, 2000);
    </script>

</body>

</html>
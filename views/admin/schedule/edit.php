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
    <title>Dashboard Quản Trị Tour</title>
    <link rel="icon" type="image/png" href="./uploads/imgproduct/snapedit_1763494732485.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
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


                <a href="index.php?act=tour-booking" class="list-group-item list-group-item-action active">

                    <i class="fas fa-road me-2"></i> Quản lý Tour
                </a>

                <a href="index.php?act=tour-booking" class="list-group-item list-group-item-action">
                    <i class="bi bi-bootstrap me-2"></i> Quản lý Booking

                </a>
                <a href="#" class="list-group-item list-group-item-action">
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

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
                <button class="btn btn-outline-secondary ms-3" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse me-3">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#"><i class="fas fa-bell me-1"></i> Thông báo <span
                                    class="badge bg-danger">4</span></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> Admin Name
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Hồ sơ</a>
                                <a class="dropdown-item" href="#">Đổi mật khẩu</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="index.php?act=tour-login"><i
                                        class="fas fa-sign-out-alt me-1"></i>
                                    Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container p-4">

                <h2 class="text-secondary">Sửa lịch khởi hành</h2>

                <form action="index.php?act=schedule-update" method="POST">

                    <input type="hidden" name="schedule_id" value="<?= $schedule['schedule_id'] ?>">

                    <!-- Tour -->
                    <div class="mb-3">
                        <label class="form-label">Tour:</label>
                        <select name="tour_id" class="form-select" required>
                            <?php foreach ($tours as $tour): ?>
                                <option value="<?= $tour['tour_id'] ?>" <?= $tour['tour_id'] == $schedule['tour_id'] ? 'selected' : '' ?>>
                                    <?= $tour['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Guide -->
                    <div class="mb-3">
                        <label class="form-label">Hướng dẫn viên:</label>
                        <select name="guide_id" class="form-select">
                            <option value="">-- Không gán --</option>
                            <?php foreach ($guides as $g): ?>
                                <option value="<?= $g['guide_id'] ?>"><?= $g['full_name'] ?></option>


                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Ngày -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày bắt đầu:</label>
                            <input type="date" name="start_date" class="form-control"
                                value="<?= $schedule['start_date'] ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày kết thúc:</label>
                            <input type="date" name="end_date" class="form-control" value="<?= $schedule['end_date'] ?>"
                                required>
                        </div>
                    </div>

                    <!-- Vehicle -->
                    <div class="mb-3">
                        <label class="form-label">Phương tiện:</label>
                        <select name="vehicle_id" class="form-select" required>
                            <option value="">-- Chọn xe --</option>
                            <?php
                            // 1. Lấy tên/mô tả xe cũ đang được lưu trong CSDL
                            $old_vehicle_name = $schedule['vehicle_id'];
                            ?>
                            <?php foreach ($vehicles as $vehicle):
                                // 2. Tạo chuỗi tên đầy đủ của xe hiện tại để so sánh
                                // (Phải khớp với chuỗi được tạo bởi hàm getVehicleNameById() trong Controller)
                                $current_vehicle_name = htmlspecialchars($vehicle['vehicle_type']) . ' (' . htmlspecialchars($vehicle['capacity']) . ' chỗ)';

                                // 3. Kiểm tra và chọn nếu tên xe khớp với tên xe cũ
                                $isSelected = ($current_vehicle_name == $old_vehicle_name) ? 'selected' : '';
                            ?>
                                <option value="<?= htmlspecialchars($vehicle['id']) ?>" <?= $isSelected ?>>
                                    <?= $current_vehicle_name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Hotel -->
                    <div class="mb-3">
                        <label class="form-label">Khách sạn:</label>
                        <select name="hotel_id" class="form-select" required>
                            <option value="">-- Chọn khách sạn --</option>
                            <?php
                            // 1. Lấy tên khách sạn cũ đang được lưu trong CSDL
                            $old_hotel_name = $schedule['hotel_id'];
                            ?>
                            <?php foreach ($hotels as $hotel):
                                $current_hotel_name = htmlspecialchars($hotel['name']);

                                // 2. Kiểm tra và chọn nếu tên khách sạn khớp với tên khách sạn cũ
                                $isSelected = ($current_hotel_name == $old_hotel_name) ? 'selected' : '';
                            ?>
                                <option value="<?= htmlspecialchars($hotel['id']) ?>" <?= $isSelected ?>>
                                    <?= $current_hotel_name . ' - ' . htmlspecialchars($hotel['address']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Trạng thái:</label>
                        <select name="status" class="form-select">
                            <option value="Chưa khởi hành" <?= $schedule['status'] == 'Chưa khởi hành' ? 'selected' : '' ?>>
                                Chưa khởi hành
                            </option>

                            <option value="Đang chạy" <?= $schedule['status'] == 'Đang chạy' ? 'selected' : '' ?>>
                                Đang chạy
                            </option>

                            <option value="Hoàn thành" <?= $schedule['status'] == 'Hoàn thành' ? 'selected' : '' ?>>
                                Hoàn thành
                            </option>

                        </select>
                    </div>

                    <button class="btn btn-success"><i class="fas fa-save"></i> Cập nhật</button>
                    <a href="index.php?act=schedule-list" class="btn btn-secondary">Hủy</a>
                </form>
            </div>

        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="..."
        crossorigin="anonymous"></script>
</body>

</html>
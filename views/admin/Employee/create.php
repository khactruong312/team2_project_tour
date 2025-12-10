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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        .shadow {
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
                <a href="index.php?act=employees-list" class="list-group-item list-group-item-action active">

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
            <!-- //hiện thị danh sách nhân sự -->


            <div class="form-container p-3">
                <div class="d-flex justify-content-center">
                    <h2><i class="fas fa-user-plus me-2"></i> Thêm Nhân Sự Mới</h2>
                </div>

                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?= $isSuccess ? 'success' : 'danger' ?> alert-dismissible fade show mt-3"
                        role="alert">
                        <i class="fas fa-<?= $isSuccess ? 'check-circle' : 'exclamation-triangle' ?> me-2"></i>
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form method="post" action="index.php?act=employees-store">

                    <div class="mb-3">
                        <label for="full_name">Tên nhân sự:</label>
                        <input type="text" class="form-control" name="full_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone">Điện thoại:</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label for="status">Trạng thái:</label>
                        <select class="form-select" name="status">
                            <option value="Active">Đang làm</option>
                            <option value="Inactive">Đã nghỉ</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Thêm Nhân Sự</button>
                </form>

            </div>



        </div>
    </div>
</body>

</html>

<script>
    console.log(<?php echo json_encode($listEmployees); ?>);
</script>
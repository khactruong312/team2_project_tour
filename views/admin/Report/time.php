<?php
// views/admin/Report/time.php
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Doanh thu theo Tháng</title>
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
                <a href="index.php?act=report-list" class="list-group-item list-group-item-action active">
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
<body>
<div class="container p-4">
    <h2 class="text-body mb-3">Doanh thu theo Tháng (Năm <?= htmlspecialchars($_GET['year'] ?? date('Y')) ?>)</h2>

    <form class="row g-3 mb-3" action="index.php" method="get">
        <input type="hidden" name="act" value="report-time">
        <div class="col-md-3">
            <label class="form-label">Năm</label>
            <input type="number" class="form-control" name="year" value="<?= htmlspecialchars($_GET['year'] ?? date('Y')) ?>">
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button class="btn btn-primary me-2">Xem</button>
            <a href="index.php?act=report-list" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>

    <div class="card mb-3">
        <div class="card-body">
            <canvas id="chartTime" height="80"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Bảng doanh thu theo tháng</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr><th>Tháng</th><th>Doanh thu</th><th>Chi phí</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= (int)$row['month'] ?></td>
                            <td><?= number_format($row['revenue']) ?></td>
                            <td><?= number_format($row['expense']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const months = <?= json_encode(array_map(function($r){ return (int)$r['month']; }, $data)) ?>;
    const revenues = <?= json_encode(array_map(function($r){ return (float)$r['revenue']; }, $data)) ?>;
    const expenses = <?= json_encode(array_map(function($r){ return (float)$r['expense']; }, $data)) ?>;
    const ctx = document.getElementById('chartTime').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                { label: 'Doanh thu', data: revenues, tension: 0.3 },
                { label: 'Chi phí', data: expenses, tension: 0.3 }
            ]
        }
    });
</script>
</body>
</html>

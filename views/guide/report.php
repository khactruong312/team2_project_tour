<?php
// Giả định biến $scheduleDetail đã được định nghĩa trong GuideController
// Cấu trúc code này chứa toàn bộ HTML, CSS, Sidebar, Navbar
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo Cáo Tour - Guide</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* CSS tùy chỉnh cơ bản (Đã copy từ list.php) */
        :root {
            --sidebar-width: 250px;
            --main-bg: #f8f9fa;
        }

        body {
            background-color: var(--main-bg);
        }

        /* 1. Sidebar Styling - Tăng cỡ chữ link */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            z-index: 1000;
        }

        .sidebar h3 {
            font-size: 1.5rem;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            padding: 15px 20px;
            font-size: 1.1rem;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            color: white;
            background-color: #0d6efd;
            border-radius: 0;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
        }

        /* 2. Tiêu đề Dashboard - Tăng cỡ chữ H1 */
        .main-content h1 {
            font-size: 2.2rem;
            font-weight: 600;
        }

        /* Header / Navbar Styling */
        .top-navbar {
            margin-left: var(--sidebar-width);
            background-color: white;
            border-bottom: 1px solid #dee2e6;
        }

        /* 3. Stats Card Styling - Điều chỉnh tiêu đề và số liệu */
        .stat-card {
            color: white;
            padding: 20px;
            border-radius: 8px;
            height: 140px;
            margin-bottom: 20px;
        }

        .stat-card h4 {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 5px !important;
        }

        .stat-card h2 {
            font-size: 3rem;
            font-weight: 700;
            line-height: 1.1;
        }

        .stat-card p {
            font-size: 0.9rem;
        }


        /* Màu thẻ theo mẫu */
        .bg-blue {
            background-color: #0d6efd;
        }

        .bg-green {
            background-color: #198754;
        }

        .bg-yellow {
            background-color: #ffc107;
            color: #343a40 !important;
        }

        .bg-red {
            background-color: #dc3545;
        }

        /* Chart/Widget Styling */
        .chart-widget {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .chart-widget h5 {
            font-size: 1.25rem;
        }

        /* Điều chỉnh cỡ chữ cho phần quản lý tour đang hoạt động */
        .chart-widget p {
            font-size: 1rem;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h3 class="text-center mb-4">Guide</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="?act=guide-home">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="?act=guide-list">
                    <i class="fas fa-list-alt me-2"></i> Tour Của Tôi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-clipboard-list me-2"></i> Quản lý Tour
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-bar me-2"></i> Thống kê tour
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-cog me-2"></i> Cài đặt Chung
                </a>
            </li>

        </ul>
    </div>

    <nav class="navbar navbar-expand top-navbar sticky-top">
        <div class="container-fluid">
            <button class="btn btn-outline-secondary d-lg-none me-3" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse">
                <i class="fas fa-bars"></i>
            </button>

            <a class="navbar-brand" href="#"></a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#">
                            <i class="fas fa-bell"></i> Thông báo <span class="badge bg-danger rounded-pill">4</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> Hướng Dẫn Viên
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Thông tin cá nhân</a></li>
                            <li><a class="dropdown-item" href="?act=logout">Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <h1 class="mb-4">
            <i class="fas fa-file-alt me-2"></i> Báo Cáo Hoàn Thành Tour
        </h1>
        <p class="lead">Gửi báo cáo cho lịch trình **<?= htmlspecialchars($scheduleDetail['tour_name'] ?? 'Tên Tour') ?>** (ID: #<?= $scheduleDetail['schedule_id'] ?? 'ID' ?>)</p>
        <hr>

        <div class="container-fluid p-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    Form Báo Cáo
                </div>
                <div class="card-body">
                    <form action="index.php?act=guide-submit-report" method="POST">
                        <input type="hidden" name="schedule_id" value="<?= $scheduleDetail['schedule_id'] ?? '' ?>">

                        <div class="row">
                            <div class="col-md-6">

                                <!-- Số lượng khách -->
                                <div class="mb-3">
                                    <label for="pax_count" class="form-label">Số lượng khách thực tế *</label>
                                    <input type="number" class="form-control" id="pax_count" name="pax_count" required min="1">
                                    <small class="form-text text-muted">Tổng số khách đã tham gia tour.</small>
                                </div>

                                <!-- Chi phí phát sinh -->
                                <div class="mb-3">
                                    <label for="extra_expenses" class="form-label">Chi phí phát sinh (VND)</label>
                                    <input type="number" class="form-control" id="extra_expenses" name="extra_expenses" value="0" min="0">
                                    <small class="form-text text-muted">Tổng chi phí phát sinh ngoài dự kiến.</small>
                                </div>

                                <!-- Đánh giá tour -->
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Đánh giá chung về Tour (1-5)</label>
                                    <select class="form-select" id="rating" name="rating" required>
                                        <option value="" selected>Chọn mức đánh giá</option>
                                        <option value="5">5 - Xuất sắc</option>
                                        <option value="4">4 - Tốt</option>
                                        <option value="3">3 - Trung bình</option>
                                        <option value="2">2 - Kém</option>
                                        <option value="1">1 - Rất kém</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <!-- Sự cố -->
                                <div class="mb-3">
                                    <label for="issues" class="form-label">Sự cố/Vấn đề phát sinh (Nếu có)</label>
                                    <textarea class="form-control" id="issues" name="issues" rows="4" placeholder="Mô tả các vấn đề không lường trước..."></textarea>
                                </div>

                                <!-- Ghi chú -->
                                <div class="mb-3">
                                    <label for="guide_notes" class="form-label">Ghi chú & Đề xuất của Hướng dẫn viên</label>
                                    <textarea class="form-control" id="guide_notes" name="guide_notes" rows="4" required placeholder="Tóm tắt ngắn gọn về tour..."></textarea>
                                </div>

                            </div>
                        </div>

                        <hr>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-paper-plane me-2"></i> Gửi Báo Cáo Hoàn Thành
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        // Toggle Sidebar (cần thêm element có id="menu-toggle" nếu muốn dùng)
        /*
        document.getElementById("menu-toggle").onclick = function() {
             document.getElementById("wrapper").classList.toggle("toggled");
        };
        */
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
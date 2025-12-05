?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiến Trình Tour - Guide</title>
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
            <i class="fas fa-road me-2"></i> Chi Tiết / Tiến Trình Tour #<?= $scheduleDetail['schedule_id'] ?? 'ID' ?>
        </h1>
        <p class="lead"><strong><?= htmlspecialchars($scheduleDetail['tour_name'] ?? 'Tên Tour') ?></strong></p>
        <hr>

        <div class="container-fluid p-4">
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="card shadow-sm border-primary">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-info-circle me-2"></i> Thông Tin Lịch Trình
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Ngày khởi hành:</strong> <?= isset($scheduleDetail['start_date']) ? date('d/m/Y', strtotime($scheduleDetail['start_date'])) : 'N/A' ?></li>
                            <li class="list-group-item"><strong>Ngày kết thúc:</strong> <?= isset($scheduleDetail['end_date']) ? date('d/m/Y', strtotime($scheduleDetail['end_date'])) : 'N/A' ?></li>
                            <li class="list-group-item"><strong>Trạng thái hiện tại:</strong>
                                <span class="badge bg-<?= (isset($scheduleDetail['schedule_status']) && $scheduleDetail['schedule_status'] == 'Đang chạy' ? 'danger' : (isset($scheduleDetail['schedule_status']) && $scheduleDetail['schedule_status'] == 'Hoàn thành' ? 'success' : 'warning text-dark')) ?>">
                                    <?= htmlspecialchars($scheduleDetail['schedule_status'] ?? 'N/A') ?>
                                </span>
                            </li>
                            <li class="list-group-item"><strong>Hướng dẫn viên:</strong> <?= htmlspecialchars($scheduleDetail['guide_name'] ?? 'N/A') ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm border-secondary">
                        <div class="card-header bg-secondary text-white">
                            <i class="fas fa-users me-2"></i> Thống Kê Nhanh
                        </div>
                        <div class="card-body">
                            <p class="mb-1">Tổng số khách đã booking: <strong>[Số liệu Booking]</strong></p>
                            <p class="mb-1">Tổng chi phí dự kiến: <strong>[Số liệu Chi phí]</strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <h3><i class="fas fa-clipboard-check me-2"></i> Các Mốc Tiến Trình Tour (Checkpoints)</h3>
            <p class="text-muted">Cập nhật trạng thái và ghi chú cho từng mốc.</p>

            <div class="row">
                <?php if (!empty($checkpoints)): ?>
                    <?php foreach ($checkpoints as $cp): ?>
                        <div class="col-md-12 mb-3">
                            <div class="card shadow-sm p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1"><?= htmlspecialchars($cp['checkpoint_name']) ?></h5>
                                        <p class="mb-1 text-muted"><small>Thời gian dự kiến: <?= date('H:i d/m/Y', strtotime($cp['time'])) ?></small></p>
                                        <?php if (!empty($cp['notes'])): ?>
                                            <p class="mb-0 text-info"><i class="fas fa-comment-dots me-1"></i> Ghi chú HDV: <?= htmlspecialchars($cp['notes']) ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <form action="index.php?act=guide-update-progress" method="POST" class="d-flex align-items-center">
                                        <input type="hidden" name="schedule_id" value="<?= $scheduleDetail['schedule_id'] ?>">
                                        <input type="hidden" name="checkpoint_id" value="<?= $cp['checkpoint_id'] ?>">

                                        <span class="me-3">Trạng thái:
                                            <span class="badge bg-<?= ($cp['status'] == 'Hoàn thành' ? 'success' : 'secondary') ?> py-2 px-3">
                                                <?= htmlspecialchars($cp['status']) ?>
                                            </span>
                                        </span>

                                        <?php if ($cp['status'] != 'Hoàn thành'): ?>
                                            <button type="submit" name="action" value="complete" class="btn btn-success btn-sm me-2">
                                                <i class="fas fa-check"></i> Đánh Dấu Hoàn Thành
                                            </button>
                                        <?php endif; ?>

                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#notesModal<?= $cp['checkpoint_id'] ?>">
                                            <i class="fas fa-pencil-alt"></i> Ghi Chú
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="notesModal<?= $cp['checkpoint_id'] ?>" tabindex="-1" aria-labelledby="notesModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="index.php?act=guide-update-progress-notes" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="notesModalLabel">Ghi Chú Mốc: <?= htmlspecialchars($cp['checkpoint_name']) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="schedule_id" value="<?= $scheduleDetail['schedule_id'] ?>">
                                            <input type="hidden" name="checkpoint_id" value="<?= $cp['checkpoint_id'] ?>">
                                            <div class="mb-3">
                                                <label for="notes<?= $cp['checkpoint_id'] ?>" class="form-label">Nội dung ghi chú</label>
                                                <textarea class="form-control" id="notes<?= $cp['checkpoint_id'] ?>" name="notes" rows="3"><?= htmlspecialchars($cp['notes'] ?? '') ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary">Lưu Ghi Chú</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-warning">Tour này chưa có mốc tiến trình chi tiết.</div>
                    </div>
                <?php endif; ?>
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
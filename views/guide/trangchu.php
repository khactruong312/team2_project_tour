<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Hướng Dẫn Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        /* CSS tùy chỉnh cơ bản */
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
            font-size: 1.5rem; /* Tiêu đề Sidebar */
        }
        
        .sidebar .nav-link {
            color: #adb5bd;
            padding: 15px 20px;
            font-size: 1.1rem; /* Tăng cỡ chữ link Sidebar */
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
            font-size: 1.1rem; /* Tiêu đề thẻ thống kê (TỔNG SỐ TOUR) */
            font-weight: 500;
            margin-bottom: 5px !important;
        }

        .stat-card h2 {
            font-size: 3rem; /* Số liệu lớn (500 Triệu, 245) */
            font-weight: 700;
            line-height: 1.1;
        }

        .stat-card p {
            font-size: 0.9rem; /* Mô tả nhỏ hơn */
        }


        /* Màu thẻ theo mẫu */
        .bg-blue { background-color: #0d6efd; }
        .bg-green { background-color: #198754; }
        .bg-yellow { background-color: #ffc107; color: #343a40 !important; }
        .bg-red { background-color: #dc3545; }

        /* Chart/Widget Styling */
        .chart-widget {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        
        .chart-widget h5 {
            font-size: 1.25rem; /* Tiêu đề Biểu đồ */
        }
        
        /* Điều chỉnh cỡ chữ cho phần quản lý tour đang hoạt động */
        .chart-widget p {
            font-size: 1rem;
        }

    </style>
</head>
<body>

<div class="sidebar">
    <h3 class="text-center mb-4">HDV Tour</h3>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link " href="index.php?act=guide-home">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?act=guide-list">
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
                        <li><a class="dropdown-item" href="index.php?act=logout">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="main-content">
    <h1 class="mb-4">Dashboard Tổng Quan</h1>

    <div class="row">
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card bg-blue">
                <h4 class="mb-2"><i class="fas fa-route me-2"></i> TỔNG SỐ TOUR</h4>
                <h2>18</h2> 
                <p class="mb-0">Tour đã hoàn thành</p>
            </div>
        </div>

        

        <div class="col-lg-3 col-md-6">
            <div class="stat-card bg-yellow">
                <h4 class="mb-2"><i class="fas fa-users me-2"></i> KHÁCH HÀNG MỚI</h4>
                <h2>245</h2>
                <p class="mb-0">Lượt khách trong tháng</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card bg-red">
                <h4 class="mb-2"><i class="fas fa-exclamation-circle me-2"></i> BÁO CÁO CẦN LÀM</h4>
                <h2>2</h2>
                <p class="mb-0">Báo cáo hoàn thành Tour</p>
            </div>
        </div>
    </div>

    <div class="row">
        
        

    </div>

    <div class="row">
        <div class="col-12">
            <div class="chart-widget">
                <h5 class="mb-3"><i class="fas fa-road me-2"></i> Tour Hiện Tại Của Tôi (Vận Hành)</h5>
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <p class="mb-0"><strong>Tên Tour:</strong> Vịnh Hạ Long - Đảo Cát Bà (5N4Đ)</p>
                        <p class="mb-0"><strong>Ngày:</strong> 22/11/2025 - 26/11/2025</p>
                        <p class="mb-0"><strong>Trạng thái:</strong> Đang vận hành - Ngày 1/5</p>
                    </div>
                    <div class="col-md-5 text-end">
                        <a class="btn btn-primary me-2" href="index.php?act=guide-list"><i class="fas fa-edit me-1"></i> Cập nhật tiến trình</a>
                        <button class="btn btn-success"><i class="fas fa-flag-checkered me-1"></i> Báo cáo hoàn thành</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
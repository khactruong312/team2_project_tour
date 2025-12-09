
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="./uploads/imgproduct/snapedit_1763494732485.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<style>
    body {
            background-color: #f8f9fa;
        }

        .sidebar-heading {
            padding: 0.875rem 1.25rem 20px;
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
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .table thead {
        background: #0d6efd;
        color: white;
    }
</style>

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
                <a href="index.php?act=tour-booking" class="list-group-item list-group-item-action ">
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
                <a href="#" class="list-group-item list-group-item-action active">
                    <i class="fas fa-cog me-2"></i> Quản Lí Tài Khoản
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

<div class="container mt-4">

    <div class="page-header mb-3">
        <h2 class="fw-bold">Danh sách tài khoản</h2>
        <a href="index.php?act=user-create" class="btn btn-primary">+ Thêm tài khoản</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tài khoản</th>
                        <th>Họ tên</th>
                        <th>Quyền</th>
                        <th>Ngày tạo</th>
                        <th class="text-center" style="width: 180px">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $u): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><?= $u['username'] ?></td>
                        <td><?= $u['fullname'] ?></td>
                        <td>
                            <span class="badge bg-<?= $u['role']=='admin'?'danger':'secondary' ?>">
                                <?= $u['role'] ?>
                            </span>
                        </td>
                        <td><?= date('d/m/Y', strtotime($u['created_at'])) ?></td>
                        <td class="text-center">
                            <a href="index.php?act=user-detail&id=<?= $u['id'] ?>" class="btn btn-sm btn-info">Xem</a>
                            <a href="index.php?act=user-edit&id=<?= $u['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                            <a onclick="return confirm('Bạn có chắc chắn xóa người dùng này ?')" 
                                href="index.php?act=user-delete&id=<?= $u['id'] ?>" 
                                class="btn btn-sm btn-danger">
                                Xóa
                            </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

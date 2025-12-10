<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
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
                    <i class="fas fa-list me-2"></i> Danh Sách Tour
                </a>
                <a href="index.php?act=schedule-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-road me-2"></i> Quản Lý Tour
                </a>
                <a href="index.php?act=tour-booking" class="list-group-item list-group-item-action">
                    <i class="bi bi-bootstrap me-2"></i> Quản Lý Booking
                </a>
                <a href="index.php?act=customer-list" class="list-group-item list-group-item-action ">
                    <i class="fas fa-users me-2"></i> Quản Lý Khách hàng
                </a>
                <a href="index.php?act=employees-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-users me-2"></i> Quản Lý Nhân Sự
                </a>

                <a href="index.php?act=report-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-chart-line me-2"></i> Báo Cáo Thống kê
                </a>
                <a href="index.php?act=user-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-cog me-2"></i> Quản Lý Tài Khoản
                </a>
                
            </div>
        </div>
    <div class="container-fluid px-4">

        

        <?php if (!isset($customer) || empty($customer)): ?>
            <div class="alert alert-danger mt-3">
                Không tìm thấy khách hàng.
            </div>
            <a href="index.php?act=customer-list" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left me-1"></i> Quay lại
            </a>
            <?php return; ?>
        <?php endif; ?>

        <div class="card mt-4 shadow-sm" style="max-width: 700px; margin: auto;">
            <div class="card-header bg-info text-dark fw-bold">
                <i class="fas fa-pen-to-square me-1"></i> Chỉnh sửa thông tin khách hàng
            </div>

            <div class="card-body">

                <form action="index.php?act=customer-update" method="POST">

                    <input type="hidden" name="customer_id" value="<?= $customer['customer_id'] ?? '' ?>">

                    <div class="mb-3">
                        <label class="form-label">Tên khách hàng</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-user"></i></span>
                            <input type="text" name="full_name" class="form-control"
                                value="<?= htmlspecialchars($customer['full_name'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control"
                                value="<?= htmlspecialchars($customer['email'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-phone"></i></span>
                            <input type="text" name="phone" class="form-control"
                                value="<?= htmlspecialchars($customer['phone'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-location-dot"></i></span>
                            <input type="text" name="address" class="form-control"
                                value="<?= htmlspecialchars($customer['address'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="1" <?= ($customer['status'] ?? '') == 1 ? 'selected' : '' ?>>✔ Active</option>
                            <option value="0" <?= ($customer['status'] ?? '') == 0 ? 'selected' : '' ?>>✖ Inactive</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-success"><i class="fas fa-save"></i> Cập nhật</button>
                        <a href="index.php?act=customer-list" class="btn btn-secondary ms-2">
                            <i class="fas fa-arrow-left me-1"></i> Quay lại
                        </a>
                    </div>

                </form>
            </div>
        </div>
        </div>

    </div>
</body>
</html>
<?php
// views/admin/booking_create.php
// expects $tours = TourModel::all()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" href="./uploads/imgproduct/snapedit_1763494732485.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
</head>
<body>
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
                    <i class="fas fa-list me-2"></i> Danh sách tour
                </a>
             
                <a href="index.php?act=schedule-list" class="list-group-item list-group-item-action">
                     <i class="fas fa-road me-2"></i> Quản lý Tour
                </a>
                <a href="index.php?act=tour-booking" class="list-group-item list-group-item-action active">
                    <i class="bi bi-bootstrap me-2"></i> Quản lý Booking
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-users me-2"></i> Quản lý Khách hàng
                </a>
                <a href="index.php?act=employees-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-users me-2"></i> Quản lý Nhân Sự
                </a>
                <a href="index.php?act=expense-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-clipboard-list me-2"></i> Chi phí
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-chart-line me-2"></i> Thống kê
                </a>
                <a href="index.php?act=user-list" class="list-group-item list-group-item-action">
                    <i class="fas fa-cog me-2"></i> Cài đặt hệ thống
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
            

   

<?php
// views/admin/booking_create.php
// Yêu cầu biến $tours chứa danh sách tour từ TourModel::all()
?>
<div class="container-fluid p-4">
    <h1 class="mt-4 mb-4 "><i class="fas fa-plus-circle me-2"></i> Tạo Booking Mới</h1>
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" action="index.php?act=booking-store">
                
                <div class="mb-3">
                    <label class="form-label">Chọn Tour</label>
                    <select name="tour_id" class="form-select" required>
                        <option value="">-- Chọn tour --</option>
                        <?php foreach ($tours as $t): ?>
                            <option value="<?= $t['tour_id'] ?>">
                                <?= htmlspecialchars($t['name']) ?> (<?= number_format($t['price']) ?> đ)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <p>Lịch trình theo tour</p>
                            <select name="schedule_id" id="schedule-select" class="form-select" required>
                                <option value="">-- Vui lòng chọn tour trước --</option>
                            </select>

                    


                <div class="mb-3">
                    <label class="form-label">Danh sách khách</label>
                    <div id="customers-wrapper">
                        <div class="row g-2 mb-2 customer-row">
                            <div class="col"><input name="cust_name[]" class="form-control" placeholder="Họ tên" required></div>
                            <div class="col-3"><input name="cust_phone[]" class="form-control" placeholder="Điện thoại" ></div>
                            <div class="col-4"><input name="cust_email[]" class="form-control" placeholder="Email" ></div>
                            <br>
                            <div class="col-5"><input name="cust_address[]" class="form-control" placeholder="Địa chỉ"></div>

                            

                            <div class="col-auto">
                                <button type="button" class="btn btn-sm btn-outline-danger remove-customer-btn">Xóa</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary mt-2" id="add-customer"><i class="fas fa-plus me-1"></i> Thêm khách</button>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phương thức thanh toán</label>
                    <select name="payment_method" class="form-select">
                        <option>Tiền mặt</option>
                        <option>Chuyển khoản</option>
                    </select>
                </div>

                <div class="text-end mt-4">
                    <a href="index.php?act=tour-booking" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary">Lưu Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Thêm khách hàng mới
document.getElementById('add-customer').addEventListener('click', function(){
    const wrapper = document.getElementById('customers-wrapper');
    const node = document.createElement('div');
    node.className = 'row g-2 mb-2 customer-row'; 
    
    node.innerHTML = `
        <div class="col"><input name="cust_name[]" class="form-control" placeholder="Họ tên" required></div>
        <div class="col-3"><input name="cust_phone[]" class="form-control" placeholder="Điện thoại"></div>
        <div class="col-4"><input name="cust_email[]" class="form-control" placeholder="Email"></div>
        <div class="col-auto">
            <button type="button" class="btn btn-sm btn-outline-danger remove-customer-btn"><i class="fas fa-times"></i> Xóa</button>
        </div>
    `;
    
    node.querySelector('.remove-customer-btn').addEventListener('click', function() {
        node.remove();
    });

    wrapper.appendChild(node);
});

// Xóa hàng khách hàng ban đầu (nếu có) và các hàng được thêm thủ công
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-customer-btn')) {
        event.target.closest('.customer-row').remove();
    }
});
document.querySelector("select[name='tour_id']").addEventListener("change", function() {
    const tourID = this.value;
    const scheduleSelect = document.getElementById("schedule-select");

    scheduleSelect.innerHTML = '<option>Đang tải...</option>';

    if (!tourID) {
        scheduleSelect.innerHTML = '<option value="">-- Vui lòng chọn tour trước --</option>';
        return;
    }

    fetch(`index.php?act=get-schedule-by-tour&id=${tourID}`)
        .then(res => res.json())
        .then(list => {
            scheduleSelect.innerHTML = '<option value="">-- Chọn lịch --</option>';

            if (list.length === 0) {
                scheduleSelect.innerHTML = '<option value="">Không có lịch cho tour này</option>';
                return;
            }

            list.forEach(item => {
                scheduleSelect.innerHTML += `
                    <option value="${item.schedule_id}">
                    
                      Ngày Khởi Hành  ${item.start_date} → Ngày Kết Thúc ${item.end_date}
                    </option>
                `;
            });
        })
        .catch(error => {
            console.error(error);
            scheduleSelect.innerHTML = '<option>Lỗi tải lịch</option>';
        });
});
</script>
</body>
</html>

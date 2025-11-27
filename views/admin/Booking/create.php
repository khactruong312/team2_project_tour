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
</head>
<body>
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
                            <<select name="schedule_id" id="schedule-select" class="form-select" required>
    <option value="">-- Vui lòng chọn tour trước --</option>
</select>


                <div class="mb-3">
                    <label class="form-label">Danh sách khách</label>
                    <div id="customers-wrapper">
                        <div class="row g-2 mb-2 customer-row">
                            <div class="col"><input name="cust_name[]" class="form-control" placeholder="Họ tên" required></div>
                            <div class="col-3"><input name="cust_phone[]" class="form-control" placeholder="Điện thoại"></div>
                            <div class="col-4"><input name="cust_email[]" class="form-control" placeholder="Email"></div>
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
                        ${item.start_date} → ${item.end_date}
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

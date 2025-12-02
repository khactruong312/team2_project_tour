<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid px-4">

        <h1 class="mt-4 text-secondary">
            <i class="fas fa-user-edit me-2"></i> Sửa Khách Hàng
        </h1>

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
</body>
</html>
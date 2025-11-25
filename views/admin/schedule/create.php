<div class="container p-4">

    <h2 class="text-secondary">Thêm lịch khởi hành</h2>

    <form action="index.php?act=schedule-store" method="POST">

        <!-- Tour -->
        <div class="mb-3">
            <label class="form-label">Tour:</label>
            <select name="tour_id" class="form-select" required>
                <option value="">-- Chọn tour --</option>
                <?php foreach ($tours as $tour): ?>
                    <option value="<?= $tour['tour_id'] ?>"><?= $tour['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Guide -->
        <div class="mb-3">
            <label class="form-label">Hướng dẫn viên:</label>
            <select name="guide_id" class="form-select">
                <option value="">-- Không gán --</option>
                <?php foreach ($guides as $g): ?>
                    <option value="<?= $g['guide_id'] ?>"><?= $g['full_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Ngày bắt đầu:</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Ngày kết thúc:</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
        </div>

        <!-- Phương tiện -->
        <div class="mb-3">
            <label class="form-label">Phương tiện:</label>
            <input type="text" name="vehicle" class="form-control" placeholder="VD: Xe giường nằm" required>
        </div>

        <!-- Hotel -->
        <div class="mb-3">
            <label class="form-label">Khách sạn:</label>
            <input type="text" name="hotel" class="form-control" placeholder="VD: 4 sao" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Trạng thái:</label>
            <select name="status" class="form-select">
                <option value="Active">Hoạt động</option>
                <option value="Inactive">Dừng</option>
            </select>
        </div>

        <button class="btn btn-success"><i class="fas fa-save"></i> Lưu</button>
        <a href="index.php?act=schedule-list" class="btn btn-secondary">Hủy</a>

    </form>
</div>

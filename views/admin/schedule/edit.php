<div class="container p-4">

    <h2 class="text-secondary">Sửa lịch khởi hành</h2>

    <form action="index.php?act=schedule-update" method="POST">

        <input type="hidden" name="schedule_id" value="<?= $schedules['schedule_id'] ?>">

        <!-- Tour -->
        <div class="mb-3">
            <label class="form-label">Tour:</label>
            <select name="tour_id" class="form-select" required>
                <?php foreach ($tours as $tour): ?>
                    <option value="<?= $tour['tour_id'] ?>"
                        <?= $tour['tour_id'] == $schedules['tour_id'] ? 'selected' : '' ?>>
                        <?= $tour['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Guide -->
        <div class="mb-3">
            <label class="form-label">Hướng dẫn viên:</label>
            <select name="guide_id" class="form-select">
                <option value="">-- Không gán --</option>
                <?php foreach ($guides as $g): ?>
                    <option value="<?= $g['guide_id'] ?>"
                        <?= $g['guide_id'] == $schedules['guide_id'] ? 'selected' : '' ?>>
                        <?= $g['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Ngày -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Ngày bắt đầu:</label>
                <input type="date" name="start_date" class="form-control"
                       value="<?= $schedules['start_date'] ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Ngày kết thúc:</label>
                <input type="date" name="end_date" class="form-control"
                       value="<?= $schedules['end_date'] ?>" required>
            </div>
        </div>

        <!-- Vehicle -->
        <div class="mb-3">
            <label class="form-label">Phương tiện:</label>
            <input type="text" name="vehicle" value="<?= $schedules['vehicle'] ?>" class="form-control">
        </div>

        <!-- Hotel -->
        <div class="mb-3">
            <label class="form-label">Khách sạn:</label>
            <input type="text" name="hotel" value="<?= $schedules['hotel'] ?>" class="form-control">
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Trạng thái:</label>
            <select name="status" class="form-select">
                <option value="Active"   <?= $schedules['status'] == 'Active' ? 'selected' : '' ?>>Hoạt động</option>
                <option value="Inactive" <?= $schedules['status'] == 'Inactive' ? 'selected' : '' ?>>Dừng</option>
            </select>
        </div>

        <button class="btn btn-success"><i class="fas fa-save"></i> Cập nhật</button>
        <a href="index.php?act=schedule-list" class="btn btn-secondary">Hủy</a>
    </form>
</div>

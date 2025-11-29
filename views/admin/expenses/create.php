<h2 class="mt-4">Thêm Chi Phí Tour</h2>

<form action="index.php?act=expense-store" method="POST">

    <label>Chọn Tour</label>
    <select name="tour_id" class="form-select" required>
        <?php foreach ($tours as $t): ?>
        <option value="<?= $t['tour_id'] ?>"><?= $t['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label class="mt-3">Loại chi phí</label>
    <select name="type" class="form-select" required>
        <option value="Xe">Xe</option>
        <option value="Khách sạn">Khách sạn</option>
        <option value="Ăn uống">Ăn uống</option>
        <option value="Dịch vụ">Dịch vụ</option>
        <option value="Khác">Khác</option>
    </select>

    <label class="mt-3">Số tiền</label>
    <input type="number" name="amount" class="form-control" required>

    <label class="mt-3">Ngày chi</label>
    <input type="date" name="date" class="form-control" required>

    <label class="mt-3">Ghi chú</label>
    <textarea name="note" class="form-control"></textarea>

    <button class="btn btn-primary mt-3">Lưu</button>
</form>

<h2 class="mt-4">Sửa Chi Phí</h2>

<form action="index.php?act=expense-update" method="POST">

    <input type="hidden" name="expense_id" value="<?= $expense['expense_id'] ?>">

    <label>Chọn Tour</label>
    <select name="tour_id" class="form-select">
        <?php foreach ($tours as $t): ?>
        <option value="<?= $t['tour_id'] ?>" 
            <?= $t['tour_id']==$expense['tour_id'] ? 'selected' : '' ?>>
            <?= $t['name'] ?>
        </option>
        <?php endforeach; ?>
    </select>

    <label class="mt-3">Loại chi phí</label>
    <select name="type" class="form-select">
        <?php
        $types = ['Xe','Khách sạn','Ăn uống','Dịch vụ','Khác'];
        foreach ($types as $tp): ?>
        <option value="<?= $tp ?>" <?= $tp==$expense['type']?'selected':'' ?>>
            <?= $tp ?>
        </option>
        <?php endforeach; ?>
    </select>

    <label class="mt-3">Số tiền</label>
    <input type="number" name="amount" class="form-control"
           value="<?= $expense['amount'] ?>">

    <label class="mt-3">Ngày chi</label>
    <input type="date" name="date" class="form-control" 
           value="<?= $expense['date'] ?>">

    <label class="mt-3">Ghi chú</label>
    <textarea name="note" class="form-control"><?= $expense['note'] ?></textarea>

    <button class="btn btn-success mt-3">Cập nhật</button>
</form>

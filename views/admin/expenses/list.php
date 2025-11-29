<h2 class="mt-4 text-secondary">Danh Sách Chi Phí Tour</h2>

<a href="index.php?act=expense-create" class="btn btn-primary mb-3">
    <i class="fas fa-plus"></i> Thêm Chi Phí
</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tour</th>
            <th>Loại chi phí</th>
            <th>Số tiền</th>
            <th>Ngày</th>
            <th>Ghi chú</th>
            <th>Tạo lúc</th>
            <th>Thao tác</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($expenses as $e): ?>
        <tr>
            <td><?= $e['expense_id'] ?></td>
            <td><?= $e['tour_name'] ?></td>
            <td><?= $e['type'] ?></td>
            <td><?= number_format($e['amount']) ?>đ</td>
            <td><?= $e['date'] ?></td>
            <td><?= $e['note'] ?></td>
            <td><?= $e['created_at'] ?></td>

            <td>
                <a href="index.php?act=expense-edit&id=<?= $e['expense_id'] ?>" class="btn btn-warning btn-sm">
                    Sửa
                </a>

                <a onclick="return confirm('Xóa?')" 
                   href="index.php?act=expense-delete&id=<?= $e['expense_id'] ?>" 
                   class="btn btn-danger btn-sm">
                    Xóa
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

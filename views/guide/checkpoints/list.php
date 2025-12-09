<h2 class="text-secondary mb-3">Check-in / Check-out</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Điểm đến</th>
            <th>Trạng thái</th>
            <th>Giờ check-in</th>
            <th>Giờ check-out</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>

        <!-- Nếu không có checkpoints -->
        <?php if (empty($checkpoints)): ?>
            <tr>
                <td colspan="5" class="text-center text-muted">
                    Không có checkpoint nào cho lịch này.
                </td>
            </tr>

        <?php else: ?>

            <!-- Duyệt danh sách checkpoints -->
            <?php foreach ($checkpoints as $c): ?>
                <tr>
                    <td><?= $c['destination_name'] ?></td>
                    <td><?= $c['status'] ?></td>
                    <td><?= $c['actual_checkin'] ?: '-' ?></td>
                    <td><?= $c['actual_checkout'] ?: '-' ?></td>

                    <td>
                        <!-- Nút Check-in -->
                        <?php if ($c['status'] == 'Chưa đến'): ?>
                            <form action="index.php?act=checkpoint-checkin&id=<?= $c['checkpoint_id'] ?>&schedule_id=<?= $_GET['schedule_id'] ?>" method="post">
                                <input type="hidden" name="location" value="GPS-TEST-123">
                                <button class="btn btn-success btn-sm">Check-in</button>
                            </form>
                        <?php endif; ?>

                        <!-- Nút Check-out -->
                        <?php if ($c['status'] == 'Đã check-in'): ?>
                            <form action="index.php?act=checkpoint-checkout&id=<?= $c['checkpoint_id'] ?>&schedule_id=<?= $_GET['schedule_id'] ?>" method="post">
                                <input type="hidden" name="location" value="GPS-TEST-456">
                                <button class="btn btn-danger btn-sm">Check-out</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        <?php endif; ?>

    </tbody>
</table>

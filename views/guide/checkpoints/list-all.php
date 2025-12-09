<h2 class="text-secondary mb-3">Tất cả Check-in / Check-out</h2>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Lịch</th>
            <th>Tour</th>
            <th>Điểm đến</th>
            <th>Trạng thái</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Hành động</th>
        </tr>
    </thead>

    <tbody>
        <?php if (empty($checkpoints)): ?>
            <tr>
                <td colspan="7" class="text-center text-muted">
                    Chưa có checkpoint nào !
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($checkpoints as $c): ?>
                <tr>
                    <td>#<?= $c['schedule_id'] ?></td>
                    <td><?= $c['tour_name'] ?></td>
                    <td><?= $c['destination_name'] ?></td>

                    <td>
                        <?php if ($c['status'] == 'Chưa đến'): ?>
                            <span class="badge bg-warning text-dark">Chưa đến</span>
                        <?php elseif ($c['status'] == 'Đã check-in'): ?>
                            <span class="badge bg-primary">Đã check-in</span>
                        <?php else: ?>
                            <span class="badge bg-success">Đã check-out</span>
                        <?php endif; ?>
                    </td>

                    <td><?= $c['actual_checkin'] ?: '-' ?></td>
                    <td><?= $c['actual_checkout'] ?: '-' ?></td>

                    <td>
                        <a href="index.php?act=checkpoint-list&schedule_id=<?= $c['schedule_id'] ?>"
                           class="btn btn-info btn-sm">
                            <i class="fa fa-map-pin"></i> Xem Checkpoints
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

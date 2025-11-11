<?php ob_start(); ?>
<h2>My Schedules</h2>
<?php if (empty($schedules)): ?><p>No schedules assigned.</p><?php else: ?>
<table><thead><tr><th>ID</th><th>Tour</th><th>Start</th><th>End</th><th>Status</th></tr></thead><tbody>
<?php foreach($schedules as $s): ?><tr>
<td><?php echo $s['schedule_id']; ?></td>
<td><?php echo htmlspecialchars($s['tour_name']); ?></td>
<td><?php echo $s['start_date']; ?></td>
<td><?php echo $s['end_date']; ?></td>
<td><?php echo $s['status']; ?></td>
</tr><?php endforeach; ?></tbody></table>
<?php endif; ?>
<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>

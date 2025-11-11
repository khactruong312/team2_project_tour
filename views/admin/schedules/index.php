<?php ob_start(); ?>
<h2>Schedules <a href="/schedules/assign" style="float:right">Assign</a></h2>
<table><thead><tr><th>ID</th><th>Tour</th><th>Guide</th><th>Start</th><th>End</th><th>Vehicle</th><th>Hotel</th><th>Status</th></tr></thead>
<tbody><?php foreach($schedules as $s): ?><tr>
<td><?php echo $s['schedule_id']; ?></td>
<td><?php echo htmlspecialchars($s['tour_name']); ?></td>
<td><?php echo htmlspecialchars($s['guide_name']); ?></td>
<td><?php echo $s['start_date']; ?></td>
<td><?php echo $s['end_date']; ?></td>
<td><?php echo $s['vehicle']; ?></td>
<td><?php echo $s['hotel']; ?></td>
<td><?php echo $s['status']; ?></td>
</tr><?php endforeach; ?></tbody></table>
<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>

<?php ob_start(); ?>
<h2>Bookings <a href="/bookings/create" style="float:right">Create</a></h2>
<table><thead><tr><th>ID</th><th>Code</th><th>Tour</th><th>Amount</th><th>Status</th><th>Created At</th></tr></thead><tbody>
<?php foreach($bookings as $b): ?><tr>
<td><?php echo $b['booking_id']; ?></td>
<td><?php echo htmlspecialchars($b['booking_code']); ?></td>
<td><?php echo htmlspecialchars($b['tour_name']); ?></td>
<td><?php echo $b['total_amount']; ?></td>
<td><?php echo $b['status']; ?></td>
<td><?php echo $b['created_at']; ?></td>
</tr><?php endforeach; ?></tbody></table>
<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>

<?php ob_start(); ?>
<h2>Tours <a href="/tours/create" style="float:right">Create</a></h2>
<table><thead><tr><th>ID</th><th>Name</th><th>Type</th><th>Price</th><th>Days</th><th>Status</th><th>Actions</th></tr></thead>
<tbody><?php foreach($tours as $t): ?><tr>
<td><?php echo $t['tour_id']; ?></td>
<td><?php echo htmlspecialchars($t['name']); ?></td>
<td><?php echo $t['type']; ?></td>
<td><?php echo $t['price']; ?></td>
<td><?php echo $t['duration_days']; ?></td>
<td><?php echo $t['status']; ?></td>
<td><a href="/tours/edit?id=<?php echo $t['tour_id']; ?>">Edit</a> | <a href="/tours/delete?id=<?php echo $t['tour_id']; ?>" onclick="return confirm('Delete?')">Delete</a></td>
</tr><?php endforeach; ?></tbody></table>
<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>

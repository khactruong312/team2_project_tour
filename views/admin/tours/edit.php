<?php ob_start(); ?>
<h2>Edit Tour #<?php echo $tour['tour_id']; ?></h2>
<form method="post" action="/tours/edit">
<input type="hidden" name="tour_id" value="<?php echo $tour['tour_id']; ?>">
<div><label>Name<br><input name="name" value="<?php echo htmlspecialchars($tour['name']); ?>"></label></div>
<div><label>Type<br><select name="type"><option <?php if($tour['type']=='Trong nước') echo 'selected'; ?>>Trong nước</option><option <?php if($tour['type']=='Quốc tế') echo 'selected'; ?>>Quốc tế</option><option <?php if($tour['type']=='Theo yêu cầu') echo 'selected'; ?>>Theo yêu cầu</option></select></label></div>
<div><label>Price<br><input name="price" value="<?php echo $tour['price']; ?>"></label></div>
<div><label>Duration days<br><input name="duration_days" value="<?php echo $tour['duration_days']; ?>"></label></div>
<div><label>Description<br><textarea name="description"><?php echo htmlspecialchars($tour['description']); ?></textarea></label></div>
<div><label>Status<br><select name="status"><option <?php if($tour['status']=='Active') echo 'selected'; ?>>Active</option><option <?php if($tour['status']=='Inactive') echo 'selected'; ?>>Inactive</option></select></label></div>
<button type="submit">Update</button>
</form>

<h3>Destinations</h3>
<?php if (!empty($destinations)): ?>
<ul><?php foreach($destinations as $d): ?><li><?php echo htmlspecialchars($d['name']); ?> (<?php echo $d['order_no']; ?>)</li><?php endforeach; ?></ul>
<?php else: ?><p>No destinations.</p><?php endif; ?>

<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>

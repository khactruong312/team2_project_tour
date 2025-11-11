<?php ob_start(); ?>
<h2>Create Booking</h2>
<form method="post" action="/bookings/create">
  <div><label>Tour<br><select name="tour_id"><?php foreach($tours as $t): ?><option value="<?php echo $t['tour_id']; ?>"><?php echo htmlspecialchars($t['name']); ?></option><?php endforeach; ?></select></label></div>
  <div><label>Customer name<br><input name="full_name" required></label></div>
  <div><label>Phone<br><input name="phone"></label></div>
  <div><label>Email<br><input name="email"></label></div>
  <div><label>Total amount<br><input name="total_amount" type="number" step="0.01"></label></div>
  <div><label>Note<br><textarea name="note"></textarea></label></div>
  <button type="submit">Save</button>
</form>
<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>

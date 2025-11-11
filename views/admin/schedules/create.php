<?php ob_start(); ?>
<h2>Assign Schedule</h2>
<form method="post" action="/schedules/assign">
  <div><label>Tour<br><select name="tour_id"><?php foreach($tours as $t): ?><option value="<?php echo $t['tour_id']; ?>"><?php echo htmlspecialchars($t['name']); ?></option><?php endforeach; ?></select></label></div>
  <div><label>Guide<br><select name="guide_id"><?php foreach($guides as $g): ?><option value="<?php echo $g['guide_id']; ?>"><?php echo htmlspecialchars($g['full_name']); ?></option><?php endforeach; ?></select></label></div>
  <div><label>Start<br><input name="start_date" type="date"></label></div>
  <div><label>End<br><input name="end_date" type="date"></label></div>
  <div><label>Vehicle<br><input name="vehicle"></label></div>
  <div><label>Hotel<br><input name="hotel"></label></div>
  <button type="submit">Assign</button>
</form>
<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>

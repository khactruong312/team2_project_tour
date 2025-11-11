<?php ob_start(); ?>
<h2>Create Tour</h2>
<form method="post" action="/tours/create">
  <div><label>Name<br><input name="name" required></label></div>
  <div><label>Type<br><select name="type"><option>Trong nước</option><option>Quốc tế</option><option>Theo yêu cầu</option></select></label></div>
  <div><label>Price<br><input name="price" type="number" step="0.01" required></label></div>
  <div><label>Duration days<br><input name="duration_days" type="number" value="1"></label></div>
  <div><label>Description<br><textarea name="description"></textarea></label></div>
  <div><label>Status<br><select name="status"><option>Active</option><option>Inactive</option></select></label></div>
  <button type="submit">Save</button>
</form>
<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>

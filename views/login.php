<?php ob_start(); ?>
<h2>Login</h2>
<form method="post" action="/login">
  <div><label>Username<br><input name="username" required></label></div>
  <div><label>Password<br><input name="password" type="password" required></label></div>
  <button type="submit">Login</button>
</form>
<?php $content = ob_get_clean(); require __DIR__ . '/layout.php'; ?>

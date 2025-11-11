<?php
$user = \App\Auth::user();
?><!doctype html>
<html><head><meta charset="utf-8"><title>Tour Ops</title>
<style>body{font-family:Arial;margin:10px 40px}nav a{margin-right:10px}table{border-collapse:collapse;width:100%}th,td{border:1px solid #ddd;padding:6px}</style>
</head><body>
<header><h1>Tour Operations System</h1>
<nav>
  <?php if ($user): ?>
    <a href="/">Dashboard</a>
    <a href="/tours">Tours</a>
    <a href="/bookings">Bookings</a>
    <a href="/schedules">Schedules</a>
    <a href="/guides/my">My Schedules</a>
    <a href="/logout">Logout (<?php echo htmlspecialchars($user['username']); ?>)</a>
  <?php else: ?>
    <a href="/login">Login</a>
  <?php endif; ?>
</nav><hr></header>
<main>
<?php if (!empty($error)): ?><div style="color:red"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
<?php echo $content ?? ''; ?>
</main>
<footer><hr><small>Student demo base - extend for production </small></footer>
</body></html>

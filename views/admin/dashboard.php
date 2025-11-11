<?php ob_start(); ?>
<h2>Dashboard</h2>
<p>Tours: <?php echo count($tours); ?> | Bookings: <?php echo count($bookings); ?> | Schedules: <?php echo count($schedules); ?></p>
<p><a href="/tours">Manage Tours</a> | <a href="/bookings">Manage Bookings</a> | <a href="/schedules">Manage Schedules</a></p>
<?php $content = ob_get_clean(); require __DIR__ . '/../layout.php'; ?>

<?php
$role = $_SESSION['user_role'] ?? '';
?>
<div class="sidebar">
  <h2><?php echo $role; ?> Pannel</h2>
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="files.php">📂 Files</a>
  <a href="history.php">🕘 History</a>
  <a href="notification.php">🔔 Notifications</a>

  <?php if ($role === 'admin'): ?>
    <a href="user_management.php">👥 Manage Users</a>
    <a href="broadcast.php">📢 Broadcast</a>
  <?php endif; ?>

  <a href="logout.php">🚪 Logout</a>
</div>
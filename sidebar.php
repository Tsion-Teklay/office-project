<?php
$role = $_SESSION['user_role'] ?? '';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<div class="sidebar">
  <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
  <a href="files.php"><i class="bi bi-folder-fill"></i> Files</a>
  <a href="history.php"><i class="bi bi-clock-history"></i> History</a>
  <a href="notification.php"><i class="bi bi-bell-fill"></i> Notifications</a>
  <?php if ($role === 'admin'): ?>
    <a href="user_management.php"><i class="bi bi-people-fill"></i> Manage Users</a>
    <a href="broadcast.php"><i class="bi bi-megaphone-fill"></i> Broadcast</a>
  <?php endif; ?>
  <a href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
    <i class="bi bi-key"></i> Change Password
  </a>
  <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<?php
// role must be defined before including this file
$role = $_SESSION['role'] ?? '';
?>
<style>
  .sidebar {
    width: 220px;
    background-color: #006b65;
    color: white;
    height: 100vh;
    position: fixed;
    padding-top: 20px;
  }

  .sidebar h2 {
    text-align: center;
    margin-bottom: 30px;
  }

  .sidebar a {
    display: block;
    color: white;
    padding: 12px 20px;
    text-decoration: none;
  }

  .sidebar a:hover {
    background-color: #004f4a;
  }
</style>

<div class="sidebar">
  <h2>Office Panel</h2>
  <a href="dashboard.php">🏠 Dashboard</a>
  <a href="files.php">📂 Files</a>
  <a href="history.php">🕘 History</a>
  <a href="notifications.php">🔔 Notifications</a>

  <?php if ($role === 'admin'): ?>
    <a href="user_management.php">👥 Manage Users</a>
    <a href="broadcast.php">📢 Broadcast</a>
  <?php endif; ?>

  <a href="logout.php">🚪 Logout</a>
</div>

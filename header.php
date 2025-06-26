<?php
// session_start();
// if (!isset($_SESSION['user_id'])) {
//   header("Location: login.php");
//   exit;
// }

// Optional: Load user info
$name = $_SESSION['name'] ?? 'User';
$role = $_SESSION['role'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Office Document System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <script>
    function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar');
      sidebar.classList.toggle('active');
    }

        document.addEventListener('click', function (e) {
      const sidebar = document.querySelector('.sidebar');
      const toggle = document.getElementById('menuToggle');
      if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
        sidebar.classList.remove('active');
      }
    });

  </script>


  <style>
     header{
    background-color: #87B0E8;
  }
  footer{
    background-color: #87B0E8;
  }
  </style>
</head>
<body class="d-flex flex-column min-vh-100" >
<header class=" shadow-sm sticky-top">
  <div class="container-fluid py-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-3 mb-3 mb-md-0">
      <!-- Menu button for small screens -->
      <button id="menuToggle" class="btn btn-outline-dark me-2" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
      </button>
      <img src="logo.png" alt="Office Logo" style="height: 50px;">
      <h1 class="h5 text-center text-md-start mb-0">
        አዲስ ከተማ ክፍለ ከተማ የወረዳ 4 ግንባታ ፈቃድና ቁጥጥር ጽ/ቤት
      </h1>
    </div>
    <div class="d-flex align-items-center gap-3">
      <div class="d-flex gap-2">
        <a href="https://www.facebook.com/share/12LjbqheQc6/" target="_blank" class="text-dark"><i class="bi bi-facebook  text-dark fs-5"></i></a>
        <a href="https://twitter.com" target="_blank" class="text-dark"><i class="bi bi-twitter-x  text-dark fs-5"></i></a>
        <a href="https://linkedin.com" target="_blank" class="text-dark"><i class="bi bi-linkedin text-dark fs-5"></i></a>
      </div>
      <button class="btn btn-outline-dark btn-sm" onclick="openModal()">Send</button>
    </div>
  </div>
</header>

<?php include 'sidebar.php'; ?>
<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <?php if (!empty($message)): ?>
          <div class="alert <?= str_starts_with($message, '✅') ? 'alert-success' : 'alert-danger' ?>">
            <?= htmlspecialchars($message) ?>
          </div>
        <?php endif; ?>

        <div class="mb-3">
          <label for="current_password" class="form-label">Current Password</label>
          <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="mb-3">
          <label for="new_password" class="form-label">New Password</label>
          <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Confirm New Password</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-dark"><i class="bi bi-key me-1"></i> Change Password</button>
      </div>
    </form>
  </div>
</div>

<div class="main-content">
<?php 
include 'send.php';
?>
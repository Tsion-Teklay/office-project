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
      <button id="menuToggle" class="btn btn-outline-dark d-md-none me-2" onclick="toggleSidebar()">
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
<div class="main-content">
<?php 
include 'send.php';
?>
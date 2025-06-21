<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

// Optional: Load user info
$name = $_SESSION['name'] ?? 'User';
$role = $_SESSION['role'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Office Document System</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="header-bar">
  <div style="display: flex; align-items: center;">
    <img src="logo.png" alt="Office Logo">
    <h1>አዲስ ከተማ ክፍለ ከተማ የወረዳ 11 ግንባታ ፈቃድና ቅጥጥር ጽ/ቤት</h1>
  </div>

  <div style="display: flex; align-items: center; gap: 15px;">
    <!-- Social Icons -->
    <div class="header-social-icons">
      <a href="https://facebook.com" target="_blank"><i class="bi bi-facebook"></i></a>
      <a href="https://twitter.com" target="_blank"><i class="bi bi-twitter-x"></i></a>
      <a href="https://linkedin.com" target="_blank"><i class="bi bi-linkedin"></i></a>
    </div>

    <div class="top-bar">
      <button class="btn" onclick="openModal()">Send</button>
    </div>
  </div>
</div>


<div class="main-content">
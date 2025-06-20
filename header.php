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
  
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="header-bar">
  <img src="assets/logo.png" alt="Office Logo">
  <h1 style="margin: 0; font-size: 22px;">የቢሮ ሰነድ እና መልዕክት መላኪያ ሲስተም</h1>

  <div class="top-bar">
    <button class="btn" onclick="openModal()">➕ Send File/Message</button>
  </div>
</div>

<div class="main-content">
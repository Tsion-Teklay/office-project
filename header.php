<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

// Optionally load user info
$name = $_SESSION['name'] ?? 'User';
$role = $_SESSION['role'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Office Document System</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
    }

    .main-content {
      margin-left: 220px;
      padding: 20px;
      width: calc(100% - 220px);
      background-color: #f4f4f4;
      min-height: 100vh;
    }

    .top-bar {
      background-color: #008E87;
      color: white;
      padding: 10px 20px;
    }
  </style>
</head>
<body>

  <?php include 'sidebar.php'; ?>

  <div class="main-content">
    <div class="top-bar">
      Logged in as: <strong><?= htmlspecialchars($name) ?></strong> (<?= htmlspecialchars($role) ?>)
    </div>

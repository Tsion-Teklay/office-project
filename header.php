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
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      display: flex;
    }

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
      font-size: 20px;
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

    .header-bar {
      position: fixed;
      top: 0;
      left: 220px;
      right: 0;
      height: 70px;
      background-color: #008E87;
      color: white;
      display: flex;
      align-items: center;
      padding: 0 30px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
      z-index: 1000;
    }

    .header-bar img {
      height: 40px;
      margin-right: 15px;
    }

    .main-content {
      margin-left: 220px;
      margin-top: 70px;
      padding: 20px;
      width: calc(100% - 220px);
    }

    .user-bar {
      margin-left: auto;
      font-size: 14px;
      opacity: 0.9;
    }
  </style>
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
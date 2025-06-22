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

  <style>
     header{
    background-color: #aec3e1;
  }
  footer{
    background-color: #aec3e1;
  }
  </style>
</head>
<body>
<header class=" shadow-sm sticky-top">
  <div class="container-fluid py-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-3 mb-3 mb-md-0">
      <img src="logo.png" alt="Office Logo" style="height: 50px;">
      <h1 class="h5 text-center text-md-start mb-0">
        አዲስ ከተማ ክፍለ ከተማ የወረዳ 4 ግንባታ ፈቃድና ቁጥጥር ጽ/ቤት
      </h1>
    </div>
    <div class="d-flex align-items-center gap-3">
      <div class="d-flex gap-2">
        <a href="https://facebook.com" target="_blank" class="text-dark"><i class="bi bi-facebook  text-primary fs-5"></i></a>
        <a href="https://twitter.com" target="_blank" class="text-dark"><i class="bi bi-twitter-x  text-primary fs-5"></i></a>
        <a href="https://linkedin.com" target="_blank" class="text-dark"><i class="bi bi-linkedin text-primary fs-5"></i></a>
      </div>
      <button class="btn btn-outline-primary btn-sm" onclick="openModal()">Send</button>
    </div>
  </div>
</header>
<?php include 'sidebar.php'; ?>
<div class="main-content">
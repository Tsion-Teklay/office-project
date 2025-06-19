<?php
session_start();
require 'config.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get user info from session
$name = $_SESSION['user_name'];
$role = $_SESSION['user_role'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - <?= ucfirst($role) ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
    }

    nav {
      width: 220px;
      height: 100vh;
      background: #008E87;
      color: white;
      padding: 20px;
      box-sizing: border-box;
    }

    nav h2 {
      margin-top: 0;
    }

    nav a {
      display: block;
      margin: 10px 0;
      color: white;
      text-decoration: none;
    }

    main {
      flex: 1;
      padding: 30px;
      background: #f4f4f4;
    }

    .top-bar {
      background: #EC7346;
      color: white;
      padding: 10px;
      text-align: right;
    }

    .btn {
      padding: 8px 16px;
      background: #008E87;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

  </style>
</head>
<body>

<nav>
  <h2><?= ucfirst($role) ?> Panel</h2>
  <p>Welcome, <?= $name ?></p>
  <a href="#">📂 Files</a>
  <a href="#">📜 History</a>
  <a href="#">🔔 Notifications</a>

  <?php if ($role == 'admin'): ?>
    <a href="user_management.php">👥 Manage Users</a>
    <a href="broadcast.php">📢 Broadcast Message</a>
  <?php endif; ?>

  <a href="logout.php">🚪 Logout</a>
</nav>

<main>
  <div class="top-bar">
    <button class="btn">➕ Send File/Message</button>
    <button class="btn" onclick="openModal()">➕ Send File/Message</button>
  </div>

  <h1>Dashboard</h1>

  <?php if ($role == 'admin'): ?>
    <p>You can manage users, view all file flows, and broadcast messages.</p>
  <?php elseif ($role == 'coordinator'): ?>
    <p>You can manage documents sent from employees and respond accordingly.</p>
  <?php elseif ($role == 'employee'): ?>
    <p>You can send documents to admin/coordinator and track their status.</p>
  <?php endif; ?>

  <!-- Modal Background -->
<div id="sendModal" style="display: none; position: fixed; top: 0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5);">
  <div style="background: white; width: 500px; margin: 100px auto; padding: 20px; border-radius: 10px; position: relative;">
    <span onclick="closeModal()" style="position: absolute; right: 15px; top: 10px; cursor: pointer; font-weight: bold;">&times;</span>
    <h3>Send File or Message</h3>
    
    <form id="sendForm" action="send_handler.php" method="POST" enctype="multipart/form-data">
      <label>Type:</label><br>
      <select id="typeSelect" name="send_type" required onchange="toggleSendType()">
        <option value="">-- Select --</option>
        <option value="file">File</option>
        <option value="message">Message</option>
      </select><br><br>

      <div id="fileFields" style="display: none;">
        <label>File Type:</label><br>
        <select name="file_type" id="fileTypeSelect" required onchange="fetchReceivers()">
          <option value="">-- Choose --</option>
          <option value="file1">File 1</option>
          <option value="file2">File 2</option>
          <option value="file3">File 3</option>
          <option value="file4">File 4</option>
        </select><br><br>

        <label>Select File:</label>
        <input type="file" name="uploaded_file" accept=".pdf,.docx,.xlsx,.dwg" required><br><br>

        <label>Deadline:</label>
        <input type="date" name="deadline" required><br><br>
      </div>

      <div id="messageField" style="display: none;">
        <label>Message:</label>
        <textarea name="message_content" style="width:100%; height:100px;"></textarea><br><br>
      </div>

      <label>Select Receivers:</label><br>
      <div id="receiverList">
        <!-- Receivers will load here with JS -->
      </div><br>

      <input type="submit" value="Send">
    </form>
  </div>
</div>

<script>
function openModal() {
  document.getElementById('sendModal').style.display = 'block';
}

function closeModal() {
  document.getElementById('sendModal').style.display = 'none';
}

function toggleSendType() {
  let type = document.getElementById('typeSelect').value;
  document.getElementById('fileFields').style.display = (type === 'file') ? 'block' : 'none';
  document.getElementById('messageField').style.display = (type === 'message') ? 'block' : 'none';
  fetchReceivers();
}

function fetchReceivers() {
  const fileType = document.getElementById('fileTypeSelect')?.value || '';
  const sendType = document.getElementById('typeSelect')?.value || '';

  fetch(`receiver_list.php?send_type=${sendType}&file_type=${fileType}`)
    .then(res => res.text())
    .then(html => document.getElementById('receiverList').innerHTML = html);
}
</script>


<?php
$user_id = $_SESSION['user_id'];

// Count unread files (status = pending)
$stmt = $pdo->prepare("SELECT COUNT(*) FROM files WHERE receiver_id = ? AND status = 'pending'");
$stmt->execute([$user_id]);
$pendingFiles = $stmt->fetchColumn();

// Count unseen notifications/messages (optional, depends on your schema)
?>
<div style="margin: 20px 0; background: #e7f3f3; padding: 15px; border-radius: 8px;">
  <strong>Summary:</strong><br>
  Pending Files to review: <strong><?= $pendingFiles ?></strong><br>
  <!-- Add more summaries here if desired -->
</div>



</main>

</body>
</html>

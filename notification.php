<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get broadcast messages
$broadcasts = $pdo->query("
  SELECT n.*, u.name AS sender_name 
  FROM notifications n 
  JOIN users u ON n.sender_id = u.id 
  ORDER BY n.sent_at DESC
")->fetchAll();

// Get personal messages
$stmt = $pdo->prepare("
  SELECT m.*, u.name AS sender_name 
  FROM messages m 
  JOIN users u ON m.sender_id = u.id 
  WHERE m.receiver_id = ?
  ORDER BY m.sent_at DESC
");
$stmt->execute([$user_id]);
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Notifications</title>
  <style>
    .section {
      margin-bottom: 40px;
    }

    .message-box {
      background: white;
      padding: 15px;
      margin-bottom: 10px;
      border-radius: 8px;
      border: 1px solid #ddd;
    }

    .sender {
      font-weight: bold;
      color: #008E87;
    }

    .time {
      font-size: 0.9em;
      color: #888;
    }
  </style>
</head>
<body>

  <div class="section">
    <h2>📢 Broadcasts</h2>
    <?php foreach ($broadcasts as $b): ?>
      <div class="message-box">
        <div class="sender"><?= $b['sender_name'] ?> (Admin)</div>
        <div class="time"><?= $b['sent_at'] ?></div>
        <p><?= $b['content'] ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="section">
    <h2>💬 Direct Messages</h2>
    <?php foreach ($messages as $m): ?>
      <div class="message-box">
        <div class="sender"><?= $m['sender_name'] ?></div>
        <div class="time"><?= $m['sent_at'] ?></div>
        <p><?= $m['content'] ?></p>
      </div>
    <?php endforeach; ?>
  </div>

</body>
</html>

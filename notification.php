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

// Get client feedback
$feedbacks = $pdo->query("
  SELECT name, message, submitted_at 
  FROM client_feedback 
  ORDER BY submitted_at DESC
")->fetchAll();

?>



<?php include 'header.php'?>
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

  <div class="section">
  <h2>📝 Client Feedback</h2>
  <?php if (empty($feedbacks)): ?>
    <p>No feedback received yet.</p>
  <?php else: ?>
    <?php foreach ($feedbacks as $f): ?>
      <div class="message-box">
        <div class="sender"><?= htmlspecialchars($f['name']) ?> (Client)</div>
        <div class="time"><?= $f['submitted_at'] ?></div>
        <p><?= nl2br(htmlspecialchars($f['message'])) ?></p>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>


<?php include 'footer.php'?>

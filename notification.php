<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'] ?? '';

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

 <style>
  .section {
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    padding: 20px 25px;
    margin-bottom: 30px;
    color: var(--primary-color);
    font-family: var(--font-base);
  }

  .section h2 {
    font-size: 26px;
    margin-bottom: 20px;
    font-weight: 700;
  }

  .message-box {
    border: 1px solid rgba(0,0,0,0.07);
    border-radius: var(--radius);
    padding: 15px 20px;
    margin-bottom: 15px;
    background-color: rgba(255, 255, 255, 0.65);
    box-shadow: inset 0 0 8px rgba(0,0,0,0.03);
    transition: box-shadow 0.3s ease;
  }

  .message-box:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }

  .sender {
    font-weight: 600;
    font-size: 16px;
    color: var(--accent-color);
    margin-bottom: 6px;
  }

  .time {
    font-size: 12px;
    color: #555;
    margin-bottom: 10px;
    font-style: italic;
  }

  .message-box p {
    font-size: 15px;
    line-height: 1.5;
    white-space: pre-wrap;
    color: var(--primary-color);
  }
</style>

<div class="main-content">
 <?php if ($role !== 'admin'): ?>
  <div class="section">
    <h2>📢 Broadcasts</h2>
    <?php foreach ($broadcasts as $b): ?>
      <div class="message-box">
        <div class="sender"><?= htmlspecialchars($b['sender_name']) ?> (Admin)</div>
        <div class="time"><?= htmlspecialchars($b['sent_at']) ?></div>
        <p><?= nl2br(htmlspecialchars($b['content'])) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>


<div class="section">
  <h2>💬 Direct Messages</h2>
  <?php foreach ($messages as $m): ?>
    <div class="message-box">
      <div class="sender"><?= htmlspecialchars($m['sender_name']) ?></div>
      <div class="time"><?= htmlspecialchars($m['sent_at']) ?></div>
      <p><?= nl2br(htmlspecialchars($m['content'])) ?></p>
    </div>
  <?php endforeach; ?>
</div>

<?php if ($role === 'admin'): ?>
  <div class="section">
    <h2>📝 Client Feedback</h2>
    <?php if (empty($feedbacks)): ?>
      <p>No feedback received yet.</p>
    <?php else: ?>
      <?php foreach ($feedbacks as $f): ?>
        <div class="message-box">
          <div class="sender"><?= htmlspecialchars($f['name']) ?> (Client)</div>
          <div class="time"><?= htmlspecialchars($f['submitted_at']) ?></div>
          <p><?= nl2br(htmlspecialchars($f['message'])) ?></p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
<?php endif; ?>

</div>



<?php include 'footer.php'?>

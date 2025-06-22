<?php
session_start();
require 'config.php';

// Only allow admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_id = $_SESSION['user_id'];
    $content = trim($_POST['message']);

    if (!empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO notifications (sender_id, content) VALUES (?, ?)");
        $stmt->execute([$sender_id, $content]);
        $success = "Message sent to all employees.";
    } else {
        $error = "Message cannot be empty.";
    }
}
?>

<?php include 'header.php'?>

  <div class="main-content">
    <h2 style="text-align: center;">📢 Send Broadcast Message</h2>

  <?php if ($success): ?>
    <p class="message"><?= $success ?></p>
  <?php endif; ?>

  <?php if ($error): ?>
    <p class="error"><?= $error ?></p>
  <?php endif; ?>

  <form method="POST">
    <label for="message">Your Message to All Employees:</label><br>
    <textarea name="message" required></textarea><br>
    <input type="submit" value="Send Message">
  </form>
  </div>

<?php include 'footer.php'?>

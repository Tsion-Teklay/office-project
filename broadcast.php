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
        $success = "Message sent to all users.";
    } else {
        $error = "Message cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Broadcast Message</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 30px;
    }

    form {
      background: white;
      padding: 20px;
      border-radius: 10px;
      max-width: 500px;
      margin: auto;
    }

    textarea {
      width: 100%;
      height: 150px;
      padding: 10px;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background: #EC7346;
      color: white;
      border: none;
      padding: 10px 15px;
      cursor: pointer;
    }

    .message {
      text-align: center;
      color: green;
    }

    .error {
      text-align: center;
      color: red;
    }
  </style>
</head>
<body>

  <h2 style="text-align: center;">📢 Send Broadcast Message</h2>

  <?php if ($success): ?>
    <p class="message"><?= $success ?></p>
  <?php endif; ?>

  <?php if ($error): ?>
    <p class="error"><?= $error ?></p>
  <?php endif; ?>

  <form method="POST">
    <label for="message">Your Message to All Users:</label><br>
    <textarea name="message" required></textarea><br>
    <input type="submit" value="Send Message">
  </form>

</body>
</html>

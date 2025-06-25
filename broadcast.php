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

$user_id = $_SESSION['user_id'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($current, $user['password'])) {
        $message = "❌ Current password is incorrect.";
    } elseif (strlen($new) < 6) {
        $message = "❌ New password must be at least 6 characters.";
    } elseif ($new !== $confirm) {
        $message = "❌ New passwords do not match.";
    } else {
        $new_hash = password_hash($new, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$new_hash, $user_id]);

        $message = "✅ Password changed successfully.";
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
<?php include 'header.php'?>

  <div class="main-content">
  <section>
    <h2 style="text-align: center;"> Send Broadcast Message to All Employees</h2>

  <?php if ($success): ?>
    <p class="message"><?= $success ?></p>
  <?php endif; ?>

  <?php if ($error): ?>
    <p class="error"><?= $error ?></p>
  <?php endif; ?>

  <form method="POST">
    <label for="message">Your Message to All Employees:</label><br>
    <textarea name="message" required></textarea><br>
    <button type="submit" class="btn btn-dark">Send Message</button>
  </form>
  </section>
  </div>

<?php include 'footer.php'?>

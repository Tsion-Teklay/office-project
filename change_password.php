<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    // Fetch current password hash
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
        // Update password
        $new_hash = password_hash($new, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$new_hash, $user_id]);

        $message = "✅ Password changed successfully.";
    }
}
?>

<?php include 'header.php'; ?>

<div class="main-content">
  <h2>Change Password</h2>

  <?php if ($message): ?>
    <p style="color:<?= strpos($message, '✅') === 0 ? 'green' : 'red' ?>"><?= $message ?></p>
  <?php endif; ?>

  <form method="POST" style="max-width: 400px;">
    <label>Current Password:</label>
    <input type="password" name="current_password" required><br><br>

    <label>New Password:</label>
    <input type="password" name="new_password" required><br><br>

    <label>Confirm New Password:</label>
    <input type="password" name="confirm_password" required><br><br>

    <input type="submit" value="Change Password" style="background-color: #008E87; color: white; padding: 8px 20px; border: none;">
  </form>
</div>

<?php include 'footer.php'; ?>
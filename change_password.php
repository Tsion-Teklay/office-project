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

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">

<?php include 'header.php'; ?>

<div class="main-content">
  <section>
    <h2 class=" card-title mb-3" style="color:#265295">Change Password</h2>

    <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <?php if ($message): ?>
              <div class="alert <?= strpos($message, '✅') === 0 ? 'alert-success' : 'alert-danger' ?>">
                <?= htmlspecialchars($message) ?>
              </div>
            <?php endif; ?>

            <form method="POST" novalidate>
              <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
              </div>

              <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
              </div>

              <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
              </div>

              <button type="submit" class="btn btn-dark w-100" style="border: none;">
                <i class="bi bi-key me-1"></i> Change Password
              </button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  </section>
</div>

<?php include 'footer.php'; ?>

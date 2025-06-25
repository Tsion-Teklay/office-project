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

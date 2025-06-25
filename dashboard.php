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

<?php

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


<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Orbitron:wght@500&family=Righteous&family=Rajdhani:wght@600&family=Syncopate&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  

<?php include 'header.php' ?>

<main class="main-content">
 <!-- Modal Background -->

 
  <?php
$user_id = $_SESSION['user_id'];

// Pending Files (received)
$stmt = $pdo->prepare("SELECT COUNT(*) FROM files WHERE receiver_id = ? AND status = 'pending'");
$stmt->execute([$user_id]);
$pendingFiles = $stmt->fetchColumn();

// Sent Files (sent by user)
$stmt = $pdo->prepare("SELECT COUNT(*) FROM files WHERE sender_id = ?");
$stmt->execute([$user_id]);
$sentFiles = $stmt->fetchColumn();

// Broadcasted messages (if user is admin)
$broadcasts = 0;
if ($role === 'admin') {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM notifications WHERE sender_id = ?");
    $stmt->execute([$user_id]);
    $broadcasts = $stmt->fetchColumn();
}
?>

<div class="container my-4">
  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8 text-center">
      <h2 class="fs-3 fs-md-3 fs-lg-2">እንኳን ወደ የቢሮ ሰነድ እና መልዕክት ሲስተም በደህና መጡ</h2>
      <p class="text-muted fs-6 fs-md-5">በዚህ ሲስተም በቀላሉ ሰነዶችን ማስተላለፍ፣ መልዕክቶችን መላክ፣ እና ሥራዎችን መከታተል ይችላሉ።</p>
    </div>
  </div>
</div>


<div class="summary-container">
  <div class="summary-card">
    <div class="summary-count" data-target="<?= $pendingFiles ?>">0</div>
    <div class="summary-label">Pending Files</div>
  </div>

  <div class="summary-card">
    <div class="summary-count" data-target="<?= $sentFiles ?>">0</div>
    <div class="summary-label">Sent Files</div>
  </div>

  <?php if ($role === 'admin'): ?>
    <div class="summary-card">
      <div class="summary-count" data-target="<?= $broadcasts ?>">0</div>
      <div class="summary-label">Broadcasts</div>
    </div>
  <?php endif; ?>
</div>

<style>
  .summary-container {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 30px;
    justify-content: center;
  }

  .summary-card {
    width: 280px;
    height: 280px;
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-family: var(--font-base);
    text-align: center;
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .summary-card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
  }

  .summary-count {
    font-size: 80px;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 10px;
    font-family: 'Syncopate', sans-serif;
  }

  .summary-label {
    font-size: 20px;
    font-weight: 500;
    color: var(--primary-color);
    letter-spacing: 1px;
    font-family: 'DM Sans', sans-serif;
  }
</style>

  
</main>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll(".summary-count");

  counters.forEach(counter => {
    const finalValue = +counter.getAttribute("data-target");
    let fakeRuns = 15; // how many random numbers before showing actual value
    let run = 0;

    const rollRandom = () => {
      if (run < fakeRuns) {
        const fakeNum = Math.floor(Math.random() * finalValue * 1.5);
        counter.textContent = fakeNum;
        run++;
        setTimeout(rollRandom, 50);
      } else {
        animateCount(finalValue);
      }
    };

    const animateCount = (target) => {
      let current = 0;
      const increment = Math.ceil(target / 40);

      const update = () => {
        current += increment;
        if (current >= target) {
          counter.textContent = target;
        } else {
          counter.textContent = current;
          requestAnimationFrame(update);
        }
      };

      update();
    };

    rollRandom();
  });
});
</script>


<?php include 'footer.php' ?>





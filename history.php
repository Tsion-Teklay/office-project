<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
  SELECT f.*, u.name AS receiver_name 
  FROM files f 
  JOIN users u ON f.receiver_id = u.id 
  WHERE f.sender_id = ?
  ORDER BY f.sent_at DESC
");
$stmt->execute([$user_id]);
$files = $stmt->fetchAll();
?>

<?php include 'header.php'?>

<div class="main-content">
  <h2 class="text-center mb-4" style="color: var(--primary-color); font-size: 28px;">Sent Files</h2>

<div class="container mb-5">
  <div class="table-responsive">
    <table class="table table-hover table-bordered text-center align-middle" style="background: var(--glass-bg); backdrop-filter: var(--glass-blur); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden;">
      <thead class="table-light">
        <tr>
          <th>File</th>
          <th>Receiver</th>
          <th>Deadline</th>
          <th>Status</th>
          <th>Sent At</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($files as $f): ?>
        <tr>
          <td class="text-start ps-4">
            <i class="bi bi-file-earmark-text-fill me-1 text-primary"></i>
            <?= $f['file_name'] ?>
          </td>
          <td><?= $f['receiver_name'] ?></td>
          <td><?= $f['deadline'] ?></td>
          <td>
            <span class="badge bg-<?= 
  $f['status'] === 'pending' ? 'warning' : 
  ($f['status'] === 'seen' ? 'info' : 'success') 
?> d-inline-block w-100 py-2" style="min-width: 90px;">
  <?= ucfirst($f['status']) ?>
            </span>

          </td>
          <td><?= date('F j, Y h:i A', strtotime($f['sent_at'])) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

</div> 

<?php include 'footer.php'?>

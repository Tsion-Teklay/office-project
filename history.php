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

  <h2>History: Sent Files</h2>

  <table>
    <tr>
      <th>File</th>
      <th>Receiver</th>
      <th>Deadline</th>
      <th>Status</th>
      <th>Sent At</th>
    </tr>

    <?php foreach ($files as $f): ?>
    <tr>
      <td><?= $f['file_name'] ?></td>
      <td><?= $f['receiver_name'] ?></td>
      <td><?= $f['deadline'] ?></td>
      <td><?= ucfirst($f['status']) ?></td>
      <td><?= $f['sent_at'] ?></td>
    </tr>
    <?php endforeach; ?>
  </table>

<?php include 'footer.php'?>

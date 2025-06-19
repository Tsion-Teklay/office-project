<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['mark']) && isset($_GET['id'])) {
    $status = $_GET['mark'];
    $file_id = $_GET['id'];

    if (in_array($status, ['seen', 'received'])) {
        $stmt = $pdo->prepare("UPDATE files SET status = ? WHERE id = ? AND receiver_id = ?");
        $stmt->execute([$status, $file_id, $user_id]);
    }

    header("Location: files.php");
    exit;
}

$stmt = $pdo->prepare("
  SELECT f.*, u.name AS sender_name 
  FROM files f 
  JOIN users u ON f.sender_id = u.id 
  WHERE f.receiver_id = ?
  ORDER BY f.sent_at DESC
");
$stmt->execute([$user_id]);
$files = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Your Files</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ccc;
    }

    .btn {
      padding: 5px 10px;
      background: #008E87;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

    .btn.disabled {
      background: gray;
      pointer-events: none;
    }
  </style>
</head>
<body>

  <h2>Your Received Files</h2>

  <table>
    <tr>
      <th>File</th>
      <th>Sender</th>
      <th>Deadline</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>

    <?php foreach ($files as $f): ?>
    <tr>
      <td><a href="uploads/<?= $f['file_name'] ?>" download><?= $f['file_name'] ?></a></td>
      <td><?= $f['sender_name'] ?></td>
      <td><?= $f['deadline'] ?></td>
      <td><?= ucfirst($f['status']) ?></td>
      <td>
        <?php if ($f['status'] === 'pending'): ?>
          <a class="btn" href="?mark=seen&id=<?= $f['id'] ?>">Mark as Seen</a>
        <?php elseif ($f['status'] === 'seen'): ?>
          <a class="btn" href="?mark=received&id=<?= $f['id'] ?>">Mark as Received</a>
        <?php else: ?>
          <span class="btn disabled">Completed</span>
        <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>

</body>
</html>

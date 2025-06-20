<?php
session_start();
require 'config.php';

// Only allow admins
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

 //for activity log 
function logActivity($pdo, $user_id, $action) {
    $stmt = $pdo->prepare("INSERT INTO activity_logs (user_id, action) VALUES (?, ?)");
    $stmt->execute([$user_id, $action]);
}

// Handle Add User
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $title = trim($_POST['title']);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, title) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $password, $role, $title]);

    //for activity log 
    logActivity($pdo, $_SESSION['user_id'], "Added user: $name ($email)");


    header("Location: user_management.php");
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
    header("Location: user_management.php");
    exit;
}

// Fetch users
$users = $pdo->query("SELECT * FROM users ORDER BY role")->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'?>

  <h2>All Users</h2>
  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Title</th>
      <th>Action</th>
    </tr>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?= htmlspecialchars($user['name']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= htmlspecialchars($user['role']) ?></td>
        <td><?= htmlspecialchars($user['title']) ?></td>
        <td>
          <!-- Optional: Edit link -->
          <a class="delete" href="?delete=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <h2>Add New User</h2>
  <form method="POST">
    <input type="hidden" name="add_user" value="1">
    <label>Name</label>
    <input type="text" name="name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Role</label>
    <select name="role" required>
      <option value="employee">Employee</option>
      <option value="coordinator">Coordinator</option>
      <option value="admin">Admin</option>
    </select>

    <label>Title (if employee)</label>
    <input type="text" name="title">

    <input type="submit" value="Add User">
  </form>

<?php include 'footer.php'?>

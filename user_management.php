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

// Handle Update User
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $id = $_POST['user_id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    $title = trim($_POST['title']);

    // Optional: update password only if provided
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, password=?, role=?, title=? WHERE id=?");
        $stmt->execute([$name, $email, $password, $role, $title, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, role=?, title=? WHERE id=?");
        $stmt->execute([$name, $email, $role, $title, $id]);
    }

    logActivity($pdo, $_SESSION['user_id'], "Updated user: $name ($email)");

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

// Handle Edit
$edit_user = null;
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_user = $stmt->fetch(PDO::FETCH_ASSOC);
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
          <a class="edit" href="?edit=<?= $user['id'] ?>">Edit</a> |
          <a class="delete" href="?delete=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

  <h2><?= $edit_user ? 'Edit User' : 'Add New User' ?></h2>

<form method="POST">
  <?php if ($edit_user): ?>
    <input type="hidden" name="update_user" value="1">
    <input type="hidden" name="user_id" value="<?= $edit_user['id'] ?>">
  <?php else: ?>
    <input type="hidden" name="add_user" value="1">
  <?php endif; ?>

  <label>Name</label>
  <input type="text" name="name" required value="<?= $edit_user['name'] ?? '' ?>">

  <label>Email</label>
  <input type="email" name="email" required value="<?= $edit_user['email'] ?? '' ?>">

  <label><?= $edit_user ? 'New Password (leave blank to keep current)' : 'Password' ?></label>
  <input type="password" name="password" <?= $edit_user ? '' : 'required' ?>>

  <label>Role</label>
  <select name="role" required>
    <option value="employee" <?= isset($edit_user) && $edit_user['role'] === 'employee' ? 'selected' : '' ?>>Employee</option>
    <option value="coordinator" <?= isset($edit_user) && $edit_user['role'] === 'coordinator' ? 'selected' : '' ?>>Coordinator</option>
    <option value="admin" <?= isset($edit_user) && $edit_user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
  </select>

  <label>Title (if employee)</label>
  <input type="text" name="title" value="<?= $edit_user['title'] ?? '' ?>">

  <input type="submit" value="<?= $edit_user ? 'Update User' : 'Add User' ?>">
</form>


<?php include 'footer.php'?>

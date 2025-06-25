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

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<?php include 'header.php'?>
<style>
  /* Users Table */
table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 40px;
  font-family: var(--font-base);
  color: var(--primary-color);
  background: var(--glass-bg);
  backdrop-filter: var(--glass-blur);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  overflow: hidden;
}

table thead tr {
  background-color: var(--accent-color);
  color: white;
  font-weight: 700;
}

table th, table td {
  padding: 12px 15px;
  text-align: left;
  border-bottom: 1px solid rgba(0,0,0,0.1);
}

table tbody tr:hover {
  background-color: rgba(236, 115, 70, 0.1);
}

a.edit, a.delete {
  color: var(--accent-color);
  text-decoration: none;
  font-weight: 600;
  margin: 0 5px;
  cursor: pointer;
  transition: color 0.3s ease;
}

a.edit:hover {
  color: #d35400; /* slightly darker */
}

a.delete:hover {
  color: #c0392b;
}

/* Form styling */
form {
  max-width: 600px;
  background: var(--glass-bg);
  backdrop-filter: var(--glass-blur);
  padding: 25px 30px;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  font-family: var(--font-base);
  color: var(--primary-color);
  margin-bottom: 60px;
}

form h2 {
  margin-bottom: 20px;
  font-weight: 700;
  font-size: 28px;
  color: var(--primary-color);
}

form label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
}

form input[type="text"],
form input[type="email"],
form input[type="password"],
form select {
  width: 100%;
  padding: 10px 12px;
  margin-bottom: 20px;
  border: 1.5px solid var(--accent-color);
  border-radius: var(--radius);
  font-size: 16px;
  font-family: var(--font-base);
  transition: border-color 0.3s ease;
  color: var(--primary-color);
  background: white;
}

form input[type="text"]:focus,
form input[type="email"]:focus,
form input[type="password"]:focus,
form select:focus {
  outline: none;
  border-color: var(--primary-color);
}

form input[type="submit"] {
  background: var(--accent-color);
  border: none;
  color: white;
  font-weight: 700;
  padding: 12px 30px;
  border-radius: var(--radius);
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

form input[type="submit"]:hover {
  background: #d35400; /* darker orange */
}

</style>

  <div class="main-content">
  <section>
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
  </section>

<section>
  <h2><?= $edit_user ? 'Edit User' : 'Add New User' ?></h2>

 <div class="row justify-content-center">
  <form method="POST" class="card p-4 shadow-sm border-0" style="max-width: 800px;">
    <?php if ($edit_user): ?>
      <input type="hidden" name="update_user" value="1">
      <input type="hidden" name="user_id" value="<?= $edit_user['id'] ?>">
    <?php else: ?>
      <input type="hidden" name="add_user" value="1">
    <?php endif; ?>

    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" required value="<?= $edit_user['name'] ?? '' ?>" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" required value="<?= $edit_user['email'] ?? '' ?>" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label"><?= $edit_user ? 'New Password (leave blank to keep current)' : 'Password' ?></label>
      <input type="password" name="password" <?= $edit_user ? '' : 'required' ?> class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Role</label>
      <select name="role" required class="form-select">
        <option value="employee" <?= isset($edit_user) && $edit_user['role'] === 'employee' ? 'selected' : '' ?>>Employee</option>
        <option value="coordinator" <?= isset($edit_user) && $edit_user['role'] === 'coordinator' ? 'selected' : '' ?>>Coordinator (አስተባባሪ)</option>
        <option value="admin" <?= isset($edit_user) && $edit_user['role'] === 'admin' ? 'selected' : '' ?>>Admin (ሃላፊ)</option>
      </select>
    </div>

    <div class="mb-4">
      <label class="form-label">Title (if employee)</label>
      <input type="text" name="title" value="<?= $edit_user['title'] ?? '' ?>" class="form-control">
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-dark">
        <?= $edit_user ? 'Update User' : 'Add User' ?>
      </button>
    </div>
  </form>
</div>
</section>

  </div>

<?php include 'footer.php'?>

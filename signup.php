<?php
require 'config.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];
    $title    = trim($_POST['title']);

    // Basic checks
    if (!$name || !$email || !$password || !$role) {
        $error = "All fields are required.";
    } else {
        // Insert user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, title) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $role, $role === 'employee' ? $title : null]);
        $success = "User registered successfully.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Test Signup</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 50px;
    }

    form {
      max-width: 400px;
      margin: auto;
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 10px #ccc;
    }

    input, select {
      width: 100%;
      padding: 8px;
      margin-bottom: 12px;
    }

    input[type="submit"] {
      background: #008E87;
      color: white;
      border: none;
      cursor: pointer;
    }

    .msg {
      text-align: center;
      margin-bottom: 10px;
      color: green;
    }

    .error {
      text-align: center;
      margin-bottom: 10px;
      color: red;
    }
  </style>
</head>
<body>

  <form method="POST">
    <h2 style="text-align:center;">Signup (Test Only)</h2>

    <?php if ($success): ?>
      <p class="msg"><?= $success ?></p>
    <?php elseif ($error): ?>
      <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <label>Name</label>
    <input type="text" name="name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Role</label>
    <select name="role" id="role" onchange="toggleTitle()" required>
      <option value="">-- Select Role --</option>
      <option value="admin">Admin</option>
      <option value="coordinator">Coordinator</option>
      <option value="employee">Employee</option>
    </select>

    <div id="titleBox" style="display:none;">
      <label>Title (only for Employee)</label>
      <input type="text" name="title">
    </div>

    <input type="submit" value="Register">
  </form>

  <script>
    function toggleTitle() {
      const role = document.getElementById('role').value;
      document.getElementById('titleBox').style.display = (role === 'employee') ? 'block' : 'none';
    }
  </script>

</body>
</html>

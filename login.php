<?php
session_start();
require 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Valid credentials, set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        // Redirect based on role
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Office Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    :root {
  --primary-color: #265295;
  --secondary-color: #f0faff;
  --text-dark: #1a1a1a;
  --text-light: #fff;
  --accent-color: #2f80ed;
  --bg-color: #f9fbfd;
  --shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  --radius: 16px;
  --glass-bg: rgba(255, 255, 255, 0.6);
  --glass-blur: blur(10px);
}
     .login-container {
      width: 400px;
      margin: 100px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px #ccc;
    }

    h2 {
      text-align: center;
      color: var(--primary-color);
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    input[type="email"],
    input[type="password"] {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="submit"] {
      background: var(--primary-color);
      color: white;
      border: none;
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
    }

    .error {
      color: red;
      text-align: center;
    }
  </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
  <div class="card p-4 shadow-sm border-0" style="width: 100%; max-width: 400px;">
    <h2 class="text-center mb-4">Login</h2>

    <?php if ($error): ?>
      <div class="alert alert-danger text-center p-2 py-1 mb-3" role="alert">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required />
      </div>

      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required />
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-box-arrow-in-right me-2"></i>Login
        </button>
      </div>
    </form>
  </div>
</body>

</html>

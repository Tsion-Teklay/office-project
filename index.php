<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Office Document System</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      display: flex;
    }

    .header-bar {
      position: fixed;
      left: 0;
      top: 0;
      right: 0;
      height: 70px;
      background-color: #008E87;
      color: white;
      display: flex;
      align-items: center;
      padding: 0 30px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
      z-index: 1000;
    }

    .header-bar img {
      height: 40px;
      margin-right: 15px;
    }

    .main-content {
      margin-top: 70px;
      padding: 20px;
      width: calc(100% - 220px);
    }

    .user-bar {
      margin-left: auto;
      font-size: 14px;
      opacity: 0.9;
    }
  </style>
</head>
<body>

<div class="header-bar">
  <img src="assets/logo.png" alt="Office Logo">
  <h1 style="margin: 0; font-size: 22px;">የቢሮ ሰነድ እና መልዕክት መላኪያ ሲስተም</h1>

  <div class="top-bar">
    <button class="btn" ><a href="login.php">Login</a></button>
  </div>
</div>

<div class="main-content">

  <section>
    <h2>Our Mission</h2>
    <p>
      To streamline communication and document management within the office through a secure, efficient, and role-based platform.
    </p>
  </section>

  <section>
    <h2>Our Vision</h2>
    <p>
      Empowering employees with digital tools to manage tasks, share files, and stay updated through a collaborative workspace.
    </p>
  </section>

  <section>
    <h2>Goals</h2>
    <ul>
      <li>Improve workflow visibility and accountability</li>
      <li>Facilitate fast and secure file sharing</li>
      <li>Enhance communication among team members</li>
      <li>Track work progress through deadline-based submissions</li>
    </ul>
  </section>

  <section>
    <h2>Our Team Structure</h2>
    <div class="roles">
      <div class="role-box">
        <h3>Admin</h3>
        <p>Manages users, tracks all activity, sends broadcasts, and oversees document workflow.</p>
      </div>
      <div class="role-box">
        <h3>Coordinator</h3>
        <p>Receives files from employees, coordinates responses, and sends files to Admin or back to employees.</p>
      </div>
      <div class="role-box">
        <h3>Employees</h3>
        <p>Send and receive files depending on their role. Roles include inspectors, engineers, and permit issuers.</p>
      </div>
    </div>
  </section>

    <section>
    <h2>Feedback / Message to Admin</h2>
    <form action="submit_feedback.php" method="POST" style="max-width: 600px;">
      <label for="client_name">Your Name:</label><br>
      <input type="text" name="client_name" id="client_name" required style="width: 100%; padding: 8px;"><br><br>

      <label for="message">Your Feedback or Message:</label><br>
      <textarea name="message" id="message" required rows="5" style="width: 100%; padding: 8px;"></textarea><br><br>

      <input type="submit" value="Send Message" style="padding: 10px 20px; background-color: #008E87; color: white; border: none; cursor: pointer;">
    </form>
  </section>

</div> <!-- Close .main-content -->


</body>
</html>

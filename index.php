<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Office Document System</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #265295;
      --secondary-color: #E0F7F5;
      --text-dark: #222;
      --text-light: #fff;
      --accent-color:rgb(72, 107, 159);
      --bg-color: #f4f4f4;
      --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      --radius: 12px;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--bg-color);
      color: var(--text-dark);
    }

    .header-bar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 70px;
      background-color: var(--primary-color);
      color: var(--text-light);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 30px;
      box-shadow: var(--shadow);
      z-index: 1000;
    }

    .header-bar img {
      height: 45px;
      margin-right: 15px;
    }

    .header-bar h1 {
      font-size: 18px;
      margin: 0;
    }

    .top-bar .btn {
      background-color: var(--accent-color);
      border: none;
      padding: 8px 16px;
      border-radius: var(--radius);
      font-size: 14px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .top-bar .btn a {
      text-decoration: none;
      color: var(--text-light);
    }

    .top-bar .btn:hover {
      background-color: #1d447a;
    }

    .main-content {
      margin-top: 90px;
      padding: 40px 20px;
    }

    section h2 {
      font-size: 26px;
      color: var(--primary-color);
      margin-bottom: 20px;
      border-left: 5px solid var(--accent-color);
      padding-left: 15px;
    }

    ul {
      list-style: none;
      padding-left: 0;
    }

    ul li::before {
      content: '✔️';
      margin-right: 8px;
      color: var(--accent-color);
    }

    .role-box {
      background-color: var(--secondary-color);
      padding: 25px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
      height: 100%;
    }

    .role-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .role-box img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 15px;
      border: 3px solid var(--primary-color);
    }

    .role-box h3 {
      font-size: 18px;
      margin-bottom: 5px;
      color: #111;
    }

    .role-box h4 {
      font-size: 15px;
      margin-bottom: 10px;
      color: var(--primary-color);
      font-weight: normal;
    }

    .role-box p {
      font-size: 14px;
      color: #333;
      line-height: 1.5;
    }

    @media (max-width: 768px) {
      .header-bar h1 {
        font-size: 14px;
      }

      .header-bar img {
        height: 35px;
      }
    }
  </style>
</head>
<body>

<!-- ✅ Header -->
<div class="header-bar">
  <div class="d-flex align-items-center">
    <img src="logo.png" alt="Office Logo">
    <h1>አዲስ ከተማ ክፍለ ከተማ የወረዳ 11 ግንባታ ፈቃድና ቅጥጥር ጽ/ቤት</h1>
  </div>
  <div class="top-bar">
    <button class="btn"><a href="login.php">Login</a></button>
  </div>
</div>

<!-- ✅ Main Content -->
<div class="main-content container">
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

  <!-- ✅ Team Section -->
  <section>
    <h2>Our Team Structure</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="role-box">
          <img src="assets/team/admin.jpg" alt="Admin Photo">
          <h3>Selam Tadesse</h3>
          <h4>Admin</h4>
          <p>Manages users, tracks all activity, sends broadcasts, and oversees document workflow.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="role-box">
          <img src="assets/team/coordinator.jpg" alt="Coordinator Photo">
          <h3>Mekdes Alemu</h3>
          <h4>Coordinator</h4>
          <p>Receives files from employees, coordinates responses, and sends files to Admin or back to employees.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="role-box">
          <img src="assets/team/employee.jpg" alt="Employee Photo">
          <h3>Yonatan Girma</h3>
          <h4>Employee</h4>
          <p>Send and receive files depending on their role. Roles include inspectors, engineers, and permit issuers.</p>
        </div>
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

      <input type="submit" value="Send Message" style="background-color: var(--primary-color); color: white;"">
    </form>
  </section>
</div>

<!-- ✅ Bootstrap JS Bundle (Optional for dropdowns, modals) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

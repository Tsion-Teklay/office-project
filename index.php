<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Office Document System</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ✅ Header -->
<div class="header-bar">
  <div class="d-flex align-items-center">
    <img src="logo.png" alt="Office Logo">
    <h1>አዲስ ከተማ ክፍለ ከተማ የወረዳ 11 ግንባታ ፈቃድና ቅጥጥር ጽ/ቤት</h1>
  </div>
  <div class="top-bar">
    <button class="btn" style="color: #ccc;"><a href="login.php">Login</a></button>
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Office Document System</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    :root {
      --primary-color: #008E87;
      --secondary-color: #E0F7F5;
      --text-dark: #222;
      --text-light: #fff;
      --accent-color: #00B3A6;
      --bg-color: #f4f4f4;
      --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      --radius: 12px;
    }

    * {
      margin: 0;
      padding: 0;
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
      font-size: 22px;
      margin: 0;
    }

    .top-bar .btn {
      background-color: var(--accent-color);
      border: none;
      padding: 10px 18px;
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
      background-color: #009c91;
    }

    .main-content {
      margin-top: 90px;
      padding: 40px 50px;
      max-width: 1000px;
      margin-left: auto;
      margin-right: auto;
    }

    section {
      margin-bottom: 50px;
    }

    section h2 {
      font-size: 26px;
      color: var(--primary-color);
      margin-bottom: 15px;
      border-left: 5px solid var(--accent-color);
      padding-left: 15px;
    }

    section p,
    section ul {
      font-size: 16px;
      line-height: 1.6;
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

    .roles {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }

    .role-box {
      background-color: var(--secondary-color);
      padding: 20px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .role-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .role-box h3 {
      margin-bottom: 10px;
      color: var(--primary-color);
      font-size: 20px;
    }

    .role-box p {
      font-size: 15px;
    }

    @media (max-width: 600px) {
      .main-content {
        padding: 20px;
      }

      .header-bar h1 {
        font-size: 16px;
      }

      .header-bar img {
        height: 35px;
      }
    }
  </style>
</head>
<body>

<div class="header-bar">
  <div style="display: flex; align-items: center;">
    <img src="assets/logo.png" alt="Office Logo">
    <h1>የቢሮ ሰነድ እና መልዕክት መላኪያ ሲስተም</h1>
  </div>

  <div class="top-bar">
    <button class="btn"><a href="login.php">Login</a></button>
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
</div>

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

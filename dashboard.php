<?php
session_start();
require 'config.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get user info from session
$name = $_SESSION['user_name'];
$role = $_SESSION['user_role'];
?>

<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Orbitron:wght@500&family=Righteous&family=Rajdhani:wght@600&family=Syncopate&display=swap" rel="stylesheet">

 <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  

<?php include 'header.php' ?>

<main class="main-content">
 <!-- Modal Background -->
<div id="sendModal" class="modal-overlay">
  <div class="custom-modal">
    <span onclick="closeModal()" class="close-btn">&times;</span>
    <h3 style="color: var(--primary-color);">Send File or Message</h3>
    <div class="modal-body-scroll">
      <form id="sendForm" action="send_handler.php" method="POST" enctype="multipart/form-data">
        <label>Type:</label><br>
        <select id="typeSelect" name="send_type" required onchange="toggleSendType()">
          <option value="">-- Select --</option>
          <option value="file">File</option>
          <option value="message">Message</option>
        </select><br><br>

        <div id="fileFields" style="display: none;">
          <label>File Type:</label><br>
          <select name="file_type" id="fileTypeSelect" required onchange="fetchReceivers()">
            <option value="">-- Choose --</option>
            <option value="file1" class="from_employee" style="<?= $role === 'employee' ? '' : 'display:none;' ?>">File 1</option>
            <option value="file2" class="from_employee" style="<?= $role === 'employee' ? '' : 'display:none;' ?>">File 2</option>
            <option value="file3" class="bn_ac" style="<?= $role === 'employee' ? 'display:none;' : '' ?>">File 3</option>
            <option value="file4" class="to_employee" style="<?= $role === 'employee' ? 'display:none;' : '' ?>">File 4</option>
          </select><br><br>

          <label>Select File:</label>
          <input type="file" name="uploaded_file" accept=".pdf,.docx,.xlsx,.dwg" required><br><br>

          <label>Deadline:</label>
          <input type="date" name="deadline" required><br><br>
        </div>

        <div id="messageField" style="display: none;">
          <label>Message:</label>
          <textarea name="message_content" style="width:100%; height:100px;"></textarea><br><br>
        </div>

        <label>Select Receivers:</label><br>
        <div id="receiverList"></div><br>

        <input type="submit" value="Send" class="btn" style="background: var(--accent-color); color: white; padding: 10px 20px; border: none; border-radius: var(--radius); cursor: pointer;">
      </form>
    </div>
  </div>
</div>


  <?php
$user_id = $_SESSION['user_id'];

// Pending Files (received)
$stmt = $pdo->prepare("SELECT COUNT(*) FROM files WHERE receiver_id = ? AND status = 'pending'");
$stmt->execute([$user_id]);
$pendingFiles = $stmt->fetchColumn();

// Sent Files (sent by user)
$stmt = $pdo->prepare("SELECT COUNT(*) FROM files WHERE sender_id = ?");
$stmt->execute([$user_id]);
$sentFiles = $stmt->fetchColumn();

// Broadcasted messages (if user is admin)
$broadcasts = 0;
if ($role === 'admin') {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM notifications WHERE sender_id = ?");
    $stmt->execute([$user_id]);
    $broadcasts = $stmt->fetchColumn();
}
?>

<div class="summary-container">
  <div class="summary-card">
    <div class="summary-count" data-target="<?= $pendingFiles ?>">0</div>
    <div class="summary-label">Pending Files</div>
  </div>

  <div class="summary-card">
    <div class="summary-count" data-target="<?= $sentFiles ?>">0</div>
    <div class="summary-label">Sent Files</div>
  </div>

  <?php if ($role === 'admin'): ?>
    <div class="summary-card">
      <div class="summary-count" data-target="<?= $broadcasts ?>">0</div>
      <div class="summary-label">Broadcasts</div>
    </div>
  <?php endif; ?>
</div>

<style>

  .modal-overlay {
  display: none;
  position: fixed;
  top: 0; left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0,0,0,0.5);
  z-index: 2000;
  overflow-y: auto;
  padding: 30px 15px;
  box-sizing: border-box;
}

.custom-modal {
  background: white;
  max-width: 600px;
  width: 100%;
  max-height: 90vh;
  margin: auto;
  padding: 20px 20px 0;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.modal-body-scroll {
  overflow-y: auto;
  max-height: 65vh;
  padding-right: 10px;
  margin-top: 10px;
}

.close-btn {
  position: absolute;
  right: 15px;
  top: 10px;
  cursor: pointer;
  font-weight: bold;
  font-size: 20px;
}


  .summary-container {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 30px;
    justify-content: center;
  }

  .summary-card {
    width: 280px;
    height: 280px;
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-family: var(--font-base);
    text-align: center;
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .summary-card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
  }

  .summary-count {
    font-size: 80px;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 10px;
    font-family: 'Syncopate', sans-serif;
  }

  .summary-label {
    font-size: 20px;
    font-weight: 500;
    color: var(--primary-color);
    letter-spacing: 1px;
    font-family: 'DM Sans', sans-serif;
  }
</style>

  
</main>

<script>
function openModal() {
  document.getElementById('sendModal').style.display = 'block';
}

function closeModal() {
  document.getElementById('sendModal').style.display = 'none';
}

function toggleSendType() {
  let type = document.getElementById('typeSelect').value;

  document.getElementById('fileFields').style.display = (type === 'file') ? 'block' : 'none';
  document.getElementById('messageField').style.display = (type === 'message') ? 'block' : 'none';

  document.querySelector('[name="uploaded_file"]').required = (type === 'file');
  document.querySelector('[name="file_type"]').required = (type === 'file');
  document.querySelector('[name="deadline"]').required = (type === 'file');
  document.querySelector('[name="message_content"]').required = (type === 'message');

  fetchReceivers();
}

function fetchReceivers() {
  const fileType = document.getElementById('fileTypeSelect')?.value || '';
  const sendType = document.getElementById('typeSelect')?.value || '';

  fetch(`receiver_list.php?send_type=${sendType}&file_type=${fileType}`)
    .then(res => res.text())
    .then(html => document.getElementById('receiverList').innerHTML = html);
}

document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll(".summary-count");

  counters.forEach(counter => {
    const finalValue = +counter.getAttribute("data-target");
    let fakeRuns = 15; // how many random numbers before showing actual value
    let run = 0;

    const rollRandom = () => {
      if (run < fakeRuns) {
        const fakeNum = Math.floor(Math.random() * finalValue * 1.5);
        counter.textContent = fakeNum;
        run++;
        setTimeout(rollRandom, 50);
      } else {
        animateCount(finalValue);
      }
    };

    const animateCount = (target) => {
      let current = 0;
      const increment = Math.ceil(target / 40);

      const update = () => {
        current += increment;
        if (current >= target) {
          counter.textContent = target;
        } else {
          counter.textContent = current;
          requestAnimationFrame(update);
        }
      };

      update();
    };

    rollRandom();
  });
});
</script>


</body>
</html>
<?php include 'footer.php' ?>
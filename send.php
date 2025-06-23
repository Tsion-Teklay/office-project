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

</script>
<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$sender_id = $_SESSION['user_id'];
$send_type = $_POST['send_type'] ?? '';
$receivers = $_POST['receivers'] ?? [];

if (empty($receivers)) {
    die("Please select at least one receiver.");
}

// === 📩 MESSAGE MODE ===
if ($send_type === 'message') {
    $message = trim($_POST['message_content']);
    if (empty($message)) {
        die("Message content cannot be empty.");
    }

    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, content) VALUES (?, ?, ?)");
    foreach ($receivers as $receiver_id) {
        $stmt->execute([$sender_id, $receiver_id, $message]);
    }

    header("Location: dashboard.php?success=message_sent");
    exit;
}

// === 📁 FILE MODE ===
if ($send_type === 'file') {
    $file_type = $_POST['file_type'] ?? '';
    $deadline = $_POST['deadline'] ?? '';
    $allowed_extensions = ['pdf', 'docx', 'xlsx', 'dwg'];

    if (empty($file_type) || empty($deadline)) {
        die("Please fill out all file fields.");
    }

    if (!isset($_FILES['uploaded_file']) || $_FILES['uploaded_file']['error'] !== 0) {
        die("Error uploading file.");
    }

    $originalName = $_FILES['uploaded_file']['name'];
    $tmpPath = $_FILES['uploaded_file']['tmp_name'];
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_extensions)) {
        die("Invalid file type. Only PDF, DOCX, XLSX, and DWG allowed.");
    }

    // Unique file name to prevent overwrite
    $uniqueName = time() . '_' . basename($originalName);
    $destination = "uploads/" . $uniqueName;

    if (!move_uploaded_file($tmpPath, $destination)) {
        die("Failed to save file.");
    }

    // Insert into `files` table
    $stmt = $pdo->prepare("INSERT INTO files (sender_id, receiver_id, file_name, file_type, deadline) VALUES (?, ?, ?, ?, ?)");

    foreach ($receivers as $receiver_id) {
        $stmt->execute([$sender_id, $receiver_id, $uniqueName, $file_type, $deadline]);
    }

    header("Location: dashboard.php?success=file_sent");
    exit;
}

die("Invalid send type.");

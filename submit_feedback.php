<?php
require 'config.php';

$name = trim($_POST['client_name'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name && $message) {
    $stmt = $pdo->prepare("INSERT INTO client_feedback (name, message) VALUES (?, ?)");
    $stmt->execute([$name, $message]);
    header("Location: index.php?success=1");
    exit;
} else {
    header("Location: index.php?error=1");
    exit;
}

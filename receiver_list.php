<?php
session_start();
require 'config.php';

$send_type = $_GET['send_type'] ?? '';
$file_type = $_GET['file_type'] ?? '';
$current_user_id = $_SESSION['user_id'];
$current_role = $_SESSION['user_role'];

$receivers = [];

if ($send_type === 'message') {
    $stmt = $pdo->prepare("SELECT id, name, role FROM users WHERE id != ?");
    $stmt->execute([$current_user_id]);
    $receivers = $stmt->fetchAll();
}

if ($send_type === 'file') {
    if ($file_type === 'file1' || $file_type === 'file2') {
        $stmt = $pdo->prepare("SELECT id, name, role FROM users WHERE role IN ('admin', 'coordinator')");
        $stmt->execute();
    } elseif ($file_type === 'file3') {
        $stmt = $pdo->prepare("SELECT id, name, role FROM users WHERE role IN ('admin', 'coordinator') AND id != ?");
        $stmt->execute([$current_user_id]);
    } elseif ($file_type === 'file4') {
        $stmt = $pdo->prepare("SELECT id, name, role FROM users WHERE role = 'employee'");
        $stmt->execute();
    } else {
        // Fallback: get all except self
        $stmt = $pdo->prepare("SELECT id, name, role FROM users WHERE id != ?");
        $stmt->execute([$current_user_id]);
    }

    $receivers = $stmt->fetchAll();
}

// Output checkboxes
foreach ($receivers as $r) {
    echo "<label><input type='checkbox' name='receivers[]' value='{$r['id']}'> {$r['name']} ({$r['role']})</label><br>";
}

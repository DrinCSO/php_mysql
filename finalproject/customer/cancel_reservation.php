<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/session.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$reservation_id = $_GET['id'] ?? null;

if ($reservation_id) {
    $stmt = $pdo->prepare("DELETE FROM reservations WHERE id = ? AND user_id = ?");
    if ($stmt->execute([$reservation_id, $user_id])) {
        header("Location: dashboard.php");
        exit();
    }
}
header("Location: dashboard.php");
exit();

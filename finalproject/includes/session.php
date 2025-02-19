<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}


$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user_role = $stmt->fetchColumn();


$_SESSION['role'] = $user_role;
?>

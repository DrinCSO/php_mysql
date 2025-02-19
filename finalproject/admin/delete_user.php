<?php
require_once '../includes/session.php';
require_once '../includes/config.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../dashboard.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $delete->execute([$id]);
}

header("Location: manage.php");
exit();
?>

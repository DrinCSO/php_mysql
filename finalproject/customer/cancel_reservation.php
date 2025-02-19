<?php
require_once '../includes/session.php';
require_once '../includes/config.php';

if ($_SESSION['role'] !== 'customer') {
    header("Location: ../dashboard.php");
    exit();
}

if (isset($_GET['id'])) {
    $reservation_id = $_GET['id'];

    // Check if the reservation belongs to the logged-in user
    $stmt = $pdo->prepare("SELECT * FROM reservations WHERE id = ? AND user_id = ?");
    $stmt->execute([$reservation_id, $_SESSION['user_id']]);
    $reservation = $stmt->fetch();

    if ($reservation) {
        // Update status to cancelled
        $update = $pdo->prepare("UPDATE reservations SET status = 'cancelled' WHERE id = ?");
        $update->execute([$reservation_id]);
    }
}

header("Location: dashboard.php");
exit();
?>

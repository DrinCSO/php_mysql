<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/session.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch reservations with table number
$stmt = $pdo->prepare("SELECT r.*, t.table_number FROM reservations r JOIN tables t ON r.table_id = t.id WHERE r.user_id = ?");
$stmt->execute([$user_id]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Restaurant</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../customer/add_reservation.php">Make a Reservation</a></li>
                    <li class="nav-item"><a class="nav-link active" href="../customer/dashboard.php">My Reservations</a></li>
                    <li class="nav-item"><a class="nav-link" href="../assets/about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="../assets/contact.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="../customer/reviews.php">Reviews</a></li>

                    <li class="nav-item"><a class="nav-link btn btn-danger text-white ms-2" href="../auth/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

<div class="container mt-5">
    <h2>My Reservations</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Table Number</th>
                <th>Date</th>
                <th>Time</th>
                <th>Guests</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $res) : ?>
                <tr>
                    <td><?= htmlspecialchars($res['table_number']) ?></td>
                    <td><?= htmlspecialchars($res['reservation_date']) ?></td>
                    <td><?= htmlspecialchars($res['reservation_time']) ?></td>
                    <td><?= htmlspecialchars($res['guests']) ?></td>
                    <td><?= htmlspecialchars($res['status']) ?></td>
                    <td>
                        <?php if ($res['status'] !== 'cancelled'): ?>
                            <a href="cancel_reservation.php?id=<?= $res['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to cancel this reservation?')">Cancel</a>
                        <?php else: ?>
                            <span class="text-muted">Cancelled</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

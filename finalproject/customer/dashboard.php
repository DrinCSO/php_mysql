<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/session.php';

// Redirect if not logged in or not a customer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user reservations
$stmt = $pdo->prepare("SELECT * FROM reservations WHERE user_id = ?");
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Restaurant</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="add_reservation.php">Make a Reservation</a></li>
                <li class="nav-item"><a class="nav-link active" href="dashboard.php">My Reservations</a></li>
                <li class="nav-item"><a class="nav-link" href="../assets/about.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="../assets/contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link btn btn-danger text-white ms-2" href="../auth/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>Your Reservations</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Guests</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $res): ?>
                <tr>
                    <td><?= $res['id'] ?></td>
                    <td><?= $res['reservation_date'] ?></td>
                    <td><?= $res['reservation_time'] ?></td>
                    <td><?= $res['guests'] ?></td>
                    <td><span class="badge bg-<?= $res['status'] === 'approved' ? 'success' : ($res['status'] === 'pending' ? 'warning' : 'danger') ?>"><?= ucfirst($res['status']) ?></span></td>
                    <td>
                        <?php if ($res['status'] === 'pending' || $res['status'] === 'approved'): ?>
                            <a href="payment.php?reservation_id=<?= $res['id'] ?>" class="btn btn-success btn-sm">Pay</a>
                            <a href="cancel.php?reservation_id=<?= $res['id'] ?>" class="btn btn-danger btn-sm">Cancel</a>
                        <?php else: ?>
                            <span class="text-muted">No Actions</span>
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

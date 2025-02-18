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
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $guests = $_POST['guests'];
    $table_id = $_POST['table_id'];

    // Insert reservation
    $stmt = $pdo->prepare("INSERT INTO reservations (user_id, table_id, reservation_date, reservation_time, status) VALUES (?, ?, ?, ?, 'pending')");
    if ($stmt->execute([$user_id, $table_id, $reservation_date, $reservation_time])) {
        $message = "<div class='alert alert-success'>Reservation request submitted successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error making reservation.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Reservation</title>
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
                <li class="nav-item"><a class="nav-link active" href="add_reservation.php">Make a Reservation</a></li>
                <li class="nav-item"><a class="nav-link" href="dashboard.php">My Reservations</a></li>
                <li class="nav-item"><a class="nav-link" href="../assets/about.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="../assets/contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link btn btn-danger text-white ms-2" href="../auth/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>Make a Reservation</h2>
    <?= $message ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" class="form-control" name="reservation_date" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Time</label>
            <input type="time" class="form-control" name="reservation_time" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Guests</label>
            <input type="number" class="form-control" name="guests" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Reserve</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

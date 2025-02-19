<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/session.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $guests = $_POST['guests'];
    $table_number = $_POST['table_number'];

    
    if ($table_number < 1 || $table_number > 60) {
        $message = "<div class='alert alert-danger'>Table number must be between 1 and 60.</div>";
    } elseif ($guests < 1) {
        $message = "<div class='alert alert-danger'>Guests must be at least 1.</div>";
    } else {
        if (!empty($reservation_date) && !empty($reservation_time) && !empty($guests) && !empty($table_number)) {
           
            $stmt = $pdo->prepare("SELECT id FROM tables WHERE table_number = ?");
            $stmt->execute([$table_number]);
            $table = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$table) {
               
                $stmt = $pdo->prepare("INSERT INTO tables (table_number, capacity) VALUES (?, ?)");
                $stmt->execute([$table_number, $guests]);
                $table_id = $pdo->lastInsertId(); 
            } else {
                $table_id = $table['id']; 
            }

           
            $stmt = $pdo->prepare("SELECT id FROM reservations WHERE table_id = ? AND reservation_date = ?");
            $stmt->execute([$table_id, $reservation_date]);
            $existing_reservation = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existing_reservation) {
               
                $message = "<div class='alert alert-danger'>Table $table_number is already booked for this date. Please choose another table or date.</div>";
            } else {
               
                $stmt = $pdo->prepare("INSERT INTO reservations (user_id, table_id, reservation_date, reservation_time, guests, status) VALUES (?, ?, ?, ?, ?, 'pending')");
                if ($stmt->execute([$user_id, $table_id, $reservation_date, $reservation_time, $guests])) {
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $message = "<div class='alert alert-danger'>Error making reservation.</div>";
                }
            }
        } else {
            $message = "<div class='alert alert-danger'>All fields are required.</div>";
        }
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
    <h2>Make a Reservation</h2>
    <?= $message ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label">Table Number (1-60)</label>
            <input type="number" class="form-control" name="table_number" min="1" max="60" required>
        </div>
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
            <input type="number" class="form-control" name="guests" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Reserve</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

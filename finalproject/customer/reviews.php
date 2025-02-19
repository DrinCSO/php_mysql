<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/session.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch reservations for the user
$stmt = $pdo->prepare("SELECT id, reservation_date FROM reservations WHERE user_id = ?");
$stmt->execute([$user_id]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle review submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservation_id = $_POST['reservation_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Validate input
    if ($reservation_id && $rating && !empty($comment)) {
        $stmt = $pdo->prepare("INSERT INTO reviews (user_id, reservation_id, rating, comment, review_date) VALUES (?, ?, ?, ?, NOW())");
        if ($stmt->execute([$user_id, $reservation_id, $rating, $comment])) {
            $success = "Review submitted successfully!";
        } else {
            $error = "Failed to submit review. Try again!";
        }
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave a Review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
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
    <h2 class="text-center">Leave a Review</h2>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success; ?></div>
    <?php endif; ?>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST" class="card p-4 shadow">
        <div class="mb-3">
            <label for="reservation_id" class="form-label">Select Reservation</label>
            <select name="reservation_id" id="reservation_id" class="form-select" required>
                <option value="">Choose a reservation</option>
                <?php foreach ($reservations as $res): ?>
                    <option value="<?= $res['id']; ?>">Reservation on <?= $res['reservation_date']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-5)</label>
            <select name="rating" id="rating" class="form-select" required>
                <option value="">Select rating</option>
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very Good</option>
                <option value="5">5 - Excellent</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Your Review</label>
            <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit Review</button>
    </form>

    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

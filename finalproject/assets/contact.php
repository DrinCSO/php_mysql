<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
                    <li class="nav-item"><a class="nav-link" href="add_reservation.php">Make a Reservation</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">My Reservations</a></li>
                    <li class="nav-item"><a class="nav-link" href="../assets/about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="../assets/contact.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-danger text-white ms-2" href="../auth/logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Contact Us</h2>
        <p>Email: contact@restaurant.com</p>
        <p>Phone: +123 456 7890</p>
    </div>
</body>
</html>
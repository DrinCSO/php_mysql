<?php
require_once '../includes/session.php';
require_once '../includes/config.php';


if ($_SESSION['role'] !== 'admin') {
    header("Location: ../dashboard.php");
    exit();
}


$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalReservations = $pdo->query("SELECT COUNT(*) FROM reservations")->fetchColumn();
$totalReviews = $pdo->query("SELECT COUNT(*) FROM reviews")->fetchColumn();
$totalPayments = $pdo->query("SELECT COUNT(*) FROM payments")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100"> 
    <div class="container text-center">
        <h2 class="mb-4">Admin Dashboard</h2>
        <div class="row justify-content-center"> 
            <div class="col-md-3">
                <div class="card text-center p-3 shadow">
                    <h5>Total Users</h5>
                    <p><?= $totalUsers; ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3 shadow">
                    <h5>Total Reservations</h5>
                    <p><?= $totalReservations; ?></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3 shadow">
                    <h5>Total Reviews</h5>
                    <p><?= $totalReviews; ?></p>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a href="manage.php" class="btn btn-primary">Manage Everything</a>
            <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>

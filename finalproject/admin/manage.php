<?php
require_once '../includes/session.php';
require_once '../includes/config.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../dashboard.php");
    exit();
}

$users = $pdo->query("SELECT id, name, email, role FROM users")->fetchAll(PDO::FETCH_ASSOC);
$reservations = $pdo->query("
    SELECT reservations.id, reservations.user_id, reservations.table_id, tables.table_number, 
           reservations.reservation_date, reservations.reservation_time, reservations.status
    FROM reservations
    JOIN tables ON reservations.table_id = tables.id
")->fetchAll(PDO::FETCH_ASSOC);
$reviews = $pdo->query("SELECT * FROM reviews")->fetchAll(PDO::FETCH_ASSOC);
$payments = $pdo->query("SELECT * FROM payments")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">Manage Users, Reservations, Reviews</h2>

        <div class="mt-4">
            <h4>Users</h4>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id']; ?></td>
                            <td><?= $user['name']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['role']; ?></td>
                            <td>
                                <a href="edit_user.php?id=<?= $user['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="delete_user.php?id=<?= $user['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <h4>Reservations</h4>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th><th>User ID</th><th>Table ID</th><th>Table Number</th><th>Date</th><th>Time</th><th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $res): ?>
                        <tr>
                            <td><?= $res['id']; ?></td>
                            <td><?= $res['user_id']; ?></td>
                            <td><?= $res['table_id']; ?></td>
                            <td><?= $res['table_number']; ?></td>
                            <td><?= $res['reservation_date']; ?></td>
                            <td><?= $res['reservation_time']; ?></td>
                            <td><?= $res['status']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <h4>Reviews</h4>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th><th>User ID</th><th>Review</th><th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reviews as $review): ?>
                        <tr>
                            <td><?= $review['id']; ?></td>
                            <td><?= $review['user_id']; ?></td>
                            <td><?= htmlspecialchars($review['comment']) ?></td>
                            <td><?= $review['rating']; ?>/5</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        

        <div class="text-center mt-4">
            <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
            <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>
</html>

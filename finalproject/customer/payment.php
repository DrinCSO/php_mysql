<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/session.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_POST['pay'])) {
    $reservation_id = $_POST['reservation_id'];
    $amount = $_POST['amount'];
    
    
    $stmt = $pdo->prepare("INSERT INTO payments (reservation_id, amount) VALUES (?, ?)");
    if ($stmt->execute([$reservation_id, $amount])) {
        echo "Payment successful!";
    } else {
        echo "Payment failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Make a Payment</h2>
        <form action="payment.php" method="POST">
            <input type="hidden" name="reservation_id" value="<?= $_GET['reservation_id'] ?>">
            <div class="mb-3">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control" required>
            </div>
            <button type="submit" name="pay" class="btn btn-primary">Pay Now</button>
        </form>
    </div>
</body>
</html>

<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Please login to make a reservation.");
}

if (isset($_GET['table_id'])) {
    $table_id = $_GET['table_id'];
    $user_id = $_SESSION['user_id'];
    $date = date('Y-m-d'); // Current date
    $time = date('H:i:s'); // Current time
    
    $sql = "INSERT INTO reservations (user_id, table_id, reservation_date, reservation_time) 
            VALUES ('$user_id', '$table_id', '$date', '$time')";
    if ($conn->query($sql) === TRUE) {
        $conn->query("UPDATE tables SET status='reserved' WHERE id='$table_id'");
        echo "Table reserved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

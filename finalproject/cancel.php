<?php
include 'db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE reservations SET status='cancelled' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Reservation cancelled!";
    }
}
?>

<?php
include 'db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE reservations SET status='approved' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Reservation approved!";
    }
}
?>

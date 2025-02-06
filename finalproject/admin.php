<?php
include 'db.php';
$sql = "SELECT reservations.id, users.name, tables.table_number, reservations.reservation_date, reservations.status 
        FROM reservations 
        JOIN users ON reservations.user_id = users.id 
        JOIN tables ON reservations.table_id = tables.id";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "Reservation #" . $row['id'] . " - " . $row['name'] . " booked Table " . $row['table_number'] . " on " . $row['reservation_date'] . 
         " - Status: " . $row['status'] . 
         " [<a href='approve.php?id=" . $row['id'] . "'>Approve</a>] 
           [<a href='cancel.php?id=" . $row['id'] . "'>Cancel</a>]<br>";
}
?>

<?php
include 'db.php';
$sql = "SELECT * FROM tables WHERE status='available'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo "Table " . $row['table_number'] . " (Capacity: " . $row['capacity'] . ") - <a href='reserve.php?table_id=" . $row['id'] . "'>Reserve</a><br>";
}
?>

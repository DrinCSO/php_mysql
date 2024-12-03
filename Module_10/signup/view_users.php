<?php

$host = 'localhost';
$dbname = 'user_management';
$username = "root";
$password = "root"; //$password = "";

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    //Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connected";

    //Fetch all the data from the users table
    $sql = "SELECT id, username, email, created_at FROM users";
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

}catch(PDOException $e){
    echo "Error: ".$e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html> 
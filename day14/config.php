<?php
$host = 'localhost';
$dbname ='mms';
$username = 'root';
$pass = ' ';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO:ERRMODE_EXCEPTION);
    echo "Connected!!";
}catch(PDOException $e){
    echo "Database connection failed: ".$e->getMessage();
}
?> 
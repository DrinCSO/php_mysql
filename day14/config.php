<?php
$user = 'root';
$password = '';
$server = 'localhost';
$dbname ='mms';

try{
    $conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $password);
    //echo "Connected!!";
}catch(PDOException $e){
    echo "Database connection failed: ".$e->getMessage();
}
?> 
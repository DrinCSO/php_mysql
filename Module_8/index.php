<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = "testdb";

try{
    $pdo = new PDO("mysql:host=$host; dbname=$db", $user, $pass);

    //$sql = "CREATE TABLE users (id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    //username VARCHAR(30) NOT NULL,
    //password VARCHAR(30) NOT NULL )";

    //$pdo -> exec($sql);

   // echo "Table created successfully";

    //Set the values to be inserted
    $username = "Jack";

    $password = password_ha("mypassword", PASSWORD_DEFAULT);

    //Insert statement for SQL
    $sql = "INSERT INTO users(username, password) VALUES('$username', 'password')";
    
    $pdo -> exec(statement: $sql);

    echo "New "





}catch(Exception $e){
    echo "Error creating table:  ". $e->getMessage();
}
?> 
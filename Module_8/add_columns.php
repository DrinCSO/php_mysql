<?php
//Adding Columns

try{
    //Connect to the database
    $pdo = new PDO("mysql:host=localhost; dbname=new_db", "root", "");

    //Table alqeration SQL
    $sql = "ALTER TABLE users ADD email VARCHAR(255)";

    $pdo ->exec($sql);

    echo "Column created successfully";

}catch(PDOException $e){
    echo "Error creating column", $e->getMessage();
}
?> 
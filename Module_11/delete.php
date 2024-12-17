<?php
include 'db.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = :id";

    $stmt = $pdo >prepare($sql);
    $stmt->bindParam(':id',$id,PDO::PARAM_INT);

    if($stmt->excecute()){
        echo "User deleted succesfully";
    }else{
        echo "Error deleting the user";
    }
}

?>
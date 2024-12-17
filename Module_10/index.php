<?php
require_once 'config.php';

try{
    $sql = "SELECT id, username, email, password FROM users";
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "Error fetching data: ".$e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f9f9f9;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #C1BAA1;
            color: white;
        }
        tr:nth-child(even) {
            background-color: rgb(236, 235, 222);
        }
        tr:hover {
            background-color: rgb(236, 235, 230);
        }
        a {
            text-decoration: none;
            color: rgb(165, 157, 132);
        }
        a:hover {
            color: rgb(170, 157, 132);
            text-decoration: underline;
        }
        .actions a {
            margin-right: 10px;
        }
    </style> 
    </style>
</head>
<body>
    
</body>
</html> 
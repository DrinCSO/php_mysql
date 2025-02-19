<?php
require_once 'config.php';


function getUserRole($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn(); 
}


function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}


function isLoggedIn() {
    return isset($_SESSION['user_id']);
}


function logout() {
    session_destroy();
    header("Location: ../auth/login.php");
    exit();
}
?>

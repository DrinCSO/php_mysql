<?php
require_once 'config.php';

// Get user role
function getUserRole($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn(); // Returns 'admin' or 'customer'
}

// Check if user is admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Logout function
function logout() {
    session_destroy();
    header("Location: ../auth/login.php");
    exit();
}
?>

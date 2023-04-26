<?php

require_once 'includes/dbConnect.php';
// Start a session
session_start();
$adminid = $_POST['adminid'];
$password = $_POST['password'];

try {

    $query = "SELECT * FROM admins WHERE admin_id = :adminid AND password = :password";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':adminid', $adminid);
    $stmt->bindValue(':password', $password);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Admin logged in successfully, redirect to admin dashboard
        header('Location: admin_dashboard.php');
        exit;
    } else {
        // Login failed, redirect back to login page with error message
        header('Location: admin_login.php?error=Invalid%20login%20credentials');
        exit;
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    exit;
}

?>
<?php

require_once 'includes/dbConnect.php';

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: Login.php');
    exit();
}

// get user data
$username = $_SESSION['username'];
$stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute([$username]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

// return user data in JSON format
header('Content-Type: application/json');
echo json_encode($userData);
exit();
?>

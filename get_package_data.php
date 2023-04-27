<?php
// PHP code to retrieve package data from the database
require_once 'includes/dbConnect.php';

$stmt = $conn->query("SELECT package_name FROM packages");
$packages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// return package data as JSON
header('Content-Type: application/json');
echo json_encode($packages);
?>

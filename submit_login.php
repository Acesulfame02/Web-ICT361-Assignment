<?php
// Require database connection file
require_once 'includes/dbConnect.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get input values from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");

    // Bind parameters
    $stmt->bindParam(':username', $username);

    // Execute SQL statement
    $stmt->execute();

    // Fetch user data from database
    $user = $stmt->fetch();

    // Check if user exists and is active
if ($user) {
    if ($user['is_active'] == 1) {
        // Verify password
        if (password_verify($password, $user['password'])) {

            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Set cookie for username
            setcookie('username', $user['username'], time() + (86400 * 30), "/"); // Cookie expires in 30 days

            // Redirect to profile form
            header('Location: profile_form.php');
            exit();
        } else {
            // Password is incorrect
            header('Location: login.php?error=Invalid Password');
            exit();
        }
    } else {
        // User is not active
        header('Location: verification.php');
        exit();
    }
} else {
    // User not found
    header('Location: login.php?error=invalid_username');
    exit();
}
}

?>
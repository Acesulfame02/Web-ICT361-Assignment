<<<<<<< HEAD
<?php
require_once 'includes/dbConnect.php';

// Validate form input
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['captcha'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $captcha = $_POST['captcha'];

    // Check if password matches confirm_password
    if ($password != $confirm_password) {
        header("Location: Register.php?error=Password+and+confirm+password+do+not+match.");
        exit();
    }

    // Check if captcha is correct
    session_start();
    if ($_SESSION['captcha'] != $captcha) {
        header("Location: Register.php?error=Invalid+captcha.");
        exit();
    }
    
    // Check if username already exists
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            header("Location: Register.php?error=Username+already+exists.");
            exit();
        }
    
    } catch(PDOException $e) {
        header("Location: Register.php?error=" . $e->getMessage());
        exit();
    }
    
    // Generate password hash
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Generate verification token
    $verify_token = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
    
    // Set token expiry time to 20 minutes from now.
    $verify_time = date('Y-m-d H:i:s', strtotime('+20 minutes'));
    
    // Insert user into database with verification info
    try {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, verify_token, verify_time) VALUES (:username, :email, :password, :verify_token, :verify_time)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':verify_token', $verify_token);
        $stmt->bindParam(':verify_time', $verify_time);
        $stmt->execute();
    
        header("Location: verification1.php");
    
    } catch(PDOException $e) {
        header("Location: Register.php?error=" . $e->getMessage());
        exit();
    }

} else {
    header("Location: Register.php?error=Missing+form+input.");
}

?>
=======
<?php
require_once 'includes/dbConnect.php';

// Validate form input
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['captcha'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $captcha = $_POST['captcha'];

    // Check if password matches confirm_password
    if ($password != $confirm_password) {
        header("Location: Register.php?error=Password+and+confirm+password+do+not+match.");
        exit();
    }

    // Check if captcha is correct
    session_start();
    if ($_SESSION['captcha'] != $captcha) {
        header("Location: Register.php?error=Invalid+captcha.");
        exit();
    }
    
    // Check if username already exists
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            header("Location: Register.php?error=Username+already+exists.");
            exit();
        }
    
    } catch(PDOException $e) {
        header("Location: Register.php?error=" . $e->getMessage());
        exit();
    }
    
    // Generate password hash
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Generate verification token
    $verify_token = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
    
    // Set token expiry time to 20 minutes from now.
    $verify_time = date('Y-m-d H:i:s', strtotime('+20 minutes'));
    
    // Insert user into database with verification info
    try {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, verify_token, verify_time) VALUES (:username, :email, :password, :verify_token, :verify_time)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':verify_token', $verify_token);
        $stmt->bindParam(':verify_time', $verify_time);
        $stmt->execute();
    
        header("Location: verification1.php");
    
    } catch(PDOException $e) {
        header("Location: Register.php?error=" . $e->getMessage());
        exit();
    }

} else {
    header("Location: Register.php?error=Missing+form+input.");
}

?>
>>>>>>> 246a15c096a35ade5f083b3e0c02ceefe2eca41b

<?php
require_once 'includes/dbConnect.php';
include_once 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;

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

        // Send verification email to user
        $mail = new PHPMailer(true); // Create new PHPMailer instance
        try {
            // Server settings
            $mail->isSMTP(); // Send using SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to use
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'aaronmasembemujabikalibala@gmail.com'; // Your Gmail address
            $mail->Password = 'atdzvrcamxnptwpd'; // Your Gmail password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('aaronmasembemujabikalibala@gmail.com', 'Finness');
            $mail->addAddress($email, $username); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Verify your account';
            $mail->Body    = "Hi $username,<br><br>
                                Please use the following token to verify your account: <strong>$verify_token</strong>.<br><br> 
                                Thank you for registering with us!<br><br>
                                Best regards,<br>Team Example";

            $mail->send();
            
            header("Location: verification.php");
    
        } catch (Exception $e) {
            header("Location: Register.php?error=Verification+email+could+not+be+sent.");
            exit();
        }
    
    } catch(PDOException $e) {
        header("Location: Register.php?error=" . $e->getMessage());
        exit();
    }

} else {
    header("Location: Register.php?error=Missing+form+input.");
}

?>
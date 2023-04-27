<?php
require_once 'includes/dbConnect.php';
include_once 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the verification token from the form input
    $token = $_POST['token'];
    
    // Prepare a PDO statement to select the user with the matching verification token and still valid
    $stmt = $conn->prepare('SELECT * FROM users WHERE verify_token = :token AND verify_time > NOW()');
    $stmt->execute(['token' => $token]);
    
    // Check if a user was found with the matching verification token and it is still valid
    if ($stmt->rowCount() > 0) {
        // Get the user ID and update the "is_active" column to 1
        $user = $stmt->fetch();
        $user_id = $user['username'];
        $update_stmt = $conn->prepare('UPDATE users SET is_active = 1 WHERE username= :username');
        $update_stmt->execute(['username' => $user_id]);
        
        // Verification successful, redirect to success page
        header('Location: Login.php');
        exit;
    } else {
        // Prepare a PDO statement to select the user with the matching verification token and expired time
        $stmt = $conn->prepare('SELECT * FROM users WHERE verify_token = :token AND verify_time <= NOW()');
        $stmt->execute(['token' => $token]);
        
        // Check if a user was found with the matching verification token and expired time
        if ($stmt->rowCount() > 0) {
            // Generate a new 6 character verification token
            $new_token = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
            
            // Update the verification token and verification time in the database
            $user = $stmt->fetch();
            $user_id = $user['username'];
            $update_stmt = $conn->prepare('UPDATE users SET verify_token = :token, verify_time = DATE_ADD(NOW(), INTERVAL 30 MINUTE) WHERE username= :username');
            $update_stmt->execute(['token' => $new_token, 'username' => $user_id]);
            

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
                                    Please use the following token to verify your account: <strong>$new_token</  strong>.<br><br> 
                                    Thank you for registering with us!<br><br>
                                    Best regards,<br>Team Example";

                $mail->send();

                header('Location: verification.php?error=expired_token');
            
            } catch (Exception $e) {
                header("Location: verification.php?error=Verification+email+could+not+be+sent.");
                exit();
            }
            exit;
        } else {
            // Verification failed, redirect back to login form with error message
            header('Location: verification.php?error=invalid_token');
            exit;
        }
    }
} else {
    // Redirect back to login form if accessed directly
    header('Location: Login.php');
    exit;
}
?>
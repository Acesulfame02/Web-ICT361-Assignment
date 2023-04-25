<?php
    $page_title = "Verification Page";
    include('includes/Header.php'); 
    include('includes/Nav-bar.php');
?>

<?php
// Require database connection file
require_once 'includes/dbConnect.php';

// Get verification token from form submission
$token = $_POST['token'];

// Prepare SQL statement to get user with matching verification token
$stmt = $conn->prepare("SELECT * FROM users WHERE verify_token = :token");

// Bind parameters
$stmt->bindParam(':token', $token);

// Execute SQL statement
$stmt->execute();

// Fetch user data from database
$user = $stmt->fetch();

// Check if user exists and verification token is not expired
if ($user && $user['verify_time'] > date('Y-m-d H:i:s')) {

    // Update user's is_active field to 1
    try {
        $stmt = $conn->prepare("UPDATE users SET is_active = 1 WHERE username = :username");
        $stmt->bindParam(':username', $user['username']);
        $stmt->execute();

        // Redirect to login page with success message
        header('Location: login.php?success=Your account has been successfully verified. Please log in.');
        exit();

    } catch(PDOException $e) {
        // Redirect to error page if database update fails
        header('Location: error.php?error=' . $e->getMessage());
        exit();
    }

} else {
    // Generate new verification token and update database with new token and expiry time
    $new_token = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
    $new_verify_time = date('Y-m-d H:i:s', strtotime('+20 minutes'));
    
    try {
        $stmt = $conn->prepare("UPDATE users SET verify_token = :new_token, verify_time = :new_verify_time WHERE username = :username");
        $stmt->bindParam(':new_token', $new_token);
        $stmt->bindParam(':new_verify_time', $new_verify_time);
        $stmt->bindParam(':username', $user['username']);
        $stmt->execute();
    } catch(PDOException $e) {
        // Redirect to error page if database update fails
        header('Location: error.php?error=' . $e->getMessage());
        exit();
    }

    // Reload page with new verification token
    header('Location: verification.php');
    exit();
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-5">Verification</h1>
    <?php if (isset($errorMsg)): ?>
    <div class="alert alert-danger text-center" role="alert">
      <?php echo $errorMsg; ?>
    </div>
    <?php endif; ?>
    <form action="" method="post" class="text-center">
      <div class="form-group">
        <label for="token">Enter verification token:</label>
        <input type="text" id="token" name="token" class="form-control" required>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<?php include('includes/Footer.php'); ?>
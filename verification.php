<?php
    $page_title = "Verification Page";
    include('includes/Header.php'); 
    include('includes/Nav-bar.php');
?>

<?php
session_start();
// Check if user is already logged in
if (isset($_SESSION['username'])) {
  // User is already logged in, redirect to login page
  header('Location: login.php');
  exit;
}

include 'includes/dbConnect.php';

// Function to generate a new verification token
function generateToken() {
  $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $token = '';
  for ($i = 0; $i < 6; $i++) {
    $index = rand(0, strlen($chars) - 1);
    $token .= $chars[$index];
  }
  return $token;
}

if (isset($_POST['submit'])) {
  // Get entered verification token from form
  $token = $_POST['token'];
  
  // Get user info from database based on email
  $email = $_SESSION['email'];
  $stmt = $pdo->prepare('SELECT * FROM users WHERE email=:email');
  $stmt->execute(['email' => $email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  
  // Check if token is correct and not expired
  $expireTime = strtotime('+30 minutes', strtotime($user['verify_time']));
  if ($user['verify_token'] === $token && time() <= $expireTime) {
    // Verification successful, update database and redirect to login page
    $stmt = $pdo->prepare('UPDATE users SET is_active=1 WHERE email=:email');
    $stmt->execute(['email' => $email]);
    header('Location: login.php');
    exit;
  } else {
    // Token is incorrect or expired, generate new token and update database
    $newToken = generateToken();
    $stmt = $pdo->prepare('UPDATE users SET verify_token=:token, verify_time=NOW() WHERE email=:email');
    $stmt->execute(['token' => $newToken, 'email' => $email]);
    $errorMsg = 'Invalid or expired token. A new verification token has been sent to your email.';
  }
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
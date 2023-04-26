<?php 
    $page_title = "Register Page";
    include('includes/Header.php'); 
    include('includes/Nav-bar.php'); 
?>

<div class="register-info">
  <div class="register-form">
    <h3>Register</h3>
    <form method="POST" action="submit_register.php">
      <div class="input-group">
        <?php
        if (isset($_GET['error'])) {
            echo '<p style="color:red;">Error: ' . $_GET['error'] . '</p>';
        }
        ?>
          <label for="username">Username</label>
          <input type="text" class="input-field" name="username" id="username" placeholder="Enter your name">
          <label for="email">Email address</label>
          <input type="email" class="input-field" name="email" id="email"aria-describedby="emailHelp"placeholder="Enter email">
          <label for="password">Password</label>
          <input type="password" name="password" class="input-field" id="password" placeholder="Password">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" class="input-field" name="confirm_password"id="confirm_password"placeholder="Confirm Password">
          <label for="captcha">Captcha</label>
          <img src="captcha.php" alt="Captcha" width="300" height="100">
          <input type="text" class="input-field" name="captcha" id="captcha" placeholder="Enter Captcha">
          <p>Already Have an account <a href="Login.php">login</a></p>
          <div class="btn-field">
            <button type="submit" class="btn">Register</button>
          </div>
      </div>
    </form>
  </div>
</div>

<?php include('includes/Footer.php'); ?>
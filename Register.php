<?php 
    $page_title = "Register Page";
    include('includes/Header.php'); 
    include('includes/Nav-bar.php'); 
?>

<div class="card-header bg-primary text-white text-center">
    <h3>Register</h3>
</div>
<div class="card-body">
  <form method="POST" action="submit_register.php">
    <?php
    if (isset($_GET['error'])) {
        echo '<p style="color:red;">Error: ' . $_GET['error'] . '</p>';
    }
    ?>
    <div class="form-group mb-3">
      <label for="username" class="col-sm-2 col-form-label d-block">Username</label>
      <div class="col-sm-10 d-block">
        <input type="text" class="form-control" name="username" id="username" placeholder="Enter your name">
      </div>
    </div>
    <div class="form-group mb-3">
      <label for="email" class="col-form-label d-block">Email address</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="email" id="email"aria-describedby="emailHelp"placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted d-block">We'll never share your email with anyoneelse.<small>
      </div>
    </div>
    <div class="form-group mb-3">
      <label for="password" class="col-sm-2 col-form-label d-block">Password</label>
      <div class="col-sm-10">
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      </div>
    </div>
    <div class="form-group mb-3">
      <label for="confirm_password" class="col-form-label d-block">Confirm Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" name="confirm_password"id="confirm_password"placeholder="Confirm Password">
      </div>
    </div>
    <div class="form-group mb-3">
      <label for="captcha" class="col-sm-2 col-form-label d-block">Captcha</label>
      <div class="col-sm-5">
        <img src="captcha.php" alt="Captcha" width="400" height="100">
      </div>
      <div class="col-sm-5">
        <input type="text" class="form-control d-block" name="captcha" id="captcha" placeholder="Enter Captcha">
      </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Register</button>
  </form>
    
</div>
<?php include('includes/Footer.php'); ?>
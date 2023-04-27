<?php
    $page_title = "Verification Page";
    include('includes/Header.php'); 
    include('includes/Nav-bar.php');
?>

<div class="container mt-5">
    <h1 class="text-center mb-5">Verification</h1>
    <form action="" method="POST" class="text-center">
      <div class="form-group">
        <label for="token">Enter verification token:</label>
        <input type="text" id="token" name="token"  required>
      </div>
      <button type="submit" name="submit">Submit</button>
    </form>
</div>


<?php include('includes/Footer.php'); ?>
<?php 
    $page_title = "Login Page";
    include('includes/Header.php'); 
    include('includes/Nav-bar.php'); 
?>

<div class="login-info">
    <div class="login-form">
        <h2>Login</h2>
        <?php
            if (isset($_GET['error'])) {
                echo '<p style="color:red;">Error: ' . $_GET['error'] . '</p>';
            }
        ?>
        <form action="submit_login.php" method="POST">
            <div class="input-group">
                <div class="input-field" id="nameField">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="username" placeholder="Name" />
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-unlock-keyhole"></i>
                    <input type="password" name="password" placeholder="Password" />
                </div>
                    <p>Don't Have an account <a href="Register.php">register</a></p>
                <div class="btn-field">
                    <button type="submit" >Login in</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('includes/Footer.php'); ?>
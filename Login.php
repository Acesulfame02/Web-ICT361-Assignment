<?php 
    $page_title = "Login Page";
    include('includes/Header.php'); 
    include('includes/Nav-bar.php'); 
?>

<div class="login-info">
    <div class="login-form">
        <h2>Login</h2>
        <form action="submit_login" method="POST">
            <div class="input-group">
                <div class="input-field" id="nameField">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="Name" placeholder="Name" />
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-unlock-keyhole"></i>
                    <input type="password" name="Password" placeholder="Password" />
                </div>
                    <p>Don't Have an account <a href="Register.php">register</a></p>
                </div>
                <div class="btn-field">
                    <button type="button" >Login in</button>
                </div>
        </form>
    </div>
</div>

<?php include('includes/Footer.php'); ?>
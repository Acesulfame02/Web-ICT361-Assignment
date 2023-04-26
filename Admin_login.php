<?php 
    $page_title = "Admin Login Page";
    include('includes/Header.php'); 
    include('includes/Nav-bar.php'); 
?>

<div class="login-info">
    <div class="login-form">
        <h2>Admin Login</h2>
        <?php
            if (isset($_GET['error'])) {
                echo '<p style="color:red;">Error: ' . $_GET['error'] . '</p>';
            }
        ?>
        <form action="admin_submit_login.php" method="POST">
            <div class="input-group">
                <div class="input-field" id="nameField">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="adminid" placeholder="Admin ID" />
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-unlock-keyhole"></i>
                    <input type="password" name="password" placeholder="Password" />
                </div>
                <div class="btn-field">
                    <button type="submit" >Login in</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('includes/Footer.php'); ?>
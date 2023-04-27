<?php
    $page_title = "Verification Page";
    include('includes/Header.php'); 
    include('includes/Nav-bar.php');
?>

<div class="login-info">
    <div class="login-form">
        <h2>Account Verification</h2>
        <?php
            if (isset($_GET['error'])) {
                echo '<p style="color:red;">Error: ' . $_GET['error'] . '</p>';
            }
        ?>
        <form action="verification_login.php" method="POST">
            <div class="input-group">
                <div class="input-field">
                    <i class="fa-solid fa-unlock-keyhole"></i>
                    <input type="password" name="token" placeholder="Verification token" />
                </div>
                <div class="btn-field">
                    <button type="submit" >Verify</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php include('includes/Footer.php'); ?>
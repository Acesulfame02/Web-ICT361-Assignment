<?php
// start session
session_start();

// unset session variables
unset($_SESSION['username']);

// destroy session
session_destroy();

// redirect to login page
header('Location: login.php');
exit();
?>

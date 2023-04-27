<?php

require_once 'includes/dbConnect.php';

// start session and check if user is logged in
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// get submitted form data
$username = $_SESSION['username'];
$email = $_POST['email'];
$image = $_FILES['image']['name'];
$image_tmp = $_FILES['image']['tmp_name'];

// save uploaded image to server
if (!empty($image)) {
    $image_dir = "images/" . $image;
    move_uploaded_file($image_tmp, $image_dir);
} else {
    $image_dir = "";
}

// update user data in database
$stmt = $conn->prepare("UPDATE users SET email = :email, image_url = :image_url WHERE username = :username");
$stmt->bindValue(':email', $email);
$stmt->bindValue(':image_url', $image_dir);
$stmt->bindValue(':username', $username);
$stmt->execute();

// redirect to profile page
header('Location: profile_form.php');
exit();

?>

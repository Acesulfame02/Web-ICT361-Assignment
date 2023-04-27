<?php
// PHP code to update the packages table in the database
require_once 'includes/dbConnect.php';

// Start session
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Get form data
  $package_name = $_POST['package_name'];
  $rating = $_POST['rating'];
  $comment = $_POST['comment'];
  $image = $_FILES['image']['name'];
  $image_tmp = $_FILES['image']['tmp_name'];
  $username = $_SESSION['username'];

  // Check if package name and rating are provided
  if (!empty($package_name) && !empty($rating)) {

    // Save uploaded image to server
    if (!empty($image)) {
      $image_dir = "images/" . $image;
      if (!move_uploaded_file($image_tmp, $image_dir)) {
        error_log("Error moving uploaded file to $image_dir");
        echo 'Error uploading image';
        exit;
      }
    } else {
      $image_dir = "";
    }

    // Prepare SQL statement to insert package review data into packages table
    $stmt = $conn->prepare("INSERT INTO package_ratings (package_name, image_url, ratings, username, user_comment) VALUES (:package_name, :image_url, :ratings, :username, :user_comment)");

    // Bind parameters to statement
    $stmt->bindParam(':package_name', $package_name);
    $stmt->bindParam(':image_url', $image_dir);
    $stmt->bindParam(':ratings', $rating);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':user_comment', $comment);

    // Execute statement
    if ($stmt->execute()) {
      // Redirect back to Journeys page
      header('Location: Profile_form.php?page=Journeys');
      exit;
    } else {
      error_log("Error inserting package review data: " . print_r($stmt->errorInfo(), true));
      echo 'Error adding package review data';
    }
  } else {
    echo 'Please provide package name and rating';
  }
}
?>

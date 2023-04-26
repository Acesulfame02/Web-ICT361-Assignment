<?php 
    $page_title = "Detail Page";
    include('includes/Header.php'); 
    include('includes/Nav-bar.php'); 
?>

<?php
 require_once 'includes/dbConnect.php';
// Check if a package ID is provided in the URL
if (isset($_GET['id'])) {
  // Get the package ID from the URL and sanitize it
  $package_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

  // Prepare a SQL statement to select the package with the specified ID
  $stmt = $conn->prepare("SELECT * FROM packages WHERE package_id = :package_id");
  $stmt->bindParam(':package_id', $package_id, PDO::PARAM_INT);
  // Execute the statement
  $stmt->execute();

  // Check if there is a package with the specified ID
  if ($stmt->rowCount() > 0) {
    // Fetch the package information from the result set
    $package = $stmt->fetch(PDO::FETCH_ASSOC);
    // Display the package information
    echo "<div class='info-more' style='background-image: url({$package['image_url']});'>";
    echo "<div class='package-info'>";
    echo "<h1>{$package['package_name']}</h1>";
    echo "<div class='description'>{$package['description']}</div>";
    echo "<div class='price'>Price: {$package['price']}</div>";
    echo "<img src='{$package['image_url']}' alt='{$package['package_name']}'>";
    echo "</div>";
    echo "</div>";
  } else {
    echo "Package not found.";
  }
  
} else {
  echo "No package ID provided.";
}
?>

<?php include('includes/Footer.php'); ?>

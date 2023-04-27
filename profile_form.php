<?php 
    session_start();
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        header('Location: login.php');
        exit();
    }
    $page_title = "Profile Page";
    include('includes/Header.php'); 
    include('includes/Nav-bar.php'); 
?>

<div class="profiler">
    <div class="sidebar">
      <ul>
        <li><a href="#" onclick="changeContent('Journeys')">Journeys</a></li>
        <li><a href="#" onclick="changeContent('Profile')">Profile</a></li>
        <li><a href="#" onclick="changeContent('Logout')">Logout</a></li>
      </ul>
    </div>
    <div class="contenter">
        <h1 id="page-title">Welcome <?php echo $username; ?> back to Our website</h1>
        <div id="page-content">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor,     dignissim     sit amet, adipiscing nec, ultricies sed, dolor.</p>
        </div>
    </div>
</div>

<?php include('includes/Footer.php'); ?>
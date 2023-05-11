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
          <p>Our travel website welcomes you! Your user profile is the key to personalized travel experiences and seamless trip planning. Whether you're a seasoned traveler or embarking on your first adventure, we're here to make your journey unforgettable.</p>
          <br>
          <p>
             With your user profile, you can easily manage travel preferences, save favorite destinations, and access exclusive deals tailored just for you. Our platform offers a wealth of travel resources, including destination guides, insider tips, and customer reviews, to help you make informed decisions and discover hidden gems worldwide.
          </p>
          <br>
          <p>
          By sharing your preferences and interests, we can provide personalized recommendations that match your unique travel style. Whether you crave a relaxing beach escape, thrilling adventures, cultural immersion, or culinary exploration, we have you covered.
          </p>
          <br>
          <p>
          Your user profile also allows you to track bookings, view itineraries, and communicate with our dedicated support team for assistance. We're committed to ensuring your travel experience is smooth and hassle-free.
          </p>
          <br>
          <p>
          Take a moment to set up your user profile and unlock a world of personalized travel possibilities. Let us be your trusted companion on your journey as you create lifelong memories. Happy travels!
          </p>
        </div>
    </div>
</div>

<?php include('includes/Footer.php'); ?>
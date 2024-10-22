<?php 
    $page_title = "Packages Page";
    include('includes/Header.php'); 
    include('includes/Nav-bar.php'); 
    session_start();
?>

<!--Landing Area-->
<div id="landing">
    <div id="landing-text">
        <div id="landing-text-inner">
            <h1>LET'S EXPLORE</h1>
            <h2>packages</h2>
            <img src="images/img.jpg" alt="nature">
        </div>
    </div>
    <div id="landing-image"></div>
</div>
<div id="images">
    <div id="header">
        <h2>Beautifull sites</h2>
    </div>
    <div id="packages">
        <div class="package">
            <a href="package.php?id=1">
                <img src="images/img2.jpg" alt="nature image">
            </a>
            <div class="caption">
                <h3>Victoria falls</h3>
                <p>Location: Livingstone</p>
                <p>Price: k800.00</p>
            </div>
            <a href="<?php echo isset($_SESSION['loggedin']) ? 'profile_form.php' : 'Login.php'; ?>">Click here to buy package</a>
     </div>
    <div class="package">
        <a href="package.php?id=2">
            <img src="images/img3.jpg" alt="nature image">
        </a>
        <div class="caption">
            <h3>Samfya beach</h3>
            <p>Location: Kasama</p>
            <p>Price: k700.00</p>
        </div>
        <a href="<?php echo isset($_SESSION['loggedin']) ? 'profile_form.php' : 'Login.php'; ?>">Click here to buy package</a>
    </div>
    <div class="package">
        <img src="images/img4.jpg" alt="nature image">
        <div class="caption">
            <h3>Muchinga escarpment</h3>
            <p>Location: Muchinga</p>
            <p>Price: k600.00</p>
        </div>
        <a href="<?php echo isset($_SESSION['loggedin']) ? 'profile_form.php' : 'Login.php'; ?>">Click here to buy package</a>
    </div>    
    <div class="package">
        <img src="images/img5.jpg" alt="nature image">
        <div class="caption">
            <h3>Chishimba falls</h3>
            <p>Location: Kasama</p>
            <p>Price: k500.00</p>
        </div>
        <a href="<?php echo isset($_SESSION['loggedin']) ? 'profile_form.php' : 'Login.php'; ?>">Click here to buy package</a>
    </div>
    <div class="package">
        <img src="images/img6.jpg" alt="nature image">
        <div class="caption">
            <h3>South luangwa national park</h3>
            <p>Location: Eastern province</p>
            <p>Price: k400.00</p>
        </div>
        <a href="<?php echo isset($_SESSION['loggedin']) ? 'profile_form.php' : 'Login.php'; ?>">Click here to buy package</a>
        </div>
    </div>          
</div>

<?php include('includes/Footer.php'); ?>
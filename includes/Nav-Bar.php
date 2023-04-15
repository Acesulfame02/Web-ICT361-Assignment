<div class="bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <nav class="navbar navbar-expand-lg navbar-dark ">
          <div class="container-fluid">

            <a class="navbar-brand" href="#">Cloud 7</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link <?php if($active_page == 'Home_Page') echo 'active'; ?>" aria-current="page" href="Home_Page.php">
                  <i class="fa-solid fa-house"></i>
                    Home
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="dashboard.php">DashBoard</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php if($active_page == 'Register') echo 'active'; ?>" href="Register.php">Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php if($active_page == 'login') echo 'active'; ?>" href="login.php">Login</a>
                </li>

              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</div>
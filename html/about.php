<?php

  @include 'config.php';
  session_start();

  // Check both user_name and email
  if (!isset($_SESSION['user_name']) || !isset($_SESSION['email'])) {
      header('location:../index.php');
      exit(); 
  }

  // ONLY for guest user: session timer
  if ($_SESSION['user_name'] === "Guest") {

  // Initialize login time if not set
  if (!isset($_SESSION['login_time'])) {
        $_SESSION['login_time'] = time();
  }

  $sessionDuration = 180; 
  $timeLeft = $sessionDuration - (time() - $_SESSION['login_time']);

  if ($timeLeft <= 0) {
      session_unset();
      session_destroy();
      header("Location: ../index.php?expired=1");
      exit();
  }
  } else {
  $timeLeft = null;
  }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../asset/tablogo1.jpg" type="image/x-icon">
    <title>About</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/about.css">
   

</head>
<body>
    <header>
        <!-- <video src="./asset/theboys.webm" autoplay muted style="margin-top: 370px;"></video> -->
        <nav>
            <div class="header1">
              <a href="#" class="logo"><img src="../asset/logo.png" alt="" srcset="" height="70px" width="260px"> </a>
              <i class='bx bx-menu' id="menu-icon"></i>
              <nav class="navbar">
                <a href="./home.php" class="nav-menu">Home</a>
                <a href="./series.php" class="nav-menu">Series</a>
                <a href="./movie.php" class="nav-menu">Movie</a>
                <a href="#" class="nav-menu">About</a>
                <a href="./contact.php" class="nav-menu">Contact</a>
                <a href="#" class="nav-menu" class="search_user">
                    <input type="text" placeholder="Search..." id="search_input" >
                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 7px;" x="0px" y="0px" width="15px" height="15px" viewBox="0,0,256,256">
                        <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M21,3c-9.39844,0 -17,7.60156 -17,17c0,9.39844 7.60156,17 17,17c3.35547,0 6.46094,-0.98437 9.09375,-2.65625l12.28125,12.28125l4.25,-4.25l-12.125,-12.09375c2.17969,-2.85937 3.5,-6.40234 3.5,-10.28125c0,-9.39844 -7.60156,-17 -17,-17zM21,7c7.19922,0 13,5.80078 13,13c0,7.19922 -5.80078,13 -13,13c-7.19922,0 -13,-5.80078 -13,-13c0,-7.19922 5.80078,-13 13,-13z"></path></g></g>
                    </svg>
                    <!-- SEARCH CONTAINER start     -->
                    <div class="search">
                        <!--  <a href="#" class="search_card">
                              <img src="https://wallpapers.com/images/featured/money-heist-segtwbhffwy01w82.jpg" alt="">
                              <div class="search_details">
                                <h3> The boys </h3>
                                <p>Action ,  2021, <span>IMDB</span><i class="bi bi-star-fill"></i> 9.36 </p>
                              </div>
                              </a> -->
                    </div>
                    <!-- SEARCH CONTAINER END     -->
                </a>
                <!--User Profile Button and Guest Time start -->
                <a href="#" class="nav-menu"><i class="bi bi-person-circle" class="profile-btn" onclick="toggleProfile()"></i></a>
                <p id="guest-timer" style="color: red; font-weight: bold;"></p>
                <!--User Profile Button and Guest Time End -->
              </nav>
            </div>
            <div class="nav-bg"></div>
        </nav>
        <div id="expaire">Guest session expired. Please log in again.</div>
    </header>



    <script src="../javascript/navbar.js"></script>
    <script src="../javascript/search.js"></script>
    <script src="../javascript/guest_session_check.js"></script>




    <section>
          <div class="about">
              <h2>About Us</h2>
              <p> Welcome to <strong>cinegatewa</strong> — where cinema meets code. We're a team of developers who love movies and tech, dedicated to building sleek, responsive, and functional movie-related web apps. Whether you're looking for a place to rate films, browse actor bios, or stream with style — we've got you covered.</p>
              <br><br>
              <h3>Our Vision</h3>
              <p>
                To bring movie magic online with immersive UI/UX design, powerful backend functionality, and a deep love for storytelling through technology.
              </p>
          </div>
    </section>




  <!--================ Start Portfolio =================-->
  <header class="hero-section">
          <div class="text-content">
              <h4>HELL0</h4>
              <h1>I AM <span>GAURAV SHEVKAR</span></h1>
              <p>FRONTEND, BACKEND DEVELOPER</p>
              <div class="buttons">
                <button class="cv-btn"><a href="#cv">GET CV</a></button>
              </div>
          </div>
          <div class="hero-img">
              <img src="../asset/home-right.png" alt="Developer at computer">
          </div>
  </header>
  <section class="about-section">
          <div class="about-img">
              <img src="../asset/about-us.png" alt="Developer illustration">
          </div>
          <div class="about-text" id="cv">
              <h3>Let’s <br><strong>Introduce About Myself</strong></h3>
              <p>
                Whose given. Were gathered. There first subdue greater. Bearing you Whales heaven midst their. Beast creepeth. Fish days.
                <br><br>
                Is give may shall likeness made yielding spirit a itself together created after sea is in beast beginning signs open god you're gathering whose gathered cattle let. Creature whales fruit unto meat the life beginning all in under give two.
              </p>
              <button  class="download-btn"><a href="../asset/GauravShevkar_Resume1.pdf" download>DOWNLOAD CV</a> </button>
          </div>
  </section>
          <div id="userProfile" class="collapse-box">
            <div class="collapse-content">
              <h3>User Information</h3>
              <p> <?php echo $_SESSION['user_name'] ?></p>
              <p><?php echo $_SESSION['email'] ?></p>
              <p><button><a href="../logout.php" class="logout">Logout</a></button></p>
            </div>
          </div>

          <div id="expaire">Guest session expired. Please log in again.</div>


  <script>
        let seconds = <?= $timeLeft ?? 'null' ?>;

        if (seconds !== null) {
        const timerElement = document.getElementById("guest-timer");
        const expireBox = document.getElementById("expaire");

        const interval = setInterval(() => {
        let min = Math.floor(seconds / 60);
        let sec = seconds % 60;
        timerElement.innerText = ` ${min}:${sec < 10 ? '0' : ''}${sec}`;
        seconds--;

        if (seconds === 5) {
            expireBox.style.display = 'flex';
            expireBox.innerText = "Guest session expired. Please log in again.";
        }

        if (seconds === 0) {
            clearInterval(interval);
            window.location.href = "../index.php?expired=1";
        }

    }, 1000);
}
</script>

    
</body>
</html>
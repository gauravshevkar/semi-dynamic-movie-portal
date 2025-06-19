<?php

@include 'config.php';

session_start();

// Check both user_name and email
if (!isset($_SESSION['user_name']) || !isset($_SESSION['email'])) {
    header('location:../index.php');
    exit(); // Always good to add after header
}

// ONLY for guest user: session timer
if ($_SESSION['user_name'] === "Guest") {

    // Initialize login time if not set
    if (!isset($_SESSION['login_time'])) {
        $_SESSION['login_time'] = time();
    }

    $sessionDuration = 180; // seconds (for testing), use 180 for 3 min
    $timeLeft = $sessionDuration - (time() - $_SESSION['login_time']);

    if ($timeLeft <= 0) {
        session_unset();
        session_destroy();
        header("Location: ../index.php?expired=1");
        exit();
    }
} else {
  // If not guest, set timeLeft to null or high value (used in JS maybe)
  $timeLeft = null;
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../asset/tablogo1.jpg" type="image/x-icon">
    <title>Cinegatewa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-HYDNV6M2LW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-HYDNV6M2LW');
</script>



</head>
<body class="nav-open">
    <header>
      <div class="main-banner-container" id="banner"></div>
        <!-- <img src="https://wallpapers.com/images/featured/money-heist-segtwbhffwy01w82.jpg" alt="" class="index-banner" id="banner" > -->
        <!-- <video src="./asset/theboys.webm" autoplay muted style="margin-top: 370px;"></video> -->
        <nav>
            <div class="header1">
              <a href="#" class="logo"><img src="../asset/logo.png" alt="" srcset="" height="70px" width="260px"> </a>
              <i class='bx bx-menu' id="menu-icon"></i>
              <nav class="navbar">
                  <a href="#" class="nav-menu">Home</a>
                  <a href="./series.php" class="nav-menu">Series</a>
                  <a href="./movie.php" class="nav-menu">Movie</a>
                  <a href="./about.php" class="nav-menu">About</a>
                  <a href="./contact.php" class="nav-menu">Contact</a>
                  <a href="#" class="nav-menu" class="search_user">
                      <input type="text" placeholder="Search..." id="search_input" class="search_box" >
                      <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 7px;" x="0px" y="0px" width="15px" height="15px" viewBox="0,0,256,256">
                          <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M21,3c-9.39844,0 -17,7.60156 -17,17c0,9.39844 7.60156,17 17,17c3.35547,0 6.46094,-0.98437 9.09375,-2.65625l12.28125,12.28125l4.25,-4.25l-12.125,-12.09375c2.17969,-2.85937 3.5,-6.40234 3.5,-10.28125c0,-9.39844 -7.60156,-17 -17,-17zM21,7c7.19922,0 13,5.80078 13,13c0,7.19922 -5.80078,13 -13,13c-7.19922,0 -13,-5.80078 -13,-13c0,-7.19922 5.80078,-13 13,-13z"></path></g></g>
                      </svg>
                      <!-- SEARCH CONTAINER start     -->
                      <div class="search">
                          <!-- SEARCH CARD END -->
                          <!-- <a href="#" class="search_card">
                                <img src="https://wallpapers.com/images/featured/money-heist-segtwbhffwy01w82.jpg" alt="">
                                <div class="search_details">
                                  <h3> The boys </h3>
                                  <p>Action ,  2021, <span>IMDB</span><i class="bi bi-star-fill"></i> 9.36 </p>
                                </div>
                              </a> -->
                          <!-- SEARCH CARD END     -->
                      </div>
                      <!-- SEARCH CONTAINER END     -->
                  </a>
                  <!--User Profile Button and Guest Time start -->
                  <span class="nav-menu"><i class="bi bi-person-circle profile-btn"  onclick="toggleProfile()"></i> </span>
                  <span> <p id="guest-timer" style="color: red; font-weight: bold;"></p></span>
                  <!--User Profile Button and Guest Time start -->
                </nav>
            </div>
            <div class="nav-bg"></div>
        </nav>
       

        <!-- <img src="https://wallpapers.com/images/featured/money-heist-segtwbhffwy01w82.jpg" alt="" style="opacity:0.5; background-color: black; position: absolute; top: 15px; width: 100%; height:100%; border-radius: 20px;"> -->
       
        <!-- main_banner Header_top section  -->
        <div class="container">
            <h1 id="title"></h1>
            <div class="details">
                <h5 id="gen"></h5>
                <h4 id="duration"></h4>
                <h4 id="date"></h4>
                <h3 id="rate"></h3>
            </div>
            <br>
            <p id="paragraph"></p>
            <div class="btns">
                <a href="#" id="play">Watch <i class="bi bi-play-circle"></i></a>
                <a href="#" id="download_main"><i class="bi bi-cloud-arrow-down"></i></a>
            </div>
        </div>
        <!-- main_banner Header_top section End -->

      </div>
    </header>


    <script src="../javascript/navbar.js"></script>
    <script src="../javascript/main_banner.js"></script>
    <script src="../javascript/search.js"></script>
   

    <!-- New Release Movies Start-->
  <section>
      <div class="head-card">
          <h2>New Release Movies </h2>
          <a href="./movie.php" class="more">MORE VIDEO</a>
      </div>
      <i class="bi bi-chevron-left new-left"></i>
      <i class="bi bi-chevron-right new-right"></i>
      <div class="cards new_release">
        <!-- <a href="" class="card">
                <img src="./asset/money heist.jpg" alt="" class="poster">
                <div class="rest_card">
                  <img src="./asset/money heist.jpg" alt="">
                  <div class="container_detail">
                      <h4>The Boyz</h4>
                      <div class="sub">
                        <p>Action, 2021</p>
                        <h3><span>IMDB</span><i class="bi bi-star-fill"></i> 9.36</h3>
                      </div>
                    </div>
                </div>
              </a> -->
      </div>
    </section>


<script src="../javascript/new_release.js"></script>

<!-- Most Popular start -->
<section>
      <div class="head-card">
        <h2>Most Popular</h2>
        <a href="./movie.php"  class="more">MORE VIDEO</a>
      </div>
      <i class="bi bi-chevron-left popular-left"></i>
      <i class="bi bi-chevron-right popular-right"></i>
      <div class="cards most_popular">
        <!-- <a href="" class="card">
              <img src="./asset/money heist.jpg" alt="" class="poster">
              <div class="rest_card">
                <img src="./asset/money heist.jpg" alt="">
                <div class="container_detail">
                  <h4>The Boyz</h4>
                  <div class="sub">
                    <p>Action, 2021</p>
                    <h3><span>IMDB</span><i class="bi bi-star-fill"></i> 9.36</h3>
                  </div>
                </div>
              </div>
            </a> -->
        </div>
</section>

<script src="../javascript/most_popular.js"></script>

<!-- Upcoming_movie_section carousel  -->
<section>
  <div class="carousel">
    <div class="list">
        <!-- <div class="item">
                <img src="https://webneel.com/wnet/file/images/11-16/8-xmen-movie-poster-design.jpg">
                <div class="introduce">
                  <div class="title">DESIGN SLIDER</div>
                  <div class="topic">Aerphone</div>
                  <div class="des">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, laborum cumque dignissimos quidem atque et eligendi aperiam voluptates beatae maxime.
                  </div>
                  <div class="time flex">
                    <span><i class="fas fa-circle"></i><span>1hrs 50mins</span></span>
                    <span style="margin-left: 15px;"><i class="fas fa-circle"></i><span>8.6 <span style="background-color: yellow; padding: 0px 5px;">IMDb</span> </span></span>
                    <span style="margin-left: 15px;"><i class="fas fa-circle"></i><span>2021</span></span>
                  </div>
                  <button class="watch_trailer">WATCH TRAILER &#8599</button>
                </div>
              </div> -->

    </div>
    <div class="arrows">
        <button id="prev"><</button>
        <button id="next">></button>

    </div>
  </div>
</section>
<!-- Upcoming_movie_section carousel end  -->


<script src="../javascript/release_carousel.js"></script>


<!-- Footer Start  -->
<footer>
  <div class="container mtop ">
    <div class="box">
      <div class="logo">
        <img src="../asset/logo.png">
      </div>
      <p> Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <div class="icon">
        <i class="fab fa-facebook-square"></i>
        <i class="fab fa-instagram"></i>
        <i class="fab fa-twitter-square"></i>
        <i class="fab fa-youtube-square"></i>
      </div>
    </div>

    <div class="box">
      <h2>Explore</h2>
      <div class="flex2">
        <ul>
          <li>Home</li>
          <li>Tv Shows</li>
          <li>Actors</li>
        </ul>
        <ul class="ul">
          <li>Movie</li>
          <li>Video</li>
          <li>Basketball</li>
          
        </ul>
        <ul class="ul">
          <li>Celebrity</li>
          <li>Coress</li>
        </ul>
      </div>
    </div>

    <div class="box">
      <h2>Company</h2>
      <div class="flex2">
        <ul>
          <li>Company</li>
          <li>Terms of Use</li>
          <li>Contact us</li>
          <li>Our Team</li>
        </ul>
        <ul class="ul">
          <li>Privacy Policy</li>
          <li>Helps Center</li>
          <li>Subscribe</li>
          <li>FAQ</li>
        </ul>
      </div>
    </div>

    <div class="box">
      <h2>Download App</h2>
      <p> Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <div class="img flex1">
        <img src="../asset/app1.png" alt="App Store" title="App Store">
        <img src="../asset/app2.png" alt="Play store" title="Play Store">
      </div>
    </div>
  </div>
</footer>
<!-- Footer end  -->

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

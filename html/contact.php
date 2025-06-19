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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../asset/tablogo1.jpg" type="image/x-icon">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="../css/contact_us.css">
    <link rel="stylesheet" href="../css/navbar.css">
</head>
<body class="nav-open">

    <!-- NAV SATART -->

    <header>       
        <nav>
            <div class="header1">
            <a href="#" class="logo"><img src="../asset/logo.png" alt="" srcset="" height="70px" width="260px"> </a>
            <i class='bx bx-menu' id="menu-icon"></i>
            <nav class="navbar">
                <a href="./home.php" class="nav-menu">Home</a>
                <a href="./series.php" class="nav-menu">Series</a>
                <a href="./movie.php" class="nav-menu">Movie</a>
                <a href="./about.php" class="nav-menu">About</a>
                <a href="#" class="nav-menu">Contact</a>
                <!--User Profile Button and Guest Time start -->
                <span class="nav-menu"><i class="bi bi-person-circle profile-btn"  onclick="toggleProfile()"></i></span>
                <p id="guest-timer" style="color: red; font-weight: bold;"></p>
                <!--User Profile Button and Guest Time ENd -->
              </div>
            </div>
            <div class="nav-bg"></div>
           
        </nav>
    </header>
  
    <!-- NAV END  -->


    <script src="../javascript/navbar.js"></script>


    <!-- Form Section start  -->

    <div class="landing_page">
        <div class="responsive-container-block big-container">
          <img class="bg-img" id="iq5bf" src="https://cdn.create.vista.com/api/media/small/285780842/stock-photo-selective-focus-cheerful-blonde-operator-headset-looking-camera">
          <div class="responsive-container-block container">
            <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12 left-one">
              <div class="content-box">
                <p class="text-blk section-head">
                  Contact us
                </p>
                <p class="text-blk section-subhead">
                  Fill out the form below and our support team will get back to you within 24 hours — just like your favorite movie callback!
                </p>
                <div class="icons-container">
                  <a href="#" class="share-icon">
                    <img class="img" src="https://workik-widget-assets.s3.amazonaws.com/Footer1-83/v1/images/Icon-twitter.png">
                  </a>
                  <a href="#" class="share-icon">
                    <img class="img" src="https://workik-widget-assets.s3.amazonaws.com/Footer1-83/v1/images/Icon-facebook.png">
                  </a>
                  <a href="#" class="share-icon">
                    <img class="img" src="https://workik-widget-assets.s3.amazonaws.com/Footer1-83/v1/images/Icon-google.png">
                  </a>
                  <a href="#" class="share-icon">
                    <img class="img" src="https://workik-widget-assets.s3.amazonaws.com/Footer1-83/v1/images/Icon-instagram.png">
                  </a>
                </div>
              </div>
            </div>
            <div class="responsive-cell-block wk-ipadp-6 wk-tab-12 wk-mobile-12 wk-desk-6 right-one" id="i1zj">
              <form action="https://api.web3forms.com/submit" method="POST" class="form-box">
                <div class="container-block form-wrapper">
                  <p class="text-blk contactus-head">
                    <a class="link" href="">
                    </a>
                    Get a quote
                  </p>
                  <p class="text-blk contactus-subhead">
                    We will get back to you in 24 hours
                  </p>
                  <div class="responsive-container-block">
                    <input type="hidden" name="access_key" value="65c240c8-85be-47bf-a343-d0bde5c2ae90">
                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12" id="i10mt-7">
                      <input class="input" id="ijowk-7" name="FirstName" required placeholder="First Name">
                    </div>
                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12" id="i1ro7">
                      <input class="input" id="indfi-5" name="Last Name" required placeholder="Last Name">
                    </div>
                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-6 wk-ipadp-6 emial" id="ityct">
                      <input class="input" id="ipmgh-7" name="Email" required placeholder="Email">
                    </div>
                    <div class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                      <input class="input" id="imgis-6" name="PhoneNumber" required placeholder="Phone Number">
                    </div>
                    <div class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12" name="Message" id="i634i-7">
                      <textarea  name="message" class="textinput" id="i5vyy-7" placeholder="Type message here"></textarea>
                    </div>
                  </div>
                  <button class="submit-btn">
                    Send Request
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- User Information Collapse Start -->
      <div id="userProfile" class="collapse-box">
            <div class="collapse-content">
              <h3>User Information</h3>
              <p> <?php echo $_SESSION['user_name'] ?></p>
              <p><?php echo $_SESSION['email'] ?></p>
              <p><button><a href="../logout.php" class="logout">Logout</a></button></p>
            </div>
          </div>
        <!-- User Information Collapse end -->

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

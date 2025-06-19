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
    <title id="tab-title"></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../css/products.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body class="nav-open">

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
                    <a href="./about.php" class="nav-menu">About</a>
                    <a href="./contact.php" class="nav-menu">Contact</a>
                    <a href="#" class="nav-menu" class="search_user">
                        <input type="text" placeholder="Search..." id="search_input" class="search_box">
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
                    <a href="#" class="nav-menu"><i class="bi bi-person-circle profile-btn" onclick="toggleProfile()"></i></a>
                    <p id="guest-timer" style="color: red; font-weight: bold;"></p>
                    <!--User Profile Button and Guest Time end -->
                </nav>
            </div>
            <div class="nav-bg"></div>
        </nav>
    </header>


    <script src="../javascript/navbar.js"></script>
    <script src="../javascript/search.js"></script>

    <!-- CArd DATA  -->
    <div id="product-details" class="product-details"></div>
    <!-- END -->


    <script>
        // Fetch product details from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get("id");

        fetch("../json/main.json")
            .then(response => response.json())
            .then(products => {

                const product = products.find(p => p.id == productId);

                // Tab Title
                document.getElementById('tab-title').innerText = product.title;

                if (product) {
                    document.getElementById("product-details").innerHTML = `
                    
                        <section>
                            <div class="conatiner">
                                <div class="img-container">
                                    <img class="bg-img" src="${product.mainbanner} ">
                                </div>
                                <div class="detail">
                                    <h1>${product.title} </h1>
                                    <div class="data">
                                        <span> <i class="bi bi-dot"></i>${product.genre} </span>
                                        <span> <i class="bi bi-dot"></i>${product.language} </span>
                                        <span> <i class="bi bi-dot"></i> ${product.date} </span>
                                        <span> <i class="bi bi-dot"></i> ${product.imdb} <span style="background-color: rgb(255, 255, 11); padding: 0px 5px; font-weight: bold; color: black; " class="imdb">IMDb</span></span>
                                    </div>
                                    <p>${product.paragraph} </p>
                                    <div id="list-example" class="list-group">
                                        <a class="list-group-item list-group-item-action" href="#list-item-1"><i class="bi bi-play-circle-fill"></i> Watch Now</a>
                                      </div>
                                </div>

                            </div>
                        </section>
                        <section>
                            <div class="movie-card">
                                <div class="movie-poster">
                                    <img src="${product.poster} " alt="${product.title} ">
                                </div>
                                <div class="movie-info">
                                    <h2>${product.title} </h2>
                                    <p><strong>Genre:</strong> <span style="color: red;">${product.genre} </span></p>
                                    <p><strong>Duration:</strong>${product.duration} </p>
                                    <p><strong>IMDb:</strong> <span >N/A</span></p>
                                </div>
                                <div class="rating">
                                    <div class="rating-box">${product.imdb} </div>
                                    <div class="stars"><i class="bi bi-star-fill" style="color: yellow;"></i><i class="bi bi-star-fill" style="color: yellow;"></i><i class="bi bi-star-fill" style="color: yellow;"></i><i class="bi bi-star-fill" style="color: rgb(255, 255, 255);"></i><i class="bi bi-star-fill" style="color: rgb(255, 255, 255);"></i></div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="trailer">
                                        <iframe  src="${product.trailer}"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                        </section>
                        <section>
                            <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example" tabindex="0">
                                <button class="download-btn">Download</button>
                                <table id="list-item-1">
                                    <thead>
                                        <tr>
                                            <th>Server</th>
                                            <th>Language</th>
                                            <th>Quality</th>
                                            <th>Links</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>🌐 Drive Link</td>
                                            <td>🇮🇳 ${product.language}</td>
                                            <td>HD 1080p</td>
                                            <td><a href="${product.download} " target="blank" class="download-link">⬇ Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>🌐 Drive Link</td>
                                            <td>🇮🇳 ${product.language}</td>
                                            <td>HD 1080p</td>
                                            <td><a href="#" download class="download-link">⬇ Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>🌐 Drive Link</td>
                                            <td>🇮🇳 ${product.language}</td>
                                            <td>HD 720p</td>
                                            <td><a href="#" download class="download-link">⬇ Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>🌐 Drive Link</td>
                                            <td>🇮🇳 ${product.language}</td>
                                            <td>HD 720p</td>
                                            <td><a href="#" download class="download-link">⬇ Download</a></td>
                                        </tr>
                                        <tr>
                                            <td>🌐 Drive Link</td>
                                            <td>🇮🇳 ${product.language}</td>
                                            <td>HD 480p</td>
                                            <td><a href="#" download class="download-link">⬇ Download</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                              </div>
                        </section>
                    `;
                } else {
                    document.getElementById("product-details").innerHTML = "<h2>Product not found</h2>";
                }
            });

        function goBack() {
            window.history.back();
        }
    </script>


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

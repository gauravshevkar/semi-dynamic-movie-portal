<?php
@include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];

    $query = "SELECT * FROM login_data WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['password'])) {
            if ($row['user_type'] === 'Admin') {
                $_SESSION['admin_name'] = $row['name'];
                header('location:./admin_portal/home.php');
            } else {
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                header('location:./html/home.php');
            }
            exit();
        } else {
            $error[] = "Incorrect password!";
        }
    } else {
        $error[] = "Email not found!";
    }
}

// Guest login 
if (isset($_GET['expired']) && $_GET['expired'] == 1) {
    // echo "<p style='color:red;'>Guest session expired. Please login again.</p>";
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./asset/tablogo1.jpg" type="image/x-icon">
    <title>login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./login.css">
</head>
<body>
    <div class="container">
        <div class="curved-shape"></div>
        <div class="form-box Login">
            <h2>Login</h2>
            <form action="#" method="post">
                <?php
                if(isset($error)){
                   foreach($error as $error){
                      echo '<span class="error-msg">'.$error.'</span>';
                   };
                };
                ?>
                <div class="input-box">
                    <input type="email" name="email" required>
                    <label for="">Email Id</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label for="">Password</label>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box">
                    <button class="btn" type="submit" name="submit" value="login">Login</button>
                </div>
               
            </form>
            <div class="regi-link">
                    <p>Don't have an account ? <a href="./sign_up.php" class="signuplink">Sign Up</a>

                    <!-- Guest button  -->
                    <form method="post" action="guest_login.php">
                            <button type="submit" class="guest">Login as Guest</button>
                    </form>
                    </p>
                    
                </div>
            
        </div>
        <div class="info-content">
            <h2>WELCOME BACK</h2>
            <p>Sign in to explore the best movies and continue your cinematic journey.</p>
        </div>
    </div>
    
</body>
</html>
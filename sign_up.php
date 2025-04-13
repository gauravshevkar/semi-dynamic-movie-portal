<?php
@include 'config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];
    $user_type = $_POST['user_type'];

    $check = mysqli_query($conn, "SELECT * FROM login_data WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error[] = 'User already exists!';
    } else {
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        $insert = "INSERT INTO login_data (name, email, password, user_type) VALUES ('$name', '$email', '$hashed_pass', '$user_type')";
        mysqli_query($conn, $insert);
        header('location:index.php');
        exit();
    }
}
?>
















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="shortcut icon" href="./asset/tablogo1.jpg" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./login.css">
</head>
<body>
    <div class="container">
        <div class="curved-shape"></div>
        <div class="form-box Login">
            
            <h2>Create Your Account</h2>
            
            <form action="#" method="post" class="signup">

            <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
                <div class="input-box">
                    <input type="text" name="name" required>
                    <label for="">Name</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="email" required>
                    <label for="">Email</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="password" required>
                    <label for="">Password</label>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                
                <div class="input-box">
                    <select name="user_type" id="" class="User_Type">
                        <option disabled selected value="" >Select User_Type</option>
                        <option  value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                    
                    
                </div>
                <div class="input-box signup_btn">
                    <button class="btn" type="submit" name="submit" value="Sign_up">Sign_up</button>
                </div>
                <div class="regi-link log-link">
                    <p>Already have an account ? <a href="./index.php" class="signuplink">Log In</a></p>
                </div>

            </form>
        </div>
        <div class="info-content">
            <h2>WELCOME BACK</h2>
            <p>"Join us today! Create your account to explore and enjoy unlimited movies."</p>
        </div>
    </div>
    
</body>
</html>
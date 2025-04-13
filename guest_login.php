<!-- guest login file  -->

<?php
session_start();

$_SESSION['user_name'] = "Guest";
$_SESSION['email'] = "email";
$_SESSION['login_time'] = time(); // ye line bohot important hai

header("Location: ./html/home.php");
exit();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./asset/tablogo1.jpg" type="image/x-icon">
    <title>login</title>
</head>

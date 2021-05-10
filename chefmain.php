<?php
session_start();
require_once ('connection.php');

if(!isset($_SESSION['cheflogin'])){
    header("Location: chefsignin.php");
}
else{
    $user   = $_SESSION['cheflogin'];
    $user_id = $user['user_id'];
    $user_name = $user['first_name'];
}

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION);
    header("Location: chefsignin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Meals | Home </title>
    <link rel="stylesheet" href="css/mainStyle.css">
</head>
<body>
<!-- Navbar Section Starts Here -->
<section class="navbar">
    <div class="container">
        <div class="logo">
            <a href="main.php" title="Logo">
                <img src="img/icon.png" alt="Logo" class="img-responsive">
            </a>
        </div>

        <div class="menu text-right">
            <ul>
                <li>
                    <a href="chefmain.php">Home</a>
                </li>
                <li>
                    <a href="chefcontributions.php">My Contributions</a>
                </li>
                <li>
                    <a href="chefaccount.php">Account</a>
                </li>
                <li>
                    <a href="chefmain.php?logout=true">Logout</a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2><a href="#" class="text-white">Welcome Back <?php echo $user_name; ?>!</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
</body>


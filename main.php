<?php
session_start();

if(!isset($_SESSION['userlogin'])){
    header("Location: signin.php");
}

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION);
    header("Location: signin.php");
}
?>

<p>Welcome to the Main Page</p>
<a href="main.php?logout=true">Sign out</a>

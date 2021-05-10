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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- Navbar Section Starts Here -->

<div class="menu text-center">
    <div class="wrapper">
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
</div>
<div class="main-content">
    <div class="wrapper">
        <h1>My Contributions</h1>
        <br/>

        <a href="addRecipe.php" class="btn-primary">Add Recipe</a>

        <br  /><br  /><br  />

        <table class="tbl-full">
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Skill Level</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>N</td>
                <td>I</td>
                <td>SL</td>
                <td>
                    <a href="#" class="btn-secondary">Update Recipe</a>
                    <a href="#" class="btn-danger">Delete Recipe</a>
                </td>
            </tr>

        </table>
    </div>
</div>
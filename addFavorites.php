<?php
session_start();
require_once('connection.php');

if (!isset($_SESSION['userlogin'])) {
    header("Location: signin.php");
} else {
    $user = $_SESSION['userlogin'];
    $user_id = $user['user_id'];
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION);
    header("Location: signin.php");
}

$recipe_id = $_GET['recipe_id'];

$sql = "INSERT INTO favorites_list(recipe_id, viewer_id) VALUES($recipe_id, $user_id)";
$stmtinsert = $conn->prepare($sql);
$result = $stmtinsert->execute();

if($result == true) {
    $_SESSION['add'] = "Recipe added successfully";
    header("Location: favorites.php");
} else {
    $_SESSION['add'] = "Failed to Add Recipe";
    header("Location: favorites.php");
}
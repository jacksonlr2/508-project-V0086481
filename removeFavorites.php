<?php
session_start();
require_once ('connection.php');

if(!isset($_SESSION['userlogin'])){
    header("Location: signin.php");
}
else{
    $user   = $_SESSION['userlogin'];
    $user_id = $user['user_id'];
}
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION);
    header("Location: signin.php");
}

$recipe_id = $_GET['recipe_id'];

$sql = "DELETE FROM favorites_list WHERE recipe_id = $recipe_id AND viewer_id = $user_id";
$stmtinsert = $conn->prepare($sql);
$result = $stmtinsert->execute();

if($result == true){
    $_SESSION['delete'] = "Recipe removed successfully";
    header("Location: favorites.php");
}
else{
    $_SESSION['delete'] = "Failed to Remove Recipe";
    header("Location: favorites.php");
}
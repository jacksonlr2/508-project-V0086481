<?php
session_start();
require_once('connection.php');

$username = $_POST['username'];
$password   = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmtselect = $conn->prepare($sql);
$result = $stmtselect->execute([$username]);


if($result){
    $user = $stmtselect->fetch(PDO::FETCH_ASSOC);
    $user_id = $user['user_id'];

    $sql2 = "SELECT * FROM users_chef WHERE user_chef_id = $user_id";
    $adminselect = $conn->prepare($sql2);
    $result2 = $adminselect->execute();

    $sql3 = "SELECT * FROM users_viewer WHERE user_viewer_id = $user_id";
    $viewerselect = $conn->prepare($sql3);
    $result3 = $viewerselect->execute();

    if($viewerselect->rowCount() > 0 AND password_verify($password, $user['password'])){
        $_SESSION['userlogin'] = $user;
        header('Location: main.php');
    }
    elseif ($adminselect->rowCount() > 0 AND password_verify($password, $user['password'])){
        $_SESSION['cheflogin'] = $user;
        header('Location: chefmain.php');
    }
    else{
        echo "The username/password you entered is incorrect.";
    }
}
else{
    echo "There were errors while connecting to the database.";
}
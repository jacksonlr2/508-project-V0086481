<?php
session_start();
require_once('connection.php');

$username = $_POST['username'];
$origPassword   = $_POST['password'];
$password = password_hash($origPassword, PASSWORD_DEFAULT);

$sql = "SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1";
$stmtselect = $conn->prepare($sql);
$result = $stmtselect->execute([$username, $password]);

if($result){
    $user = $stmtselect->fetch(PDO::FETCH_ASSOC);
    if($stmtselect->rowCount() > 0){
        $_SESSION['userlogin'] = $user;
    }
    else{
        echo '<script type = "text/javascript">';
        echo 'alert("The username/password you entered is incorrect.");';
        echo 'window.location.href = "signin.php" ';
        echo '</script>';
    }
}
else{
    echo "There were errors while connecting to the database.";
}
<?php
session_start();
// Report all PHP errors
error_reporting(E_ALL);
require_once ('connection.php');

if(isset($_POST['update'])){

    $userNewName  =    $_POST['updateUserName'];
    $userNewEmail =    $_POST['userEmail'];
    $userNewPassword = $_POST['userPassword'];

    if(!empty($userNewName) && !empty($userNewEmail)){

        $loggedInUser = $_SESSION['cheflogin'];
        $user_id = $loggedInUser['user_id'];

        if(empty($userNewPassword)){
            $sql = "UPDATE users SET username = '$userNewName', email ='$userNewEmail' WHERE user_id = '$user_id'";
        }
        else{
            $password = password_hash($userNewPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET username = '$userNewName', email ='$userNewEmail', password='$password' WHERE user_id = '$user_id'";
        }

        $stmt = $conn->prepare($sql);
        $results = $stmt->execute();

        header('Location: chefaccount.php?success=userUpdated');
        exit;
    }
    else{
        header('Location: chefaccount.php?error=emptyNameAndEmail');
        exit;
    }

}

?>
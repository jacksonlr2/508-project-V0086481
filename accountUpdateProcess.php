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

                    $loggedInUser = $_SESSION['userlogin'];
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

                    header('Location: account.php?success=userUpdated');
                    exit;
    }
    else{
        header('Location: account.php?error=emptyNameAndEmail');
        exit;
    }

}
if(isset($_POST['delete'])){

        $loggedInUser = $_SESSION['userlogin'];
        $user_id = $loggedInUser['user_id'];

        $sql = "DELETE FROM favorites_lists WHERE viewer_id = '$user_id'";
        $results = mysqli_query($conn,$sql);
        $stmt = $conn->prepare($sql);
        $results = $stmt->execute();

        $sql3 = "DELETE FROM users_viewer WHERE user_viewer_id = '$user_id'";
        $results3 = mysqli_query($conn,$sql3);
        $stmt3 = $conn->prepare($sql3);
        $results3 = $stmt3->execute();

        $sql2 = "DELETE FROM users WHERE user_id = '$user_id'";
        $results2 = mysqli_query($conn,$sql2);
        $stmt2 = $conn->prepare($sql2);
        $results2 = $stmt2->execute();

        session_destroy();
        unset($_SESSION);
        header('Location: index.php');
        exit;

}

?>
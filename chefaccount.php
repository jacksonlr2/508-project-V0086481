<?php
session_start();
require_once ('connection.php');

if(!isset($_SESSION['cheflogin'])){
    header("Location: chefsignin.php");
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/detailStyle.css">
</head>
<body>
<section class="navbar">
    <div class="container">
        <div class="logo">
            <a href="chefmain.php" title="Logo">
                <img src="img/icon.png" alt="Logo" class="img-responsive">
            </a>
        </div>

        <div class="menu text-right">
            <ul>
                <li>
                    <a href="chefmain.php">Home</a>
                </li>
                <li>
                    <a href="chefcontributions.php">My Favorites</a>
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

<div align="center">
    <hr>
    <h3>Update Account Information</h3>
    <hr>
    <div class="row">
        <div class="col-md-6 offset-3">
            <?php

            if(isset($_GET['error'])){
                if($_GET['error'] == 'emptyNameAndEmail'){
                    ?>
                    <small class="alert alert-danger"> Username and email is required</small>
                    <hr>
                    <?php
                }
            }
            if(isset($_GET['success'])){
                if($_GET['success'] == 'userUpdated'){
                    ?>
                    <small class="alert alert-success"> User updated Successfully</small>
                    <hr>
                    <?php
                }
            }
            ?>
            <form action="chefaccountProcess.php"
                  method="POST"
                  enctype="multipart/form-data"
            >
                <?php
                $currentUser = $_SESSION['cheflogin'];
                $user_id = $currentUser['user_id'];
                $sql = "SELECT * FROM users WHERE user_id ='$user_id'";
                $stmt = $conn->prepare($sql);
                $results = $stmt->execute();

                if($results){
                    if($stmt->rowCount() > 0){
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <div class="form-group">
                                <input type="text" name="updateUserName" class="form-control" value="<?php echo $row['username']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="email" name="userEmail" class="form-control" value="<?php echo $row['email']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="password" name="userPassword" placeholder="New Password (Optional)" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="update"  class="btn btn-info" value="Update">
                            </div>

                            <?php
                        }
                    }
                }
                ?>

            </form>
        </div>

    </div>


</div>

</body>
</html>
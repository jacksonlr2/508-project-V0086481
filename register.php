<?php require_once ('connection.php'); ?>
<html lang="en">
<head>
    <title> Registration </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>

<div>
    <?php
    if(isset($_POST['create'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $origPassword = $_POST['password'];
        $password = password_hash($origPassword, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user(first_name, last_name, email, username, password) VALUES (?,?,?,?,?)";
        $stmtinsert = $conn->prepare($sql);
        $result = $stmtinsert->execute([$first_name, $last_name, $email, $username, $password]);
        if($result){
            echo 'Successfully saved.';
        }
        else{
            echo 'There were errors while saving the data';
        }
    }
    else{
        echo 'No data';
    }
    ?>
</div>
<div>
    <form action="register.php" method="post">
        <div class="container mt-3 mb-3">
            <div class="row justify-content-center">
                <div class="col-4">
                    <h1>Registration</h1>
                    <p>Fill up the form with correct values.</p>
                    <hr class="mb-3">
                    <label for="first_name"><b>First Name</b></label>
                    <input class="form-control" id="first_name" placeholder="Enter first name"type="text" name="first_name" required>

                    <label for="last_name"><b>Last Name</b></label>
                    <input class="form-control" id="last_name" placeholder="Enter last name" type="text" name="last_name" required>

                    <label for="email"><b>Email Address</b></label>
                    <input class="form-control" id="email" placeholder="Enter email" type="email" name="email" required>

                    <label for="username"><b>Username</b></label>
                    <input class="form-control" id="username" placeholder="Enter username" type="text" name="username" required>

                    <label for="password"><b>Password</b></label>
                    <input class="form-control" id="password" placeholder="Enter password" type="password" name="password" required>
                    <hr class="mb-3">
                    <input class="btn btn-primary" type="submit" id="register" name="create" value="Sign Up">
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>


<?php require_once ('connection.php'); ?>
<html lang="en">
<head>
    <title> Registration </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>

<div>
    <form action="register.php" method="post">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-3">
                    <h1>Registration</h1>
                    <p>Fill up the form with correct values.</p>
                    <hr class="mb-3">
                    <label for="first_name"><b>First Name</b></label>
                    <input class="form-control" id="first_name" placeholder="Enter first name" type="text" name="first_name" required>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(function(){
        $('#register').click(function(event){

            var valid = this.form.checkValidity();

            if(valid){

                var first_name = $('first_name').val();
                var last_name = $('last_name').val();
                var email = $('email').val();
                var username = $('username').val();
                var password = $('password').val();

                event.preventDefault();

                $.ajax({
                    type:'POST',
                    url: 'registerProcess.php',
                    data: {first_name: first_name, last_name: last_name, email: email, username: username, password: password},
                    success: function(data){
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Your account has been created.',
                            footer: '<a href="signin.php">Sign in</a>'
                        })
                    },
                    error: function(data){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'There were errors while saving the data.'
                        })
                    }
                });
            }
        });
    });
</script>
</body>
</html>


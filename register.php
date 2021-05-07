<?php require_once ('connection.php'); ?>
<html lang="en">
<head>
    <title> Registration </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.min.css">
</head>

<body>
<div>
    <form action="register.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Registration</h1>
                    <p>Fill up the form with correct values.</p>
                    <hr class="mb-3">
                    <label for="first_name"><b>First Name</b></label>
                    <input class="form-control" id="first_name" type="text" name="first_name" required>

                    <label for="last_name"><b>Last Name</b></label>
                    <input class="form-control" id="last_name" type="text" name="last_name" required>

                    <label for="email"><b>Email Address</b></label>
                    <input class="form-control" id="email" type="text" name="email" required>

                    <label for="username"><b>Username</b></label>
                    <input class="form-control" id="username" type="text" name="username" required>

                    <label for="password"><b>Password</b></label>
                    <input class="form-control" id="password" type="text" name="password" required>
                    <hr class="mb-3">
                    <input class="btn btn-primary" type="submit" id="register" name="create" value="Sign Up">
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(function(){
        $('#register').click(function(e){

            var valid = this.form.checkValidity();

            if(valid){

                var first_name = $('first_name').val();
                var last_name = $('last_name').val();
                var email = $('email').val();
                var username = $('username').val();
                var password = $('password').val();

                e.preventDefault();

                $.ajax({
                    type:'POST',
                    url: 'process.php',
                    data: {first_name: first_name, last_name: last_name, email: email, username: username, password: password},
                    success: function(data){
                        Swal.fire({
                            'title': 'Success!',
                            'text': 'Your account has been created.',
                            'type': 'success'

                        })
                    },
                    error: function(data){
                        Swal.fire({
                            'title': 'Error',
                            'text': 'There were errors while saving the data.',
                            'type': 'error'

                        })
                    }
                });
            }
            else{

            }
        });
    });
</script>
</body>
</html>


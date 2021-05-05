<?php require_once ('connection.php'); ?>
<html>
<head>
    <title> Registration </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.min.css">
</head>
<body>

<div>
    <?php
    if(isset($_POST['create'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "INSERT INTO users (first_name, last_name, email, username, password) VALUES (?,?,?,?,?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$first_name, $last_name, $email, $username, $password]);
        if($result){
            echo 'Successfully saved.';
        }
        else{
            echo 'There were errors while saving the data';
        }

        /*echo $firstname . " " . $lastname . " " . $email . " " . $username . " " . $password;*/
        /*echo 'User submitted.';*/
    }
    ?>
</div>

<div>
    <form action="register.php" method="post">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Registration</h1>
                    <p>Fill up the form with correct values</p>
                    <hr class="mb-3">
                    <label for="firstname"><b>First Name </b></b></label>
                    <input class="form-control" id="firstname" type="text" name="firstname" required>

                    <label for="lastname"><b>Last Name </b></b></label>
                    <input class="form-control" id="lastname" type="text" name="lastname" required>

                    <label for="email"><b>Email Address </b></b></label>
                    <input class="form-control" id="email" type="text" name="email" required>

                    <label for="username"><b>Username </b></b></label>
                    <input class="form-control" id="username" type="text" name="username" required>

                    <label for="password"><b>Password </b></b></label>
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

                alert('true');
            }
            else{
                alert('false');
            }
        });
    });
</script>
</body>
</html>


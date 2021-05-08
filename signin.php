<?php
    session_start();

    if(isset($_SESSION['userlogin'])){
        header("Location: main.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/signinStyles.css">
    <script src="https://kit.fontawesome.com/13e4b9f1ad.js" crossorigin="anonymous"></script>

</head>

<body>
<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img src="img/logo.png" class="brand_logo" alt="Master Meals logo">
                </div>
            </div>
            <div class="d-flex justify-content-center form_container">
                <form>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="username" id="username" placeholder="Username" class="form-control input_user" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control input_user" required>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="rememberme" class="custom-control-input" id="customControlInLine">
                            <label class="custom-control-label" for="customControlInLine">Remember me</label>
                        </div>
                    </div>
            </div>
                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button type="button" name="button" id="login" class="btn login_btn">Sign In</button>
                    </div>
                </form>
            <div class="mt-4">
                <div class="d-flex justify-content-center links">
                    Don't have an account? <a href="register.php" class="ml-2">Register</a>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="#">Forgot your password?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"> </script>
<script>
    $(function(){
        $('#login').click(function(event){

            var valid = this.form.checkValidity();

            if(valid){
                var username = $('#username').val();
                var password = $('#password').val();
            }

            event.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'jssignin.php',
                data:  {username: username, password: password},
                success: function(data){
                        setTimeout(' window.location.href =  "main.php"', 1000);
                },
                error: function(data){
                    alert('there were errors while doing the operation.');
                }
            });

        });
    });
</script>
</body>
</html>
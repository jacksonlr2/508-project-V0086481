<?php require_once ('connection.php'); ?>
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
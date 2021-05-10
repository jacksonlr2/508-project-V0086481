<?php
session_start();
require_once ('connection.php');

if(!isset($_SESSION['cheflogin'])){
    header("Location: chefsignin.php");
}
else{
    $user   = $_SESSION['cheflogin'];
    $user_id = $user['user_id'];
    $user_name = $user['first_name'];
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Meals | Home </title>
    <link rel="stylesheet" href="css/chefStyle.css">
</head>
<body>
<!-- Navbar Section Starts Here -->

<div class="menu text-center">
    <div class="wrapper">
        <ul>
            <li>
                <a href="chefmain.php">Home</a>
            </li>
            <li>
                <a href="chefcontributions.php">My Contributions</a>
            </li>
            <li>
                <a href="chefaccount.php">Account</a>
            </li>
            <li>
                <a href="chefmain.php?logout=true">Logout</a>
            </li>
        </ul>
    </div>
</div>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Recipe</h1>
        <br><br>

        <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="#" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>
                        <input type="text" name="name" placeholder="Name of Recipe">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="number" name="serving_size" min="0" step="1" size="6" placeholder="Serving of Recipe">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="number" name="calories" min="0" step="1" size="6" placeholder="Calories of Recipe">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="number" name="cook_time" min="0" step="1" size="6" placeholder="Cook Time of Recipe">
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="skill_level">
                            <option value="Easy">Easy</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Difficult">Difficult</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="meal_type_id">
                            <?php
                            $sql = "SELECT * FROM meal_types";
                            $stmt = $conn->prepare($sql);
                            $result = $stmt->execute();
                            if($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $meal_type_num = $row['meal_type_id'];
                                    $meal_type_name = $row['name'];

                                    ?>
                                    <option value="<?php echo $meal_type_num; ?>"><?php echo $meal_type_name; ?></option>
                                    <?php

                                }
                            }
                            else{
                                ?>
                                <option value="0">No Types Found</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="region_id">
                            <?php
                            $sql = "SELECT * FROM regions";
                            $stmt = $conn->prepare($sql);
                            $result = $stmt->execute();
                            if($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $region_num = $row['region_id'];
                                    $region_name = $row['name'];

                                    ?>
                                    <option value="<?php echo $region_num; ?>"><?php echo $region_name; ?></option>
                                    <?php

                                }
                            }
                            else{
                                ?>
                                <option value="0">No Region Found</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="file" name="image_path">
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea name="instructions" cols="50" rows="10" placeholder="Instructions of Recipe"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
            if(isset($_POST['submit'])){
                $name = $_POST['name'];
                $serving_size = $_POST['serving_size'];
                $calories = $_POST['calories'];
                $cook_time = $_POST['cook_time'];
                $instructions = $_POST['instructions'];
                $region_id = $_POST['region_id'];
                $meal_type_id = $_POST['meal_type_id'];
                $skill_level = $_POST['skill_level'];

                if(isset($_FILES['image_path']['name'])){
                    $image_name = $_FILES['image_path']['name'];

                    if($image_name != ""){
                        $ext = end(explode('.', $image_name));
                        $image_name = "img/Recipes-".rand(0000,9999). ".".$ext;
                        $src = $_FILES['image_path']['tmp_name'];
                        $dst = $image_name;
                        $upload = move_uploaded_file($src,$dst);

                        if($upload==false){
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header("Location: addRecipe.php");
                            die();
                        }
                    }
                }
                else{
                    $image_name = "";
                }
                $sql2 = "INSERT INTO recipes SET 
                            name = '$name',
                            instructions = '$instructions',
                            serving_size = $serving_size,
                            calories = $calories,
                            cook_time = $cook_time,
                            skill_level = '$skill_level',
                            meal_type_id = $meal_type_id,
                            region_id = $region_id,
                            chef_id = $user_id,
                            image_path = '$image_name'";
                $stmt2 = $conn->prepare($sql2);
                $result2 = $stmt2->execute();

                header("Location: chefcontributions.php");


            }
        ?>

    </div>
</div>
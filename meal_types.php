<?php
session_start();
require_once ('connection.php');

if(!isset($_SESSION['userlogin'])){
    header("Location: signin.php");
}

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION);
    header("Location: signin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Meals | Home </title>
    <link rel="stylesheet" href="css/mainStyle.css">
</head>
<body>
<!-- Navbar Section Starts Here -->
<section class="navbar">
    <div class="container">
        <div class="logo">
            <a href="main.php" title="Logo">
                <img src="img/icon.png" alt="Logo" class="img-responsive">
            </a>
        </div>

        <div class="menu text-right">
            <ul>
                <li>
                    <a href="main.php">Home</a>
                </li>
                <li>
                    <a href="recipes.php">Recipes</a>
                </li>
                <li>
                    <a href="favorites.php">My Favorites</a>
                </li>
                <li>
                    <a href="account.php">Account</a>
                </li>
                <li>
                    <a href="main.php?logout=true">Logout</a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Recipes By Type</h2>

        <?php
        $sql = "SELECT * FROM meal_types";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();;

        if($stmt->rowCount() > 0){
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                $meal_type_id = $row['meal_type_id'];
                $name = $row['name'];
                $image_path = $row['image_path'];
                ?>
                <a href="category-foods.html">
                    <div class="box-3 float-container">
                        <?php
                        if($image_path==""){
                            echo "<div class='error'>Image not Available</div>";
                        }
                        else{
                            ?>
                            <img src="<?php echo $image_path;?>" alt="" class="img-responsive img-curve">
                            <?php

                        }
                        ?>
                        <h3 class="float-text text-white"><?php echo $name; ?></h3>
                    </div>
                </a>
                <?php
            }
        }
        else{
            echo "<div class='error'>Categories have not been added.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
</body>


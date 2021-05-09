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
    <script src="https://kit.fontawesome.com/13e4b9f1ad.js" crossorigin="anonymous"></script>
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
<!-- Navbar Section Ends Here -->

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="searchRecipes.php" method="POST">
            <input type="search" name="search" placeholder="Search for Recipes..." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Recipes</h2>

        <?php
        $sql = "SELECT * FROM recipes";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();

        if($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $recipe_id = $row['recipe_id'];
                $name = $row['name'];
                $serving_size = $row['serving_size'];
                $calories = $row['calories'];
                $cook_time = $row['cook_time'];
                $skill_level = $row['skill_level'];
                $instructions = $row['instructions'];
                $chef_id = $row['chef_id'];
                $favorite_id = $row['favorite_id'];
                $meal_type_id = $row['meal_type_id'];
                $region_id = $row['region_id'];
                $image_path2 = $row['image_path'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if($image_path2==""){
                            echo "<div class='error'>Image not Available</div>";
                        }
                        else{
                            ?>
                            <img src="<?php echo $image_path2; ?>" alt="" class="img-responsive img-curve">
                            <?php

                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $name; ?></h4>
                        <?php
                        if($cook_time==""){ ?>
                            <i class="far fa-clock">---</i>
                            <?php
                        }
                        else{
                        ?>
                            <i class="far fa-clock"><?php echo $cook_time; ?></i>
                            <?php
                        }
                                ?>

                        <p class="food-detail">
                            <?php echo $skill_level; ?>
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Details</a>
                    </div>
                </div>
        <?php
            }
        }
        else{
            echo "<div class='error'>Recipes have not been added.</div>";
        }
        ?>



        <div class="clearfix"></div>

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->


</body>
</html>
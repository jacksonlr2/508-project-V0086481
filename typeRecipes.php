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

if(isset($_GET['meal_type_id'])){
    $meal_type_id = $_GET['meal_type_id'];
    $sql = "SELECT name FROM meal_types WHERE meal_type_id = ?";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$meal_type_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $meal_type_name = $row['name'];
}
else{
    header("Location: main.php");
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
<!-- Navbar Section Ends Here -->

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2><a href="#" class="text-white">"<?php echo $meal_type_name; ?>"</a> Recipes</h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Recipes</h2>

        <?php
        $sql2 = "SELECT * FROM recipes WHERE meal_type_id = ?";
        $stmt2 = $conn->prepare($sql2);
        $result2 = $stmt2->execute([$meal_type_id]);

        if($stmt2->rowCount() > 0){
            while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
                $recipe_id = $row2['recipe_id'];
                $name = $row2['name'];
                $serving_size = $row2['serving_size'];
                $calories = $row2['calories'];
                $cook_time = $row2['cook_time'];
                $skill_level = $row2['skill_level'];
                $instructions = $row2['instructions'];
                $chef_id = $row2['chef_id'];
                $favorite_id = $row2['favorite_id'];
                $meal_type_id = $row2['meal_type_id'];
                $region_id = $row2['region_id'];
                $image_path2 = $row2['image_path'];
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

                        <a href="detailRecipes.php?recipe_id=<?php echo $recipe_id;?>" class="btn btn-primary">Details</a>
                    </div>
                </div>
                <?php
            }
        }
        else{
            echo "<div class='error'>No recipes were found that match this type.</div>";
        }
        ?>
        <div class="clearfix"></div>

    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

</body>
</html>
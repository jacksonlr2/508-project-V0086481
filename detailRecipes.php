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
    <title>Master Meals | Recipe </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/detailStyle.css">
    <script src="https://kit.fontawesome.com/13e4b9f1ad.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
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
    </div>
</section>
<!-- Navbar Section Ends Here -->
<!-- Recipe Detail Section Starts Here -->
<?php
if(isset($_GET['recipe_id'])){
    $recipe_id = $_GET['recipe_id'];
    $sql = "SELECT * FROM recipes WHERE recipe_id = $recipe_id";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();

    if($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $recipe_id = $row['recipe_id'];
        $name = $row['name'];
        $serving_size = $row['serving_size'];
        $calories = $row['calories'];
        $cook_time = $row['cook_time'];
        $skill_level = $row['skill_level'];
        $instructions = $row['instructions'];
        $chef_id = $row['chef_id'];
        $image_path2 = $row['image_path'];
    }
    else{
        header("Location: main.php");
    }
}
else{
    header("Location: main.php");
}
?>
<?php
$sql2 = "SELECT * FROM recipes JOIN users ON chef_id = user_id WHERE recipe_id = $recipe_id";
$stmt2 = $conn->prepare($sql2);
$result2 = $stmt2->execute();

if($stmt2->rowCount() == 1) {
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $first_name = $row2['first_name'];
    $last_name = $row2['last_name'];
}
else{
   $first_name = ' ';
   $last_name = ' ';
}
?>

<?php
$sql3 = "SELECT * FROM recipes JOIN users ON chef_id = user_id WHERE recipe_id = $recipe_id";
$stmt3 = $conn->prepare($sql3);
$result3 = $stmt3->execute();

if($stmt3->rowCount() == 1) {
    $row3 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $first_name = $row3['first_name'];
    $last_name = $row3['last_name'];
}
else{
    $first_name = ' ';
    $last_name = ' ';
}
?>

<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5">
                <?php
                if($image_path2==""){
                    echo "<div class='error'>Image not Available</div>";
                }
                else{
                    ?>
                    <a href="#"class="img-bg">
                        <img src="<?php echo $image_path2?>"class="img-fluid"alt="">
                    </a>
                    <?php

                }
                ?>
            </div>
            <div class="col-lg-6 prod-des p1-md-5">
                <h3><?php echo $name?></h3>
                <div class="rating d-flex">
                    <p class="text-left mr-2 text-dark"> By: <?php echo $first_name?> <?php echo $last_name?></p>
                </div>
                <div class="rating d-flex">
                    <p class="text-left mr-4">
                        <a href="#"class="mr-2 text-dark">4.5 out of 5.0</a>
                    </p>
                    <p class="text-left mr-4">
                        <a href="#"class="mr-2 text-dark">100
                            <span style="color: #2c2e2c8a;">Ratings</span>
                        </a>
                    </p>
                </div>
                <div class="rating d-flex">
                    <p class="text-left mr-4">
                        <i class="far fa-clock mr-2 text-dark"> <?php echo $cook_time?> minutes</i>
                    </p>
                    <p class="text-left mr-4">
                        <i class="fas fa-users mr-2 text-dark"> <?php echo $serving_size?> servings</i>
                    </p>
                    <p class="text-left mr-4">
                        <i class="fas fa-signal mr-2 text-dark"> <?php echo $skill_level?></i>
                    </p>
                    <p class="text-left mr-4">
                        <i class="fas fa-fire mr-2 text-dark"> <?php echo $calories?> calories</i>
                    </p>
                </div>
                <p class="amount">Ingredients</p>
                <?php
                $sql4 = "SELECT i.name, quantity, unit FROM recipes r JOIN recipe_ingredient USING (recipe_id) JOIN ingredients i USING (ingredient_id) WHERE recipe_id = $recipe_id";
                $stmt4 = $conn->prepare($sql4);
                $result4 = $stmt4->execute();
                if($stmt4->rowCount() > 0) {
                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                        $ingred_name = $row4['name'];
                        $quantity = $row4['quantity'];
                        $unit = $row4['unit'];
                        ?>
                        <p>     *<?php echo $quantity?> <?php echo $ingred_name?> <?php echo $unit?></p>
                        <?php
                    }
                }
                else{
                    echo "<div class='error'>No ingredients needed.</div>";
                }
                ?>
                <p class="amount">Instructions</p>
                <p><?php echo $instructions?></p>
                <p>
                    <a href="#"class="btn btn-bg py-3 px-3 mr-2">
                        Add to Favorites
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Recipe Detail Section Ends Here -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"> </script>

</body>
</html>
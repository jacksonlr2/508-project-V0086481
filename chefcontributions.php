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
        <h1>My Contributions</h1>
        <br/>

        <a href="addRecipe.php" class="btn-primary">Add Recipe</a>

        <br  /><br  /><br  />
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <table class="tbl-full">
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Skill Level</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM recipes WHERE chef_id = $user_id";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute();

            if($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $name = $row['name'];
                    $image_path = $row['image_path'];
                    $skill_level = $row['skill_level'];
                    ?>
                    <tr>
                        <td><?php echo $name;?></td>
                        <td>
                            <?php
                                if($image_path == ""){
                                    echo "<div class='error'>Image not Added";
                                }
                                else{
                                    ?>
                                    <img src="<?php echo $image_path;?>" width="100px">

                                    <?php
                                }
                            ?>
                        </td>
                        <td><?php echo $skill_level;?></td>
                        <td>
                            <a href="#" class="btn-secondary">Update Recipe</a>
                            <a href="#" class="btn-danger">Delete Recipe</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else{
                echo "<tr> <td colspan='7' class='error'> Recipes not added yet.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
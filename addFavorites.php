<?php

require_once('connection.php');

if (isset($_POST)) {
    $recipe_id  	= $_POST['recipe_id'];
    $viewer_id 		= $_POST['user_id'];

    $sql = "INSERT INTO favorites_list(recipe_list, viewer_id) VALUES(?,?)";
    $stmtinsert = $conn->prepare($sql);
    $result = $stmtinsert->execute([$recipe_id, $viewer_id]);
    if ($result) {
        echo 'Successfully added.';
    } else {
        echo 'There were errors while adding.';
    }
} else {
    echo 'No data';
}
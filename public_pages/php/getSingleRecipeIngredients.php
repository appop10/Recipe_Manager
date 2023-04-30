<?php
$tableName = "";
$recipeID = "";

// find and set which table to pull data from
if (isset($_GET['location'])) {
    $location = $_GET['location'];

    switch ($location) {
        case "Recent":
            $tableName = "recent_recipes";
            break;
        case "Popular":
            $tableName = "popular_recipes";
            break;
        default: 
            $tableName = "all_recipes";
            break;
    }
} else {
    $location = "All";
    $tableName = "all_recipes";
}
// make sure ID is set
if (isset($_GET['recipeID'])) {
    $recipeID = $_GET['recipeID'];
} else {
    echo "Could not find recipe";
    exit();
}

try {
    // connect to database and pull information
    require "../../admin_pages/databases/rmConnect.php";
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT prep_time, cook_time, serving_size, recipe_ingredients FROM $tableName WHERE id=:recipeID";

    $stmt = $conn->prepare("$sql");
    $stmt->bindParam(':recipeID', $recipeID);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // fetch information
    $row = $stmt->fetch();
    $recipeInformation = [$row['prep_time'], $row['cook_time'], $row['serving_size'], $row['recipe_ingredients']];

    // convert array to JSON
    $recipeInformationJSON = json_encode($recipeInformation);
    echo $recipeInformationJSON;
    $conn = null;
} catch(PDOException $e) {
    echo $e;
}
?>
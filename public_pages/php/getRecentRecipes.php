<?php
    try {
        require "../../admin_pages/databases/rmConnect.php";
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT id, recipe_name, recipe_categories, recipe_image FROM recent_recipes";

        $stmt = $conn->prepare("$sql");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // make parallel arrays for the recipe information
        $count = 0;
        $recipeIDs = [];
        $recipeNames = [];
        $recipeCategories = [];
        $recipeImages = [];

        while ($row = $stmt->fetch()) {
            $recipeIDs[$count] = $row['id'];
            $recipeNames[$count] = $row['recipe_name'];
            $recipeCategories[$count] = $row['recipe_categories'];
            $recipeImages[$count] = $row['recipe_image'];
            $count++;
        }

        // store all the recipe information in one array and convert to JSON
        $recipeInformation = [$recipeIDs, $recipeNames, $recipeCategories, $recipeImages];

        $recipeInformationJSON = json_encode($recipeInformation);

        echo $recipeInformationJSON;
        
    } catch(PDOException $e) {
        echo $e;
    }
?>
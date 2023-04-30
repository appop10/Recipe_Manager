<?php
    session_start();

    if ($_SESSION['validUser']) {
        $eventID = $_GET['eventID'];

        try {
            require "../databases/rmConnect.php";
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
            $sqlPull = "SELECT * FROM all_recipes WHERE id=:eventID";
    
            $stmtPull = $conn->prepare("$sqlPull");
            $stmtPull->bindParam(':eventID', $eventID);
            $stmtPull->execute();
            $stmtPull->setFetchMode(PDO::FETCH_ASSOC);
    
            $row = $stmtPull->fetch();

            $recipeName = $row['recipe_name'];
            $prepTime = $row['prep_time'];
            $cookTime = $row['cook_time'];
            $servingSize = $row['serving_size'];
            $category = $row['recipe_category'];
            $ingredient = $row['recipe_ingredient'];
            $complexity = $row['recipe_complexity'];
            $recipeIngredientList = $row['recipe_ingredient_list'];
            $directions = $row['recipe_directions'];
            $recipeImage = $row['recipe_image'];

            $sqlPush = "INSERT INTO popular_recipes (recipe_name, prep_time, cook_time, serving_size, recipe_category, recipe_ingredient, recipe_complexity, recipe_ingredient_list, recipe_directions, recipe_image) VALUES (:recipeName, :prepTime, :cookTime, :servingSize, :recipeCategory, :recipeIngredient, :recipeComplexity, :recipeIngredientList, :directions, :image)";

            $stmtPush = $conn->prepare("$sqlPush");
            $stmtPush->bindParam(':recipeName', $recipeName);
            $stmtPush->bindParam(':prepTime', $prepTime);
            $stmtPush->bindParam(':cookTime', $cookTime);
            $stmtPush->bindParam(':servingSize', $servingSize);
            $stmtPush->bindParam(':recipeCategory', $category);
            $stmtPush->bindParam(':recipeIngredient', $ingredient);
            $stmtPush->bindParam(':recipeComplexity', $complexity);
            $stmtPush->bindParam(':recipeIngredientList', $recipeIngredientList);
            $stmtPush->bindParam(':directions', $directions);
            $stmtPush->bindParam(':image', $recipeImage);

            $stmtPush->execute();
            header("Location: ../popular_recipes/viewPopularRecipes.php");
        } catch(PDOException $e) {
            echo $e;
        }
    }
?>
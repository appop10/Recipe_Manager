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
            $categories = $row['recipe_categories'];
            $ingredients = $row['recipe_ingredients'];
            $directions = $row['recipe_directions'];
            $recipeImage = $row['recipe_image'];

            $sqlPush = "INSERT INTO recent_recipes (recipe_name, prep_time, cook_time, serving_size, recipe_categories, recipe_ingredients, recipe_directions, recipe_image) VALUES (:recipeName, :prepTime, :cookTime, :servingSize, :categories, :ingredients, :directions, :image)";

            $stmtPush = $conn->prepare("$sqlPush");
            $stmtPush->bindParam(':recipeName', $recipeName);
            $stmtPush->bindParam(':prepTime', $prepTime);
            $stmtPush->bindParam(':cookTime', $cookTime);
            $stmtPush->bindParam(':servingSize', $servingSize);
            $stmtPush->bindParam(':categories', $categories);
            $stmtPush->bindParam(':ingredients', $ingredients);
            $stmtPush->bindParam(':directions', $directions);
            $stmtPush->bindParam(':image', $recipeImage);

            $stmtPush->execute();
            header("Location: ../recent_recipes/viewRecentRecipes.php");
        } catch(PDOException $e) {
            echo $e;
        }
    }
?>
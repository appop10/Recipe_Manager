<?php
    session_start();

    if ($_SESSION['validUser']) {
        $eventID = $_GET['eventID'];

        try {
            require "../databases/dbConnect.php";
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
            $sqlPull = "SELECT * FROM recipe_manager_test WHERE id=:eventID";
    
            $stmtPull = $conn->prepare("$sqlPull");
            $stmtPull->bindParam(':eventID', $eventID);
            $stmtPull->execute();
            $stmtPull->setFetchMode(PDO::FETCH_ASSOC);
    
            $row = $stmtPull->fetch();

            $recipeName = $row['name'];
            $prepTime = $row['prep_time'];
            $cookTime = $row['cook_time'];
            $servingSize = $row['servings'];
            $categories = $row['categories'];
            $ingredients = $row['ingredients'];
            $directions = $row['directions'];
            $recipeImage = $row['image'];

            $sqlPush = "INSERT INTO recent_recipes_test (name, prep_time, cook_time, servings, categories, ingredients, directions, image) VALUES (:recipeName, :prepTime, :cookTime, :servingSize, :categories, :ingredients, :directions, :image)";

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

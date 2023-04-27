<?php
    session_start();

    if ($_SESSION['validUser']) {
        try {
            require "databases/dbConnect.php";
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT id, name, prep_time, cook_time, servings, categories FROM recipe_manager_test";
    
            $stmt = $conn->prepare("$sql");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
        } catch(PDOException $e) {
            echo $e;
        }
    } else {
        header("Location: loginPage.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Recipes</title>

    <!-- stylesheets -->
    
</head>
<body>
    <nav>
        <p><a href="loginPage.php">Admin Area</a></p>

        <ul>
            <li><a href="addRecipe.php" class="active">Add Recipe</a></li>
            <li><a href="viewRecipes.php">View All Recipes</a></li>
            <li><a href="logoutPage.php">Sign out</a></li>
        </ul>
    </nav>

    <main>
        <table>
            <tr class="first-row">
                <td>Recipe Name</td>
                <td>Prep Time</td>
                <td>Cook Time</td>
                <td>Servings</td>
                <td>Categories</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
            <?php
                while ($row = $stmt->fetch()) {
                    $categories = json_decode($row['categories']);
            ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['prep_time']; ?> min</td>
                    <td><?php echo $row['cook_time']; ?> min</td>
                    <td><?php echo $row['servings']; ?></td>
                    <td><?php echo $categories[0].", ".$categories[1].", ".$categories[2]; ?></td>
                    <td><a href="#"><button>Edit</button></a></td>
                    <td><a href="#"><button>Delete</button></a></td>
                </tr>
            <?php
                }
            ?>
        </table>
    </main>
</body>
</html>
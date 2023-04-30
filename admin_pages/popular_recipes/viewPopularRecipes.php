<?php
    session_start();

    $deleteRecordConfirm = false;

    if ($_SESSION['validUser']) {
        try {
            require "../databases/rmConnect.php";
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT id, recipe_name, recipe_category, recipe_ingredient, recipe_complexity FROM popular_recipes";
    
            $stmt = $conn->prepare("$sql");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
        } catch(PDOException $e) {
            echo $e;
        }

        if (isset($_GET['eventID'])) {
            $deleteRecordConfirm = true;
            $eventID = $_GET['eventID'];
        }
    } else {
        header("Location: ../loginPage.php");
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
    <link rel="stylesheet" href="../stylesheets/viewAllRecipes.css">
</head>
<body>
    <nav>
        <div>
            <p><a href="../loginPage.php">Admin Area</a></p>

            <ul>
                <li><a href="../addRecipe.php">Add Recipe</a></li>
                <li><a href="../all_recipes/viewAllRecipes.php">All Recipes</a></li>
                <li><a href="../recent_recipes/viewRecentRecipes.php">Recent Recipes</a></li>
                <li><a href="viewPopularRecipes.php" class="active">Popular Recipes</a></li>
                <li><a href="../logoutPage.php">Sign out</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <?php
            if ($deleteRecordConfirm) {
        ?>
            <div class="confirm-delete">
                <form method="post" action="deletePopularRecipe.php?eventID=<?php echo $eventID; ?>">
                    <legend>Confirm Delete</legend>
                    <p>You are about to delete a record. Do you wish to proceed?</p>

                    <p>
                        <input type="submit" name="submit" type="submit" value="Yes, delete record">
                        <a href="viewPopularRecipes.php">No, keep record</a>
                    </p>
                </form>
            </div>
        <?php
            }
        ?>
        <table rules="all">
            <tr class="first-row">
                <td>Recipe Name</td>
                <td class="category-col">Categories</td>
                <td>Delete</td>
            </tr>
            <?php
                while ($row = $stmt->fetch()) {
                    $recipeCategoriesString = $row['recipe_category'] . ", " . $row['recipe_ingredient'] . ", " . $row['recipe_complexity'];
            ?>
                <tr>
                    <td><?php echo $row['recipe_name']; ?></td>
                    <td class="category-col"><?php echo $recipeCategoriesString; ?></td>
                    <td class="delete-col"><a href="viewPopularRecipes.php?eventID=<?php echo $row['id']; ?>"><button>Delete</button></a></td>
                </tr>
            <?php
                }
            ?>
        </table>
    </main>
</body>
</html>
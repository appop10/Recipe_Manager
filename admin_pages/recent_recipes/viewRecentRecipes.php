<?php
    session_start();

    $deleteRecordConfirm = false;

    if ($_SESSION['validUser']) {
        try {
            require "../databases/dbConnect.php";
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
            $sql = "SELECT id, name, categories FROM recent_recipes_test";
    
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
                <li><a href="viewRecentRecipes.php" class="active">Recent Recipes</a></li>
                <li><a href="../popular_recipes/viewPopularRecipes.php">Popular Recipes</a></li>
                <li><a href="../logoutPage.php">Sign out</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <?php
            if ($deleteRecordConfirm) {
        ?>
            <div class="confirm-delete">
                <form method="post" action="deleteRecentRecipe.php?eventID=<?php echo $eventID; ?>">
                    <legend>Confirm Delete</legend>
                    <p>You are about to delete a record. Do you wish to proceed?</p>

                    <p>
                        <input type="submit" name="submit" type="submit" value="Yes, delete record">
                        <a href="viewRecentRecipes.php">No, keep record</a>
                    </p>
                </form>
            </div>
        <?php
            }
        ?>
        <table rules="all">
            <tr class="first-row">
                <td class="name-col">Recipe Name</td>
                <td class="category-col">Categories</td>
                <td>Delete</td>
            </tr>
            <?php
                while ($row = $stmt->fetch()) {
                    $categories = json_decode($row['categories']);
            ?>
                <tr>
                    <td class="name-col"><?php echo $row['name']; ?></td>
                    <td class="category-col"><?php echo $categories[0].", ".$categories[1].", ".$categories[2]; ?></td>
                    <td class="delete-col"><a href="viewRecentRecipes.php?eventID=<?php echo $row['id']; ?>"><button>Delete</button></a></td>
                </tr>
            <?php
                }
            ?>
        </table>
    </main>
</body>
</html>
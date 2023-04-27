<?php
    session_start();

    if ($_SESSION['validUser']) {
        $eventID = $_GET["eventID"];  

        // do the delete
        try {
            require "../databases/dbConnect.php";
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM popular_recipes_test WHERE id=:eventID";

            $stmt = $conn->prepare("$sql");
            $stmt->bindParam(':eventID', $eventID);
            
            $stmt->execute();

            header("Location: viewPopularRecipes.php");
        } catch(PDOException $e) {
            echo "Oops, something went wrong";
        }
    } else {
        header("Location: ../loginPage.php");
    }
?>
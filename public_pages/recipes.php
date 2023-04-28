<?php
    // check for location
    if (isset($_GET['location'])) {
        $location = $_GET['location'];
    } else {
        $location = "All";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Recipe page for All Things Pasta">
    <title>ATP | Recipes</title>

    <link rel="stylesheet" href="stylesheets/recipes.css">

    <script src="javascript/recipes.js"></script>
</head>
<body onload="pageLoad('<?php echo $location; ?>')">
    <nav class="static"><!-- Navbar -->
        <a href="home.html"><img src="../images/logo_white.png" alt="all things pasta logo"></a>

        <ul>
            <li><a href="recipes.php">Recipes</a></li>
            <li><a>About</a></li>
            <li><a>Contact</a></li>
            <li><a class="signin" href="../admin_pages/loginPage.php">Sign In</a></li>
        </ul>
    </nav><!-- Navbar -->

    <div class="title-filter"><!-- Title and filter -->
        <div>
            <h2><!-- changes depending on where the information is from--></h2>
            <a class="green-button">Filter</a>
        </div>

        <!--
            another section to hold the filter options
            will not be visible unless filter is clicked
        -->
    </div><!-- Title and filter -->

    <div class="recipe-list"><!-- Recipes generated dynamically -->
    </div><!-- Recipes -->

    <footer><!-- Footer -->
        <section>
            <a href="#"><img src="../images/logo_white.png" alt="all things pasta logo"></a>

            <div><!-- Browse -->
                <h3>Browse</h3>
                <p><a>All Recipes</a></p>
                <p><a>Recipes by Category</a></p>
                <p><a>Recipes by Ingredient</a></p>
            </div><!-- Browse -->

            <div><!-- Shop -->
                <h3>Shop</h3>
                <p><a>My Cookbook</a></p>
                <p><a>Cookware</a></p>
                <p><a>Merchandise</a></p>
            </div><!-- Shop -->

            <div><!-- Connect -->
                <h3>Connect</h3>
                <p><a>About</a></p>
                <p><a>Contact</a></p>
            </div><!-- Connect -->
        </section>

        <div>
            <p>Photo and Recipe Credits</p>
            <a href="#" target="_blank" class="signin">View</a>
        </div>
    </footer><!-- Footer -->
</body>
</html>
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

    <div class="title-filter"><!-- Title -->
        <div>
            <h2><!-- changes depending on where the information is from--></h2>
            <a class="green-button">Filter</a>
        </div>
    </div><!-- Title -->

    <div class="filter"><!-- Filter -->
        <div><!-- category options -->
            <p>Categories</p>

            <input type="checkbox" name="categorySimple" id="categorySimple">
            <label for="categorySimple">Simple</label>

            <input type="checkbox" name="categoryOnePot" id="categoryOnePot">
            <label for="categoryOnePot">One Pot</label>

            <input type="checkbox" name="categoryFusion" id="categoryFusion">
            <label for="categoryFusion">Fusion</label>

            <input type="checkbox" name="categoryComfort" id="categoryComfort">
            <label for="categoryComfort">Comfort</label>

            <input type="checkbox" name="categorySpicy" id="categorySpicy">
            <label for="categorySpicy">Spicy</label>
        </div><!-- category options -->

        <div><!-- ingredient options -->
            <p>Ingredients</p>

            <input type="checkbox" name="ingredientNoMeat" id="ingredientNoMeat">
            <label for="ingredientNoMeat">No Meat</label>

            <input type="checkbox" name="ingredientChicken" id="ingredientChicken">
            <label for="ingredientChicken">Chicken</label>

            <input type="checkbox" name="ingredientBeef" id="ingredientBeef">
            <label for="ingredientBeef">Beef</label>

            <input type="checkbox" name="ingredientPork" id="ingredientPork">
            <label for="ingredientPork">Pork</label>

            <input type="checkbox" name="ingredientFish" id="ingredientFish">
            <label for="ingredientFish">Fish</label>
        </div><!-- ingredient options -->

        <div><!-- complexity options -->
            <p>Complexities</p>

            <input type="checkbox" name="complexityNovice" id="complexityNovice">
            <label for="complexityNovice">Novice</label>

            <input type="checkbox" name="complexityBeginner" id="complexityBeginner">
            <label for="complexityBeginner">Beginner</label>

            <input type="checkbox" name="complexityIntermediate" id="complexityIntermediate">
            <label for="complexityIntermediate">Intermediate</label>

            <input type="checkbox" name="complexityAdvanced" id="complexityAdvanced">
            <label for="complexityAdvanced">Advanced</label>

            <input type="checkbox" name="complexityExpert" id="complexityExpert">
            <label for="complexityExpert">Expert</label>
        </div><!-- complexity options -->
    </div><!-- Filter -->

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
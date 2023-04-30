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

    <div class="title"><!-- Title & Filter -->
        <div>
            <h2><!-- changes depending on where the information is from--></h2>
            <a class="green-button">Filter</a>
        </div>

        <section class="filter"><!-- Filter -->
            <div><!-- category options -->
                <p>Categories</p>

                <div>
                    <p>
                        <input type="checkbox" name="categorySimple" id="categorySimple">
                        <label for="categorySimple">Simple</label>
                    </p>

                    <p>
                        <input type="checkbox" name="categoryOnePot" id="categoryOnePot">
                        <label for="categoryOnePot">One Pot</label>
                    </p>

                    <p>
                        <input type="checkbox" name="categoryFusion" id="categoryFusion">
                        <label for="categoryFusion">Fusion</label>
                    </p>

                    <p>
                        <input type="checkbox" name="categoryComfort" id="categoryComfort">
                        <label for="categoryComfort">Comfort</label>
                    </p>

                    <p>
                        <input type="checkbox" name="categorySpicy" id="categorySpicy">
                        <label for="categorySpicy">Spicy</label>
                    </p>
                </div>
            </div><!-- category options -->

            <div class="ingredient-options"><!-- ingredient options -->
                <p>Ingredients</p>

                <div>
                    <p>
                        <input type="checkbox" name="ingredientNoMeat" id="ingredientNoMeat">
                        <label for="ingredientNoMeat">No Meat</label>
                    </p>

                    <p>
                        <input type="checkbox" name="ingredientChicken" id="ingredientChicken">
                        <label for="ingredientChicken">Chicken</label>
                    </p>

                    <p>
                        <input type="checkbox" name="ingredientBeef" id="ingredientBeef">
                        <label for="ingredientBeef">Beef</label>
                    </p>

                    <p>
                        <input type="checkbox" name="ingredientPork" id="ingredientPork">
                        <label for="ingredientPork">Pork</label>
                    </p>

                    <p>
                        <input type="checkbox" name="ingredientFish" id="ingredientFish">
                        <label for="ingredientFish">Fish</label>
                    </p>
                </div>
            </div><!-- ingredient options -->

            <div><!-- complexity options -->
                <p>Complexities</p>

                <div>
                    <p>
                        <input type="checkbox" name="complexityNovice" id="complexityNovice">
                        <label for="complexityNovice">Novice</label>
                    </p>

                    <p>
                        <input type="checkbox" name="complexityBeginner" id="complexityBeginner">
                        <label for="complexityBeginner">Beginner</label>
                    </p>

                    <p>
                        <input type="checkbox" name="complexityIntermediate" id="complexityIntermediate">
                        <label for="complexityIntermediate">Intermediate</label>
                    </p>

                    <p>
                        <input type="checkbox" name="complexityAdvanced" id="complexityAdvanced">
                        <label for="complexityAdvanced">Advanced</label>
                    </p>

                    <p>
                        <input type="checkbox" name="complexityExpert" id="complexityExpert">
                        <label for="complexityExpert">Expert</label>
                    </p>
                </div>
            </div><!-- complexity options -->
        </section><!-- Filter -->
    </div><!-- Title & Filter -->

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
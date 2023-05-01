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

    <link rel="stylesheet" href="stylesheets/recipes/recipes.css">
    <link rel="stylesheet" href="stylesheets/recipes/recipes_mq.css">

    <script src="javascript/recipes.js"></script>
</head>

<body onload="pageLoad('<?php echo $location; ?>')">
    <nav class="transforming"><!-- Navbar -->
        <div>
            <a href="home.html"><img src="../images/logo_white.png" alt="all things pasta logo"></a>

            <div class="hamburger" onclick="dropMenu()">
                <p id="bar1"></p>
                <p id="bar2"></p>
                <p id="bar3"></p>
            </div>
        </div>

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
            <div class="filter-options-panel"><!-- filter options panel -->
                <div><!-- category options -->
                    <p>Categories</p>

                    <div>
                        <p>
                            <input type="checkbox" name="Simple" id="Simple">
                            <label for="Simple">Simple</label>
                        </p>

                        <p>
                            <input type="checkbox" name="One Pot" id="One Pot">
                            <label for="One Pot">One Pot</label>
                        </p>

                        <p>
                            <input type="checkbox" name="Fusion" id="Fusion">
                            <label for="Fusion">Fusion</label>
                        </p>

                        <p>
                            <input type="checkbox" name="Comfort" id="Comfort">
                            <label for="Comfort">Comfort</label>
                        </p>

                        <p>
                            <input type="checkbox" name="Spicy" id="Spicy">
                            <label for="Spicy">Spicy</label>
                        </p>
                    </div>
                </div><!-- category options -->

                <div class="ingredient-options"><!-- ingredient options -->
                    <p>Ingredients</p>

                    <div>
                        <p>
                            <input type="checkbox" name="No Meat" id="No Meat">
                            <label for="No Meat">No Meat</label>
                        </p>

                        <p>
                            <input type="checkbox" name="Chicken" id="Chicken">
                            <label for="Chicken">Chicken</label>
                        </p>

                        <p>
                            <input type="checkbox" name="Beef" id="Beef">
                            <label for="Beef">Beef</label>
                        </p>

                        <p>
                            <input type="checkbox" name="Pork" id="Pork">
                            <label for="Pork">Pork</label>
                        </p>

                        <p>
                            <input type="checkbox" name="Fish" id="Fish">
                            <label for="Fish">Fish</label>
                        </p>
                    </div>
                </div><!-- ingredient options -->

                <div><!-- complexity options -->
                    <p>Complexities</p>

                    <div>
                        <p>
                            <input type="checkbox" name="Novice" id="Novice">
                            <label for="Novice">Novice</label>
                        </p>

                        <p>
                            <input type="checkbox" name="Beginner" id="Beginner">
                            <label for="Beginner">Beginner</label>
                        </p>

                        <p>
                            <input type="checkbox" name="Intermediate" id="Intermediate">
                            <label for="Intermediate">Intermediate</label>
                        </p>

                        <p>
                            <input type="checkbox" name="Advanced" id="Advanced">
                            <label for="Advanced">Advanced</label>
                        </p>

                        <p>
                            <input type="checkbox" name="Expert" id="Expert">
                            <label for="Expert">Expert</label>
                        </p>
                    </div>
                </div><!-- complexity options -->
            </div><!-- filter options panel -->

            <div class="filter-search-buttons"><!-- filter search buttons -->
                <button>Apply Filters</button>
                <button>Clear Filters</button>
            </div><!-- filter search buttons -->
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
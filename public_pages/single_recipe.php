<?php
    $recipeLocation = $_GET['location'];
    $recipeID = $_GET['recipeID'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Single recipe page for All Things Pasta">
    <title>ATP | Recipe</title>

    <link rel="stylesheet" href="stylesheets/single_recipe/single_recipe.css">
    <link rel="stylesheet" href="stylesheets/single_recipe/single_recipe_mq.css">

    <script src="javascript/main.js"></script>
    <script src="javascript/single_recipe.js"></script>
</head>

<body onload="pageLoad('<?php echo $recipeLocation?>', '<?php echo $recipeID?>')">
    <nav class="static"><!-- Navbar -->
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

    <main>
        <div class="left-half"><!-- left half -->
            <div>
                <h1></h1>
                <p></p>
            </div>  

            <img>
        </div><!-- left half -->

        <div class="right-half"><!-- right half -->
            <section><!-- general info -->
                <h2>General Information</h2>

                <div><!-- times and servings -->
                    <div id="recipe-times">
                        <p>Prep Time: <span></span></p>
                        <p>Cook Time: <span></span></p>
                        <strong>
                            <p>Total: <span></span></p>
                        </strong>
                    </div>

                    <div id="recipe-size">
                        <p>Serving Size: <span></span></p>

                        <div class="adjust-size">
                            <p class="current-size">1x</p>
                            <p class="double">2x</p>
                            <p>3x</p>
                        </div>
                    </div>
                </div><!-- times and servings -->
            </section><!-- general info -->

            <section><!-- ingredients -->
                <h2>Ingredients</h2>

                <ul id="ingredient-list"></ul>
            </section><!-- ingredients -->

            <section><!-- directions -->
                <h2>Directions</h2>

                <ol></ol>
            </section><!-- directions -->
        </div><!-- right half -->
    </main>
</body>

</html>
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

    <link rel="stylesheet" href="stylesheets/single_recipe.css">

    <script src="javascript/single_recipe.js"></script>
</head>

<body onload="pageLoad('<?php echo $recipeLocation?>', '<?php echo $recipeID?>')">
    <nav class="static"><!-- Navbar -->
        <a href="home.html"><img src="../images/logo_white.png" alt="all things pasta logo"></a>

        <ul>
            <li><a href="recipes.php">Recipes</a></li>
            <li><a>About</a></li>
            <li><a>Contact</a></li>
            <li><a class="signin" href="../admin_pages/loginPage.php">Sign In</a></li>
        </ul>
    </nav><!-- Navbar -->

    <main>
        <div class="left-half"><!-- left half -->
            <img>

            <div>
                <h1></h1>
                <p></p>
            </div>
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

                <ul id="ingredient-list">
                    <li><span class="ingredient-amount">8</span> bamboo skewers</li>
                    <li><span class="ingredient-amount">4 x 200g (7oz)</span> pre-packaged udon noodles</li>
                    <li><span class="ingredient-amount">600g (1lb 5oz)</span> chickn thigh fillets, cut into bite-sized pieces</li>
                    <li>sea salt</li>
                    <li>vegetable oil for frying</li>
                    <li>sliced spring onion (scallions), to serve</li>
                    <li>sesame seeds, to serve</li>
                </ul>
            </section><!-- ingredients -->

            <section><!-- directions -->
                <h2>Directions</h2>

                <ol>
                    <li><span>To prep, soak your bamboo skewers in some cool water. While they're soaking, let's make the teriyaki sauce. Heat the sake, mirin, soy sauce and brown sugar in a small saucepan over medium heat. Bring to the boil, then simmer on low for 3-4 minutes or until the sugar dissolves. Set aside until ready to cook.</span></li>
                    <li><span>Thread chicken pieces onto your soaked bamboo skewers. Transfer to a tray, then sprinkle with sea salt.</span></li>
                    <li><span>Make up the dashi according to packet instructions (you want 8 cups in total - I find one sachet is usually enough for 4 cups of broth, so I used 2 sachets for this recipe). Place the dashi broth, soy sauce, mirin and sugar in a pot over high heat and bring to a simmer. Taste your broth and add salt to taste, if required. Then turn off the heat but cover and keep warm.</span></li>
                    <li><span>Heat a large non-stick frying pan over medium heat. Brush the pan with a little oil. Cook chicken skewers for 2-3 minutes on each side until almost cooked, turning every 30 seconds or so and brushing each time with a generous amount of teriyaki sauce. Keep turning and basting the chicken until the sauce thickens and chicken is cooked through. Transfer skewers to a plate.</span></li>
                </ol>
            </section><!-- directions -->
        </div><!-- right half -->
    </main>
</body>

</html>
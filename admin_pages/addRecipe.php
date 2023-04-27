<?php
session_start();

// flag/switch variable - tells whether or not you requested the form
$formRequested = true;
$errMsg = "";
$recipeNameEmpty = "";
$prepTimeEmpty = "";
$cookTimeEmpty = "";
$servingSizeEmpty = "";

// functions to make sure all fields are filled in
function checkFieldEmpty($inField)
{
    if (empty($inField)) {
        $requireddMsg = "*Field is required";
    } else {
        $requireddMsg = "";
    }

    return $requireddMsg;
}
function countEmptyFields($inFieldArray)
{
    $tally = 0;

    for ($x = 0; $x < count($inFieldArray); $x++) {
        if ($inFieldArray[$x] != "") {
            $tally++;
        }
    }

    return $tally;
}

// if invalid user return to loginPage.php
if (!(isset($_SESSION['validUser']))) {
    header("Location: loginPage.php");
    exit();
}

// process the form if submitted
if (isset($_POST['submit'])) {

    if (empty($_POST['totalTime']) && empty($_POST['imageName']) && empty($_POST['ingredientSection1'])) {
        // general recipe variables
        $recipeName = $_POST['recipeName'];
        $prepTime = $_POST['prepTime'];
        $cookTime = $_POST['cookTime'];
        $servingSize = $_POST['servingSize'];
        $category = $_POST['category'];
        $ingredient = $_POST['ingredient'];
        $complexity = $_POST['complexity'];
        $recipeImage = $_POST['recipeImage'];

        // make a categories array after validation
        $categories = [$category, $ingredient, $complexity];

        // load ingredients into parallel arrays
        $ingredientAmounts = [];
        $ingredientTypes = [];
        $ingredientNames = [];

        for ($x = 0; $x < 21; $x++) {
            $ingredientAmountID = "ingredientAmount$x";
            $ingredientTypeID = "ingredientType$x";
            $ingredientNameID = "ingredientName$x";

            if (isset($_POST[$ingredientAmountID])) {
                $ingredientAmounts[$x] = $_POST[$ingredientAmountID];
            }

            if (isset($_POST[$ingredientTypeID])) {
                $ingredientTypes[$x] = $_POST[$ingredientTypeID];
            }

            if (isset($_POST[$ingredientNameID])) {
                $ingredientNames[$x] = $_POST[$ingredientNameID];
            }
        }

        $ingredients = [$ingredientAmounts, $ingredientTypes, $ingredientNames];

        // load directions variables into an array
        $recipeSteps = [];

        for ($x = 0; $x < 11; $x++) {
            $directionID = "recipeStep$x";

            if (isset($_POST[$directionID])) {
                $recipeSteps[$x] = $_POST[$directionID];
            }
        }

        // arrays to JSON
        $categoriesJSON = json_encode($categories);
        $ingredientsJSON = json_encode($ingredients);
        $recipeStepsJSON = json_encode($recipeSteps);

        // check if other fields are empty
        // show form with require message if any
        // image will default to the logo if empty
        $recipeNameEmpty = checkFieldEmpty($recipeName);
        $prepTimeEmpty = checkFieldEmpty($prepTime);
        $cookTimeEmpty = checkFieldEmpty($cookTime);
        $servingSizeEmpty = checkFieldEmpty($servingSize);

        $singleRecipeFields = [$recipeNameEmpty, $prepTimeEmpty, $cookTimeEmpty, $servingSizeEmpty];

        $emptyTally = countEmptyFields($singleRecipeFields);

        if (empty($recipeImage)) {
            $recipeImage = "logo_black.png";
        }

        if ($emptyTally == 0) {
            $formRequested = false;
           // INSERT into database
            try {
                require "databases/dbConnect.php";
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO recipe_manager_test (name, prep_time, cook_time, servings, categories, ingredients, directions, image) VALUES (:recipeName, :prepTime, :cookTime, :servingSize, :categories, :ingredients, :directions, :image)";

                $stmt = $conn->prepare("$sql");
                $stmt->bindParam(':recipeName', $recipeName);
                $stmt->bindParam(':prepTime', $prepTime);
                $stmt->bindParam(':cookTime', $cookTime);
                $stmt->bindParam(':servingSize', $servingSize);
                $stmt->bindParam(':categories', $categoriesJSON);
                $stmt->bindParam(':ingredients', $ingredientsJSON);
                $stmt->bindParam(':directions', $recipeStepsJSON);
                $stmt->bindParam(':image', $recipeImage);

                $stmt->execute();
            } catch(PDOException $e) {
                $errMsg = "Could not add new recipe. Please try again";
                echo $e;
            }
        } else {
            $formRequested = true;
        }
    } else {
        exit("Form Invalid");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>

    <link rel="stylesheet" href="stylesheets/addRecipe.css">

    <script src="formFunctions.js"></script>
</head>

<body onload="pageLoad()">
    <nav>
        <p><a href="loginPage.php">Admin Area</a></p>

        <ul>
            <li><a href="addRecipe.php" class="active">Add Recipe</a></li>
            <li><a href="viewRecipes.php">View All Recipes</a></li>
            <li><a href="logoutPage.php">Sign out</a></li>
        </ul>
    </nav>

    <main>

        <?php
        if ($formRequested) {
        ?>
            <form method="post" action="addRecipe.php">
                <!-- General Information -->
                <h2>General Information</h2>

                <p>
                    <label for="recipeName">Recipe Name <span class="error-message"><?php echo $recipeNameEmpty; ?></span></label>
                    
                    <input type="text" name="recipeName" id="recipeName" placeholder="Pasta Dish">
                </p>

                <div class="recipe-times"><!-- prep, cook, total time and serving size -->
                    <p>
                        <label for="prepTime">Prep Time</label>
                        <span class="error-message"><?php echo $prepTimeEmpty; ?></span>
                        
                        <input type="number" name="prepTime" id="prepTime" min="0" max="100" step="5" placeholder="minutes">
                    </p>

                    <p>
                        <label for="cookTime">Cook Time</label>
                        <span class="error-message"><?php echo $cookTimeEmpty; ?></span>
                        
                        <input type="number" name="cookTime" id="cookTime" min="0" max="100" step="5" placeholder="minutes">
                    </p>

                    <p>
                        <label for="servingSize">Serving Size</label>
                        <span class="error-message"><?php echo $servingSizeEmpty; ?></span>
                        
                        <input type="number" name="servingSize" id="servingSize" min="0" max="20" step="1" placeholder="servings">
                    </p>

                    <p>
                        <label for="totalTime">Total Time</label>
                        <span></span>
                        
                        <input type="number" name="totalTime" id="totalTime" min="0" max="100" step="5" placeholder="minutes">
                    </p>
                </div><!-- prep, cook, total time and serving size -->

                <div class="recipe-categories"><!-- recipe categories -->
                    <p>
                        <label for="category">Category</label>
                        <select name="category" id="category">
                            <option value="">Please choose one</option>
                            <option value="Simple">Simple</option>
                            <option value="One Pot">One Pot</option>
                            <option value="Fusion">Fusion</option>
                            <option value="Comfort">Comfort</option>
                            <option value="Spicy">Spicy</option>
                        </select>
                    </p>

                    <p>
                        <label for="ingredient">Ingredient</label>
                        <select name="ingredient" id="ingredient">
                            <option value="">Please choose one</option>
                            <option value="No Meat">No Meat</option>
                            <option value="Chicken">Chicken</option>
                            <option value="Beef">Beef</option>
                            <option value="Pork">Pork</option>
                            <option value="Fish">Fish</option>
                        </select>
                    </p>

                    <p>
                        <label for="complexity">Complexity</label>
                        <select name="complexity" id="complexity">
                            <option value="">Please choose one</option>
                            <option value="Novice">Novice</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                            <option value="Expert">Expert</option>
                        </select>
                    </p>
                </div><!-- recipe categories -->

                <p>
                    <label for="imageName">Recipe Image Name</label>
                    <input type="text" name="imageName" id="imageName">

                    <label for="recipeImage">Upload Image</label>
                    <input type="file" name="recipeImage" id="recipeImage" accept="image/png, image/jpeg">
                </p>

                <!-- Ingredient List -->
                <h2>Ingredient List</h2>

                <p>
                    <label for="ingredientSection1">Section Title</label>
                    <input type="text" name="ingredientSection1" id="ingredientSection1">
                </p>

                <div class="ingredient-list"><!-- Ingredient List div -->
                    <div class="ingredient-row"><!-- Intgredient 1 -->
                        <p>
                            <label for="ingredientAmount1">Amount</label>
                            <input type="number" name="ingredientAmount1" id="ingredientAmount1" step="0.01">
                        </p>

                        <p>
                            <label for="ingredientType1">Type</label>
                            <select name="ingredientType1" id="ingredientType1">
                                <option value=""></option>
                                <option value="tsp">tsp</option>
                                <option value="tbsp">tbsp</option>
                                <option value="cup(s)">cup(s)</option>
                                <option value="lb(s)">lb(s)</option>
                                <option value="oz">oz</option>
                            </select>
                        </p>

                        <p class="ingredient-name">
                            <label for="ingredientName1">Ingredient Name</label>
                            <input type="text" name="ingredientName1" id="ingredientName1">
                        </p>
                    </div><!-- Intgredient 1 -->
                </div><!-- Ingredient List div -->

                <p class="add-parts">
                    <a class="button">+ Add Ingredient</a>
                    <a class="button"></a>
                </p>

                <!-- Directions -->
                <h2>Directions</h2>

                <div class="direction-list">
                    <p>
                        <label for="recipeStep1">Step 1</label>
                        <textarea name="recipeStep1" id="recipeStep1" rows="10"></textarea>
                    </p>

                    <p>
                        <label for="recipeStep2">Step 2</label>
                        <textarea name="recipeStep2" id="recipeStep2" rows="10"></textarea>
                    </p>

                    <p>
                        <label for="recipeStep3">Step 3</label>
                        <textarea name="recipeStep3" id="recipeStep3" rows="10"></textarea>
                    </p>
                </div>

                <p class="add-parts">
                    <a class="button">+ Add Step</a>
                    <a class="button"></a>
                </p>

                <!-- Submit and Clear buttons -->
                <div class="form-buttons">
                    <input type="submit" name="submit" id="submit" value="Submit">
                    <input type="reset" name="reset" id="reset" value="Clear">
                </div>
            </form>
        <?php
        } else {
        ?>
            <div class="confirm-message">
                <div>
                    <img src="../images/logo_black.png" alt="all things pasta logo">
                    <?php 
                        if ($errMsg == "") {
                    ?>
                        <h1>New Recipe Added!</h1>
                        <h2>View all recipes to see your changes</h2>
                    <?php
                        } else {
                    ?>
                        <h1><?php echo $errMsg; ?></h1>
                    <?php
                        }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
    </main>
</body>

</html>
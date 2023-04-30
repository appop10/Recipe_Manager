/*
    JavaScript for ATP Single Recipe
*/

function pageLoad(inLocation, inID) {
    getRecipeInfo(inLocation, inID);
}

function getRecipeInfo(inLocation, inID) {
    fetch("php/getSingleRecipe.php?location=" + inLocation + "&recipeID=" +inID, {
        method: "POST",
        headers: {
            'Accept': 'application/json'
        }
    }).then((response) => {
        return response.json();
    }).then((response) => {
        // separate response into different variables
        let recipeName = response[0];
        let prepTime = response[1];
        let cookTime = response[2];
        let servingSize = response[3];
        let recipeCategoriesJSON = response[4];
        let recipeIngredientsJSON = response[5];
        let recipeDescription = response[6];
        let recipeImage = response[7];
        // print them to the page
        // left side
        // image
        let imagePath = "../images/food-images/" + recipeImage;
        let pageImage = document.querySelector("div.left-half img");
        pageImage.setAttribute("src", imagePath);
        pageImage.setAttribute("alt", recipeName);
        // h1
        let pageName = document.querySelector("div.left-half div h1");
        pageName.innerHTML = recipeName;
        // p
        let recipeCategories = JSON.parse(recipeCategoriesJSON);
        let recipeCategoriesString = recipeCategories[0] + " - " + recipeCategories[1] + " - " + recipeCategories[2];
        let pageCategories = document.querySelector("div.left-half div p");
        pageCategories.innerHTML = recipeCategoriesString;
        // right side
        // general information
        let recipeTimesSpans = document.querySelectorAll("#recipe-times span");
        recipeTimesSpans[0].innerHTML = prepTime + " minutes";
        recipeTimesSpans[1].innerHTML = cookTime + " minutes";
        recipeTimesSpans[2].innerHTML = prepTime + cookTime + " minutes";
        let recipeSizeSpan = document.querySelector("#recipe-size span");
        recipeSizeSpan.innerHTML = servingSize + " servings";
        // ingredients
        let recipeIngredients = JSON.parse(recipeIngredientsJSON);
        let recipeIngredientAmounts = [recipeIngredients[0]];
        let ingredientList = document.querySelector("#ingredient-list");


        console.log(recipeIngredientAmounts);
    })
}

function addLiElement() {
    console.log("li element");
}
function doubleRecipe(inLocation, inID) {
    fetch("php/getSingleRecipe.php?location=" + inLocation + "&recipeID=" +inID, {
        method: "POST",
        headers: {
            'Accept': 'application/json'
        }
    }).then((response) => {
        return response.json();
    }).then((response) => {
        // grab the time, servings, and amounts to double them
        // print them to the page
    })
}
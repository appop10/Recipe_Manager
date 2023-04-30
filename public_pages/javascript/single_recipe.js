/*
    JavaScript for ATP Single Recipe
*/



function pageLoad(inLocation, inID) {
    // generate recipe information
    getRecipeInfo(inLocation, inID);

     // select all the "buttons" (p elements)
    let sizeButtons = document.querySelectorAll("div.adjust-size p");

    // onclick events for the buttons
    sizeButtons[0].onclick = () => {
        console.log("single size");
    }
    sizeButtons[1].onclick = () => {
        console.log("double the size!");
    }
    sizeButtons[2].onclick = () => {
        console.log("tripple the size!");
    }
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
        let recipeDirectionsJSON = response[6];
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
        let recipeIngredientAmounts = JSON.parse(recipeIngredients[0]);
        let recipeIngredientTypes = JSON.parse(recipeIngredients[1]);
        let recipeIngredientNames = JSON.parse(recipeIngredients[2]);
        let ingredientList = document.querySelector("#ingredient-list");

        let count = 1;
        let stop = false;

        while (!stop) {

            if (recipeIngredientAmounts[count] || recipeIngredientAmounts[count] == "") {
                let listElement = document.createElement("li");
                listElement.innerHTML = recipeIngredientAmounts[count] + " " + recipeIngredientTypes[count] + " " + recipeIngredientNames[count];

                ingredientList.appendChild(listElement);
            } else {
                stop = true;
            }
            
            count++;
        }

        count = 1;
        stop = false;

        // directions
        let recipeDirections = JSON.parse(recipeDirectionsJSON);
        let directionList = document.querySelector("ol");

        while (!stop) {

            if (recipeDirections[count] || recipeDirections[count] == "") {
                let spanElement = document.createElement("span");
                spanElement.innerHTML = recipeDirections[count];
                let listElement = document.createElement("li");
                listElement.appendChild(spanElement);

                directionList.appendChild(listElement);
            } else {
                stop = true;
            }
            
            count++;
        }

        // console.log(count);
    })
}

function doubleRecipe() {
    console.log("double the recipe!");
}

function trippleRecipe() {
    console.log("tripple the recipe!");
}
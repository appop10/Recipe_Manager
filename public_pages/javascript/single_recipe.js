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
        if (!(sizeButtons[0].classList.contains("current-size"))) {
            for (x=0; x < sizeButtons.length; x++) {
                if (sizeButtons[x].classList.contains("current-size")) {
                    sizeButtons[x].classList.toggle("current-size");
                }
            }

            sizeButtons[0].classList.toggle("current-size");
            changeRecipeInformation(inLocation, inID, 1);
        }
    }
    sizeButtons[1].onclick = () => {
        if (!(sizeButtons[1].classList.contains("current-size"))) {
            for (x=0; x < sizeButtons.length; x++) {
                if (sizeButtons[x].classList.contains("current-size")) {
                    sizeButtons[x].classList.toggle("current-size");
                }
            }

            sizeButtons[1].classList.toggle("current-size");
            changeRecipeInformation(inLocation, inID, 2);
        }
    }
    sizeButtons[2].onclick = () => {
        if (!(sizeButtons[2].classList.contains("current-size"))) {
            for (x=0; x < sizeButtons.length; x++) {
                if (sizeButtons[x].classList.contains("current-size")) {
                    sizeButtons[x].classList.toggle("current-size");
                }
            }

            sizeButtons[2].classList.toggle("current-size");
            changeRecipeInformation(inLocation, inID, 3);
        }
    }
}
// repeated steps 
function printGeneralInfo(inPrepTime, inCookTime, inServingSize) {
    let recipeTimesSpans = document.querySelectorAll("#recipe-times span");
    recipeTimesSpans[0].innerHTML = inPrepTime + " minutes";
    recipeTimesSpans[1].innerHTML = inCookTime + " minutes";
    recipeTimesSpans[2].innerHTML = inPrepTime + inCookTime + " minutes";
    let recipeSizeSpan = document.querySelector("#recipe-size span");
    recipeSizeSpan.innerHTML = inServingSize + " servings";
}
// Generate recipe information and print to page
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
        printGeneralInfo(prepTime, cookTime, servingSize);
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
    })
}
// change recipe information and ingredients, print to page
function changeRecipeInformation(inLocation, inID, multiplier) {
    // remove old ingredient list
    let oldIngerdientList = document.querySelector("#ingredient-list");
    
    oldIngerdientList.remove();

    // get recipe information
    fetch("php/getSingleRecipeIngredients.php?location=" + inLocation + "&recipeID=" +inID, {
        method: "POST",
        headers: {
            'Accept': 'application/json'
        }
    }).then((response) => {
        return response.json();
    }).then((response) => {
        // separate response into different variables
        let prepTime = response[0];
        let cookTime = response[1];
        let servingSize = response[2];
        let recipeIngredientsJSON = response[3];
        // multiply the times and servings
        prepTime *= multiplier;
        cookTime *= multiplier;
        servingSize *= multiplier;
        // print them to the page
        // general information
        printGeneralInfo(prepTime, cookTime, servingSize);
        // ingredients
        let recipeIngredients = JSON.parse(recipeIngredientsJSON);
        let recipeIngredientAmounts = JSON.parse(recipeIngredients[0]);
        let recipeIngredientTypes = JSON.parse(recipeIngredients[1]);
        let recipeIngredientNames = JSON.parse(recipeIngredients[2]);

        // make new ingredient list element
        let newIngredientList = document.createElement("ul");
        newIngredientList.setAttribute("id", "ingredient-list");

        let count = 1;
        let stop = false;

        while (!stop) {

            if (recipeIngredientAmounts[count] || recipeIngredientAmounts[count] == "") {
                // change ingredient amounts
                if (recipeIngredientAmounts[count]) {
                    recipeIngredientAmounts[count] *= multiplier;
                }
                // add them to new list element
                let listElement = document.createElement("li");
                listElement.innerHTML = recipeIngredientAmounts[count] + " " + recipeIngredientTypes[count] + " " + recipeIngredientNames[count];

                newIngredientList.appendChild(listElement);
            } else {
                stop = true;
            }
            
            count++;
        }

        // add new list to the ingredient section 
        let divSections = document.querySelectorAll("div.right-half section");
        let ingredientSection = divSections[1];
        ingredientSection.appendChild(newIngredientList);
    })
}
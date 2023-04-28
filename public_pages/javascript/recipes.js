/*
    JavaScript for ATP Recipes
*/

function pageLoad(inLocation) {
    // generate recipe cards
    getRecipeInfo(inLocation);
}

// create card elements
function makeRecipeCard(inID, inName, inCategories, inImage, inLocation) {
    let imagePath = "../images/food-images/" + inImage;
    let categories = JSON.parse(inCategories);
    let categoryText = categories[0] + " - " + categories[1] + " - " + categories[2];

    // image
    let image = document.createElement("img");
    image.setAttribute("src", imagePath);
    image.setAttribute("alt", inName);    
    // h3
    let h3 = document.createElement("h3");
    h3.innerHTML = inName;
    // p
    let p = document.createElement("p");
    p.innerHTML = categoryText;
    // a
    let a = document.createElement("a");
    a.setAttribute("href", "single_recipe.html?location=" + inLocation + "?recipeID=" + inID);
    a.appendChild(image);
    a.appendChild(h3);
    a.appendChild(p);

    return a;
}

// fetch call for the recipe information
function getRecipeInfo(inLocation) {
    fetch("php/getRecipesPage.php?location=" + inLocation, {
        method: "POST",
        headers: {
            'Accept': 'application/json'
        }
    }).then((response) => {
        return response.json();
    }).then((response) => {
        // load response JSON into separate arrays
        let recipeListDiv = document.querySelector("div.recipe-list");
        let titleH2 = document.querySelector("div.title-filter div h2");
        let recipeIDs = response[0];
        let recipeNames = response[1];
        let recipeCategories = response[2];
        let recipeImages = response[3];
        let recipeLocation = response[4];
        let recipeCards = [];

        // make an array of a elements
        for (x=0; x < recipeIDs.length; x++) {
            recipeCards[x] = makeRecipeCard(recipeIDs[x], recipeNames[x], recipeCategories[x], recipeImages[x], recipeLocation);
        }

        let lastEntry = recipeCards.length - 1;

        // append a elements to the specified section
        for (x=lastEntry; x > -1; x--) {
            recipeListDiv.appendChild(recipeCards[x]);
        }
        
        // set the title of the page
        titleH2.innerHTML = recipeLocation + " Recipes";
    }) 
}
/*
    JavaScript for ATP Home
*/

// dynamically generate recipe cards
function pageLoad() {
    getRecipeInfo();
}

// create card elements
function makeRecipeCard(inID, inName, inCategories, inImage) {
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
    a.setAttribute("href", "recipes.html?recipeID=" + inID);
    a.appendChild(image);
    a.appendChild(h3);
    a.appendChild(p);

    return a;
}

// fetch call for the recipe information
function getRecipeInfo() {
    fetch("php/getAllRecipes.php", {
        method: "POST",
        headers: {
            'Accept': 'application/json'
        }
    }).then((response) => {
        return response.json();
    }).then((response) => {
        // load response JSON into separate arrays
        let recipeListDiv = document.querySelector("div.recipe-list");
        let recipeIDs = response[0];
        let recipeNames = response[1];
        let recipeCategories = response[2];
        let recipeImages = response[3];
        let recipeCards = [];

        // make an array of a elements
        for (x=0; x < recipeIDs.length; x++) {
            recipeCards[x] = makeRecipeCard(recipeIDs[x], recipeNames[x], recipeCategories[x], recipeImages[x]);
        }

        let lastEntry = recipeCards.length - 1;

        // append a elements to the specified section
        for (x=lastEntry; x > 0; x--) {
            recipeListDiv.appendChild(recipeCards[x]);
        }
    }) 
}
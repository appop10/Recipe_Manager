/*
    JavaScript for ATP Home
*/
let recipeDivs = "";

// page load events
function pageLoad() {
    recipeDivs = document.querySelectorAll("div.recipes section");
    // fetch recipe information
    getRecentRecipes();

    // generate recipe cards
    
    // seperate the sections to target them
    let popularRecipeSection = recipeDivs[1];

    // loop through to make 3 recipe cards in each section
    for (x=0; x < 3; x++) {
        // recentRecipeSection.appendChild(recentRecipes[x]);
        // popularRecipeSection.appendChild(makeRecipeCard());
    }
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

// fetch call for the recent recipes
function getRecentRecipes() {
    fetch("php/getRecentRecipes.php", {
        method: "POST",
        headers: {
            'Accept': 'application/json'
        }
    }).then((response) => {
        return response.json();
    }).then((response) => {
        let recentRecipeSection = recipeDivs[0];
        let recipeIDs = response[0];
        let recipeNames = response[1];
        let recipeCategories = response[2];
        let recipeImages = response[3];
        let recentRecipes = [];

        for (x=0; x < recipeIDs.length; x++) {
            recentRecipes[x] = makeRecipeCard(recipeIDs[x], recipeNames[x], recipeCategories[x], recipeImages[x]);
        }

        let lastEntry = recentRecipes.length - 1;

        for (x=lastEntry; x > (lastEntry - 3); x--) {
            recentRecipeSection.appendChild(recentRecipes[x]);
        }
    }) 
}
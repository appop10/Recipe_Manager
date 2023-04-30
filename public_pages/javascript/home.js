/*
    JavaScript for ATP Home
*/

// page load events
function pageLoad() {
    let recipeDivs = document.querySelectorAll("div.recipes section");
    let recentSection = recipeDivs[0];
    let popularSection = recipeDivs[1];

    let recentPHPLink = "php/getRecentRecipes.php";
    let recentLocation = "Recent";
    let popularPHPLink = "php/getPopularRecipes.php";
    let popularLocation = "Popular";


    // fetch recipe information
    getRecipeInfo(recentPHPLink, recentSection, recentLocation);
    getRecipeInfo(popularPHPLink, popularSection, popularLocation);
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
    a.setAttribute("href", "single_recipe.php?location=" + inLocation + "&recipeID=" + inID);
    a.appendChild(image);
    a.appendChild(h3);
    a.appendChild(p);

    return a;
}

// fetch call for the recipe information
function getRecipeInfo(inPHPLink, inSection, inLocation) {
    fetch(inPHPLink, {
        method: "POST",
        headers: {
            'Accept': 'application/json'
        }
    }).then((response) => {
        return response.json();
    }).then((response) => {
        // load response JSON into separate arrays
        let recipeIDs = response[0];
        let recipeNames = response[1];
        let recipeCategories = response[2];
        let recipeImages = response[3];
        let recipeCards = [];

        // make an array of a elements
        for (x=0; x < recipeIDs.length; x++) {
            recipeCards[x] = makeRecipeCard(recipeIDs[x], recipeNames[x], recipeCategories[x], recipeImages[x], inLocation);
        }

        let lastEntry = recipeCards.length - 1;

        // append a elements to the specified section
        for (x=lastEntry; x > (lastEntry - 3); x--) {
            inSection.appendChild(recipeCards[x]);
        }
    }) 
}
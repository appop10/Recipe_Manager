/*
    JavaScript for ATP Recipes
*/

function pageLoad(inLocation) {
    // generate recipe cards
    getRecipeInfo(inLocation);

    // onclick event for filter button
    document.querySelector("a.green-button").onclick = () => {
        filterDropDown();
    }

    // element lists
    let filterButtons = document.querySelectorAll("div.filter-search-buttons button");
    let filterOptions = document.querySelectorAll("div.filter-options-panel div input");

    // onclick event for apply filter button
    filterButtons[0].onclick = () => {
        let filterList = [];

        for (x=0; x < filterOptions.length; x++) {
            if (filterOptions[x].checked) {
                filterList[x] = filterOptions[x].name;
            } else {
                filterList[x] = "";
            }
        }

        applyFilter(inLocation, filterList);
    }

    // onclick event for clear filter button
    filterButtons[1].onclick = () => {
        for (x=0; x < filterOptions.length; x++) {
            filterOptions[x].checked = false;
        }
    }
}

// create card elements
function makeRecipeCard(inID, inName, inCategories, inIngredients, inComplexities, inImage, inLocation) {
    let imagePath = "../images/food-images/" + inImage;
    let categoryText = inCategories + " - " + inIngredients + " - " + inComplexities;

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
        let titleH2 = document.querySelector("div.title div h2");
        let recipeIDs = response[0];
        let recipeNames = response[1];
        let recipeCategories = response[2];
        let recipeIngredients = response[3];
        let recipeComplexities = response[4];
        let recipeImages = response[5];
        let recipeLocation = response[6];
        let recipeCards = [];

        // make an array of a elements
        for (x=0; x < recipeIDs.length; x++) {
            recipeCards[x] = makeRecipeCard(recipeIDs[x], recipeNames[x], recipeCategories[x], recipeIngredients[x], recipeComplexities[x], recipeImages[x], recipeLocation);
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

// show/hide filter options
function filterDropDown() {
    let filterSection = document.querySelector("section.filter");
    let titlePadding = document.querySelector("div.title");

    titlePadding.classList.toggle("add-padding");
    filterSection.classList.toggle("show-filter");
}

// fetch call for filtered data
function applyFilter(inLocation, inFilterNames) {
    // create a parameter string of filter names
    let getParamString = "";
    let count = 1;

    for (x=0; x < inFilterNames.length; x++) {
        if (inFilterNames[x]) {
            getParamString += "&filterName" + count + "=" + inFilterNames[x];
            count++;
        }
    }

    console.log(getParamString);
    // fetch the information
    // fetch("php/getFilteredRecipes.php?location=" + inLocation + getParamString, {
    //     method: "POST",
    //     headers: {
    //         'Accept': 'application/json'
    //     }
    // }).then((response) => {
    //     return response.json();
    // }).then((response) => {
    //     console.log(response);
    // })
}
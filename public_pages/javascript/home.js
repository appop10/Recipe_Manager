/*
    JavaScript for ATP Home
*/

// dynamically generate recipe cards
function pageLoad() {
    let recipeDivs = document.querySelectorAll("div.recipes section");
    // seperate the sections to target them
    let recentRecipes = recipeDivs[0];
    let popularRecipes = recipeDivs[1];

    // loop through to make 3 recipe cards in each section
    for (x=0; x < 3; x++) {
        recentRecipes.appendChild(makeRecipeCard());
        popularRecipes.appendChild(makeRecipeCard());
    }
}

// create card elements
function makeRecipeCard() {
    let imagePath = "../images/food-images/";

    // image
    let image = document.createElement("img");
    image.setAttribute("src", imagePath + "10-minute-Spicy-Chilli-Garlic-Oil-Noodles-02.jpg");      // take the recipe_image 
    image.setAttribute("alt", "10 minute spicy chilli garlic oil noodles");     // take the reipce_name
    // h3
    let h3 = document.createElement("h3");
    h3.innerHTML = "10-minute Spicy Chilli Garlic Oil Noodles";     // take the recipe_name
    // p
    let p = document.createElement("p");
    p.innerHTML = "Quick - Asian - No Meat";    // will be categories
    // a
    let a = document.createElement("a");
    a.appendChild(image);
    a.appendChild(h3);
    a.appendChild(p);

    return a;
}
/*
    Contains the button functions for addRecipe.php
*/
let ingredientCount = 1;
let stepCount = 3;

// make the type options
function createIngredientTypeOptions() {
    let typeOption1 = document.createElement("option");
    typeOption1.setAttribute("value", "");
    let typeOption2 = document.createElement("option");
    typeOption2.setAttribute("value", "tsp");
    typeOption2.innerHTML = "tsp";
    let typeOption3 = document.createElement("option");
    typeOption3.setAttribute("value", "tbsp");
    typeOption3.innerHTML = "tbsp";
    let typeOption4 = document.createElement("option");
    typeOption4.setAttribute("value", "cup(s)");
    typeOption4.innerHTML = "cup(s)";
    let typeOption5 = document.createElement("option");
    typeOption5.setAttribute("value", "lb(s)");
    typeOption5.innerHTML = "lb(s)";
    let typeOption6 = document.createElement("option");
    typeOption6.setAttribute("value", "oz");
    typeOption6.innerHTML = "oz";

    return [typeOption1, typeOption2, typeOption3, typeOption4, typeOption5, typeOption6];
}
// creating the new ingredient elements
function addIngredient() {
    ingredientCount++;

    // ID variables
    let amountID = "ingredientAmount" + ingredientCount;
    let typeID = "ingredientType" + ingredientCount;
    let nameID = "ingredientName" + ingredientCount;
    let paragraphID = "addIngredient" + ingredientCount;

    // Amount
    let amountLabel = document.createElement("label");
    amountLabel.setAttribute("for", amountID);
    amountLabel.innerHTML = "Amount";
    let amountInput = document.createElement("input");
    amountInput.setAttribute("type", "number");
    amountInput.setAttribute("name", amountID);
    amountInput.setAttribute("id", amountID);
    amountInput.setAttribute("step", "0.01");
    // Type
    let typeLabel = document.createElement("label");
    typeLabel.setAttribute("for", typeID);
    typeLabel.innerHTML = "Type";
    let typeOptions = createIngredientTypeOptions();
    let typeSelect = document.createElement("select");
    typeSelect.setAttribute("name", typeID);
    typeSelect.setAttribute("id", typeID);

    for (x=0; x<typeOptions.length; x++) {
        typeSelect.appendChild(typeOptions[x]);
    }

    // Name
    let nameLabel = document.createElement("label");
    nameLabel.setAttribute("for", nameID);
    nameLabel.innerHTML = "Ingredient Name";
    let nameInput = document.createElement("input");
    nameInput.setAttribute("type", "text");
    nameInput.setAttribute("name", nameID);
    nameInput.setAttribute("id", nameID);
    // paragraphs for each label/input pair
    let amountPara = document.createElement("p");
    amountPara.appendChild(amountLabel);
    amountPara.appendChild(amountInput);
    let typePara = document.createElement("p");
    typePara.appendChild(typeLabel);
    typePara.appendChild(typeSelect);
    let namePara = document.createElement("p");
    namePara.setAttribute("class", "ingredient-name");
    namePara.appendChild(nameLabel);
    namePara.appendChild(nameInput);
    // div all together
    let elements = [amountPara, typePara, namePara];
    let ingredientDiv = document.createElement("div");
    ingredientDiv.setAttribute("class", "ingredient-row");
    ingredientDiv.setAttribute("id", paragraphID);
    
    for (x=0; x<elements.length; x++) {
        ingredientDiv.appendChild(elements[x]);
    }
    
    return ingredientDiv;
}
function addStep() {
    stepCount++;

    // ID variables
    let stepID = "recipeStep" + stepCount;
    let paragraphID = "addStep" + stepCount;

    // label and input
    let stepLabel = document.createElement("label");
    stepLabel.setAttribute("for", stepID);
    stepLabel.innerHTML = "Step" + stepCount;
    let stepTextarea = document.createElement("textarea");
    stepTextarea.setAttribute("name", stepID);
    stepTextarea.setAttribute("id", stepID);
    stepTextarea.setAttribute("rows", "10");

    // paragraph all together
    let stepPara = document.createElement("p");
    stepPara.setAttribute("id", paragraphID);
    stepPara.appendChild(stepLabel);
    stepPara.appendChild(stepTextarea);

    return stepPara;
}
// remove elements
function removeIngredient() {
    if (ingredientCount > 20) {
        ingredientCount = 20;
    }

    let paragraphID = "#addIngredient" + ingredientCount;
    let ingredientNumber = document.querySelector(paragraphID);

    ingredientNumber.remove();
    ingredientCount--;
}
function removeStep() {
    if (stepCount > 10) {
        stepCount = 10;
    }

    let paragraphID = "#addStep" + stepCount;
    let stepNumber = document.querySelector(paragraphID);

    stepNumber.remove();
    stepCount--;
}

// button events
function pageLoad() {
    let buttons = document.querySelectorAll("form p a.button");
    let ingredientDiv = document.querySelector(".ingredient-list");
    let directionsDiv = document.querySelector(".direction-list");

    // generate two ingredient-row divs
    ingredientDiv.appendChild(addIngredient());
    ingredientDiv.appendChild(addIngredient());

    buttons[0].onclick = () => {
        let newIngredient = addIngredient();

        if (ingredientCount > 3) {
            buttons[1].innerHTML = "- Remove Ingredient";
        } 

        if (ingredientCount > 30) {
            buttons[0].innerHTML = "Ingredient List Full";
        } else {
            ingredientDiv.appendChild(newIngredient);
        }
    }
    buttons[1].onclick = () => {
        if (ingredientCount <= 4) {
            buttons[1].innerHTML = "";
        } 

        removeIngredient();
        buttons[0].innerHTML = "+ Add Ingredient";
    }
    buttons[2].onclick = () => {
        let newStep = addStep();

        if (stepCount > 3) {
            buttons[3].innerHTML = "- Remove Ingredient";
        } 

        if (stepCount > 15) {
            buttons[2].innerHTML = "Directions List Full";
        } else {
            directionsDiv.appendChild(newStep);
        }
    }
    buttons[3].onclick = () => {
        if (stepCount <= 4) {
            buttons[3].innerHTML = "";
        }

        removeStep();
        buttons[2].innerHTML = "+ Add Step";
    }
}
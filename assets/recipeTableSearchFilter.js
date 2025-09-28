import List from "list.js";

const options =
    { valueNames: [
            'title',
            'type'
        ]};

const recipesList = new List('recipes', options);
document.getElementById('recipe-type-filters').addEventListener('change', () => {
    const selectedType = document.getElementById('recipe-type-filters').value;
    if (selectedType === '') {
        recipesList.filter(() => true);
    } else {
        recipesList.filter((recipe) => recipe.values().type === selectedType);
    }
});
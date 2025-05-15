//TODO voir pour généraliser ce composant + documenter l'implémentation
const selectRecipeType = document.getElementById('select-recipe-type');
let recipeTypesPicked = [];
new TomSelect(selectRecipeType,{
    onItemAdd: function() {
        recipeTypesPicked = this.items;
    }
});

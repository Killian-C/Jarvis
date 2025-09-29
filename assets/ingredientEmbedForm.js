const ingredientsContainer = document.getElementById('ingredients-container');
ingredientForm = ingredientsContainer.dataset.prototype;
addIngredientButton = document.getElementById('add-ingredient');
let index = 0;
const regex = /__name__/g;
const asyncIngredientsUrl = ingredientsContainer.dataset.asyncIngredientsUrl;

const initIngredientTomSelect = (selectInput) => {

    const selectedValue = selectInput.value;
    const selectedText = selectInput.options[selectInput.selectedIndex]?.text ?? '';
    const selectedOption = selectedValue
        ? [{ id: selectedValue, name: selectedText }]
        : [];

    new TomSelect(selectInput, {
        options: selectedOption,
        items: selectedValue ? [selectedValue] : [],
        valueField: 'id',
        labelField: 'name',
        searchField: ['name'],
        sortField: [{field:'$order'},{field:'$score'}],
        load: function(query, callback) {
            let url = `${asyncIngredientsUrl}?search=${encodeURIComponent(query)}`;
            fetch(url)
                .then(response => {
                    return response.json()
                })
                .then(items => {
                    callback(items)
                })
                .catch((e)=>{
                    console.error(`Error during aliments fetching : ${e}`)
                    callback();
                });
        },
    });
}

ingredientsContainer.querySelectorAll('.tom-select-ingredients').forEach((el) => {
    if (!el.tomselect) {
        initIngredientTomSelect(el)
    }
});

addIngredientButton.addEventListener('click', (e) => {
    e.preventDefault();
    index++;

    let listedForm = document.createElement('li');
    listedForm.classList.add('recipe-new-ingredients-card');
    const suffix = 'ingredient_' + index;
    const formId = 'recipe_ingredients_' + suffix;

    listedForm.innerHTML = ingredientForm.replace(regex, suffix);

    const deleteBtn = document.createElement('button');
    deleteBtn.classList.add('btn', 'btn-secondary');
    deleteBtn.innerHTML  = '<i class="fas fa-trash"></i>'
    deleteBtn.addEventListener('click', (e) => {
        e.preventDefault();
        listedForm.remove();
    })
    listedForm.appendChild(deleteBtn);

    ingredientsContainer.appendChild(listedForm);

    const newSelect = listedForm.querySelector('.tom-select-ingredients');
    if (newSelect && !newSelect.tomselect) {
        initIngredientTomSelect(newSelect);
    }
})
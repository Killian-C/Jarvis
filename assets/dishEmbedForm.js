const mainContainer = document.getElementById('shifts-container');
const asyncSearchUrl = mainContainer.dataset.asyncUrl;
const dishBlocks = document.getElementsByClassName('dishes-block');
const seasonsQuery = mainContainer.dataset.seasonsQuery;
const initTomSelect = (selectInput) => {

    const selectedValue = selectInput.value;
    const selectedText = selectInput.options[selectInput.selectedIndex]?.text ?? '';
    const selectedOption = selectedValue
        ? [{ id: selectedValue, title: selectedText }]
        : [];

    new TomSelect(selectInput, {
        valueField: 'id',
        labelField: 'title',
        searchField: ['title', 'searchText'],
        options: selectedOption,
        items: selectedValue ? [selectedValue] : [],
        sortField: [{field:'$order'},{field:'$score'}],
        load: function(query, callback) {
            let url = `${asyncSearchUrl}?search=${encodeURIComponent(query)}&inRecipeTypes=${recipeTypesPicked}&forSeasons=${seasonsQuery}`;
            fetch(url)
                .then(response => {
                    return response.json()
                })
                .then(items => {
                    callback(items)
                })
                .catch((e)=>{
                    console.error(`Error during recipes fetching : ${e}`)
                    callback();
                });
        },
        onFocus: function() {
            this.load('');
        },
        render: {
            option: function (data, escape) {
                return `<p>${escape(data.title)}</p>`
            }
        }
    });
}

const addRemovedBtn = (elementToRemove) => {
    const deleteBtn = document.createElement('button');
    deleteBtn.innerHTML  = '<i class="fas fa-trash btn btn-secondary"></i>'
    deleteBtn.addEventListener('click', (e) => {
        e.preventDefault();
        elementToRemove.remove();
    })
    elementToRemove.appendChild(deleteBtn);
}

const clearOptionsForAllTomSelects = () => {
    dishBlocks.forEach( container => {
        container.querySelectorAll('.tom-select-recipes').forEach((el) => {
            if (el.tomselect) {
                el.tomselect.clearOptions();
            }
        })
    })
}


// *** Filtre par recipeTypes ***
const selectRecipeType = document.getElementById('select-recipe-type');
const defautRecipeTypes = Array.from(selectRecipeType.options).filter(option => option.selected).map(option => option.value);
let recipeTypesPicked = selectRecipeType.dataset.recipeTypes !== "" ? selectRecipeType.dataset.recipeTypes : defautRecipeTypes;
new TomSelect(selectRecipeType,{
    plugins: ['input_autogrow'],
    items: defautRecipeTypes,
    onItemAdd: function() {
        recipeTypesPicked = this.items;
        clearOptionsForAllTomSelects();
    },
    onItemRemove: function () {
        recipeTypesPicked = this.items;
        clearOptionsForAllTomSelects();
    }
});
// *********************************

dishBlocks.forEach( container => {
    let dishForm  = container.dataset.prototype;
    let id        = container.getAttribute('data-block-id');
    let addButton = document.querySelector(`#btn-${id}`);

    container.querySelectorAll('.tom-select-recipes').forEach((el) => {
        if (!el.tomselect) {
            initTomSelect(el);
        }
    })
    container.querySelectorAll(('.ts-wrapper')).forEach((el) => {
        el.classList.remove('form-control');
    })

    container.querySelectorAll('.async-delete-dish-button').forEach((btn) => {
        const deleteDishUrl= btn.dataset.asyncDeleteDishUrl;
        if (btn) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                fetch(deleteDishUrl, {
                    method: 'post'
                    })
                    .then(response => {
                        return response.json;
                    })
                    .catch((e)=>{
                        console.error(`Error during dish deleting : ${e}`)
                    });
                btn.parentElement.remove()
            });
        }
    });

    addButton.addEventListener('click', (e) => {
        e.preventDefault();
        let dishCount = addButton.getAttribute('data-dish-index');
        dishCount++;
        addButton.setAttribute('data-dish-index', dishCount);
        let listedForm       = document.createElement('li');
        listedForm.classList.add('dish-form', 'mb-4');
        const regexDish      = /__name__/g;
        listedForm.innerHTML = dishForm.replace(regexDish, 'dish_' + dishCount);

        addRemovedBtn(listedForm)

        container.appendChild(listedForm);

        let newSelect = listedForm.querySelector('.tom-select-recipes');
        if (newSelect && !newSelect.tomselect) {
            initTomSelect(newSelect);
        }
        //Je dois faire ça pour empêcher BootStrap de faire une mise en forme sur le ts-wrapper via form-control et avoir un rendu bizarre
        listedForm.querySelectorAll(('.ts-wrapper')).forEach((el) => {
            el.classList.remove('form-control');
        })
    });
});
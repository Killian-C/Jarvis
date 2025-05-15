const mainContainer = document.getElementById('shifts-container');
const asyncSearchUrl = mainContainer.dataset.asyncUrl;
const dishBlocks = document.getElementsByClassName('dishes-block');
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

    addButton.addEventListener('click', (e) => {
        e.preventDefault();
        let dishCount = addButton.getAttribute('data-dish-index');
        dishCount++;
        addButton.setAttribute('data-dish-index', dishCount);
        let listedForm       = document.createElement('li');
        listedForm.classList.add('dish-form');
        const regexDish      = /__name__/g;
        listedForm.innerHTML = dishForm.replace(regexDish, 'dish_' + dishCount);

        const deleteBtn = document.createElement('button');
        deleteBtn.innerHTML  = '<i class="fas fa-trash"></i>'
        deleteBtn.addEventListener('click', (e) => {
            e.preventDefault();
            listedForm.remove();
        })
        listedForm.appendChild(deleteBtn);

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

const initTomSelect = (selectInput) => {
    new TomSelect(selectInput, {
        valueField: 'id',
        labelField: 'title',
        searchField: ['title', 'searchText'],
        options: [],
        load: function(query, callback) {
            let url = `${asyncSearchUrl}?search=${encodeURIComponent(query)}`;
            fetch(url)
                .then(response => {
                    return response.json()
                })
                .then(items => {
                    callback(items)
                })
                .catch((e)=>{
                    console.warn("result warn", e)
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

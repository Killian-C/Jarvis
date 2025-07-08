const listItemsContainer = document.getElementById('list-items-container');
listItemsForm = listItemsContainer.dataset.prototype;
addListItemButton = document.getElementById('add-list-item');
let index = 0;
const regex = /__name__/g;
addListItemButton.addEventListener('click', (e) => {
    e.preventDefault();
    index++;
    let listedForm = document.createElement('li');
    listedForm.innerHTML = listItemsForm.replace(regex, 'list_item_' + index);

    listedForm.querySelector('#shopping_list_listItems_list_item_' + index + '_quantity').value = 1;
    const listedFormDiv = listedForm.querySelector('#shopping_list_listItems_list_item_' + index);
    const formGroups = listedFormDiv.querySelectorAll('.form-group');
    const checkItem = formGroups[0];
    const nameItem = formGroups[1];
    nameItem.classList.add('w-100')
    const qtyItem = formGroups[2];
    qtyItem.classList.add('w-30');
    const shopPlaceItem = formGroups[3];
    shopPlaceItem.classList.add('w-100', 'mr-2');


    let checkAndNameSection = document.createElement('div');
    checkAndNameSection.classList.add('d-flex', 'align-items-center', 'w-100', 'mb-1');
    checkAndNameSection.appendChild(checkItem);
    checkAndNameSection.appendChild(nameItem);

    const deleteBtn = document.createElement('button');
    deleteBtn.innerHTML  = '<i class="fas fa-trash ml-2"></i>'
    deleteBtn.addEventListener('click', (e) => {
        e.preventDefault();
        listedForm.remove();
    })
    checkAndNameSection.appendChild(deleteBtn);

    let qtyAndShopPlace = document.createElement('div');
    qtyAndShopPlace.classList.add('d-flex');
    qtyAndShopPlace.appendChild(qtyItem);
    qtyAndShopPlace.appendChild(shopPlaceItem);

    listedFormDiv.appendChild(checkAndNameSection)
    listedFormDiv.appendChild(qtyAndShopPlace)



    listItemsContainer.appendChild(listedForm);
})
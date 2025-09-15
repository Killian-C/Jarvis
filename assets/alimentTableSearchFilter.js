import List from "list.js";

const options =
    { valueNames: [
        'name',
        'category'
    ]};

const alimentList = new List('aliments', options);
document.getElementById('aliment-category-filters').addEventListener('change', () => {
    const selectedCategory = document.getElementById('aliment-category-filters').value;
    if (selectedCategory === '') {
        alimentList.filter(() => true);
    } else {
        alimentList.filter((aliment) => aliment.values().category === selectedCategory);
    }
});
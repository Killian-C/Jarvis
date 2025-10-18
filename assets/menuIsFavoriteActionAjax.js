const menusContainer = document.querySelector('#menu-container');
const favoriteMenuActions = menusContainer.querySelectorAll('.js-favorite-box')

favoriteMenuActions.forEach((favoriteAction) => {
    favoriteAction.addEventListener('click', () => {
        const menuId = favoriteAction.dataset.menuId
        const menuIsFavorite = favoriteAction.dataset.menuIsFavorite === '1' ? '1' : '0';

        fetch(`/menu/async-change-is-favorite/${menuId}`, {
            method: 'POST',
        })
            .then(r => {

                if (r.ok) {
                    const favoriteDisplay= menusContainer.querySelector(`#favorite-menu-${ menuId }-action`);
                    changeFavoriteDisplay(favoriteDisplay, menuIsFavorite === '1' ? '0' : '1');
                }

            })
            .catch(error => console.error(error)
        );
    })
});

const changeFavoriteDisplay = (favoriteBox, isFavorite) => {
    if (isFavorite === '1') {
        favoriteBox.dataset.menuIsFavorite = isFavorite;
        favoriteBox.innerHTML = '⭐';
        return;
    }
    favoriteBox.dataset.menuIsFavorite = isFavorite;
    favoriteBox.innerHTML = '<i class="far fa-star"></i>';
};

const accordionMenus = document.getElementsByClassName('accordion-menu');

accordionMenus.forEach((element) => {
    element.addEventListener('click', () => {
        const accordionMenuArrows = element.getElementsByClassName('accordion-menu-arrow');
        accordionMenuArrows.forEach((arrow) => {
            arrow.classList.toggle('active-arrow');
        });
    })
})

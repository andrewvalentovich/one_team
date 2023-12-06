// фильтр открытие
if(document.querySelectorAll('.search-nav__list-item-title').length) {
    const filterItem = document.querySelectorAll('.search-nav__list-item-title')
    const selectors = document.querySelectorAll('.search-nav__list-item_arrow')
    filterItem.forEach(selector => {
        selector.addEventListener('click', function() {
            const secectorContainer = selector.closest('.search-nav__list-item_arrow')
            if(secectorContainer)
            if(secectorContainer.classList.contains('active')) {
                secectorContainer.classList.remove('active')
            } else {
                changerActive(selectors)
                secectorContainer.classList.add('active')
            }
        })
    });
}
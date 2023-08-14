import './bootstrap';

const cityList = document.querySelector('.city-col__list')

array.forEach(cityElemen => {
    const cityItem = document.createElement('div');
    cityItem.classList.add('city-col__item');
    cityItem.setAttribute('id', `card_object-${cityElemen.id}`);
    cityItem.setAttribute('data_id', cityElemen.id);

});
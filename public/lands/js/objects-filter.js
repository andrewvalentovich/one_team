$(document).ready(function () {

    // При загрузке страницы выводим активные элементы
    var url_city_id = $.query.get('city_id');
    var url_type_id = $.query.get('type');

    // Проверка параметра city_id из url при загрузке страницы и подстановка значений в элементы взаимодействия
    if (typeof url_city_id !== "boolean" && url_city_id !== "" && url_city_id !== " ") {
        $('.gallery__filter').find(`[data-id=${url_city_id}]`).addClass('active');
        var city_name = $(`.sort__list-item.city[data-id='${url_city_id}']`).children().text();
        $('.sort__title-city').text(city_name);
    } else {
        $('.gallery__filter').find(`div[data-id=0]`).addClass('active');
        $('.sort__title-city').text("Все регионы");
    }

    // Проверка параметра type из url при загрузке страницы и подстановка значений в элементы взаимодействия
    if (typeof url_type_id !== "boolean" && url_type_id !== "" && url_type_id !== " ") {
        var type_name = $(`.sort__list-item.type[data-id='${url_type_id}']`).children().text();
        $('.sort__title-type').text(type_name);
    } else {
        $('.sort__title-type').text("Тип недвижимости");
    }

    // Подгрузка контента на странице
    $.ajax({
        url: window.landings_get_with_filter_url,
        method: 'GET',
        dataType: 'json',
        data: {
            city_id: (typeof url_city_id !== "boolean" && url_city_id !== "" && url_city_id !== " ") ? url_city_id : 0,
            type: (typeof url_type_id !== "boolean" && url_type_id !== "" && url_type_id !== " ") ? url_type_id : 0,
            limit: Number($('.building__list').attr('data-count')),
            offset: 0,
        },
        success: function (data) {
            $('.building__list').empty();
            append_objects(data);
            addClickBuildingItem()
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });

    // При нажатии на город из фильтра
    $('.gallery__filter div').on('click', function () {
        change_city(Number($(this).attr('data-id')));
    });

    // При нажатии на город из выпадающего списка
    $('.sort__list-item.city').on('click', function () {
        change_city(Number($(this).attr('data-id')));
    });

    // При нажатии на тип недвижимости из выпадающего списка
    $('.sort__list-item.type').on('click', function () {
        change_type(Number($(this).attr('data-id')));
    });

    // Подгрузка контента при нажатии на кнопку
    $('#load_objects_btn').on('click', function () {
        load_content();
    });
});

// Изменяем во всех элементах взаимодействия название активного города,
// редактируем url и вызваем ajax
function change_city(city_id) {
    var offset = 0;
    var limit = Number($('.building__list').attr('data-count'));
    var get_url_type_id = $.query.get('type');

    $('.building-select').removeClass('active');
    $(`.gallery__filter div[data-id='${city_id}']`).addClass('active');

    var city_name = $(`.sort__list-item.city[data-id='${city_id}']`).children().text();
    $('.sort__title-city').text(city_name);

    // Кладём параметр в url
    window.history.pushState(null, null, $.query.SET('city_id', city_id));

    $.ajax({
        url: window.landings_get_with_filter_url,
        method: 'GET',
        dataType: 'json',
        data: {
            city_id: city_id,
            type: (typeof get_url_type_id !== "boolean" && get_url_type_id !== "" && get_url_type_id !== " ") ? Number(get_url_type_id) : 0,
            limit: limit,
            offset: offset,
        },
        success: function (data) {
            $('.building__list').empty();
            append_objects(data);
            addClickBuildingItem()
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}

// Изменяем во всех элементах взаимодействия название активного типа недвижимости,
// редактируем url и вызваем ajax
function change_type(type_id) {
    var offset = 0;
    var limit = Number($('.building__list').attr('data-count'));
    var get_url_city_id = $.query.get('city_id');
    var city_id = (typeof get_url_city_id !== "boolean" && get_url_city_id !== "" && get_url_city_id !== " ") ? Number(get_url_city_id) : 0

    var type_name = $(`.sort__list-item.type[data-id='${type_id}']`).children().text();
    $('.sort__title-type').text(type_name);

    // Кладём параметр в url
    window.history.pushState(null, null, $.query.SET('type', type_id));

    $.ajax({
        url: window.landings_get_with_filter_url,
        method: 'GET',
        dataType: 'json',
        data: {
            city_id: city_id,
            type: type_id,
            limit: limit,
            offset: offset,
        },
        success: function (data) {
            $('.building__list').empty();
            append_objects(data);
            addClickBuildingItem()
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}

// Добавление объектов в блок .building__list
function append_objects(data) {
    if (data.length <= Number($('.building__list').attr('data-count'))) {
        $('#load_objects_btn').parent().hide();
    } else {
        $('#load_objects_btn').parent().show();
    }

    $.each(data, function (key, val) {
        // Если получили больше элементов чем указано в аттрибуте, то прерываем each
        if(key > Number($('.building__list').attr('data-count')) - 1) {
            return false;
        }

        var photos = '';

        $.each(val.photo, function (i, photo) {
            photos += '<div class="building__item-slide swiper-slide"><img src="/uploads/' + photo.photo + '" alt="объект"></div>';
        });

        var option = (val.option !== null) ? '<div class="building__item-hashtag">' + val.option + '</div>' : '';
        var name = (val.name) ? '<div class="building__item-name">' + val.name + '</div>\n' : '';
        var address = (val.address) ? '<div class="building__item-address">' + val.address + '</div>\n' : '';
        var price = (val.price) ? '<div class="building__item-price">от\n<b>' + val.price + '</b>\n</div>\n' : '';
        var layouts = (val.layouts) ?
            '                                        <div class="building__item-lead-point">\n' +
            '                                            <div class="icon">\n' +
            '                                                <img src="/lands/img/icons/dashboard.png" alt="dashboard">\n' +
            '                                            </div>\n' +
            '                                            ' + val.layouts + '\n' +
            '                                        </div>\n' : '';
        var size = (val.size) ?
            '                                        <div class="building__item-lead-point">\n' +
            '                                            <div class="icon">\n' +
            '                                                <img src="/lands/img/icons/wide.png" alt="wide">\n' +
            '                                            </div>\n' +
            '                                            ' + val.size + '\n' +
            '                                        </div>\n' : '';
        var to_sea = (val.to_sea) ?
            '                                        <div class="building__item-lead-point">\n' +
            '                                            <div class="icon">\n' +
            '                                                <img src="/lands/img/icons/wave.png" alt="wave">\n' +
            '                                            </div>\n' +
            '                                            ' + val.to_sea + '\n' +
            '                                        </div>\n' : '';


        $('.building__list').append('<div class="building__item" open-building-popup="popup-buildings">\n' +
            '                                <div class="building__item-top">\n' +
            '                                    <div class="building__item-swiper swiper">\n' +
            '                                        <div class="building__item-swiper-wrapper swiper-wrapper">' + photos + '</div>\n' +
            '                                        <div class="building__item-scrollbar swiper-scrollbar"></div>\n' +
            '                                    </div>\n' +
            option +
            '                                </div>\n' +
            '                                <div class="building__item-info">\n' +
            '                                    <div class="building__item-desc">\n' +
            name +
            address +
            price +
            '                                    </div>\n' +
            '                                    <div class="building__item-lead">\n' +
            layouts +
            size +
            to_sea +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                            </div>');
    });
}

// Подгрузка контента
function load_content() {
    var url_city_id = $.query.get('city_id');
    var url_type_id = $.query.get('type');

    $.ajax({
        url: window.landings_get_with_filter_url,
        method: 'GET',
        dataType: 'json',
        data: {
            city_id: (typeof url_city_id !== "boolean" && url_city_id !== "" && url_city_id !== " ") ? url_city_id : 0,
            type: (typeof url_type_id !== "boolean" && url_type_id !== "" && url_type_id !== " ") ? url_type_id : 0,
            limit: Number($('.building__list').attr('data-count')),
            offset: $('.building__list').children().length,
        },
        success: function (data) {
            append_objects(data);
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}
function addClickBuildingItem() {
    if (document.querySelectorAll('[open-building-popup="popup-buildings"]').length) {
        const openBuildingPopupBtn = document.querySelectorAll('[open-building-popup="popup-buildings"]')
        openBuildingPopupBtn.forEach(elementHouse => {
          elementHouse.addEventListener('click', function(e) {
            const buildingPopup = document.querySelector('.popup-building')
            buildingPopup.classList.add('active')
            bodyScrollLock.disableBodyScroll(buildingPopup);
      
            const houseBlock = this.closest('.building__item')
            addBuldingToPopup(houseBlock)
          })
        });
    }
}
<style>
    .search-nav__list-item {
        flex: 1;
        position: relative;
    }
    @media (max-width: 899px) {
        .dropdown {
            display: none;
        }
    }
    .dropdown.active .search-nav__item-dropdown {
        display: block;
    }
    /*.search-nav__item-dropdown {*/
    /*    padding: 26px 20px 29px 29px;*/
    /*    min-width: 100%;*/
    /*    border-radius: 0px 5px 5px 5px;*/
    /*}*/
    /*.search-nav__list-item-title.search-nav__find-title {*/
    /*    line-height: 10px;*/
    /*}*/
</style>

<div class="search-nav-w">
    <form action="{{ route('houses.index') }}" class="header_search" method="get">
        <div class ="search-nav container">
            <div class="search-nav__list">
                <div class="search-nav__list-item  search-nav__list-item_b search-nav__list-item_arrow dropdown other-element" data_id="country">
                    <div class="search-nav__list-item-title country_select dropdown__title">{{ __('Страны') }}</div>
                    <input name="country_id" type="hidden" value="">
                    <div class="search-nav__item-dropdown" style="   padding: 26px 20px 29px 29px;

                    min-width: 100%;

            border-radius: 0px 5px 5px 5px;">
                        <div class="search-nav__countries-list"></div>
                        <svg class="close-dropdown" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.37 0.37" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Слой_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"></line>
                                <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"></line>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="search-nav__list-item _regions search-nav__list-item_b search-nav__list-item_arrow dropdown other-element" data_id="city">
                    <div class="search-nav__list-item-title city_select dropdown__title">{{ __('Регионы') }}</div>
                    <input name="city_id" type="hidden" value="">
                    <div class="search-nav__item-dropdown " style="   padding: 26px 20px 29px 29px;
                        min-width: 100%;
                        border-radius: 0px 5px 5px 5px;">
                        <div class="search__filter-item search__filter-types">
                            <div class="search__filter-title">{{ __('Регионы') }}</div>
                            <div class="search__filter-types-list"></div>
                        </div>
                        <div class="search-nav__cities-list"></div>
                        <svg class="close-dropdown" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.37 0.37" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Слой_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"></line>
                                <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"></line>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="search-nav__list-item search-nav__types search-nav__list-item_b search-nav__list-item_arrow" data_id="type">
                    <div class="search-nav__list-item-title search-nav__types-title type_select">{{ __('Тип объекта') }}</div>
                    <div class="search-nav__item-dropdown search-nav__types-dropdown closert_div_parent">
                        <div class="search-nav__types-list"></div>
                        <svg class="close-dropdown" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.37 0.37" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Слой_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"></line>
                                <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"></line>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="search-nav__list-item search-nav__price search-nav__list-item_b search-nav__list-item_arrow " data_id="price">
                    <div class="search-nav__list-item-title search-nav__price-title">{{ __('Цена') }}</div>
                    <div class="search-nav__item-dropdown search-nav__price-dropdown">
                        <svg class="close-dropdown" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.37 0.37" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Слой_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"></line>
                                <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"></line>
                            </g>
                        </svg>
                        <div class="search-nav__price-dropdown-title">{{ __('Цена') }}</div>
                        <div class="search-nav__price-filter">
                            <div class="search-nav__price-filter-price">
                                <input class="search-nav__price-min search-nav__price-item" min="0" type="number" placeholder="{{ __('От') }}" name="price[min_price]" value="">
                                <div class="search-nav__price-beetwen">
                                    -
                                </div>
                                <input class="search-nav__price-max search-nav__price-item" min="0" type="number" placeholder="{{ __('До') }}" name="price[max_price]" value="">
                            </div>

                            <div class="search-nav__price-filter-currency"></div>
                        </div>
                    </div>
                </div>
                <div class="search-nav__list-item search-nav__rooms search-nav__list-item_b search-nav__list-item_arrow" data_id="spalni">
                    <div class="search-nav__list-item-title search-nav__rooms-title">{{ __('Спальни, Ванные') }}</div>
                    <div class="search-nav__item-dropdown search-nav__rooms-dropdown">
                        <svg class="close-dropdown" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.37 0.37" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Слой_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"></line>
                                <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"></line>
                            </g>
                        </svg>
                        <div class="search-nav__dropdown-content search-nav__rooms-dropdown-content">
                            <div class="search-nav__dropdown-item search-nav__rooms-dropdown-bedrooms">
                                <div class="search-nav__rooms-dropdown-title">{{ __('Спальни') }}</div>
                                <div class="search-nav__rooms-dropdown-bedrooms-buttons"></div>
                            </div>
                            <div class="search-nav__dropdown-item search-nav__rooms-dropdown-bedrooms">
                                <div class="search-nav__rooms-dropdown-title">{{ __('Ванные') }}</div>
                                <div class="search-nav__rooms-dropdown-bathrooms-buttons"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-nav__list-item search-nav__more search-nav__list-item_b search-nav__list-item_arrow" data_id="more">
                    <div class="search-nav__list-item-title search-nav__more-title">{{ __('Еще') }}</div>
                    <div class="search-nav__item-dropdown search-nav__more-dropdown ">
                        <svg class="close-dropdown" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.37 0.37" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Слой_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"></line>
                                <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"></line>
                            </g>
                        </svg>
                        <div class="search-nav__dropdown-item">
                            <div class="more-dropdown__title">{{ __('Особенности') }}</div>
                            <div class="more-dropdown__peculiarities-list"></div>
                        </div>
                        <div class="search-nav__dropdown-item more-dropdown__view">
                            <div class="more-dropdown__title">{{ __('Вид') }}</div>
                            <div class="more-dropdown__view-item"></div>
                        </div>
                        <div class="search-nav__dropdown-item more-dropdown__sea">
                            <div class="more-dropdown__title">{{ __('До моря') }}</div>
                            <div class="more-dropdown__sea-item"></div>
                        </div>
                        <div class="search-nav__dropdown-item more-dropdown__square">
                            <div class="more-dropdown__title">{{ __('Площадь (кв.м)') }}</div>
                            <div class="more-dropdown__square-item">
                                <input placeholder="{{ __('От') }}" name="size[min]" value="">
                                <input placeholder="{{ __('До') }}" name="size[max]" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-nav__list-item search-nav__find search-nav__list-item_b form_button header_search_button">
                    <div class="search-nav__list-item-title search-nav__find-title btn-filter-houses">{{ __('Найти') }}</div>
                    <svg class="search-nav__icon"  xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="59px" height="59px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                         viewBox="0 0 1.61 1.61"
                         xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Слой_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"/>
                                <circle class="fil0 str0" cx="0.67" cy="0.67" r="0.6"/>
                                <line class="fil0 str0" x1="1.09" y1="1.09" x2="1.56" y2= "1.56" />
                            </g>
                    </svg>
                </div>
            </div>
        </div>
    </form>
</div>



<div class="search-w">
    <svg class="search-w__close" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
         viewBox="0 0 0.37 0.37"
         xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="Слой_x0020_1">
            <metadata id="CorelCorpID_0Corel-Layer"/>
            <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2= "0.02" />
            <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2= "0.02" />
        </g>
    </svg>
    <form action="{{ route('houses.index') }}" class="header_search_two" method="get"/>
        <div class="search">
            <div class="search__content">
                <div class="search__filter">
                    <div class="search__filter-item search__filter-types">
                        <div class="search__filter-title">{{ __('Тип недвижимости') }}</div>
                        <div class="search__filter-types-list"></div>
                    </div>
                    <div class="search__filter-item search__filter-price">
                        <div class="search-nav__price-dropdown-title">{{ __('Цена') }}</div>
                        <div class="search-nav__price-filter">
                            <div class="search-nav__price-filter-price">
                                <input class="search-nav__price-min search-nav__price-item" min="0" type="number" placeholder="{{ __('от') }}" name="price[min_price]" value="">
                                <div class="search-nav__price-beetwen">
                                    -
                                </div>
                                <input class="search-nav__price-max search-nav__price-item" min="0" type="number" placeholder="{{ __('до') }}" name="price[max_price]" value="">
                            </div>
                            <div class="search-nav__price-filter-currency"></div>
                        </div>
                    </div>
                    <div class="search__filter-item search__filter-rooms">
                        <div class="search-nav__dropdown-item search-nav__rooms-dropdown-bedrooms">
                            <div class="search-nav__rooms-dropdown-title">{{ __('Спальни') }}</div>
                            <div class="search-nav__rooms-dropdown-bedrooms-buttons"></div>
                        </div>

                        <div class="search-nav__dropdown-item search-nav__rooms-dropdown-bedrooms">
                            <div class="search-nav__rooms-dropdown-title">{{ __('Ванные') }}</div>
                            <div class="search-nav__rooms-dropdown-bathrooms-buttons"></div>
                        </div>
                    </div>
                    <div class="search__filter-item search__filter-more">
                        <div class="more-dropdown__title">{{ __('Особенности') }}</div>
                        <div class="more-dropdown__peculiarities-list"></div>
                    </div>
                    <div class="search__filter-item search__filter-view">
                        <div class="more-dropdown__title">{{ __('Вид') }}</div>
                        <div class="more-dropdown__view-item"></div>
                    </div>
                    <div class="search__filter-item search__filter-sea">
                        <div class="more-dropdown__title">{{ __('До моря') }}</div>
                        <div class="more-dropdown__sea-item"></div>
                    </div>
                    <div class="search__filter-item">
                        <div class="search__filter-square">
                            <div class="search__filter-square-content">
                                <div class="search__filter-square-title">{{ __('Площадь (кв.м)') }}</div>
                                <div class="search__filter-square-item">
                                    <input class="search__filter-square-general" placeholder="{{ __('От') }}" name="size[min]" value="">
                                    <input class="search__filter-square-plot" placeholder="{{ __('До') }}" name="size[max]" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="search__filter-bottom form_button header_search_two_button">
                <div class="search__filter-bottom-btn">{{ __('Найти') }}</div>
            </div>
        </div>
    </form>
</div>
<script src="{{ asset('project/js/url-query-object.js') }}"></script>
<script>
    // var set_query = $.query.SET('order_by', "created_at-desc"); // создание url
    // history.pushState(null,null, set_query); // подстановка параметров

    // Получаем GET параметр country_id из url
    var url_country_id = $.query.get('country_id');
    var url_city_id = $.query.get('city_id');

    $.ajax({
        url: '/api/houses/filter_params',       /* Куда отправить запрос */
        data: {
            locale: `{{ app()->getLocale() }}`,
            country_id: (typeof url_country_id !== "boolean" && url_country_id !== "" && url_country_id !== " ") ? url_country_id : null
        },
        method: 'get',                                              /* Метод запроса (post или get) */
        success: function(data) {                                    /* функция которая будет выполнена после успешного запроса.  */
            console.log(data);
            // Выводим валюту в dropdown
            $.each(data.currency, function (index, value) {
                $('.search-nav__price-filter-currency').append('<div class="search-nav__price-currency-item ' + (($.query.get('price[code]').toString() === index.toString() || ((!$.query.get('price[code]').toString() || $.query.get('price[code]').toString() === true) && index.toString() === "EUR")) ? 'active' : '') + ' currency_type" currency_type="' + index + '">' + value + '</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $(".search-nav__price-currency-item").each(function (index) {
                $(this).on("click", function () {
                    $(".search-nav__price-currency-item").removeClass("active");
                    $(this).addClass("active");

                    var name = $(this).attr('currency_type');
                    history.pushState(null, null, $.query.SET('price[code]', name)); // подстановка параметров
                });
            });

            // Подстановка минимальной цены в input
            $('input[name="price[min_price]"]').val(($.query.get('price[min_price]').toString() && $.query.get('price[min_price]').toString() != "true") ? $.query.get('price[min_price]').toString() : "");

            // При изменении минимальной цены
            $('input[name="price[min_price]"]').on('change input', function () {
                var min_price = $(this).val();
                history.pushState(null, null, $.query.SET('price[min_price]', min_price)); // подстановка параметров
            })

            // Подстановка максимальной цены в input
            $('input[name="price[max_price]"]').val(($.query.get('price[max_price]').toString() && $.query.get('price[max_price]').toString() != "true") ? $.query.get('price[max_price]').toString() : "");

            // При изменении максимальной цены
            $('input[name="price[max_price]"]').on('change input', function () {
                var max_price = $(this).val();
                history.pushState(null, null, $.query.SET('price[max_price]', max_price)); // подстановка параметров
            })

            // Выводим название типа при загрузке страницы
            $(".type_select").text(($.query.get('type').toString() && $.query.get('type').toString() != "true") ? data.types.find(x => x.id == $.query.get('type')).name : "{{ __('Тип объекта') }}");

            // Выводим типы в dropdown
            $.each(data.types, function (index, value) {
                $('.search-nav__types-list').append('<div data_id="' + value.id + '" class="search-nav__types-item type closert_div">' + value.name + '</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $('.type').click(function (e) {
                e.stopPropagation();
                e.preventDefault();

                var name = $(this).attr('data_id');
                $(this).addClass('active');
                $('.search-nav__item-dropdown').removeClass('active');
                $('.search-nav__types').removeClass('active');

                history.pushState(null, null, $.query.SET('type', name)); // подстановка параметров

                var html = $(this).html();
                $('.type_select').html(html);

                const parentBlock = this.closest('.search-nav__list-item')
                const dropDown = this.closest('.search-nav__item-dropdown')

                parentBlock.classList.remove('active')
                dropDown.classList.remove('active')
            });

            // если задан параметр country_id, то выводим регионы
            if ((typeof url_country_id !== "boolean" && url_country_id !== "" && url_country_id !== " ") || (typeof url_city_id !== "boolean" && url_city_id !== "" && url_city_id !== " ")) {
                $('.search-nav__list-item[data_id="city"]').show();
                $('.search-nav__list-item[data_id="country"]').hide();
                // Выводим регионы при загрузке страницы
                $(".city_select").text((url_city_id.toString() && url_city_id.toString() != "true") ? data.cities.find(x => x.id == url_city_id).name : "{{ __('Регионы') }}");
                // Выводим страны в dropdown
                console.log("data.cities");
                console.log(data.cities);
                $('.search-nav__cities-list').html();
                $.each(data.cities, function (index, value) {
                    $('.search-nav__cities-list').append('<div data_id="' + value.id + '" class="search_city search-nav__types-item dropdown__selector other-element">' + value.name + '</div>');
                });

                // Вешаем событие на добавленные элементы в dropdown
                $('.search_city').click(function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                    var city_id = $(this).attr('data_id');

                    history.pushState(null, null, $.query.SET('city_id', city_id)); // подстановка параметров

                    var html = $(this).html();
                    $('.city_select').html(html);

                    const parentBlock = this.closest('.search-nav__list-item')
                    const dropDown = this.closest('.search-nav__item-dropdown')

                    parentBlock.classList.remove('active')
                    dropDown.classList.remove('active')
                });
            } else {
                $('.search-nav__list-item[data_id="city"]').hide();
                $('.search-nav__list-item[data_id="country"]').show();
                // Выводим название страны при загрузке страницы
                $(".country_select").text(($.query.get('country_id').toString() && $.query.get('country_id').toString() != "true") ? data.countries.find(x => x.id == $.query.get('country_id')).name : "{{ __('Страны') }}");
                // Выводим страны в dropdown
                $.each(data.countries, function (index, value) {
                    $('.search-nav__countries-list').append('<div data_id="' + value.id + '" class="search_country search-nav__types-item dropdown__selector other-element">' + value.name + '</div>');
                });

                // Вешаем событие на добавленные элементы в dropdown
                $('.search_country').click(function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                    var country_id = $(this).attr('data_id');

                    history.pushState(null, null, $.query.SET('country_id', country_id)); // подстановка параметров

                    var html = $(this).html();
                    $('.country_select').html(html);

                    const parentBlock = this.closest('.search-nav__list-item')
                    const dropDown = this.closest('.search-nav__item-dropdown')

                    parentBlock.classList.remove('active')
                    dropDown.classList.remove('active')
                });
            }

            // Выводим спальни в dropdown
            $.each(data.bedrooms, function (index, value) {
                $('.search-nav__rooms-dropdown-bedrooms-buttons').append('<div data_id="'+value.id+'" class="bedrooms search-nav__rooms-dropdown-bedrooms-button '+(($.query.get('bedrooms').toString() === value.name.toString()) ? 'active' : '')+'">'+value.name+'</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $('.bedrooms').click(function () {
                var bedrooms = $(this).attr('data_id');
                $(this).closest('.search-nav__rooms-dropdown-bedrooms-button').removeClass('active');
                $(this).addClass('active');

                history.pushState(null, null, $.query.SET('bedrooms', bedrooms)); // подстановка параметров
            })

            // Выводим ванные в dropdown
            $.each(data.bathrooms, function (index, value) {
                $('.search-nav__rooms-dropdown-bathrooms-buttons').append('<div data_id="'+value.id+'" class="bathrooms search-nav__rooms-dropdown-bathrooms-button '+(($.query.get('bathrooms').toString() === value.name.toString()) ? 'active' : '')+'">'+value.name+'</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $('.bathrooms').click(function () {
                var bathrooms = $(this).attr('data_id');
                console.log('bathrooms = '+bathrooms);
                $(this).closest('.search-nav__rooms-dropdown-bathrooms-button').removeClass('active');
                $(this).addClass('active');

                history.pushState(null, null, $.query.SET('bathrooms', bathrooms)); // подстановка параметров
            })

            // Выводим особенности в dropdown
            $.each(data.peculiarities, function (index, value) {
                $('.more-dropdown__peculiarities-list').append('<div class="more-dropdown__peculiarities-item">'+
                    '<label class="more-dropdown__peculiarities peculiarities">'+
                        '<input name="peculiarities['+value.id+']" '+
                        'class="more-dropdown__peculiarities-tv-checkbox more-dropdown__peculiarities-checkbox" type="checkbox" '+
                        (($.query.get('peculiarities['+value.id+']') === "true") ? 'checked' : '')+'>'+
                        '<div class="more-dropdown-custom-checkbox"></div>'+
                        '<div class="more-dropdown-checkbox-text">'+value.name+'</div>'+
                    '</label>'+
                '</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $('.more-dropdown__peculiarities-checkbox').change(function () {
                var checked = $(this).prop('checked');
                var name = $(this).attr('name');

                if(checked) {
                    history.pushState(null, null, $.query.SET(name, checked.toString())); // подстановка параметров
                } else {
                    history.pushState(null, null, $.query.REMOVE(name, "true")); // подстановка параметров
                }
            })

            // Выводим виды в dropdown
            $.each(data.views, function (index, value) {
                $('.more-dropdown__view-item').append('<div data_id="'+value.id+'" class="view search-nav__dropdown-button search-nav__view-button '+(($.query.get('view').toString() === value.name.toString()) ? 'active' : '')+'">'+value.name+'</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $('.view').click(function () {
                var id = $(this).attr('data_id');
                $(this).closest('.more-dropdown__view-item').removeClass('active');
                $(this).addClass('active');

                history.pushState(null, null, $.query.SET('view', id)); // подстановка параметров
            });


            // Выводим виды в dropdown
            $.each(data.to_sea, function (index, value) {
                $('.more-dropdown__sea-item').append('<div data_id="'+value.id+'" class="to_sea search-nav__dropdown-button search-nav__sea-button ts '+(($.query.get('to_sea').toString() == value.name.toString()) ? 'active' : '')+'">'+value.name+'</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $('.to_sea').click(function () {
                var id = $(this).attr('data_id');
                $(this).closest('.more-dropdown__sea-item').removeClass('active');
                $(this).addClass('active');

                history.pushState(null, null, $.query.SET('to_sea', id)); // подстановка параметров
            })

            // Выводим площадь в dropdown
            $('input[name="size[min]"]').val(($.query.get('size[min]').toString() && $.query.get('size[min]').toString() != "true") ? $.query.get('size[min]').toString() : "");
            $('input[name="size[max]"]').val(($.query.get('size[max]').toString() && $.query.get('size[max]').toString() != "true") ? $.query.get('size[max]').toString() : "");

            // При изменении size площади
            $('input[name="size[min]"]').on('change input', function () {
                var min = $(this).val();
                history.pushState(null, null, $.query.SET('size[min]', min)); // подстановка параметров
            })

            // При изменении size_home площади
            $('input[name="size[max]"]').on('change input', function () {
                var max = $(this).val();
                history.pushState(null, null, $.query.SET('size[max]', max)); // подстановка параметров
            })

        }
    });

    // $('.search-w__close').click(function () {
    //     $('.search-nav__list-item_b').removeClass('active');
    //     $('.search-nav__more-dropdown').removeClass('active');
    // });

    // $(document).ready(function() {
    //     $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow').click(function() {
    //         var clickedElement = $(this);
    //              $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');
    //              $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');
    //                 clickedElement.addClass('active');
    //                 clickedElement.children('.search-nav__item-dropdown, .search-nav__types-dropdown').addClass('active');
    //     });
    // });


    // $(document).ready(function() {
    //     $(".close-dropdown").each(function() {
    //         $(this).on("click", function(event) {
    //             event.stopPropagation();
    //             const searchItem = $(this).closest(".search-nav__list-item");
    //             const dropDown = searchItem.find('.search-nav__item-dropdown');
    //             console.log(searchItem);
    //             console.log(dropDown);
    //             searchItem.removeClass('active');
    //             dropDown.removeClass('active');
    //         });
    //     });
    // });


</script>

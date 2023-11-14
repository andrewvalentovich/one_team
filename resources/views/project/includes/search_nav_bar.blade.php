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
    <form action="{{ route('realty') }}" class="header_search" method="get">
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
                    <div class="search-nav__list-item-title city_select dropdown__title">{{ __('Все регионы') }}</div>
                    <input name="city_id" type="hidden" value="">
                    <div class="search-nav__item-dropdown " style="   padding: 26px 20px 29px 29px;
                        min-width: 100%;
                        border-radius: 0px 5px 5px 5px;">
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
                    <div class="search-nav__list-item-title search-nav__types-title type_select">{{ __('Все типы') }}</div>
                    <input name="type_id" type="hidden" value="">
                    <input name="sale_or_rent" type="hidden" value="">
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
                        <input type="hidden" name="currency">
                        <div class="search-nav__price-filter">
                            <div class="search-nav__price-filter-price">
                                <input class="search-nav__price-min search-nav__price-item" min="0" type="number" placeholder="{{ __('От') }}" name="price[min]" value="">
                                <div class="search-nav__price-beetwen">
                                    -
                                </div>
                                <input class="search-nav__price-max search-nav__price-item" min="0" type="number" placeholder="{{ __('До') }}" name="price[max]" value="">
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
                                <input name="bedroom" type="hidden" value="">
                                <div class="search-nav__rooms-dropdown-title">{{ __('Спальни') }}</div>
                                <div class="search-nav__rooms-dropdown-bedrooms-buttons"></div>
                            </div>
                            <div class="search-nav__dropdown-item search-nav__rooms-dropdown-bedrooms">
                                <input name="bathroom" type="hidden" value="">
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
                <div class="search-nav__list-item search-nav__find search-nav__list-item_b form_button header_search_button btn-filter-houses">
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
    <form action="{{ route('realty') }}" class="header_search_two" method="get"/>
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
                                <input class="search-nav__price-min search-nav__price-item" min="0" type="number" placeholder="{{ __('от') }}" name="price[min]" value="">
                                <div class="search-nav__price-beetwen">
                                    -
                                </div>
                                <input class="search-nav__price-max search-nav__price-item" min="0" type="number" placeholder="{{ __('до') }}" name="price[max]" value="">
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
                        <input type="hidden" name="view">
                        <div class="more-dropdown__title">{{ __('Вид') }}</div>
                        <div class="more-dropdown__view-item"></div>
                    </div>
                    <div class="search__filter-item search__filter-sea">
                        <input type="hidden" name="to_sea">
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
                <div class="search__filter-bottom-btn btn-filter-houses">{{ __('Найти') }}</div>
            </div>
        </div>
    </form>
</div>
<script>
    window.locale = '{{ app()->getLocale() }}';
</script>
<script src="{{ asset('project/js/url_functions.js') }}"></script>
<script>
    // var set_query = $.query.SET('order_by', "created_at-desc"); // создание url
    // history.pushState(null,null, set_query); // подстановка параметров
    searchBarGetParameters();
</script>

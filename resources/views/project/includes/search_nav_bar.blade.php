<?php $filter = \App\Models\Peculiarities::all() ?>

@if(isset($country->id))
    <?php  $id = $country->id ?>
@else
    <?php $id = 1;  ?>
@endif
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
    /*    width: 250px;*/
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
                    <div class="search-nav__list-item-title country_select dropdown__title">{{--Вывод страны название--}}Страны</div>
                    <div class="search-nav__item-dropdown" style="   padding: 26px 20px 29px 29px;

            width: 250px;

            border-radius: 0px 5px 5px 5px;">
                        <div class="search-nav__countries-list">
                            {{--foreach--}}
{{--                                <div data_id="--}}{{--id--}}{{--" class="country search-nav__types-item dropdown__selector other-element">--}}
                                {{--Вывод стран для выбора--}}
{{--                                </div>--}}
                            {{--endforeach--}}
                        </div>
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
                    <div class="search-nav__list-item-title search-nav__types-title type_select">Тип объекта{{--Вывод типов--}}</div>
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
                    <div class="search-nav__list-item-title search-nav__price-title">Цена</div>
                    <div class="search-nav__item-dropdown search-nav__price-dropdown">
                        <svg class="close-dropdown" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.37 0.37" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Слой_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"></line>
                                <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"></line>
                            </g>
                        </svg>
                        <div class="search-nav__price-dropdown-title">Цена</div>
                        <div class="search-nav__price-filter">
                            <div class="search-nav__price-filter-price">
                                <input class="search-nav__price-min search-nav__price-item" min="0" type="number" placeholder="от" name="min_price[price]" @if(isset($_GET['min_price'])) value="{{$_GET['min_price']}}"  @endif>
                                <div class="search-nav__price-beetwen">
                                    -
                                </div>
                                <input class="search-nav__price-max search-nav__price-item" min="0" type="number" placeholder="до" name="max_price[price]" @if(isset($_GET['max_price'])) value="{{$_GET['max_price']}}" @endif>
                            </div>

                            <div class="search-nav__price-filter-currency"></div>
                        </div>
                    </div>
                </div>
                <div class="search-nav__list-item search-nav__rooms search-nav__list-item_b search-nav__list-item_arrow" data_id="spalni">
                    <div class="search-nav__list-item-title search-nav__rooms-title">Спальни, Ванные</div>
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
                                <div class="search-nav__rooms-dropdown-title">Спальни</div>
                                <div class="search-nav__rooms-dropdown-bedrooms-buttons"></div>
                            </div>
                            <div class="search-nav__dropdown-item search-nav__rooms-dropdown-bedrooms">
                                <div class="search-nav__rooms-dropdown-title">Ванные</div>
                                <div class="search-nav__rooms-dropdown-bathrooms-buttons"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-nav__list-item search-nav__more search-nav__list-item_b " data_id="more">
                    <div class="search-nav__list-item-title search-nav__more-title">Еще</div>
                    <div class="search-nav__item-dropdown search-nav__more-dropdown ">
                        <svg class="close-dropdown" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px" height="26px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.37 0.37" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Слой_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"></line>
                                <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"></line>
                            </g>
                        </svg>
                        <div class="search-nav__dropdown-item">
                            <div class="more-dropdown__title">Особенности</div>
                            <div class="more-dropdown__peculiarities-list"></div>
                        </div>
                        <div class="search-nav__dropdown-item more-dropdown__view">
                            <div class="more-dropdown__title">Вид</div>
                            <div class="more-dropdown__view-item"></div>
                        </div>
                        <div class="search-nav__dropdown-item more-dropdown__sea">
                            <div class="more-dropdown__title">До моря</div>
                            <div class="more-dropdown__sea-item"></div>
                        </div>
                        <div class="search-nav__dropdown-item more-dropdown__square">
                            <div class="more-dropdown__title">Площади (кв.м)</div>
                            <div class="more-dropdown__square-item">
                                <input placeholder="Общая" name="all_size" value="@if(isset($_GET['all_size'])){{trim($_GET['all_size'], ' ') }}@endif">
                                <input placeholder="Дом" name="home_size" value="@if(isset($_GET['home_size'])){{trim($_GET['home_size'], ' ')}}@endif">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-nav__list-item search-nav__find search-nav__list-item_b form_button">
                    <div class="search-nav__list-item-title search-nav__find-title">Найти</div>
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
                        <div class="search__filter-title">Тип недвижимости</div>
                        <div class="search__filter-types-list">
                            {{--foreach--}}
                                    <div data_id="{{--id типа--}}" class="search__filter-types-item type" {{--условие для style="background: #508cfa; color: white;"--}}>
                                        {{--Название типа--}}
                                    </div>
                            {{--endforeach--}}
                        </div>
                    </div>
                    <div class="search__filter-item search__filter-price">
                        <div class="search-nav__price-dropdown-title">Цена</div>
                        <div class="search-nav__price-filter">
                            <div class="search-nav__price-filter-price">
                                <input class="search-nav__price-min search-nav__price-item" min="0" type="number" placeholder="от" name="min_price" value="{{isset($_GET['min_price']) ? $_GET['min_price'] : ""}}">
                                <div class="search-nav__price-beetwen">
                                    -
                                </div>
                                <input class="search-nav__price-max search-nav__price-item" min="0" type="number" placeholder="до" name="max_price" value="{{isset($_GET['max_price']) ? $_GET['max_price'] : ""}}">
                            </div>
                            <div class="search-nav__price-filter-currency"></div>
                        </div>
                    </div>
                    <div class="search__filter-item search__filter-rooms">
                        <div class="search-nav__dropdown-item search-nav__rooms-dropdown-bedrooms">
                            <div class="search-nav__rooms-dropdown-title">Спальни</div>
                            <div class="search-nav__rooms-dropdown-bedrooms-buttons">
                                {{--foreach--}}
                                    <div data_id="{{--id спальни--}}" class="search-nav__rooms-dropdown-bedrooms-button {{--условие для active--}}">
                                        {{--Название спальни--}}
                                    </div>
                                {{--endforeach--}}
                            </div>
                        </div>

                        <div class="search-nav__dropdown-item search-nav__rooms-dropdown-bedrooms">
                            <div class="search-nav__rooms-dropdown-title">Ванные</div>
                            <div class="search-nav__rooms-dropdown-bathrooms-buttons">
                                {{--foreach--}}
                                    <div data_id="{{--id ванной--}}" class="vannie search-nav__rooms-dropdown-bathrooms-button {{-- Условие для ? "active" : ""--}}">
                                        {{--Название ванной--}}
                                    </div>
                                {{--endforeach--}}
                            </div>
                        </div>
                    </div>
                    <div class="search__filter-item search__filter-more">
                        <div class="more-dropdown__title">Особенности</div>
                        <div class="more-dropdown__peculiarities-list">
                            {{--foreach--}}
                                <div class="more-dropdown__peculiarities-item">
                                    <label class="more-dropdown__peculiarities">
                                        <input name="osobenost[{{--id особенности--}}]" data_id="{{--id особенности--}}" class="more-dropdown__peculiarities-tv-checkbox more-dropdown__peculiarities-checkbox" type="checkbox" {{--условие для checked--}}>
                                        <div class="more-dropdown-custom-checkbox"></div>
                                        <div class="more-dropdown-checkbox-text">
                                            {{--Название особенности--}}
                                        </div>
                                    </label>
                                </div>
                            {{--endforeach--}}
                        </div>
                    </div>
                    <div class="search__filter-item search__filter-view">
                        <div class="more-dropdown__title">Вид</div>
                        <div class="more-dropdown__view-item">
                            {{--foreach--}}
                                    <div data_id="{{--id вида--}}" class="vid search-nav__dropdown-button search-nav__view-button {{--Условие для active--}}">
                                {{--Название вида--}}
                                </div>
                            {{--endforeach--}}
                        </div>
                    </div>
                    <div class="search__filter-item search__filter-sea">
                        <div class="more-dropdown__title">До моря</div>
                        <div class="more-dropdown__sea-item">
                            {{--foreach--}}
                                    <div data_id="{{--id до моря--}}" class="do_more search-nav__dropdown-button search-nav__sea-button {{--Условие для active--}}">
                                {{--До моря название--}}
                                    </div>
                            {{--endforeach--}}
                        </div>
                    </div>
                    <div class="search__filter-item">
                        <div class="search__filter-square">
                            <div class="search__filter-square-content">
                                <div class="search__filter-square-title">Площади (кв.м)</div>
                                <div class="search__filter-square-item">
                                    <input class="search__filter-square-general" placeholder="Общая" name="all_size" value="{{isset($_GET['all_size']) ? $_GET['all_size'] : ""}}">
                                    <input class="search__filter-square-plot" placeholder="Дом" name="home_size" value="{{isset($_GET['home_size']) ? $_GET['home_size'] : ""}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="search__filter-bottom form_button">
                <div class="search__filter-bottom-btn">Найти</div>
            </div>
        </div>
    </form>
</div>
<script src="{{ asset('project/js/url-query-object.js') }}"></script>
<script>
    // var set_query = $.query.SET('order_by', "created_at-desc"); // создание url
    // history.pushState(null,null, set_query); // подстановка параметров

    $.ajax({
        url: '{{config('app.url')}}api/houses/filter_params',       /* Куда отправить запрос */
        method: 'get',                                              /* Метод запроса (post или get) */
        success: function(data) {                                    /* функция которая будет выполнена после успешного запроса.  */
            console.log(data);
            // Выводим валюту в dropdown
            $.each(data.currency, function (index, value) {
                $('.search-nav__price-filter-currency').append('<div class="search-nav__price-currency-item '+(($.query.get('currency_type').toString() === index.toString()) ? 'active' : '')+' currency_type" currency_type="' + index + '">' + value + '</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $(".search-nav__price-currency-item").each(function (index) {
                $(this).on("click", function () {
                    $(".search-nav__price-currency-item").removeClass("active");
                    $(this).addClass("active");
                });
            });

            // Выводим название типа при загрузке страницы
            $(".type_select").text(($.query.get('type').toString() && $.query.get('type').toString() != "true") ? $.query.get('type').toString() : "Тип объекта");

            // Выводим типы в dropdown
            $.each(data.types, function (index, value) {
                $('.search-nav__types-list').append('<div data_id="'+value.id+'" class="search-nav__types-item type closert_div">'+value.name+'</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $('.type').click(function(){
                var id = $(this).attr('data_id');
                type = [];
                type.push(id)
                $(this).closest('.search-nav__types-dropdown').removeClass('active');
                $(this).closest('.search-nav__list-item').removeClass('active');
                $(this).addClass('active');

                var html = $(this).html();
                $('.type_select').html(html);
            });

            // Выводим название страны при загрузке страницы
            $(".country_select").text(($.query.get('countries').toString() && $.query.get('countries').toString() != "true") ? $.query.get('countries').toString() : "Страны");

            // Выводим страны в dropdown
            $.each(data.countries, function (index, value) {
                $('.search-nav__countries-list').append('<div data_id="'+value.id+'" class="country search-nav__types-item dropdown__selector other-element">'+value.name+'</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $('.country').click(function(){
                var id = $(this).attr('data_id');
                type = [];
                type.push(id)
                $(this).closest('.search-nav__countries-dropdown').removeClass('active');
                $(this).closest('.search-nav__list-item').removeClass('active');
                $(this).addClass('active');

                var html = $(this).html();
                $('.country_select').html(html);
            });

            // Выводим спальни в dropdown
            $.each(data.bedrooms, function (index, value) {
                $('.search-nav__rooms-dropdown-bedrooms-buttons').append('<div data_id="'+value.id+'" class="bedrooms search-nav__rooms-dropdown-bedrooms-button '+(($.query.get('bedrooms').toString() === index.toString()) ? 'active' : '')+'">'+value.name+'</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $('.bedrooms').click(function () {
                var bedrooms_id = $(this).attr('data_id');
                console.log('bedrooms_id = '+bedrooms_id);
                $('input[name="bedrooms_id"]').val(bedrooms_id);
                $(this).closest('.search-nav__rooms-dropdown-bedrooms-button').removeClass('active');
                $(this).addClass('active');
                // =========================================================== Нужно добавить формы ====================================
            })

            // Выводим ванные в dropdown
            $.each(data.bathrooms, function (index, value) {
                $('.search-nav__rooms-dropdown-bathrooms-buttons').append('<div data_id="'+value.id+'" class="bathrooms search-nav__rooms-dropdown-bathrooms-button '+(($.query.get('bathrooms').toString() === index.toString()) ? 'active' : '')+'">'+value.name+'</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $('.bathrooms').click(function () {
                var bathrooms_id = $(this).attr('data_id');
                console.log('bathrooms_id = '+bathrooms_id);
                $('input[name="bathrooms_id"]').val(bathrooms_id);
                $(this).closest('.search-nav__rooms-dropdown-bathrooms-button').removeClass('active');
                $(this).addClass('active');
                // =========================================================== Нужно добавить формы ====================================
            })

            // Выводим особенности в dropdown
            $.each(data.peculiarities, function (index, value) {
                $('.more-dropdown__peculiarities-list').append('<div class="more-dropdown__peculiarities-item">'+
                    '<label class="more-dropdown__peculiarities peculiarities">'+
                        '<input name="peculiarities['+value.id+']" data_id="'+value.id+'" '+
                        'class="more-dropdown__peculiarities-tv-checkbox more-dropdown__peculiarities-checkbox" type="checkbox" '+
                        (($.query.get('peculiarities['+value.id+']').toString() === index.toString()) ? 'checked' : '')+'>'+
                        '<div class="more-dropdown-custom-checkbox"></div>'+
                        '<div class="more-dropdown-checkbox-text">'+value.name+'</div>'+
                    '</label>'+
                '</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $('.peculiarities').click(function () {
                $(this).closest('input').attr('checked', true);
                console.log(111111111111111);
                // =========================================================== Нужно добавить формы ====================================
            })

            // Выводим виды в dropdown
            $.each(data.views, function (index, value) {
                $('.more-dropdown__view-item').append('<div data_id="'+value.id+'" class="view search-nav__dropdown-button search-nav__view-button '+(($.query.get('views').toString() === index.toString()) ? 'active' : '')+'">'+value.name+'</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $('.view').click(function () {
                var view_id = $(this).attr('data_id');
                console.log('view_id = '+view_id);
                $('input[name="views_id"]').val(view_id);
                $(this).closest('.more-dropdown__view-item').removeClass('active');
                $(this).addClass('active');
                // =========================================================== Нужно добавить формы ====================================
            })

            // Выводим виды в dropdown
            $.each(data.to_sea, function (index, value) {
                $('.more-dropdown__sea-item').append('<div data_id="'+value.name+'" class="to_sea search-nav__dropdown-button search-nav__sea-button '+(($.query.get('to_sea').toString() === value.name.toString()) ? 'active' : '')+'">'+value.name+'</div>');
            });

            // Вешаем событие на добавленные элементы в dropdown
            $('.to_sea').click(function () {
                var to_sea = $(this).attr('data_id');
                console.log('to_sea = '+to_sea);
                $('input[name="to_sea"]').val(to_sea);
                $(this).closest('.more-dropdown__sea-item').removeClass('active');
                $(this).addClass('active');
                // =========================================================== Нужно добавить формы ====================================
            })


        }
    });

    $('.search-w__close').click(function () {
        $('.search-nav__list-item_b').removeClass('active');
        $('.search-nav__more-dropdown').removeClass('active');
    });

        // $('body').click(function() {
        //     $('.search-nav__list-item').removeClass('active');
        //     $('.search-nav__list-item').children().removeClass('active');
        // });

    // $(document).ready(function() {
    //
    //     let country = false;
    //     let type = false;
    //     let price = false;
    //     let spalni = false;
    //     let more = false;
    //     $('.search-nav__list-item_arrow').click(function() {
    //         alert(1);
    //         // country = !country;
    //
    //         var clickedElement = $(this);
    //         if (clickedElement.attr('data_id') == 'country' ){
    //             if(country){
    //                 country = false;
    //             }else {
    //                 country = true;
    //                 type = false;
    //                 price = false;
    //                 spalni = false;
    //                 more = false;
    //             }
    //             $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');
    //             $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');
    //         }
    //         if (clickedElement.attr('data_id') == 'price' ){
    //             if(price){
    //                 price = false;
    //             }else {
    //                 price = true;
    //                 type = false;
    //                 country = false;
    //                 spalni = false;
    //                 more = false;
    //             }
    //             $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');
    //             $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');
    //         }
    //         if (clickedElement.attr('data_id') == 'type' ){
    //             if(type){
    //                 type = false;
    //             }else {
    //                 type = true;
    //                 country = false;
    //                 price = false;
    //                 spalni = false;
    //                 more = false;
    //             }
    //             $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');
    //             $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');
    //         }
    //         if (clickedElement.attr('data_id') == 'spalni' ){
    //             if(spalni){
    //                 spalni = false;
    //             }else {
    //                 spalni = true;
    //                 country = false;
    //                 price = false;
    //                 type = false;
    //                 more = false;
    //             }
    //             $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');
    //             $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');
    //         }
    //
    //
    //         if (clickedElement.attr('data_id') == 'more' ){
    //             if(more){
    //                 more = false;
    //             }else {
    //                 more = true;
    //                 country = false;
    //                 price = false;
    //                 type = false;
    //                 spalni = false;
    //             }
    //             $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');
    //             $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');
    //         }
    //
    //
    //
    //
    //
    //         if (country || price || type || spalni || more){
    //             clickedElement.addClass('active');
    //             clickedElement.children('.search-nav__item-dropdown, .search-nav__types-dropdown').addClass('active');
    //         }  else {
    //
    //             $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');
    //             $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');
    //
    //         }
    //     });
    // });


    $(document).ready(function() {
        $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow').click(function() {
            var clickedElement = $(this);
                 $('.search-nav__list-item, .search-nav__price, .search-nav__list-item_b, .search-nav__list-item_arrow, .search-nav__item-dropdown, .search-nav__types-dropdown').removeClass('active');
                 $('.search-nav__item-dropdown, .search-nav__types-dropdown').children().removeClass('active');
                    clickedElement.addClass('active');
                    clickedElement.children('.search-nav__item-dropdown, .search-nav__types-dropdown').addClass('active');
        });
    });

    //open dropdown
    if(document.querySelectorAll('.dropdown').length) {
        const dropdownTitle = document.querySelectorAll('.dropdown__title')
        for(let i = 0; i < dropdownTitle.length; i++) {
            dropdownTitle[i].onclick = function(e) {
                const dropwdown = dropdownTitle[i].closest('.dropdown')
                dropwdown.classList.toggle('active')
            }
        }

        const dropdownSelector = document.querySelectorAll('.dropdown__selector')
        for(let i = 0; i < dropdownSelector.length; i++) {
            dropdownSelector[i].onclick = function(e) {
                const dropwdown = dropdownSelector[i].closest('.dropdown')
                const dropdownTitle = dropwdown.querySelector('.dropdown__title')
                dropdownTitle.innerHTML = this.innerHTML
                dropwdown.classList.toggle('active')
            }
        }
    }

    let currency_type = [];
    $('.currency_type').click(function(){
        var currency_type_value = $(this).attr('currency_type');
        currency_type = [];
        currency_type.push(currency_type_value)
    });

    $('.vannie').click(function () {
        var vannie_id = $(this).attr('data_id');
        $('input[name="vannie_id"]').val(vannie_id);
    })

    $('.vid').click(function () {
        var vid = $(this).attr('data_id');
        $('input[name="vid_id"]').val(vid);
    });

    $('.do_more').click(function () {
        var do_more = $(this).attr('data_id');
        $('input[name="do_more_id"]').val(do_more);
    });

    $('.country').click(function () {
        var country = $(this).attr('data_id');
        $('input[name="country_id"]').val(country);
    });

    $('.city').click(function () {
        var city = $(this).attr('data_id');
        $('input[name="city_id"]').val(' ')
        $('input[name="city_id"]').val(city);
    });

    $('.form_button').click(function () {
        var hiddenInput = $('<input>').attr({
            type: 'hidden',
            name: 'type',
            // value: type.join(',')
        });

        var hiddenInput2 = $('<input>').attr({
            type: 'hidden',
            name: 'currency_type',
            // value: currency_type.join(',')
        });

        $('.header_search').append(hiddenInput);
        $('.header_search2').append(hiddenInput);
        $('.header_search').append(hiddenInput2);
        $('.header_search2').append(hiddenInput2);
        $(this).closest('form').submit();
    })

    $('.form_button').click(function () {
        var hiddenInput = $('<input>').attr({
            type: 'hidden',
            name: 'type',
            // value: type.join(',')
        });

        var hiddenInput2 = $('<input>').attr({
            type: 'hidden',
            name: 'currency_type',
            // value: currency_type.join(',')
        });

        $('.header_search').append(hiddenInput);
        $('.header_search2').append(hiddenInput);
        $('.header_search').append(hiddenInput2);
        $('.header_search2').append(hiddenInput2);
        $(this).closest('form').submit();
    })

    $(document).ready(function() {
        $(".search__filter-types-item").on("click", function() {
            // Remove existing inline style
            $(".search__filter-types-item").css({
                "background": "",
                "color": ""
            });
            // Add new style
            $(this).css({
                "background":"#508cfa",
                "color": "white"
            });
        });
    });

    $(document).ready(function() {
        $(".close-dropdown").each(function() {
            $(this).on("click", function(event) {
                event.stopPropagation();
                const searchItem = $(this).closest(".search-nav__list-item");
                const dropDown = searchItem.find('.search-nav__item-dropdown');
                console.log(searchItem);
                console.log(dropDown);
                searchItem.removeClass('active');
                dropDown.removeClass('active');
            });
        });
    });
</script>

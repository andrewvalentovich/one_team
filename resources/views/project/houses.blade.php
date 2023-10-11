
@extends('project.includes.layouts')
<script src="https://api-maps.yandex.ru/2.1/?lang={{ app()->getLocale() }}_RU&amp;apikey=2a0f0e9d-44f3-4f13-8628-12588d752fc3" type="text/javascript"></script>
@section('header')
    @include('project.includes.header')
@endsection
@section('content')
    @include('project.includes.search_nav_bar')
    <script>
        let product_id_is = '';
    </script>
    <?php $filter = \App\Models\Peculiarities::all() ?>
    <section class="city">
        <div class="city__content">
            <div id="map_city" class="">
            </div>
            <div class="map_city__btn-changer">
                <svg
                    class="map_city__btn-changer-img"
                    xmlns="http://www.w3.org/2000/svg"
                    xml:space="preserve"
                    width="24px"
                    height="24px"
                    version="1.1"
                    style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                    viewBox="0 0 0.6 0.6"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                >
								<g id="Слой_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"/>
                                    <path class="fil0 str0"
                                          d="M0.07 0.02l0.45 0c0.03,0 0.05,0.03 0.05,0.05l0 0.45c0,0.03 -0.02,0.05 -0.05,0.05l-0.45 0c-0.02,0 -0.05,-0.02 -0.05,-0.05l0 -0.45c0,-0.02 0.03,-0.05 0.05,-0.05z"/>
                                    <path class="fil0 str0"
                                          d="M0.2 0.17l-0.05 0m0.3 0l-0.2 0m0.2 0.25l-0.2 0m0.2 -0.12l-0.2 0m-0.05 0.12l-0.05 0m0.05 -0.12l-0.05 0"/>
                                </g>
							</svg>
                <div class="map_city__btn-changer-text">
                    {{__('Список')}}
                </div>
            </div>
            <div class="city-col active">
                <div class="city-col__top">
                    <div class="city-col__title title">
{{--                        Временный костыль--}}
                        @if(isset($_GET['city_id']))
                            @if(app()->getLocale() == 'ru')
                                {{ __('Недвижимость')." " }}{{ $countries->where('id', $_GET['city_id'])->first()->country->name }}{{ " (".$countries->where('id', $_GET['city_id'])->first()->name.")" }}
                            @endif
                            @if(app()->getLocale() == 'en')
                                {{ __('Недвижимость')." " }}{{ $countries->where('id', $_GET['city_id'])->first()->country->name_en }}{{ " (".$countries->where('id', $_GET['city_id'])->first()->name_en.")" }}
                            @endif
                            @if(app()->getLocale() == 'tr')
                                {{ __('Недвижимость')." " }}{{ $countries->where('id', $_GET['city_id'])->first()->country->name_tr }}{{ " (".$countries->where('id', $_GET['city_id'])->first()->name_tr.")" }}
                            @endif
                            @if(app()->getLocale() == 'de')
                                {{ __('Недвижимость')." " }}{{ $countries->where('id', $_GET['city_id'])->first()->country->name_de }}{{ " (".$countries->where('id', $_GET['city_id'])->first()->name_de.")" }}
                            @endif
                        @elseif(isset($_GET['country_id']))
                            @if(app()->getLocale() == 'ru')
                                {{ __('Недвижимость')." " }} {{ $countries->where('id', $_GET['country_id'])->first()->name }}
                            @endif
                            @if(app()->getLocale() == 'en')
                                {{ __('Недвижимость')." " }} {{ $countries->where('id', $_GET['country_id'])->first()->name_en }}
                            @endif
                            @if(app()->getLocale() == 'tr')
                                {{ __('Недвижимость')." " }} {{ $countries->where('id', $_GET['country_id'])->first()->name_tr }}
                            @endif
                            @if(app()->getLocale() == 'de')
                                {{ __('Недвижимость')." " }} {{ $countries->where('id', $_GET['country_id'])->first()->name_de }}
                            @endif
                        @elseif(!isset($_GET['country_id']) && !isset($_GET['city_id']))
                            {{__('Недвижимость')." " }}
                        @endif
                    </div>
                    <div class="city-col__filter">
                        <div class="city-cil__filter-title">{{__('Сначала новые')}}</div>
                        <div class="city-col__filter-list"></div>
                    </div>
                    <div class="city-col__subtitle">
                        <span>
                        </span>
                        {{__('объявлений')}}
                    </div>

                    <div class="city-col__btns" style="font-size:16px;">
                        <div class="city-col__btn city-col__all" data_id="false">
                            {{__('Все')}}
                        </div>
                        <div style="padding: 10px 27px;" class="city-col__btn" data_id="true">
                            {{__('От застройщика')}}
                        </div>
                    </div>
                </div>
                    <div class="city-col__content">
                        <div class="nothing">
                            {{__('Объявлений не найдено')}}
                        </div>
                        <div class="city-col__list">
                            @foreach($get_product as $product)
                                    <?php  $get = \App\Models\favorite::where('user_id', isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null)->where('product_id', $product->id)->first() ?>
                            @endforeach
                        </div>
                        <div class="place-w _country">
                            <div class="place-popup" data-exchange="EUR">
                                <section class="object place">
                                    <div class="place__header">
                                        <div class="place__header-content">
                                            <div class="place__header-exit">
                                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve"
                                                    width="35px" height="60px" version="1.1"
                                                    style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                                    viewBox="0 0 0.5 0.86"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <g id="Слой_x0020_1">
                                                    <metadata id="CorelCorpID_0Corel-Layer"/>
                                                    <polyline class="fil0 str0" points="0.46,0.04 0.07,0.43 0.46,0.82 "/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="place__header-favorite check-favorites">
                                                <div class="place__header-favorites-text">
                                                    {{__('В избранное')}}
                                                </div>
                                                <div class="place__header-favorites-logo">
                                                    <svg class="white-to-blue" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"
                                                        version="1.1"
                                                        style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                                        viewBox="0 0 2.14 1.86"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <g id="Слой_x0020_1">
                                                        <metadata id="CorelCorpID_0Corel-Layer"/>
                                                        <path
                                                        d="M1.07 1.76c-0.21,-0.16 -0.48,-0.37 -0.74,-0.62 -0.2,-0.19 -0.25,-0.36 -0.25,-0.54 0,-0.29 0.25,-0.52 0.55,-0.52 0.18,0 0.34,0.08 0.44,0.2 0.1,-0.12 0.26,-0.2 0.44,-0.2 0.31,0 0.56,0.23 0.56,0.52 0,0.18 -0.06,0.35 -0.25,0.54 -0.26,0.25 -0.54,0.46 -0.75,0.62z"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="place__content">
                                        <div class="place__left-col">
                                            <div class="place__left-content">
                                                <div class="place__left-top">
                                                    <div class="place__top-img place__collage-item_clickable">
                                                        <img src="" alt="">
                                                    </div>
                                                </div>
                                                <div class="place__left-collage">
                                                    <div class="place__collage-item place__collage-item_clickable">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="place__slider">
                                                <div class="place__swiper swiper">
                                                    <div class="place__wrapper swiper-wrapper">
                                                        <div class="place__slide swiper-slide place__slide_clickable">

                                                        </div>
                                                    </div>
                                                    <div class="place__prev place__slider-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve"
                                                            width="35px" height="60px" version="1.1"
                                                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                                            viewBox="0 0 0.5 0.86"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g id="Слой_x0020_1">
                                                                <metadata id="CorelCorpID_0Corel-Layer"/>
                                                                <polyline class="fil0 str0" points="0.46,0.04 0.07,0.43 0.46,0.82 "/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="place__next place__slider-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve"
                                                            width="35px" height="60px" version="1.1"
                                                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                                            viewBox="0 0 0.5 0.86"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g id="Слой_x0020_1">
                                                                <metadata id="CorelCorpID_0Corel-Layer"/>
                                                                <polyline class="fil0 str0" points="0.46,0.04 0.07,0.43 0.46,0.82 "/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="place__pagination">
                                                        <div class="test">
                                                            {{__('из')}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="place__right-col">
                                            <div class="place__right-top">
                                                <a href="{{route('home_page')}}" class="place__top-logo">
                                                    <img src="{{asset('project/img/svg/new_logo.svg')}}" alt="logo">
                                                </a>
                                                <div class="place__top-favorites check-favorites">
                                                    <div class="place__top-favorites-text">
                                                        {{__('В избранное')}}
                                                    </div>
                                                    <div class="place__top-favorites-logo">
                                                        <svg class="white" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"
                                                            version="1.1"
                                                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                                            viewBox="0 0 2.14 1.86"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g id="Слой_x0020_1">
                                                            <metadata id="CorelCorpID_0Corel-Layer"/>
                                                            <path class="white"
                                                            d="M1.07 1.76c-0.21,-0.16 -0.48,-0.37 -0.74,-0.62 -0.2,-0.19 -0.25,-0.36 -0.25,-0.54 0,-0.29 0.25,-0.52 0.55,-0.52 0.18,0 0.34,0.08 0.44,0.2 0.1,-0.12 0.26,-0.2 0.44,-0.2 0.31,0 0.56,0.23 0.56,0.52 0,0.18 -0.06,0.35 -0.25,0.54 -0.26,0.25 -0.54,0.46 -0.75,0.62z"/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="place__right-mid">
                                                <div class="place__info">
                                                    <div class="place__price">
                                                        <div class="place__price-value">
                                                            <div class="place__exchange-EUR"><span></span><b></b></div>
                                                            <div class="place__exchange-USD" style="display: none;"><span></span><b></b></div>
                                                            <div class="place__exchange-RUB" style="display: none;"><span></span><b></b></div>
                                                            <div class="place__exchange-TRY" style="display: none;"><span></span><b class="lira"></b></div>
                                                        </div>
                                                        <div class="place__currency">
                                                            <div class="place__currency-preview">
                                                                <div class="place__currency-preview-item">
                                                                    {{__('Валюта')}}
                                                                </div>
                                                                <div class="place__currency-preview-arrow">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        xml:space="preserve" version="1.1"
                                                                        style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                                                        viewBox="0 0 0.5 0.86"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                        <g id="Слой_x0020_1">
                                                                            <metadata id="CorelCorpID_0Corel-Layer"/>
                                                                            <polyline class="fil0 str0"
                                                                            points="0.46,0.04 0.07,0.43 0.46,0.82 "/>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <div class="place__currency-list">
                                                                <div class="place__currency-item" data-exchange="EUR">
                                                                    €
                                                                </div>
                                                                <div class="place__currency-item" data-exchange="USD">
                                                                    $
                                                                </div>
                                                                <div class="place__currency-item" data-exchange="RUB">
                                                                    ₽
                                                                </div>
                                                                <div class="place__currency-item" data-exchange="TRY">
                                                                    <span class="lira">
                                                                        ₺
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="object__id">
                                                    </div>
                                                    <div class="place__address">
                                                    </div>
                                                    <div class="place__square">
                                                    </div>
                                                </div>
                                                <div class="place__buy">
                                                    <div class="place__buy-btn" data_id="">
                                                        <div class="place__buy-text">
                                                            {{__('Купить в рассрочку')}}
                                                        </div>
                                                        <div class="place__buy-img">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xml:space="preserve" version="1.1"
                                                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                                                viewBox="0 0 1.34 1.29"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                <g id="Слой_x0020_1">
                                                                <metadata id="CorelCorpID_0Corel-Layer"/>
                                                                <path class="fil0 str0"
                                                                d="M1.29 0.15l0 1c0,0.05 -0.04,0.09 -0.09,0.09l-1.06 0c-0.05,0 -0.09,-0.04 -0.09,-0.09l0 -1 1.24 0z"/>
                                                                <path class="fil0 str0" d="M1.03 0l0 0.31m-0.72 -0.31l0 0.31"/>
                                                                <line class="fil0 str0" x1="0.05" y1="0.41" x2="1.29" y2="0.41"/>
                                                                <line class="fil0 str0" x1="0.75" y1="0.62" x2="0.59" y2="0.62"/>
                                                                <line class="fil0 str0" x1="0.44" y1="0.62" x2="0.28" y2="0.62"/>
                                                                <line class="fil0 str0" x1="1.06" y1="0.62" x2="0.9" y2="0.62"/>
                                                                <line class="fil0 str0" x1="0.75" y1="0.82" x2="0.59" y2="0.82"/>
                                                                <line class="fil0 str0" x1="0.44" y1="0.82" x2="0.28" y2="0.82"/>
                                                                <line class="fil0 str0" x1="1.06" y1="0.82" x2="0.9" y2="0.82"/>
                                                                <line class="fil0 str0" x1="0.75" y1="1.03" x2="0.59" y2="1.03"/>
                                                                <line class="fil0 str0" x1="0.44" y1="1.03" x2="0.28" y2="1.03"/>
                                                                <line class="fil0 str0" x1="1.06" y1="1.03" x2="0.9" y2="1.03"/>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="place__scroll-content">
                                                    <div class="place__advantages">
                                                        <div class="place__advantages-item vnj">
                                                            <div class="place__advantages-img">
                                                                <svg width="71" height="57" viewBox="0 0 71 57" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_890_2)">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M28.0208 7.95917V37.8774H8.03809V7.95917H28.0208Z" stroke="#508CFA" stroke-width="4.01887" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M0 56.0739C4.1305 56.0739 4.80031 51.8318 8.81918 51.8318C12.9497 51.8318 13.6195 56.0739 17.75 56.0739C21.7689 56.0739 22.5503 51.8318 26.5692 51.8318C30.6997 51.8318 31.3695 56.0739 35.5 56.0739C39.5189 56.0739 40.3003 51.8318 44.3192 51.8318C48.4497 51.8318 49.1195 56.0739 53.25 56.0739C57.2689 56.0739 58.0503 51.8318 62.0692 51.8318C66.1997 51.8318 66.8695 56.0739 71 56.0739" stroke="#508CFA" stroke-width="2.00943" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M0 48.0362C4.1305 48.0362 4.80031 43.7941 8.81918 43.7941C12.9497 43.7941 13.6195 48.0362 17.75 48.0362C21.7689 48.0362 22.5503 43.7941 26.5692 43.7941C30.6997 43.7941 31.3695 48.0362 35.5 48.0362C39.5189 48.0362 40.3003 43.7941 44.3192 43.7941C48.4497 43.7941 49.1195 48.0362 53.25 48.0362C57.2689 48.0362 58.0503 43.7941 62.0692 43.7941C66.1997 43.7941 66.8695 48.0362 71 48.0362" stroke="#508CFA" stroke-width="2.00943" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M71 37.8774H0" stroke="#508CFA" stroke-width="4.01887" stroke-miterlimit="22.9256"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M43.9843 21.9136V37.8774H28.0205V21.9136H43.9843Z" stroke="#508CFA" stroke-width="4.01887" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M58.9434 18.0063V37.8774" stroke="#508CFA" stroke-width="2.00943" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M58.943 18.118C63.3821 18.118 66.9807 14.5193 66.9807 10.0802C66.9807 5.6411 63.3821 2.04248 58.943 2.04248C54.5039 2.04248 50.9053 5.6411 50.9053 10.0802C50.9053 14.5193 54.5039 18.118 58.943 18.118Z" stroke="#508CFA" stroke-width="4.01887" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M20.9873 15.9969H14.959" stroke="#508CFA" stroke-width="2.00943" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M20.9873 24.0346H14.959" stroke="#508CFA" stroke-width="2.00943" stroke-miterlimit="22.9256"></path>
                                                                    </g>
                                                                    <defs>
                                                                    <clipPath id="clip0_890_2">
                                                                    <rect width="71" height="57" fill="white"></rect>
                                                                    </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </div>
                                                            <div class="place__advantages-text">
                                                            {{__('ВНЖ в подарок')}}
                                                            </div>
                                                        </div>
                                                        <div class="place__advantages-item cryptocurrency">
                                                            <div class="place__advantages-img">
                                                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_890_23)">
                                                                    <path d="M13.9252 26.9519C21.1196 26.9519 26.9519 21.1196 26.9519 13.9251C26.9519 6.73065 21.1196 0.898376 13.9252 0.898376C6.73071 0.898376 0.898438 6.73065 0.898438 13.9251C0.898438 21.1196 6.73071 26.9519 13.9252 26.9519Z" stroke="#508CFA" stroke-width="1.94652" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M11.0801 4.79144V7.93583" stroke="#508CFA" stroke-width="1.94652" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M10.4814 7.93579V19.9144" stroke="#508CFA" stroke-width="1.94652" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M9.13379 7.93579H15.2728C16.7702 7.93579 18.1177 9.28339 18.1177 10.9304C18.1177 12.5775 16.7702 13.9251 15.2728 13.9251H10.4814" stroke="#508CFA" stroke-width="1.94652" stroke-miterlimit="22.9256" stroke-linecap="square"></path>
                                                                    <path d="M14.0752 4.79144V7.93583" stroke="#508CFA" stroke-width="1.94652" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M9.13379 19.9144H17.2193C18.8664 19.9144 20.0643 18.7166 20.0643 16.9198C20.0643 15.2727 18.8664 13.9251 17.2193 13.9251H10.4814" stroke="#508CFA" stroke-width="1.94652" stroke-miterlimit="22.9256" stroke-linecap="square"></path>
                                                                    <path d="M11.0801 19.9144V23.0588" stroke="#508CFA" stroke-width="1.94652" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M14.0752 19.9144V23.0588" stroke="#508CFA" stroke-width="1.94652" stroke-miterlimit="22.9256"></path>
                                                                    </g>
                                                                    <defs>
                                                                    <clipPath id="clip0_890_23">
                                                                    <rect width="28" height="28" fill="white"></rect>
                                                                    </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </div>
                                                            <div class="place__advantages-text">
                                                                {{__('Оплата криптовалютой')}}
                                                            </div>
                                                        </div>
                                                        <div class="place__advantages-item commissions">
                                                            <div class="place__advantages-img place__advantages-commission">
                                                                <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M23.8947 2H4.05263C2.91899 2 2 2.91899 2 4.05263V23.8947C2 25.0284 2.91899 25.9474 4.05263 25.9474H23.8947C25.0284 25.9474 25.9474 25.0284 25.9474 23.8947V4.05263C25.9474 2.91899 25.0284 2 23.8947 2Z" stroke="#508CFA" stroke-width="2.05263" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M20.9303 7.47369L7.24609 21.1579" stroke="#508CFA" stroke-width="2.05263" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M12.0351 7.01752L7.01758 12.0351" stroke="#508CFA" stroke-width="2.05263" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M7.01758 7.01752L12.0351 12.0351" stroke="#508CFA" stroke-width="2.05263" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M21.1582 16.1404L16.1406 21.1579" stroke="#508CFA" stroke-width="2.05263" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M16.1406 16.1404L21.1582 21.1579" stroke="#508CFA" stroke-width="2.05263" stroke-miterlimit="22.9256"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="place__advantages-text">
                                                                {{__('Без комиссии')}}
                                                            </div>
                                                        </div>
                                                        <div class="place__advantages-item parking">
                                                            <div class="place__advantages-img">
                                                                <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M23.0804 1H2.9598C1.87743 1 1 1.87743 1 2.9598V23.0804C1 24.1628 1.87743 25.0402 2.9598 25.0402H23.0804C24.1628 25.0402 25.0402 24.1628 25.0402 23.0804V2.9598C25.0402 1.87743 24.1628 1 23.0804 1Z" stroke="#508CFA" stroke-width="1.9598" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M8.05566 6.48743V20.4673" stroke="#508CFA" stroke-width="1.9598" stroke-miterlimit="22.9256"></path>
                                                                    <path d="M8.05566 6.48743H14.1964C16.4175 6.48743 18.116 8.31657 18.116 10.5377C18.116 12.7588 16.4175 14.4573 14.1964 14.4573H8.05566" stroke="#508CFA" stroke-width="1.9598" stroke-miterlimit="22.9256" stroke-linecap="square"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="place__advantages-text">
                                                                {{__('Паркинг в подарок')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="place__order">
                                                        <div class="place__order-content">
                                                            <div class="place__order-text">
                                                                <div class="place__order-info">
                                                                    <div class="place__order-title place__title">
                                                                        {{__('Анастасия')}}
                                                                    </div>
                                                                    <div class="place__order-subtitle">
                                                                        {{__('Консультант по продажам')}}
                                                                    </div>
                                                                </div>
                                                                <div class="place__order-btn">
                                                                    {{__('Заказать просмотр')}}
                                                                </div>
                                                            </div>
                                                            <div class="place__order-img">
                                                                <img src="{{asset('project/img/woman.png')}}" alt="woman">
                                                            </div>
                                                        </div>
                                                        <div class="place__order-btn_m">
                                                            {{__('Заказать просмотр')}}
                                                        </div>
                                                    </div>
                                                    <div class="object__rooms">
                                                        <div class="object__rooms-content">
                                                            <div class="object__rooms-item">
                                                                <div class="object__rooms-subtitle">
                                                                    {{__('Общая площадь')}}
                                                                </div>
                                                                <div class="object__rooms-value main-size">
                                                                    <span></span> {{__('кв.м')}}
                                                                </div>
                                                            </div>
                                                            <div class="object__rooms-item">
                                                                <div class="object__rooms-subtitle">
                                                                    {{__('Спален')}}
                                                                </div>
                                                                <div class="object__rooms-value spalni">

                                                                </div>
                                                            </div>
                                                            <div class="object__rooms-item">
                                                                <div class="object__rooms-subtitle">
                                                                    {{__('Гостиные')}}
                                                                </div>
                                                                <div class="object__rooms-value gostinnie">

                                                                </div>
                                                            </div>
                                                            <div class="object__rooms-item">
                                                                <div class="object__rooms-subtitle">
                                                                    {{__('Ванные')}}
                                                                </div>
                                                                <div class="object__rooms-value vanie">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="place__location">
                                                        <div class="place__location-title place__title">
                                                            {{__('Расположение и инфраструктура')}}
                                                        </div>
                                                        <div class="place__location-info">
                                                        </div>
                                                        <div class="place__location-map">
                                                            <div class="current-map">
                                                                <div id="place-map" style="width: 100%; height: 195px;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kompleks__layout" bis_skin_checked="1">
                                                        <div class="kompleks__layout-content" bis_skin_checked="1">
                                                            <div class="kompleks__layout-title place__title" bis_skin_checked="1">
                                                                {{__('Планировки квартир')}}
                                                            </div>
                                                            <div class="kompleks__layout-sort">
                                                                <div class="kompleks__sort-item">
                                                                    1 + 1
                                                                </div>
                                                            </div>
                                                            <div class="kompleks__layout-list" bis_skin_checked="1">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="object__peculiarities">
                                                        <div class="object__peculiarities-title place__title">
                                                            {{__('Особенности')}}
                                                        </div>
                                                        <div class="object__peculiarities-content">
                                                            <div class="object__peculiarities-item">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="object__description">
                                                        <div class="object__description-title place__title">
                                                            {{__('Описание')}}
                                                        </div>
                                                        <div class="object__description-text">
                                                        </div>
                                                    </div>
                                                    <div class="place__btns">
                                                        <div class="place__btns-content">
                                                            <div class="place__btns-item place__btns-send">
                                                                {{__('Отправить заявку')}}
                                                            </div>
                                                            <div class="place__btns-item place__btns-call">
                                                                <div class="place__btns-call-preview">
                                                                    <svg version="1.1" id="Capa_1"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        x="0px" y="0px"
                                                                        width="32px" height="32px"
                                                                        viewBox="0 0 477.156 477.156"
                                                                        style="enable-background:new 0 0 477.156 477.156;"
                                                                        xml:space="preserve">
                                                                        <g>
                                                                        <path d="M475.009,380.316l-2.375-7.156c-5.625-16.719-24.062-34.156-41-38.75l-62.688-17.125c-17-4.625-41.25,1.594-53.688,14.031
                                                                        l-22.688,22.688c-82.453-22.28-147.109-86.938-169.359-169.375L145.9,161.94c12.438-12.438,18.656-36.656,14.031-53.656
                                                                        l-17.094-62.719c-4.625-16.969-22.094-35.406-38.781-40.969L96.9,2.19c-16.719-5.563-40.563,0.063-53,12.5L9.962,48.659
                                                                        C3.899,54.69,0.024,71.94,0.024,72.003c-1.187,107.75,41.063,211.562,117.281,287.781
                                                                        c76.031,76.031,179.454,118.219,286.891,117.313c0.562,0,18.312-3.813,24.375-9.845l33.938-33.938
                                                                        C474.946,420.878,480.571,397.035,475.009,380.316z"/>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                                <div class="place__btns-call-list">
                                                                    <div class="place__btns-call-item">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            aria-label="Telegram" role="img"
                                                                            viewBox="0 0 512 512">
                                                                            <rect
                                                                            width="512" height="512"
                                                                            rx="15%"
                                                                            fill="#37aee2"/>
                                                                            <path fill="#c8daea"
                                                                            d="M199 404c-11 0-10-4-13-14l-32-105 245-144"/>
                                                                            <path fill="#a9c9dd"
                                                                            d="M199 404c7 0 11-4 16-8l45-43-56-34"/>
                                                                            <path fill="#f6fbfe"
                                                                            d="M204 319l135 99c14 9 26 4 30-14l55-258c5-22-9-32-24-25L79 245c-21 8-21 21-4 26l83 26 190-121c9-5 17-3 11 4"/>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="place__btns-call-item">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 512 512" fill="#fff">
                                                                            <rect width="512" height="512" rx="15%"
                                                                            fill="#665ca7"/>
                                                                            <path fill="none" stroke="#fff"
                                                                            stroke-linecap="round"
                                                                            stroke-width="10"
                                                                            d="M269 186a30 30 0 0 1 31 31m-38-58a64 64 0 0 1 64 67m-73-93a97 97 0 0 1 99 104"/>
                                                                            <path fill-rule="evenodd"
                                                                            d="M95 232c0-91 17-147 161-147s161 56 161 147-17 147-161 147l-26-1-53 63c-4 4-8 1-8-3v-69c-6 0-31-12-38-19-22-23-36-40-36-118zm-30 0c0-126 55-177 191-177s191 51 191 177-55 177-191 177c-10 0-18 0-32-2l-38 43c-7 8-28 11-28-13v-42c-6 0-20-6-39-18-19-13-54-44-54-145zm223 42q10-13 24-4l36 27q8 10-7 28t-28 15q-53-12-102-60t-61-104q0-20 25-34 13-9 22 5l25 35q6 12-7 22c-39 15 51 112 73 70z"/>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="place__btns-call-item">
                                                                        <xml version="1.0">
                                                                        <svg viewBox="0 0 64 64"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                            <defs>
                                                                                <style>
                                                                                    .cls-1 {
                                                                                        fill: url(#linear-gradient);
                                                                                    }
                                                                                    .cls-2 {
                                                                                        fill: #fff;
                                                                                    }
                                                                                </style>
                                                                                <linearGradient
                                                                                    gradientUnits="userSpaceOnUse"
                                                                                    id="linear-gradient" x1="32"
                                                                                    x2="32" y1="4" y2="64.81">
                                                                                    <stop offset="0"
                                                                                    stop-color="#1df47c"/>
                                                                                    <stop offset="0.31"
                                                                                    stop-color="#12df63"/>
                                                                                    <stop offset="0.75"
                                                                                    stop-color="#05c443"/>
                                                                                    <stop offset="1"
                                                                                    stop-color="#00ba37"/>
                                                                                </linearGradient>
                                                                            </defs>
                                                                            <title/>
                                                                            <g data-name="23-whatsapp"
                                                                            id="_23-whatsapp">
                                                                            <rect class="cls-1" height="64"
                                                                            rx="11.2" ry="11.2"
                                                                            width="64"/>
                                                                            <path class="cls-2"
                                                                            d="M27.42,21.38l2,5.43a.76.76,0,0,1-.1.74,10.32,10.32,0,0,1-1.48,1.71.8.8,0,0,0-.16,1.09C28.91,32,32.1,36,36.25,37.43a.79.79,0,0,0,.89-.29l1.66-2.21a.8.8,0,0,1,1-.23L45,37.3a.79.79,0,0,1,.4,1c-.57,1.62-2.36,5.57-6.19,4.93A20.79,20.79,0,0,1,26.4,36c-3.14-3.92-9.34-14,.19-15.14A.8.8,0,0,1,27.42,21.38Z"/>
                                                                            <path class="cls-2"
                                                                            d="M33.6,54.8a24.21,24.21,0,0,1-11.94-3.13l-12,3.08,4.41-9.91A22,22,0,0,1,10,32C10,19.43,20.59,9.2,33.6,9.2S57.2,19.43,57.2,32,46.61,54.8,33.6,54.8ZM22.29,47.37l.73.45a20.13,20.13,0,0,0,10.58,3c10.81,0,19.6-8.43,19.6-18.8S44.41,13.2,33.6,13.2,14,21.63,14,32a18.13,18.13,0,0,0,4,11.34l.75.95-3.61,6.12Z"/>
                                                                            </g>
                                                                        </svg>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="place__footer">
                                                        <div class="footer-w">
                                                            <footer class="footer footer_place">
                                                                <div class="footer__top">
                                                                    <a href="{{route('home_page')}}" class="footer__logo">
                                                                        <img src="{{asset('project/img/svg/new_logo.svg')}}" alt="logo">
                                                                    </a>
                                                                </div>
                                                                <div class="footer__nav">
                                                                    <div class="footer__nav-list">
                                                                        <?php $get_footer_link =  \App\Models\CompanySelect::orderby('status' , 'asc')->orderby('updated_at', 'desc')->get(); ?>
                                                                        @foreach($get_footer_link as $link)
                                                                                <a href="{{route('company_page',$link->id)}}" class="footer__nav-item">
                                                                                    {{__($link->name)}}
                                                                                </a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="footer__content">
                                                                    <a href="{{route('personal_data_processing_policy')}}" class="footer__subtitle">
                                                                        {{__('Пользовательское соглашение при использовании сайта')}}
                                                                    </a>
                                                                    <a href="{{route('user_agreement_when_using_the_site')}}" class="footer__subtitle">
                                                                        {{__('Политика обработки персональных данных')}}
                                                                    </a>
                                                                </div>
                                                                <div class="footer__bottom">
                                                                    <div class="footer__slogan">
                                                                        © 2022 - {{\Illuminate\Support\Carbon::now()->year}} OneTeam
                                                                    </div>
                                                                </div>
                                                            </footer>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="place__exit">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                        style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                        viewBox="0 0 0.37 0.37"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Слой_x0020_1">
                                        <metadata id="CorelCorpID_0Corel-Layer"/>
                                        <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"/>
                                        <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"/>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="place__slider_p">
                            <div class="place__slider_p-swiper swiper">
                                <div class="place__slider_p-wrapper swiper-wrapper">
                                    <div class="place__slider_p-slide swiper-slide">
                                        <div class="place__slider_p-img">
                                            <img src="{{ isset($product->photo[0]) ? asset('uploads/'.$product->photo[0]->photo) : asset('uploads/') }}">
                                        </div>
                                    </div>
                                        <div class="place__slider_p-slide swiper-slide">
                                            <div class="place__slider_p-img">

                                            </div>
                                        </div>
                                </div>
                                <div class="place__slider_p-prev place__slider_p-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35px"
                                            height="60px" version="1.1"
                                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                            viewBox="0 0 0.5 0.86"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Слой_x0020_1">
                                        <metadata id="CorelCorpID_0Corel-Layer"/>
                                        <polyline class="fil0 str0" points="0.46,0.04 0.07,0.43 0.46,0.82 "/>
                                    </g>
                                </svg>
                                </div>
                                <div class="place__slider_p-next place__slider_p-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35px"
                                            height="60px" version="1.1"
                                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                            viewBox="0 0 0.5 0.86"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Слой_x0020_1">
                                        <metadata id="CorelCorpID_0Corel-Layer"/>
                                        <polyline class="fil0 str0" points="0.46,0.04 0.07,0.43 0.46,0.82 "/>
                                    </g>
                                </svg>
                                </div>
                                <div class="place__slider_p-pagination"></div>
                            </div>

                            <div class="place__slider_p-exit">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px"
                                        height="26px" version="1.1"
                                        style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                        viewBox="0 0 0.37 0.37"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Слой_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"/>
                                    <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"/>
                                    <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"/>
                                </g>
                            </svg>
                            </div>
                        </div>
                        <div class="place-popup-collage">
                            <div class="place-popup-collage__content">
                                <div class="place-popup-collage__top">
                                    <div class="place_popup__top-item">
                                    </div>
                                </div>
                                <div class="place-popup-collage__list">

                                </div>
                                <div class="place-popup-collage__exit">
                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="26px"
                                            height="26px" version="1.1"
                                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                            viewBox="0 0 0.37 0.37"
                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Слой_x0020_1">
                                        <metadata id="CorelCorpID_0Corel-Layer"/>
                                        <line class="fil0 str0" x1="0.02" y1="0.36" x2="0.36" y2="0.02"/>
                                        <line class="fil0 str0" x1="0.36" y1="0.36" x2="0.02" y2="0.02"/>
                                    </g>
                                </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="city-col__bottom">
                        <div class="city-col__bottom-btns">
                            <style>
                                .page-item {
                                    margin: 0 5px;
                                }
                                .pagination {
                                    display: flex;
                                    justify-content: space-between;
                                    margin: 0 35px;
                                }
                                .page-link {
                                    color: #002850;
                                    padding: 11px 22px;
                                    border-radius: 5px;
                                    border: 1px solid #e3e9f6;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    max-width: 50px;
                                    transition: .2s;
                                    cursor: pointer;
                                }
                                .active > span {
                                    color: #fff;
                                    border: none;
                                    background: #508cfa;
                                }
                            </style>
                            <div class="city-col__bottom-pages" style="display:none">

                            </div>
                        </div>
                    </div>
                    <div class="city-col__foooter">
                        <div class="footer-w">
                            <footer class="footer footer_col">
                                <div class="footer__top">
                                    <a href="{{route('home_page')}}" class="footer__logo">
                                        <img src="{{asset('project/img/svg/new_logo.svg')}}" alt="logo">
                                    </a>
                                </div>
                                <div class="footer__nav">
                                    <div class="footer__nav-list">
                                        <?php $get_footer_link = \App\Models\CompanySelect::orderby('status', 'asc')->orderby('updated_at', 'desc')->get(); ?>
                                        @foreach($get_footer_link as $link)
                                            <a href="{{route('company_page',$link->id)}}" class="footer__nav-item">
                                                {{__($link->name)}}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="footer__content">
                                    <a href="{{route('personal_data_processing_policy')}}" class="footer__subtitle">
                                        {{__('Пользовательское соглашение при использовании сайта')}}
                                    </a>
                                    <a href="{{route('user_agreement_when_using_the_site')}}" class="footer__subtitle">
                                        {{__('Политика обработки персональных данных')}}
                                    </a>
                                </div>
                                <div class="footer__bottom">
                                    <div class="footer__slogan">
                                        © 2022 - {{\Illuminate\Support\Carbon::now()->year}} OneTeam
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </div>
                    <div class="city-col__btn-changer active">
                        <svg class="city-col__btn-changer-img xmlns=" http://www.w3.org/2000/svg" xml:space="preserve" width="27px" height="25px" version="1.1"
                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision;
                            image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                            viewBox="0 0 0.81 0.75"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Слой_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"/>
                                <polygon class="fil0 str0"
                                         points="0.03,0.71 0.28,0.63 0.53,0.71 0.78,0.63 0.78,0.04 0.53,0.13 0.28,0.04 0.28,0.04 0.03,0.13 "/>
                                <line class="fil0 str0" x1="0.28" y1="0.63" x2="0.28" y2="0.04"/>
                                <line class="fil0 str0" x1="0.53" y1="0.71" x2="0.53" y2="0.13"/>
                            </g>
                        </svg>
                        <div class="city-col__btn-changer-text">
                            {{__('Карта')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
    .zoom-control{padding:4px}.zoom-control__group{border-radius:12px;box-shadow:0 var(--shadow-y) var(--shadow-blur) 0 var(--shadow-color)}.zoom-control__group:hover{box-shadow:0 var(--shadow-y) 10px 0 var(--shadow-color)}.zoom-control__icon{width:100%;height:100%;pointer-events:none;background-position:50%;background-repeat:no-repeat}._mobile .zoom-control{padding:0}._mobile .zoom-control__group{border-radius:0;box-shadow:none}._mobile .zoom-control__zoom-in{margin-bottom:12px}
    </style>
    <section class="object__photo">
        <div class="object__photo-popup">
            <div class="object__photo-popup-block">
                <div class="object__photo-content">
                    <div class="object__swiper swiper">
                        <div class="object__swiper-wrapper swiper-wrapper">
                            <div class="object__swiper-slide swiper-slide"></div>
                        </div>
                        <div class="object__swiper-pagination swiper-pagination"></div>
                        <div class="object__swiper-prev object__swiper-nav">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.2893 5.70708C13.8988 5.31655 13.2657 5.31655 12.8751 5.70708L7.98768 10.5993C7.20729 11.3805 7.2076 12.6463 7.98837 13.427L12.8787 18.3174C13.2693 18.7079 13.9024 18.7079 14.293 18.3174C14.6835 17.9269 14.6835 17.2937 14.293 16.9032L10.1073 12.7175C9.71678 12.327 9.71678 11.6939 10.1073 11.3033L14.2893 7.12129C14.6799 6.73077 14.6799 6.0976 14.2893 5.70708Z" fill="#fff"></path> </g></svg>
                        </div>
                        <div class="object__swiper-next object__swiper-nav">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.2893 5.70708C13.8988 5.31655 13.2657 5.31655 12.8751 5.70708L7.98768 10.5993C7.20729 11.3805 7.2076 12.6463 7.98837 13.427L12.8787 18.3174C13.2693 18.7079 13.9024 18.7079 14.293 18.3174C14.6835 17.9269 14.6835 17.2937 14.293 16.9032L10.1073 12.7175C9.71678 12.327 9.71678 11.6939 10.1073 11.3033L14.2893 7.12129C14.6799 6.73077 14.6799 6.0976 14.2893 5.70708Z" fill="#fff"></path> </g></svg>
                        </div>
                    </div>
                    <div class="object__photo-text">
                        <div class="object__photo-info">
                        </div>
                        <form class="default-form" id="">
                            <div class="title">Заявка на бронь</div>
                            <label class="field name input-wrapper" bis_skin_checked="1">
                                <span class="text">
                                    ФИО
                                </span>
                                <input type="text" value="" placeholder="Иванов Алексей Петрович" name="fio">
                            </label>
                            <div class="field field-phone selection-phone input-wrapper" bis_skin_checked="1">
                                <div class="contact__form-phone-country close-out" bis_skin_checked="1">
                                    <div class="contact__form-country-item" bis_skin_checked="1">
                                        <div class="contact__form-country-item-img" bis_skin_checked="1">
                                            <img src="https://dev.one-team.pro/project/img/countries/ru.png" alt="ru">
                                        </div>
                                    </div>
                                </div>
                                <div class="contact__phone-dropdown close-out" bis_skin_checked="1">
                                    <div class="contact__phone-list" bis_skin_checked="1">
                                        <div class="contact__phone-list-item" mask="+7 (___) ___-__-__" bis_skin_checked="1">
                                            <div class="contact__phone-img" bis_skin_checked="1">
                                                <img src="https://dev.one-team.pro/project/img/countries/ru.png" alt="ru">
                                            </div>
                                            <div class="contact__phone-title" bis_skin_checked="1">
                                                Россия (Russia) <span>+7</span>
                                            </div>
                                        </div>
                                        <div class="contact__phone-list-item" mask="+1 (___) ___-__-__" bis_skin_checked="1">
                                            <div class="contact__phone-img" bis_skin_checked="1">
                                                <img src="https://dev.one-team.pro/project/img/countries/us.png" alt="us">
                                            </div>
                                            <div class="contact__phone-title" bis_skin_checked="1">
                                                США (United States)  <span>+1</span>
                                            </div>
                                        </div>
                                        <div class="contact__phone-list-item" mask="+49 (___) ____-____" bis_skin_checked="1">
                                            <div class="contact__phone-img" bis_skin_checked="1">
                                                <img src="https://dev.one-team.pro/project/img/countries/gr.png" alt="gr">
                                            </div>
                                            <div class="contact__phone-title" bis_skin_checked="1">
                                                Германия (Germany) <span>+49</span>
                                            </div>
                                        </div>
                                        <div class="contact__phone-list-item" mask="+48 (___) ___-___" bis_skin_checked="1">
                                            <div class="contact__phone-img" bis_skin_checked="1">
                                                <img src="https://dev.one-team.pro/project/img/countries/pl.png" alt="pl">
                                            </div>
                                            <div class="contact__phone-title" bis_skin_checked="1">
                                                Польша (Poland) <span>+48</span>
                                            </div>
                                        </div>
                                        <div class="contact__phone-list-item" mask="+46 (___) ___-____" bis_skin_checked="1">
                                            <div class="contact__phone-img" bis_skin_checked="1">
                                                <img src="https://dev.one-team.pro/project/img/countries/sw.png" alt="sw">
                                            </div>
                                            <div class="contact__phone-title" bis_skin_checked="1">
                                                Швеция (Sweden) <span>+46</span>
                                            </div>
                                        </div>
                                        <div class="contact__phone-list-item" mask="+39 (___) ___-____" bis_skin_checked="1">
                                            <div class="contact__phone-img" bis_skin_checked="1">
                                                <img src="https://dev.one-team.pro/project/img/countries/it.png" alt="it">
                                            </div>
                                            <div class="contact__phone-title" bis_skin_checked="1">
                                                Италия (Italy) <span>+39</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="text">
                                    Номер телефона
                                </span>
                                <input data-phone-pattern="+7 (___) ___-__-__" class="contact__phone-input" type="text" value="" placeholder="" name="phone">
                            </div>
                            <label class="contact__form-politic">
                                <input class="contact__form-politic-checkbox contact__form-checkbox " type="checkbox" id="contact__form-politic" checked="">
                                <div class="contact__form-custom-checkbox one_check"></div>
                                <div class="contact__form-checkbox-text">
                                    Ознакомлен с <span>политикой конфеденциальности </span>
                                </div>
                            </label>
                            <label class="contact__form-data">
                                <input class="contact__form-data-checkbox contact__form-checkbox" type="checkbox" id="contact__form-data">
                                <div class="contact__form-custom-checkbox two_check"></div>
                                <div class="contact__form-checkbox-text">
                                    Согласен на обработку <span>персональных данных </span>
                                </div>
                            </label>
                            <button type="submit" class="btn">
                                Перезвонить мне
                            </button>
                            <input type="hidden" name="product_id" value="">
                            <input type="hidden" name="country" value="">
                            <!--а-->
                        </form>
                    </div>
                </div>
            </div>
            <div class="object__photo-popup-close">
                <svg viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier"><title>close [#1511]</title>
                        <desc>Created with Sketch.</desc>
                        <defs></defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Dribbble-Light-Preview" transform="translate(-419.000000, -240.000000)" fill="#fff">
                                <g id="icons" transform="translate(56.000000, 160.000000)">
                                    <polygon id="close-[#1511]"
                                             points="375.0183 90 384 98.554 382.48065 100 373.5 91.446 364.5183 100 363 98.554 371.98065 90 363 81.446 364.5183 80 373.5 88.554 382.48065 80 384 81.446"></polygon>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function changerActive(list) {
            for(let i = 0; i < list.length; i++) {
                list[i].classList.remove('active')
            }
            list = 0
        }
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

        // Сортировка
        if ($.query.get('order_by').toString() === "price-desc") {
            $('.city-cil__filter-title').text(`{{ __('Сначала дешёвые') }}`);
        }

        if ($.query.get('order_by').toString() === "price-asc") {
            $('.city-cil__filter-title').text(`{{ __('Сначала дорогие') }}`);
        }

        if ($.query.get('order_by').toString() === "created_at-desc") {
            $('.city-cil__filter-title').text(`{{ __('Сначала новые') }}`);
        }

        if ($.query.get('ot_zastroishika') === "true" || $.query.get('ot_zastroishika') === true) {
            $('.city-col__btn:not(.city-col__all)').addClass("active");
        } else {
            $('.city-col__all').addClass("active");
        }

        $('.city-col__filter-list').append('<div class="city-col__filter-item '+(($.query.get('order_by').toString() === "price-desc") ? 'active' : '')+'" data_id="price-desc">{{ __("Сначала дорогие")}}</div>');
        $('.city-col__filter-list').append('<div class="city-col__filter-item '+(($.query.get('order_by').toString() === "price-asc") ? 'active' : '')+'" data_id="price-asc">{{ __("Сначала дешёвые")}}</div>');
        $('.city-col__filter-list').append('<div class="city-col__filter-item '+(($.query.get('order_by').toString() === "created_at-desc") ? 'active' : '')+'" data_id="created_at-desc">{{ __("Сначала новые")}}</div>');

        $('.city-col__filter-item').on('click', function() {
            var value = $(this).attr('data_id');
            var text = $(this).text();


            $('.city-cil__filter-title').text(text);
            history.pushState(null, null, $.query.SET('order_by', value)); // подстановка параметров
        });

        let g = document.querySelectorAll(".kompleks__layout-img"),
            b = document.querySelectorAll(".object__photo");

        g.forEach((item, index) => {
            item.addEventListener('click', () => {
                b[0].classList.add("active");
                b[0].childNodes[1].childNodes[1].childNodes[1].src = item.childNodes[1].src;
            })
        })




        let spal = "<?php echo __('спал') ?>";
        let van = "<?php echo __('ван') ?>";
        let kvm = "<?php echo __('кв.м') ?>";

            @if(isset($_GET['city_id']))

            <?php $id = $_GET['city_id'];?>

            @else

            <?php $id = $country->id;?>

            @endif




        let ids = {{ $id }};


        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');



        (async () => {

            function e(e) {
                for (let t = 0; t < e.length; t++) e[t].classList.remove("active");
                e = 0
            }

            window.addEventListener("resize", (function (e) {
            })), document.querySelectorAll(".place-w").length && window.innerWidth <= 540 && (document.querySelector(".place__currency-preview-item").textContent = "$"), window.addEventListener("resize", (function (e) {
                document.querySelectorAll("#map_city").length && (window.innerWidth > 1003 && document.querySelector(".city__content").classList.remove("city_map"), window.innerWidth <= 1003 && (document.querySelector("#map_city").style.height = "100%"), window.innerWidth > 1003 && (document.querySelector(".city-col").classList.add("active"), document.querySelector(".map_city__btn-changer").classList.remove("active"), document.querySelector(".city-col__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.remove("map_city_active"), document.querySelector(".city__content").classList.remove("city_map")), window.innerWidth > 1199 && (document.querySelector("#map_city").style.height = window.innerHeight - 18 - 161 + "px"), window.innerWidth <= 1199 && window.innerWidth > 1003 && (document.querySelector("#map_city").style.height = window.innerHeight - 88 - 60 + "px"))
            })), document.querySelector(".header__top-lang").onclick = function () {
                document.querySelector(".header__top-lang-item").classList.toggle("active"), document.querySelector(".header__lang-list-dropdown").classList.toggle("active")
            },document.querySelector(".header__top-phone-menu").onclick = function () {
                document.querySelector(".header-m").classList.toggle("active"), document.querySelector("#nav-icon").classList.toggle("open"), document.querySelector(".header-w").classList.add("fixed"), document.querySelector(".header-m").classList.contains("active") || document.querySelector(".place-w").classList.contains("active") || document.querySelector(".header-w").classList.remove("fixed")
            }
            let t = document.querySelectorAll(".header-m__langs-item");
            for (let o = 0; o < t.length; o++) t[o].addEventListener("click", (function (c) {
                e(t), t[o].classList.add("active")
            }));

            let o = document.querySelectorAll(".index-map__button");
            for (let t = 0; t < o.length; t++) o[t].addEventListener("click", (function (c) {
                e(o), o[t].classList.add("active")
            }));

            let c, l = document.querySelectorAll(".contact__top-item");
            for (let t = 0; t < l.length; t++) l[t].addEventListener("click", (function (o) {
                e(l), l[t].classList.add("active")
            }));

            document.querySelectorAll(".contact__form-phone-country").length && (document.querySelector(".contact__form-phone-country").onclick = function () {
                this.classList.toggle("active"), document.querySelector(".contact__phone-dropdown").classList.toggle("active")
            })

            let n = document.querySelectorAll(".search-nav__rooms-dropdown-bedrooms-button");
            for (let t = 0; t < n.length; t++) n[t].addEventListener("click", (function (o) {
                e(n), n[t].classList.add("active")
            }));

            let i = document.querySelectorAll(".search-nav__rooms-dropdown-bathrooms-button");
            for (let t = 0; t < i.length; t++) i[t].addEventListener("click", (function (o) {
                e(i), i[t].classList.add("active")
            }));

            let a = document.querySelectorAll(".search-nav__view-button");

            for (let t = 0; t < a.length; t++) a[t].addEventListener("click", (function (o) {

                e(a), a[t].classList.add("active")

            }));

            let s = document.querySelectorAll(".search-nav__sea-button");

            for (let t = 0; t < s.length; t++) s[t].addEventListener("click", (function (o) {

                e(s), s[t].classList.add("active")

            }));

            function m() {

                for (let e = 0; e < u.length - 1; e++) u[e].style.zIndex = 5

            }

 document.querySelector(".city-col__filter") && (document.querySelector(".city-col__filter").onclick = function () {

                this.classList.toggle("active"), document.querySelector(".city-col__filter-list").classList.toggle("active")

            }), document.querySelector(".favorites__top-filter") && (document.querySelector(".favorites__top-filter").onclick = function () {

                this.classList.toggle("active"), document.querySelector(".favorites__top-filter-list").classList.toggle("active")

            }), document.querySelector(".place__btns-call-preview") && (document.querySelector(".place__btns-call-preview").onclick = function () {

                document.querySelector(".place__btns-call-list").classList.toggle("active")

            }), document.querySelector(".place__btns-call-preview") && (document.querySelector(".place-w").onscroll = function () {

                window.innerWidth < 640 && (document.querySelector(".place-w").scrollTop > 620 ? document.querySelector(".place__btns").style.position = "fixed" : document.querySelector(".place__btns").style.position = "static")

            }, window.addEventListener("resize", (function (e) {

                window.innerWidth >= 640 && (document.querySelector(".place__btns").style.position = "static")

            })));

            let _ = document.querySelectorAll(".favorites__list-item"),

                y = document.querySelectorAll(".favorites__item-exit");

            for (let e = 0; e < y.length; e++) y[e].addEventListener("click", (function (t) {

                _[e].style.display = "none"

            }));

            let v = document.querySelectorAll(".favorites__pages-item");

            for (let t = 0; t < v.length; t++) v[t].addEventListener("click", (function (o) {

                e(v), v[t].classList.add("active")

            }));

            let h = document.querySelectorAll(".favorite-item-btn");

            for (let e = 0; e < h.length; e++) h[e].addEventListener("click", (function (t) {

                h[e].classList.toggle("active")

            }));

            let f = document.querySelectorAll(".objects__slide-favorites");

            let w = document.querySelectorAll(".city-col__bottom-number");

            for (let t = 0; t < w.length; t++) w[t].addEventListener("click", (function (o) {

                e(w), w[t].classList.add("active")

            }));

            document.querySelector(".city-col__btn-changer") && (document.querySelector(".city-col__btn-changer").onclick = function () {

                 P(1 / 0),  this.classList.remove("active"), document.querySelector(".city-col").classList.remove("active"), document.querySelector(".map_city__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.add("map_city_active"), document.querySelector(".city__content").classList.add("city_map")

            }), document.querySelector(".map_city__btn-changer") && (document.querySelector(".map_city__btn-changer").onclick = function () {

                this.classList.remove("active"), document.querySelector(".city-col").classList.add("active"), document.querySelector(".city-col__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.remove("map_city_active"), document.querySelector(".city__content").classList.remove("city_map")

            }), document.querySelectorAll(".place__currency-preview").length && (document.querySelector(".place__currency-preview").onclick = function () {

                document.querySelector(".place__currency").classList.toggle("active")

            }), window.innerWidth > 1003 && document.querySelectorAll(".city").length && document.body.classList.add("scroll_fixed"), window.addEventListener("resize", (function (e) {

                window.innerWidth > 1003 && document.querySelectorAll(".city").length && document.body.classList.add("scroll_fixed"), window.innerWidth <= 1003 && document.querySelectorAll(".city").length && document.body.classList.remove("scroll_fixed")

            }));



            for (let e = 0; e < g.length; e++) g[e].addEventListener("click", (function (e) {
                e.target.classList.contains("favorite-item-btn") || (document.body.classList.add("scroll_fixed"), document.querySelector(".header-w").classList.add("fixed"))
            }));

            document.querySelectorAll(".place__exit").length && (document.querySelector(".place__exit").onclick = function () {
                document.querySelector(".place-w").classList.remove("active"), document.body.classList.remove("scroll_fixed"), document.querySelector(".header-w").classList.remove("fixed")
            }), document.querySelectorAll(".place__header-exit").length && (document.querySelector(".place__header-exit").onclick = function () {
                document.querySelector(".place-w").classList.remove("active"), document.body.classList.remove("scroll_fixed"), document.querySelector(".header-w").classList.remove("fixed")
            })

            let S = document.querySelectorAll(".place__collage-item_clickable"),
                L = document.querySelectorAll(".place__slide_clickable"),
                q = document.querySelector(".place__slider_p"),
                k = document.querySelector(".place__slider_p-exit"),
                x = document.querySelector(".place-popup-collage"),
                A = document.querySelector(".place-popup-collage__exit");

            if (document.querySelectorAll(".place__header-exit").length) {
                const placeExitBtn = document.querySelectorAll(".place__header-exit")
                placeExitBtn.forEach(btn => {
                    btn.addEventListener('click', function () {
                        const placeW = this.closest('.place-w')
                        placeW.classList.remove('active')
                    })
                });
            }

            if (document.querySelectorAll('.place-popup-collage__exit').length) {
                const placeCollageExitBtn = document.querySelectorAll('.place-popup-collage__exit')
                placeCollageExitBtn.forEach(btn => {
                    btn.addEventListener('click', function () {
                        const placeCollage = this.closest('.place-popup-collage')
                        placeCollage.classList.remove('active')
                    })
                });
            }
            var C, E;


// динамический массив для заполнения точек на карте map_city
let firstCall = 1
function P(e) {
    // Получение текущего URL
    const currentUrl = window.location.href;
    // Создание объекта URL
    const url = new URL(currentUrl);
    // Получение параметров из URL
    const searchParams = url.searchParams;
    let currentCoordinateMapLeft = null
    let currentCoordinateMapRight = null
    let maxPage = null
    let currentPage = 1
    let mapCountry;
    var script;
    var head = document.getElementsByTagName('head')[0];

    let site_url = `{{config('app.url')}}`;
    let locationsCity = [];
    let houseData = {}
    let objectsListSet = new Set()
    let objectsListMap = new Map()
    let user_id = {{ isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : time() }}

    const langSite = `{{ app()->getLocale() }}`

    let previousSwiperInstance = null;
    let ballons = []
    const objectSwiper = new Swiper('.object__swiper', {
        slidesPerView: 1,
        navigation: {
            nextEl: '.object__swiper-next',
            prevEl: '.object__swiper-prev',
        },
        pagination: {
            el: ".object__swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            320: {

            },
            480: {

            },
            640: {

            }
        }
    })
    const dictionary = {
        rooms_bedroom: {
            ru: 'спальни',
            en: 'bedrooms',
            tr: 'yatak odaları',
            de: 'schlafzimmer',
        },
        rooms_bathroom: {
            ru: 'ванные',
            en: 'bathrooms',
            tr: 'banyolar',
            de: 'badezimmer',
        },
        square_m: {
            ru: 'кв.м.',
            en: 'sq.m.',
            tr: 'metrekare',
            de: 'qm',
        },
        from: {
            ru: 'от',
            en: 'from',
            tr: 'itibaren',
            de: 'aus',
        }
    }

    function setListenersToOpenPopup() {
        const cityColList = document.querySelector('.city-col__list')
        cityColList.addEventListener('click', function(e) {
            const houseCard = e.target.closest('.city-col__item');
            if (!houseCard) return
            const id = houseCard.getAttribute('data_id')
            let object = {...objectsListMap.get(parseInt(id))}
            setNewPopupHouseData(object)
        })
    }
    setListenersToOpenPopup()
    function setCityItem(data, clearList) {
        const cityList = document.querySelector('.city-col__list')
        if(clearList) cityList.innerHTML = ''
        // Удаление предыдущего экземпляра Swiper, если он есть
        if (previousSwiperInstance) {
            previousSwiperInstance = null;
        }

        data.forEach(cityElement => {
            const cityItem = document.createElement('div');
            cityItem.classList.add('city-col__item');
            cityItem.setAttribute('id', `card_object-${cityElement.id}`);
            cityItem.setAttribute('data_id', cityElement.id);

            const sliderDiv = document.createElement('div');
            sliderDiv.classList.add('city-col__slider');

            const swiperDiv = document.createElement('div');
            swiperDiv.classList.add('city__swiper', 'swiper');

            const wrapperDiv = document.createElement('div');
            wrapperDiv.classList.add('city__wrapper', 'swiper-wrapper');
            swiperDiv.appendChild(wrapperDiv);

            const maxIterations = 5

            const hasMoreThanFivePhotos = cityElement.photo.length > maxIterations;

            cityElement.photo.slice(0, maxIterations).forEach((photo, index, array) => {
                const slideDiv = document.createElement('div');
                slideDiv.classList.add('city__slide', 'swiper-slide');

                const imgDiv = document.createElement('div');
                imgDiv.classList.add('city-col__item-img');

                const img = document.createElement('img');

                if (photo.preview !== null && photo.preview) {
                    img.setAttribute('src', `${photo.preview}`);
                } else {
                    img.setAttribute('src', `uploads/${photo.photo}`);
                }

                img.setAttribute('alt', 'place');
                imgDiv.appendChild(img);

                slideDiv.appendChild(imgDiv);

                // Проверяем, является ли текущий элемент последним
                if (index === array.length - 1 && hasMoreThanFivePhotos) {
                    slideDiv.classList.add('last-slide');
                    const span = document.createElement('span');
                    span.classList.add('quantity');
                    span.innerHTML = `+ еще ${cityElement.photo.length - maxIterations} фото`;
                    slideDiv.appendChild(span);
                }

                wrapperDiv.appendChild(slideDiv);
            });




            const scrollbarDiv = document.createElement('div');
            scrollbarDiv.classList.add('city__scrollbar');
            swiperDiv.appendChild(scrollbarDiv);
            sliderDiv.appendChild(swiperDiv);
            cityItem.appendChild(sliderDiv);

            // Создание текстовой части
            const textDiv = document.createElement('div');
            textDiv.classList.add('city-col__item-text');

            // favorite
            const favoriteDiv = document.createElement('div');
            favoriteDiv.classList.add('objects__slide-favorites','check-favorites');
            if(cityElement.favorite.length) {
                favoriteDiv.classList.add('active');
            }
            favoriteDiv.setAttribute('data_id', cityElement.id)
            favoriteDiv.innerHTML =
            `<svg class="blue" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="73px" height="64px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 2.33 2.04" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Слой_x0020_1">
                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                    <path class="fil0 str0" d="M1.16 1.88c-0.22,-0.16 -0.5,-0.38 -0.77,-0.65 -0.2,-0.19 -0.26,-0.37 -0.26,-0.55 0,-0.31 0.26,-0.55 0.58,-0.55 0.18,0 0.35,0.08 0.45,0.21 0.11,-0.13 0.28,-0.21 0.46,-0.21 0.32,0 0.58,0.24 0.58,0.55 0,0.18 -0.06,0.36 -0.26,0.55 -0.27,0.27 -0.56,0.49 -0.78,0.65z"></path>
                </g>
            </svg>`
            cityItem.appendChild(favoriteDiv);

            favoriteDiv.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
            })

            //цена в карточке превью
            const priceDiv = document.createElement('div');
            priceDiv.classList.add('city-col__item-price');
            if (cityElement.layouts_count > 1) {
                priceDiv.textContent = `€ ${cityElement.min_price.EUR.slice(0, -1)} +`;
            } else {
                priceDiv.textContent = `€ ${cityElement.price.EUR.slice(0, -1)}`;
            }

            textDiv.appendChild(priceDiv);

            //комнаты в карточке превью
            const roomsDiv = document.createElement('div');
            roomsDiv.classList.add('city-col__item-rooms');

            const spalni = cityElement.spalni
            const vannie = cityElement.vanie
            const layouts = cityElement.layouts



            if (layouts && layouts.length > 0) {
                roomsDiv.innerHTML = ` ${layouts}`;
            } else {
                roomsDiv.innerHTML = `${cityElement.size} кв.м`

                if (spalni && spalni.length > 0) {
                    roomsDiv.innerHTML += `<span>|</span> ${spalni.replace('+', '')} ${dictionary.rooms_bedroom[langSite]}`;
                }

                if (vannie && vannie.length > 0) {
                    roomsDiv.innerHTML += `<span>|</span> ${vannie.replace('+', '')} ${dictionary.rooms_bathroom[langSite]}`;
                }
            }


            textDiv.appendChild(roomsDiv);

            const addressDiv = document.createElement('div');
            addressDiv.classList.add('city-col__item-address');
            addressDiv.textContent = cityElement.address;
            textDiv.appendChild(addressDiv);

            cityItem.appendChild(textDiv);

            // Добавление элемента в контейнер
            cityList.appendChild(cityItem);
            cityItem.addEventListener('mouseover', function() {
                const id = cityItem.getAttribute('data_id')
                let currentBallon
                ballons.forEach(element => {
                    if(element.house_id == id) currentBallon = element
                    const marks = document.querySelectorAll(`[mark-id]`);
                    marks.forEach(element => {
                        element.classList.remove('active')
                    });
                    const mark = document.querySelector(`[mark-id="${id}"]`);
                    mark.classList.add('active')
                });
                currentBallon.balloon.open();
            })
            cityItem.addEventListener('mouseout', function() {
                mapCountry.balloon.close()
                const marks = document.querySelectorAll(`[mark-id]`);
                marks.forEach(element => {
                    element.classList.remove('active')
                });
            })
        });
        previousSwiperInstance = new Swiper(".city__swiper", {
            slidesPerView: 1,
            scrollbar: {
                el: ".city__scrollbar",
                hide: true
            }
        });
        if(data.length !== 0) {
            addHoverMouseSwiper(previousSwiperInstance)
        }
    }

    //свайп при ховере мышки
    function addHoverMouseSwiper (swipers) {
        if(swipers.length) {
            swipers.forEach(swiper => {
                const slidesLength =swiper.slides.length
                const width = 1 / slidesLength * 100
                if(!swiper.el.querySelectorAll('i').length)
                for(let i = 0; i < slidesLength; i++) {
                    let newDiv = document.createElement("i");
                    swiper.el.append(newDiv)
                    newDiv.style.width = width + '%'
                    newDiv.style.left = width * i + '%'
                    newDiv.addEventListener('mouseover', function() {
                        swiper.slideTo(i, 400)
                    })
                }
            });
        }
    }

    function setPagination(data) {
        if (data.last_page !== 1) {
            var pagination = getPagination(data);
            $(".city-col__bottom-pages").html(pagination);
            $(".city-col__pages_m").html(pagination);
        }
    }

    function getPagination(data) {
        // Пагинация
        var pagination = `<nav>
        <ul class="pagination">`;

        if (data.current_page === 1) {
            pagination +=  `<li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                            </li>`;
        } else {
            pagination +=  `<li class="page-item">
                                    <a class="page-link" href="${data.prev_page_url}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                </li>`;
        }
        $.each(data.links, function (page, link) {
            if(page === 0 || page === (data.last_page+1)) {
                return;
            } else {
                if (link.active === true) {
                    pagination += `<li class="page-item active" aria-current="page"><span class="page-link">${page}</span></li>`;
                } else {
                    let url = "";
                    let params = window
                    .location
                    .search
                    .replace('?','')
                    .split('&')
                    .reduce(
                        function(p,e){
                            var a = e.split('=');
                            p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                            return p;
                        },
                        {}
                    );

                    if (window.location.search.indexOf("?") !== -1) {
                        if (params['page'] === undefined) {
                            url = window.location + "&page=" + page;
                        } else {
                            let search_str = "page="+data.current_page;
                            let page_str = "page=";
                            let win_loc_str = window.location.toString();

                            let pos = window.location.toString().indexOf(search_str);
                            let search_len = data.current_page.toString().length;

                            url = win_loc_str.substr(0, pos + page_str.length) + page + win_loc_str.substr(pos + page_str.length + search_len);
                        }
                    } else {
                        url = window.location + "?page=" + page;
                    }

                    pagination += `<li class="page-item"><a class="page-link" href="${url}">${page}</a></li>`;
                }
            }
        });

        if (data.next_page_url !== null) {
            pagination += `<li class="page-item">
                                <a class="page-link" href="${data.next_page_url}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                            </li>`;
        } else {
            pagination += `<li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                <span class="page-link" aria-hidden="true">&rsaquo;</span>
                            </li>`;
        }

        pagination += `</ul>
                    </nav>`;

        return pagination;
    }

    function setCountObjectsPerPage() {
        const nothing = document.querySelector('.nothing')
        const pagination = document.querySelector('.city-col__bottom-btns')
        const objects = document.querySelectorAll('.city-col__item')

        if(objects.length == 0) {
            nothing.classList.add('active')
            pagination.classList.remove('active')
        } else {
            nothing.classList.remove('active')
            pagination.classList.add('active')
        }
    }

    let placeMap = null;
    async function getObjectById (id) {
        $.ajax({
                url: '/api/houses/simple',
                data: {
                    id: id
                },
                method: 'get',
                success: function(data) {
                    setNewPopupHouseData(data)
                }
            });
    }
    const objectIdFromUrl = searchParams.get('object_id');
    console.log(searchParams)
    if(objectIdFromUrl) {
        getObjectById(objectIdFromUrl)
    }
    function setNewPopupHouseData(object) {
        url.searchParams.set('object_id', object.id);
        // Получение обновленного URL
        var updatedUrl = url.toString();
        // Обновление URL в адресной строке
        window.history.replaceState({}, '', updatedUrl);
        const dataExchange = document.querySelector('.place-popup').getAttribute('data-exchange')
        const placeW = document.querySelector('.place-w')
        const placeLeftCol = document.querySelector('.place__left-col')
        const placeScrollContent = document.querySelector('.place__scroll-content')

        placeW.classList.add('active')
        $(placeLeftCol).animate({ scrollTop: 0 }, "fast");
        $(placeScrollContent).animate({ scrollTop: 0 }, "fast");
        currentHouse = {...object}
        const topPic = placeW.querySelector('.place__left-top').querySelector('img')
        topPic.setAttribute('src',`/uploads/${currentHouse.photo[0].photo}`)

        const leftCollage = placeW.querySelector('.place__left-collage')

        leftCollage.innerHTML = ''
        currentHouse.photo.forEach((photo, index) => {
            if(index === 0) return

            let div = document.createElement('div')
            div.classList.add('place__collage-item', 'place__collage-item_clickable')

            let img = document.createElement('img')
            img.setAttribute('src', `/uploads/${photo.photo}`)

            div.appendChild(img)
            leftCollage.appendChild(div)
        });


        const placeTopFavorites = document.querySelector('.place__top-favorites')
        const placeHeaderFavorites = document.querySelector('.place__header-favorite')

        placeTopFavorites.setAttribute('data_id', currentHouse.id)
        placeHeaderFavorites.setAttribute('data_id', currentHouse.id)

        if(favotires_house_id.hasOwnProperty(currentHouse.id)) {
            placeTopFavorites.classList.add('active')
            placeHeaderFavorites.classList.add('active')
        } else {
            placeTopFavorites.classList.remove('active')
            placeHeaderFavorites.classList.remove('active')
        }

        //айди в попапе
        const objectId = document.querySelector('.object__id')
        objectId.innerHTML = `ID: ${currentHouse.id}`

        //адресс в попапе
        const address = document.querySelector('.place__address')
        address.innerHTML = `${currentHouse.address}`


        // цена площади
        let divSquare = document.querySelector('.place__square')
        divSquare.innerHTML = ''
        Object.entries(currentHouse.price_size).forEach(function([currencyCode, currencyPrice]) {
            let div = document.createElement('div')
            div.classList.add('place__square-item')
            div.setAttribute('data-exchange', currencyCode)
            div.classList.add('valute')
            div.innerHTML = `${((currencyPrice))} ${kvm}`

            if(currencyCode === dataExchange) {
                div.classList.add('active')
            }

            divSquare.appendChild(div)
        })

        //цена в попапе
        if (currentHouse.layouts_count && currentHouse.layouts_count > 0) {
            Object.keys(currentHouse.min_price).forEach(function (currencyCode, price) {
                const currencyCodePrice = document.querySelector(`.place__exchange-${currencyCode}`)
                const spanPriceBlock = currencyCodePrice.querySelector('span')
                const bPriceBlock = currencyCodePrice.querySelector('b')
                let currentPrice
                const chemes = JSON.parse(currentHouse.objects)
                if(chemes.length > 1) {
                    currentPrice = `${dictionary.from[langSite]} ` + currentHouse.min_price[currencyCode];
                } else {
                    currentPrice = currentHouse.min_price[currencyCode];
                }
                const valuteSymbol = currentPrice[currentPrice.length - 1];
                currentPrice = currentPrice.slice(0, -1);


                spanPriceBlock.innerHTML = currentPrice
                bPriceBlock.innerHTML = valuteSymbol
            })
        } else {
            Object.keys(currentHouse.price).forEach(function (currencyCode, price) {
                const currencyCodePrice = document.querySelector(`.place__exchange-${currencyCode}`)
                const spanPriceBlock = currencyCodePrice.querySelector('span')
                const bPriceBlock = currencyCodePrice.querySelector('b')


                let currentPrice = currentHouse.price[currencyCode];
                const valuteSymbol = currentPrice[currentPrice.length - 1];
                currentPrice = currentPrice.slice(0, -1);


                spanPriceBlock.innerHTML = currentPrice
                bPriceBlock.innerHTML = valuteSymbol
            })
        }



        //плюсы
        const properties = [
            { property: 'vnj', selector: '.place__advantages-item.vnj' },
            { property: 'cryptocurrency', selector: '.place__advantages-item.cryptocurrency' },
            { property: 'commissions', selector: '.place__advantages-item.commissions' },
            { property: 'parking', selector: '.place__advantages-item.parking' },
        ];

        properties.forEach(item => {
            const element = document.querySelector(item.selector);
            if (element && currentHouse[item.property] === 'Да') {
                element.style.display = 'flex';
            } else {
                element.style.display = 'none';
            }
        });

        //комнаты
        const objectRooms = document.querySelector('.object__rooms')
        objectRooms.style.display = 'none'
        if(currentHouse.complex_or_not !== 'Нет' || currentHouse.complex_or_not !== null) {
            objectRooms.style.display = 'block'

            const mainSize = objectRooms.querySelector('.main-size').querySelector('span')
            mainSize.innerHTML = currentHouse.size_home

            if(currentHouse.spalni) {
                const spalni = objectRooms.querySelector('.spalni')
                spalni.innerHTML = currentHouse.spalni.replace('+', '')
            }


            if(currentHouse.gostinnie) {
                const gostinnie = objectRooms.querySelector('.gostinnie')
                gostinnie.innerHTML = currentHouse.gostinnie.replace('+', '')
            }


            if(currentHouse.vanie) {
                const vanie = objectRooms.querySelector('.vanie')
                vanie.innerHTML = currentHouse.vanie.replace('+', '')
            }


        }


        //карта
        const currentMap = document.querySelector('.current-map')
        const currentMapID = document.querySelector('#place-map')
        const div_id = 'place-map'
        ymaps.ready(function() {
            console.log(placeMap)
            currentMapID.innerHTML = ''
            placeMap = new ymaps.Map(div_id, {
                center: [currentHouse.lat, currentHouse.long],
                zoom: 10,
            });
            placeMap.controls.remove('geolocationControl'); // удаляем геолокацию
            placeMap.controls.remove('searchControl'); // удаляем поиск
            // placeMap.controls.remove('trafficControl'); // удаляем контроль трафика
            // placeMap.controls.remove('typeSelector'); // удаляем тип
            // placeMap.controls.remove('fullscreenControl'); // удаляем кнопку перехода в полноэкранный режим
            // placeMap.controls.remove('zoomControl'); // удаляем контрол зуммирования
            // placeMap.controls.remove('rulerControl'); // удаляем контрол правил
            let placemark = new ymaps.Placemark([currentHouse.lat, currentHouse.long]);
            placeMap.geoObjects.add(placemark);
        });

        //особенности
        const objectPeculiarities = document.querySelector('.object__peculiarities-content')
        objectPeculiarities.innerHTML = ''

        if(currentHouse.peculiarities)
        currentHouse.peculiarities.forEach(element => {
            if(element.type !== "Особенности") return

            let div = document.createElement('div')
            div.classList.add('object__peculiarities-item')
            div.innerHTML = element.name
            objectPeculiarities.appendChild(div)
        });

        // сортиторвка квартир
        const kompleksLayoutSort = document.querySelector('.kompleks__layout-sort')
        kompleksLayoutSort.innerHTML = ''

        const objects = JSON.parse(currentHouse.objects)
        let chemesSet = new Set()
        
        objects.forEach(object => {
            const div = document.createElement('div')
            div.classList.add('kompleks__sort-item')
            div.innerHTML = object.apartment_layout
            div.setAttribute('data-cheme',object.apartment_layout)
            if(!chemesSet.has(object.apartment_layout)) {
                chemesSet.add(object.apartment_layout)
                kompleksLayoutSort.appendChild(div)
            }
        });

        // планировки квартир
        const kompleksLayoutList = document.querySelector('.kompleks__layout-list')
        kompleksLayoutList.innerHTML = ''

        const kompleks__layout = document.querySelector('.kompleks__layout')
        kompleks__layout.style.display = 'none'

        if(currentHouse.objects !== null && currentHouse.objects !== '[]')
        if(objects.length !== 0) {

            kompleks__layout.style.display = 'block'

            objects.forEach((object, index) => {
                let divItem = document.createElement('div')
                divItem.classList.add('kompleks__layout-item')
                divItem.setAttribute('data-cheme',object.apartment_layout)

                let divInfo = document.createElement('div')
                divInfo.classList.add('kompleks__layout-info')

                let divOption = document.createElement('div')
                divOption.classList.add('kompleks__layout-option')
                divOption.innerHTML = `${object.building}`
                divInfo.appendChild(divOption)

                let divPrice = document.createElement('div')
                divPrice.classList.add('kompleks__layout-price')

                Object.entries(object.price).forEach(function([currencyCode, currencyPrice]) {
                    let span = document.createElement('span')
                    span.setAttribute('data-exchange', currencyCode)
                    span.classList.add('valute')
                    span.classList.add('lira')
                    span.innerHTML = `${((currencyPrice))}`

                    if(currencyCode === dataExchange) {
                        span.classList.add('active')
                    }

                    divPrice.appendChild(span)

                })
                divInfo.appendChild(divPrice)


                let divMeter = document.createElement('div')
                divMeter.classList.add('kompleks__layout-price-meter')
                Object.entries(object.price_size).forEach(function([currencyCode, currencyPrice]) {
                    let span = document.createElement('span')
                    span.setAttribute('data-exchange', currencyCode)
                    span.classList.add('valute')
                    span.classList.add('lira')
                    span.innerHTML = `${((currencyPrice))} ${kvm}`

                    if(currencyCode === dataExchange) {
                        span.classList.add('active')
                    }

                    divMeter.appendChild(span)

                })
                divInfo.appendChild(divMeter)

                let divSquare = document.createElement('div')
                divSquare.classList.add('kompleks__layout-square')
                divSquare.innerHTML = `${object.size} ${dictionary.square_m[langSite]} <span>|</span> ${object.apartment_layout}`
                divInfo.appendChild(divSquare)

                let divMonth = document.createElement('div')
                divMonth.classList.add('kompleks__layout-price-month')
                divMonth.innerHTML = `$645 / мес.`
                divInfo.appendChild(divMonth)

                let divCheme = document.createElement('div')
                divCheme.classList.add('kompleks__layout-scheme')

                let divChemePic = document.createElement('div')
                divChemePic.classList.add('kompleks__layout-img')

                divChemePic.addEventListener('click', function(e) {
                    const containerItem = this.closest('.kompleks__layout-item')
                    const chemePopup = document.querySelector(".object__photo");
                    const swiperWrapper = document.querySelector(".object__swiper-wrapper");
                    const objectSwiperNav = document.querySelectorAll(".object__swiper-nav");
                    swiperWrapper.innerHTML = ''
                    //если много фото
                    if(typeof(object.apartment_layout_image) === 'object') {
                        object.apartment_layout_image.forEach(element => {
                            const slide = document.createElement('div')
                            const slidePic = document.createElement('img')
                            slide.classList.add('swiper-slide')
                            slide.appendChild(slidePic)
                            slidePic.setAttribute('src', `/uploads/${element}`)
                            swiperWrapper.appendChild(slide)
                            objectSwiperNav.forEach(btn => {
                                btn.style.display = 'flex'
                            });
                        });
                    } else {// если одна фотка
                        const slide = document.createElement('div')
                        const slidePic = document.createElement('img')
                        slide.classList.add('swiper-slide')
                        slide.appendChild(slidePic)
                        slidePic.setAttribute('src', `/uploads/${object.apartment_layout_image}`)
                        swiperWrapper.appendChild(slide)
                        objectSwiperNav.forEach(btn => {
                            btn.style.display = 'none'
                        });
                    }

                    objectSwiper.update()
                    objectSwiper.updateSlides()
                    objectSwiper.slideTo(0)
                    const text = document.querySelector(".object__photo-info")
                    const infoForTextBlock = containerItem.querySelector(".kompleks__layout-info")
                    text.innerHTML = infoForTextBlock.innerHTML
                    chemePopup.classList.add('active')

                })


                let divChemeImg = document.createElement('img')
                divChemeImg.setAttribute('src', `/uploads/${object.apartment_layout_image}`)

                divChemePic.appendChild(divChemeImg)
                divCheme.appendChild(divChemePic)

                divInfo.appendChild(divMonth)

                divItem.appendChild(divInfo)
                divItem.appendChild(divCheme)
                kompleksLayoutList.appendChild(divItem)
            });
        }


        //Расположение и инфраструктура
        const placeLocationInfo = document.querySelector('.place__location-info')
        if(langSite === 'ru')
        placeLocationInfo.innerHTML = currentHouse.disposition

        if(langSite === 'en')
        placeLocationInfo.innerHTML = currentHouse.disposition_en

        if(langSite === 'tr')
        placeLocationInfo.innerHTML = currentHouse.disposition_tr

        //Описание
        const placeDescription = document.querySelector('.object__description-text')
        if(langSite === 'ru')
        placeDescription.innerHTML = currentHouse.description

        if(langSite === 'en')
        placeDescription.innerHTML = currentHouse.description_en

        if(langSite === 'tr')
        placeDescription.innerHTML = currentHouse.description_tr

        setListenersToOpenCollage()
        addNewImagesToPlaceSwiper(currentHouse)
        setListenersToOpenCollageBySlide()
        addNewImagesToCollage(currentHouse)
    }

    function setListenersToOpenCollage() {
        const collageImg = document.querySelectorAll('.place__collage-item_clickable')
        for (let i = 0; i < collageImg.length; i++) {
            collageImg[i].onclick = function (e) {
                addNewImagesToSwiper(e.target, i)
                const placeSliderP = document.querySelector(".place__slider_p")
                placeSliderP.classList.add('active')
            }
        }
    }

    function addNewImagesToSwiper(itemClick, index) {
        const imagesContainer = itemClick.closest('.place__content')
        const images = imagesContainer.querySelectorAll('.place__collage-item_clickable')
        const swiper = document.querySelector('.place__slider_p-swiper')
        const swiperWrapper = swiper.querySelector('.place__slider_p-wrapper')

        // Удаление всех дочерних элементов swiperWrapper
        while (swiperWrapper.firstChild) {
            swiperWrapper.removeChild(swiperWrapper.firstChild);
        }

        for (let i = 0; i < images.length; i++) {
            const slide = document.createElement('div');
            slide.classList.add('place__slider_p-slide', 'swiper-slide');

            const imgContainer = document.createElement('div');
            imgContainer.classList.add('place__slider_p-img');

            const img = document.createElement('img');
            img.src = images[i].querySelector('img').getAttribute('src');
            img.alt = 'house';

            imgContainer.appendChild(img);
            slide.appendChild(imgContainer);
            swiperWrapper.appendChild(slide);
        }

        const swiperPlaces = new Swiper(".place__slider_p-swiper", {
            slidesPerView: 1,
            autoHeight: !0,
            initialSlide: index,
            keyboard: {
                enabled: true, // Включить поддержку клавиатуры
            },
            navigation: {
                nextEl: ".place__slider_p-next",
                prevEl: ".place__slider_p-prev"
            },

            pagination: {
                el: ".place__slider_p-pagination",
                type: "custom",
                renderCustom: function (e, t, o) {
                    return t + " из " + o
                }
            }
        })
    }

    function addNewImagesToCollage(house) {
        const collage = document.querySelector('.place-popup-collage')

        const topPic = collage.querySelector('.place_popup__top-item')
        topPic.innerHTML = ''
        const img = document.createElement('img')
        img.setAttribute('src', `/uploads/${house.photo[0].photo}`)

        topPic.appendChild(img)

        const collageList = collage.querySelector('.place-popup-collage__list')
        collageList.innerHTML = ''
        house.photo.forEach((element,index) => {
            if(index === 0 ) return
            const collageListItem = collage.querySelector('.place-popup-collage__item')

            const div = document.createElement('div')
            div.classList.add('place-popup-collage__item')

            const img = document.createElement('img')
            img.setAttribute('src', `/uploads/${element.photo}`)

            div.appendChild(img)

            collageList.appendChild(div)
        });

    }

    function addNewImagesToPlaceSwiper(house) {
        const swiper = document.querySelector('.place__swiper')
        const swiperWrapper = swiper.querySelector('.place__wrapper')

        // Удаление всех дочерних элементов swiperWrapper
        while (swiperWrapper.firstChild) {
            swiperWrapper.removeChild(swiperWrapper.firstChild);
        }

        const images = house.photo
        for (let i = 0; i < images.length; i++) {
            const slide = document.createElement('div');
            slide.classList.add('place__slide', 'swiper-slide', 'place__slide_clickable');

            const img = document.createElement('img')
            img.setAttribute('src', `/uploads/${images[i].photo}`)

            slide.appendChild(img);
            swiperWrapper.appendChild(slide);
        }

        const swiperPlaces = new Swiper(".place__swiper", {
            slidesPerView: 2,
            spaceBetween: 4,
            navigation: {
                nextEl: ".place__next",
                prevEl: ".place__prev"
            },
            pagination: {
                el: ".place__pagination",
                type: "custom",
                renderCustom: function (e, t, o) {
                    return t + " из " + o
                }
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                540: {
                    slidesPerView: 2
                }
            }
        })
    }

    function setListenersToOpenCollageBySlide() {
        const collagePic = document.querySelectorAll('.place__slide_clickable')

        for (let i = 0; i < collagePic.length; i++) {
            collagePic[i].onclick = function (e) {
                const placeCollage = document.querySelector(".place-popup-collage")
                placeCollage.classList.add('active')
            }
        }

    }

    function checkFavorites(data) {
        favotires_house_id = Object.assign({}, favotires_house_id)
        data.forEach(element => {
            if(element.favorite.length) {
                favotires_house_id[element.id] = true
            }
        });
    }

    function setBallons(houses) {
        var t = ymaps.templateLayoutFactory.createClass('<div class="popover top"><a class="close" href="#">&times;</a><div class="arrow"></div><div class="popover-inner">$[[options.contentLayout observeSize minWidth=235 maxWidth=235 maxHeight=350]]</div></div>', {
            build: function () {
                this.constructor.superclass.build.call(this);
                this._$element = $(".popover", this.getParentElement());
                this.applyElementOffset();
                this._$element.find(".close").on("click", $.proxy(this.onCloseClick, this));
            },
            clear: function () {
                this._$element.find(".close").off("click");
                this.constructor.superclass.clear.call(this);
            },
            onSublayoutSizeChange: function () {
                t.superclass.onSublayoutSizeChange.apply(this, arguments);
                if (this._isElement(this._$element)) {
                    this.applyElementOffset();
                    this.events.fire("shapechange");
                }
            },
            applyElementOffset: function () {
                this._$element.css({
                    left: -this._$element[0].offsetWidth / 2,
                    top: -(this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight)
                });
            },
            onCloseClick: function (e) {
                e.preventDefault();
                this.events.fire("userclose");
            },
            getShape: function () {
                if (!this._isElement(this._$element)) {
                    return t.superclass.getShape.call(this);
                }
                var e = this._$element.position();
                return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                    [e.left, e.top],
                    [e.left + this._$element[0].offsetWidth, e.top + this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight]
                ]));
            },
            _isElement: function (e) {
                return e && e[0] && e.find(".arrow")[0];
            }
        });

        var o = ymaps.templateLayoutFactory.createClass('<div class="placemark"></div>', {
            build: function () {
                o.superclass.build.call(this);
                var e = this.getParentElement().getElementsByClassName("placemark")[0];
                var t = this.isActive ? 60 : 34;
                var c = {
                    type: "Circle",
                    coordinates: [0, 0],
                    radius: t / 2
                };
                var l = {
                    type: "Circle",
                    coordinates: [0, -30],
                    radius: t / 2
                };

                this.getData().options.set("shape", this.isActive ? l : c);
                document.addEventListener("click", function (e) {
                    if ((e.target.classList.contains("ymaps-2-1-79-balloon__close-button") || e.target.classList.contains("ymaps-2-1-79-user-selection-none")) && window.innerWidth <= 1003) {
                        var t = document.querySelectorAll(".placemark");
                        for (var i = 0; i < t.length; i++) {
                            t[i].classList.remove("active");
                        }
                    }
                });
                if (!this.inited) {
                    this.inited = true;
                    this.isActive = false;
                    this.getData().geoObject.events.add("click", function (t) {
                        var o = document.querySelectorAll(".placemark");
                        if (e.classList.contains("active")) {
                            e.classList.remove("active");
                        } else {
                            for (var i = 0; i < o.length; i++) {
                                o[i].classList.remove("active");
                            }
                            e.classList.add("active");
                        }
                    }, this);
                }
            }
        });

        var c = ymaps.templateLayoutFactory.createClass('<div class="ballon-city__content">$[properties.balloonContent]</div>');
        houses.forEach(city => {
            locationsCity.push({
                coordinates: [city.lat, city.long],
                balloonContent: `<div class="balloon-city" id="${city.id}">
                    <div class="balloon-city__text">
                        <div class="balloon-city__price">€ ${city.price}</div>
                        <div class="balloon-city__rooms">${city.spalni} ${spal}, ${city.vannie} ${van}</div>
                        <div class="balloon-city__rooms_m">${city.kv} ${kvm}  <span>|</span> ${city.spalni} спальни  <span>|</span> ${city.vannie} ванна</div>
                        <div class="balloon-city__address">${city.address} Balbey, 431. Sk. No:4, 07040 Muratpaşa</div>
                        <div class="balloon-city__square">${city.kv} ${kvm}</div>
                    </div>
                    <div class="balloon-city__img"> <img src="/uploads/${city.photo[0].photo}"></div>
                </div>`,
                city_id: city.id
            });
        });
        locationsCity.forEach(function (location) {
            var placemark = new ymaps.Placemark(location.coordinates, {
                balloonContent: location.balloonContent,
                balloonAutoPan: false,
            }, {
                balloonPanelMaxMapArea: 250000,
                balloonShadow: false,
                balloonLayout: t,
                balloonAutoPan: false,
                iconLayout: o,
                balloonContentLayout: c,
                hideIconOnBalloonOpen: false,
                balloonOffset: [-110, -50],
                iconImageSize: [17,17]
            });
            mapCountry.geoObjects.add(placemark);

            placemark.events.add('mouseenter', function (e) {
                placemark.balloon.open(); // Открываем балун при наведении мыши
                setTimeout(function () {
                    var balloonContentElement = document.querySelector('.balloon-city');
                    if (balloonContentElement) {
                        var mouseLeaveListener = function () {
                            placemark.balloon.close();
                            balloonContentElement.removeEventListener('mouseleave', mouseLeaveListener);
                        };
                        balloonContentElement.addEventListener('mouseleave', mouseLeaveListener);
                    }
                }, 0);
            });
        });
    }

    function changeLangMap(lang) {
        if(!firstCall) return
        firstCall = 0
        var language = lang;
        if (mapCountry) {
            mapCountry.destroy();
        }
        script = document.createElement('script');
        script.type = 'text/javascript';
        script.charset = 'utf-8';
        script.src = 'https://api-maps.yandex.ru/2.1/?onload=init_' + language + '&lang=' + language + '_RU&ns=ymaps_' + language;
        head.appendChild(script);
        window['init_' + language] = function () {
            init(window['ymaps_' + language]);
        };
    }

    let mapLang = "<?php echo app()->getLocale() ?>";
    const userAgent = navigator.userAgent.toLowerCase();

    changeLangMap(mapLang);

    async function init(ymaps) {

        let p = document.querySelectorAll(".city-col__btn");
        for (let t = 0; t < p.length; t++) p[t].addEventListener("click", ( async function (o) {
            var ot_zastroishika = p[t].getAttribute('data_id');
            // e(p), p[t].classList.add("active");
            history.pushState(null, null, $.query.SET('ot_zastroishika', ot_zastroishika)); // подстановка параметров
            let allMarks = await getDataMarks()
            createMapCity(allMarks)
        }));

        $('.city-col__filter-item').on('click', async function() {
            let allMarks = await getDataMarks()
            createMapCity(allMarks)
        });

        //отправить запрос с фильтром по кнопке найти страница houses
        if(document.querySelectorAll('.btn-filter-houses').length) {
            const btnFilterHouses = document.querySelector('.btn-filter-houses')
            btnFilterHouses.addEventListener('click', async function() {
                let allMarks = await getDataMarks()
                createMapCity(allMarks)
                changeCountryField()
            })
        }

        function changeCountryField() {
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
                success: function(data) {
                    // если задан параметр country_id, то выводим регионы
                    if ((typeof url_country_id !== "boolean" && url_country_id !== "" && url_country_id !== " ") || (typeof url_city_id !== "boolean" && url_city_id !== "" && url_city_id !== " ")) {
                        $('.search-nav__list-item[data_id="city"]').show();
                        $('.search-nav__list-item[data_id="country"]').hide();
                        // Выводим регионы при загрузке страницы
                        $(".city_select").text((url_city_id.toString() && url_city_id.toString() != "true") ? data.cities.find(x => x.id == url_city_id).name : "{{ __('Регионы') }}");
                        // Выводим страны в dropdown
                        $('.search-nav__cities-list').empty();
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
                        $('.search-nav__countries-list').empty();
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
                }
            });
        }

        function getDataMarks() {
            let params = createParams()
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `/api/houses/all`,
                    method: 'GET',
                    dataType: 'json',
                    data: params,
                    success: function (data) {
                        if(data.length) {
                            const subtitle = document.querySelector('.city-col__subtitle')
                            const span = subtitle.querySelector('span')
                            span.innerHTML = data.length
                        }
                        resolve(data);
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            })
        }

        function createParams() {
            let urlParams = new URLSearchParams(window.location.search);
            let params = {};

            urlParams.forEach((value, key) => {
                params[key] = value;
            });

            params.user_id = user_id;

            if (params.country === true) params.country = null;
            if (params.city_id === true) params.city_id = null;
            if (params.type === true) params.type = null;
            if (params.price && params.price.price_min === true) params.price.price_min = null;
            if (params.price && params.price.price_max === true) params.price.price_max = null;
            if (params.bedrooms === true) params.bedrooms = null;
            if (params.bathrooms === true) params.bathrooms = null;
            if (params.view === true) params.view = null;
            if (params.to_sea === true) params.to_sea = null;

            if (params.size && params.size.min === true) params.size.min = null;
            if (params.size && params.size.max === true) params.size.max = null;

            return params;
        }

        let marksFilter = await getDataMarks()

        createMapCity(marksFilter)
        async function getData(topLeft, bottomRight, paramsCustom) {
            let params = createParams()
            if(paramsCustom) {
                params.page = paramsCustom.page
            }
                $.ajax({
                    url: `/api/houses/by_coordinates/with_filter`,
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        ...params,
                        top_left: topLeft,
                        bottom_right: bottomRight,
                    },
                    success: function (data) {
                        console.log('data',data);
                        locationsCity.length = 0;
                        maxPage = data.last_page
                        houseData.length = 0;
                        houseData = { ...data }
                        data.data.forEach(object => {
                            if (!objectsListSet.has(object.id)) {
                                objectsListSet.add(object.id);
                                objectsListMap.set(object.id, object);
                            }
                        });
                        checkFavorites(data.data)
                        let site_url = `{{config('app.url')}}`;

                        // setBallons(data.data);
                        if(!paramsCustom) {
                            setCityItem(data.data, true);
                        } else {
                            setCityItem(data.data, false);
                        }
                        setCountObjectsPerPage()
                        // setListenersToOpenPopup();
                        setListenersToAddfavorites();
                        setPagination(data);
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
        }



        // делаем запрос на объекты когда доскролили вниз
        const cityCol = document.querySelector('.city-col');
        const cityColFooter = document.querySelector('.city-col__foooter');
        let canLoadData = true;
        function onScrollToFooter() {
            const cityColTop = cityCol.getBoundingClientRect().top;
            const footerTop = cityColFooter.getBoundingClientRect().top;
            const footerBottom = cityColFooter.getBoundingClientRect().bottom;

            if (footerTop - 800 <= cityColTop && footerBottom >= cityColTop) {
                if (canLoadData && currentPage <= maxPage) {
                    currentPage++
                    canLoadData = false;
                    getData(currentCoordinateMapLeft, currentCoordinateMapRight, { page: currentPage });
                    setTimeout(() => {
                        canLoadData = true;
                    }, 500);
                }
            }
        }

        // Добавляем слушатель события прокрутки к элементу cityCol
        cityCol.addEventListener('scroll', function() {
            onScrollToFooter()
        });
        async function createMapCity(allmarks) {
            const mapCity = document.querySelector('#map_city')
            mapCity.innerHTML = ''
            if(mapCountry) {
                mapCountry.destroy()
            }
            mapCountry = new ymaps.Map("map_city", {
                center: [<?php echo $country->lat . ',' . $country->long ?>],
                zoom: 6,
                controls: [],
                behaviors: ["default", "scrollZoom"],
                autoFitToViewport: 'always'
            }, {
                searchControlProvider: "yandex#search"
            });

            let minLat = Infinity;
            let maxLat = -Infinity;
            let minLon = Infinity;
            let maxLon = -Infinity;

            allmarks.forEach(mark => {
                if (mark.coordinate && mark.coordinate !== ',') {
                    const [lat, lon] = mark.coordinate.split(',').map(coord => parseFloat(coord));
                    if (!isNaN(lat) && !isNaN(lon)) {
                        minLat = Math.min(minLat, lat);
                        maxLat = Math.max(maxLat, lat);
                        minLon = Math.min(minLon, lon);
                        maxLon = Math.max(maxLon, lon);
                    }
                }
            });

            mapCountry.setBounds([[minLat, minLon], [maxLat, maxLon]], {
                checkZoomRange: true,
            }).then(function() {
                mapCountry.container.fitToViewport()
            }, function(err) {
                // Обработка ошибок
            }, this);


            ZoomLayout = ymaps.templateLayoutFactory.createClass('<div class="zoom-control"><div class="zoom-control__group"><div class="zoom-control__zoom-in"><button  type="button" class="button _view_air _size_medium  _pin-bottom" aria-haspopup="false" aria-label="Приблизить"><span class="button__icon" aria-hidden="true"><div class="zoom-control__icon"><svg width="30" height="30" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11 5.992c0-.537.448-.992 1-.992.556 0 1 .444 1 .992V11h5.008c.537 0 .992.448.992 1 0 .556-.444 1-.992 1H13v5.008c0 .537-.448.992-1 .992-.556 0-1-.444-1-.992V13H5.992C5.455 13 5 12.552 5 12c0-.556.444-1 .992-1H11V5.992z" fill="currentColor"/></svg></div></span></button></div><div class="zoom-control__zoom-out"><button type="button" class="button _view_air _size_medium _pin-top" aria-haspopup="false" aria-label="Отдалить"><span class="button__icon" aria-hidden="true"><div class="zoom-control__icon"><svg width="30" height="30" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M5 12a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H6a1 1 0 0 1-1-1z" fill="currentColor"/></svg></div></span></button></div></div></div></div></div>', {

                // Переопределяем методы макета, чтобы выполнять дополнительные действия
                // при построении и очистке макета.
                build: function () {
                    // Вызываем родительский метод build.
                    ZoomLayout.superclass.build.call(this);

                    // Привязываем функции-обработчики к контексту и сохраняем ссылки
                    // на них, чтобы потом отписаться от событий.
                    this.zoomInCallback = ymaps.util.bind(this.zoomIn, this);
                    this.zoomOutCallback = ymaps.util.bind(this.zoomOut, this);

                    // Начинаем слушать клики на кнопках макета.
                    $('.zoom-control__zoom-in').bind('click', this.zoomInCallback);
                    $('.zoom-control__zoom-out').bind('click', this.zoomOutCallback);
                },

                clear: function () {
                    // Снимаем обработчики кликов.
                    $('.zoom-control__zoom-in').unbind('click', this.zoomInCallback);
                    $('.zoom-control__zoom-out').unbind('click', this.zoomOutCallback);

                    // Вызываем родительский метод clear.
                    ZoomLayout.superclass.clear.call(this);
                },

                zoomIn: function () {
                    var map = this.getData().control.getMap();
                    map.setZoom(map.getZoom() + 1, {checkZoomRange: true});
                },

                zoomOut: function () {
                    var map = this.getData().control.getMap();
                    map.setZoom(map.getZoom() - 1, {checkZoomRange: true});
                }
            }),
            zoomControl = new ymaps.control.ZoomControl({options: {layout: ZoomLayout}});

            mapCountry.controls.add(zoomControl, {
                position: {
                    right: 20,
                    bottom: 20
                }
            });
            mapCountry.events.add('balloonclose', function (e) {
                var t = document.querySelectorAll(".placemark");
                for (let e = 0; e < t.length; e++) t[e].classList.remove("active")
            });
            var t = ymaps.templateLayoutFactory.createClass('<div class="popover top"><a class="close" href="#">&times;</a><div class="arrow"></div><div class="popover-inner">$[[options.contentLayout observeSize minWidth=235 maxWidth=235 maxHeight=350]]</div></div>', {
                build: function () {
                    this.constructor.superclass.build.call(this), this._$element = $(".popover", this.getParentElement()), this.applyElementOffset(), this._$element.find(".close").on("click", $.proxy(this.onCloseClick, this))
                },

                clear: function () {
                    this._$element.find(".close").off("click"), this.constructor.superclass.clear.call(this)
                },

                onSublayoutSizeChange: function () {
                    t.superclass.onSublayoutSizeChange.apply(this, arguments), this._isElement(this._$element) && (this.applyElementOffset(), this.events.fire("shapechange"))
                },

                applyElementOffset: function () {
                    this._$element.css({
                        left: -this._$element[0].offsetWidth / 2,
                        top: -(this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight)
                    })
                },

                onCloseClick: function (e) {
                    e.preventDefault(), this.events.fire("userclose")
                },

                getShape: function () {
                    if (!this._isElement(this._$element)) return t.superclass.getShape.call(this);
                    var e = this._$element.position();
                    return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                        [e.left, e.top],
                        [e.left + this._$element[0].offsetWidth, e.top + this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight]
                    ]))
                },

                _isElement: function (e) {
                    return e && e[0] && e.find(".arrow")[0]
                }
            }),

            o = ymaps.templateLayoutFactory.createClass(`<div class="placemark"></div>`, {
                build: function () {
                    o.superclass.build.call(this);
                    var e = this.getParentElement().getElementsByClassName("placemark")[0],
                        t = this.isActive ? 60 : 34,
                        c = {
                            type: "Circle",
                            coordinates: [0, 0],
                            radius: t / 2
                        },

                        l = {
                            type: "Circle",
                            coordinates: [0, -30],
                            radius: t / 2
                        };

                    this.getData().options.set("shape", this.isActive ? l : c), document.addEventListener("click", (function (e) {
                        if ((e.target.classList.contains("ymaps-2-1-79-balloon__close-button") || e.target.classList.contains("ymaps-2-1-79-user-selection-none")) && window.innerWidth <= 1003) {
                            var t = document.querySelectorAll(".placemark");
                            for (let e = 0; e < t.length; e++) t[e].classList.remove("active")
                        }
                    })), this.inited || (this.inited = !0, this.isActive = !1, this.getData().geoObject.events.add("click", (function (t) {
                        var o = document.querySelectorAll(".placemark");
                        if (e.classList.contains("active")) e.classList.remove("active");
                        else {
                            for (let e = 0; e < o.length; e++) o[e].classList.remove("active");
                            e.classList.add("active")
                        }
                    }), this))
                }
            });



            allmarks.forEach(mark => {
                const coordinate = {
                    lat: mark.coordinate.split(',')[0],
                    long: mark.coordinate.split(',')[1],
                }
                locationsCity.push({
                    coordinates: [coordinate.lat, coordinate.long],
                    balloonContent: `<div class="balloon-city-w">
                                        <div class="balloon-city" id="${mark.id}">
                                            <div class="balloon-city__text">
                                                <div class="balloon-city__price">${mark.price.EUR}</div>
                                                ${mark.spalni !== null && mark.vannie !== null ? `<div class="balloon-city__rooms">${mark.spalni} ${spal}, ${mark.vanie} ${van}</div>` : ''}
                                                <div class="balloon-city__rooms_m">${mark.kv} ${kvm} <span>|</span> ${mark.spalni} спальни <span>|</span> ${mark.vanie} ванна</div>
                                                <div class="balloon-city__address">${mark.address} Balbey, 431. Sk. No:4, 07040 Muratpaşa</div>
                                                <div class="balloon-city__square">${mark.kv} ${kvm}</div>
                                            </div>
                                            <div class="balloon-city__img"> <img src="${mark.image}"></div>
                                        </div>
                                    </div>`,
                    city_id: mark.id
                });
            });
            let areaForBallon = 250000
            if(window.innerWidth <= 768) areaForBallon = 1000000
            locationsCity.forEach(function (location) {
                var placemark = new ymaps.Placemark(location.coordinates, {
                    balloonContent: location.balloonContent,
                }, {
                    balloonPanelMaxMapArea: areaForBallon,
                    balloonShadow: false,
                    balloonLayout: t,
                    iconLayout: ymaps.templateLayoutFactory.createClass(
                    `<div class="placemark" mark-id="${location.city_id}"></div>`, {
                        build: function () {
                        o.superclass.build.call(this);
                        var e = this.getParentElement().getElementsByClassName("placemark")[0],
                            t = this.isActive ? 60 : 34,
                            c = {
                                type: "Circle",
                                coordinates: [0, 0],
                                radius: t / 2
                            },

                            l = {
                                type: "Circle",
                                coordinates: [0, -30],
                                radius: t / 2
                            };

                        this.getData().options.set("shape", this.isActive ? l : c), document.addEventListener("click", (function (e) {
                            if ((e.target.classList.contains("ymaps-2-1-79-balloon__close-button") || e.target.classList.contains("ymaps-2-1-79-user-selection-none")) && window.innerWidth <= 1003) {
                                var t = document.querySelectorAll(".placemark");
                                for (let e = 0; e < t.length; e++) t[e].classList.remove("active")
                            }
                        })), this.inited || (this.inited = !0, this.isActive = !1, this.getData().geoObject.events.add("click", (function (t) {
                            var o = document.querySelectorAll(".placemark");
                            if (e.classList.contains("active")) e.classList.remove("active");
                            else {
                                for (let e = 0; e < o.length; e++) o[e].classList.remove("active");
                                e.classList.add("active")
                            }
                        }), this))
                    }
                    }),
                    balloonContentLayout: c,
                    hideIconOnBalloonOpen: false,
                    balloonOffset: [-120, -60],
                });

                mapCountry.geoObjects.add(placemark);
                placemark.house_id = location.city_id
                ballons.push(placemark)
                // Добавляем обработчики событий на метку
                placemark.events.add('mouseenter', function (e) {
                    if (userAgent.match(/(android|iphone|ipad|ipod|blackberry|windows phone)/)) return
                    placemark.balloon.open(); // Открываем балун при наведении мыши
                    setTimeout(function () {
                        var balloonContentElement = document.querySelector('.balloon-city');
                        const id = balloonContentElement.getAttribute('id')
                        const marks = document.querySelectorAll(`.placemark`);
                        const mark = document.querySelector(`[mark-id="${id}"]`);
                        if(mark.classList.contains('active')) {
                            mark.classList.remove('active')
                            placemark.balloon.close();
                            return
                        }
                        marks.forEach(mark => {
                            mark.classList.remove('active')
                        });
                        mark.classList.add('active')
                        if (balloonContentElement) {
                            var mouseLeaveListener = function () {
                                placemark.balloon.close();
                                mark.classList.remove('active')
                                balloonContentElement.removeEventListener('mouseleave', mouseLeaveListener);
                                balloonContentElement.removeEventListener('click', clickListener);
                            };
                            balloonContentElement.addEventListener('mouseleave', mouseLeaveListener);

                            var clickListener = function (event) {
                                const id = balloonContentElement.getAttribute('id')
                                //запрос новый на объект
                                getObjectById(id)
                            };
                            balloonContentElement.addEventListener('click', clickListener);
                        }
                    }, 0);
                });
                placemark.events.add('mouseleave', function (e) {
                    const relatedTarget = e.get('domEvent').originalEvent.relatedTarget
                    if(!relatedTarget) {
                        placemark.balloon.close();
                    } else {
                        if(relatedTarget.classList.contains('.ballon-city')) {

                        }
                    }
                })
            });

            let startBounds = mapCountry.getBounds();
            let top_left = {
                lat: startBounds[0][0],
                long: startBounds[0][1]
            };

            let bottom_right = {
                lat: startBounds[1][0],
                long: startBounds[1][1]
            };

            getData(top_left, bottom_right);
            currentCoordinateMapLeft = top_left
            currentCoordinateMapRight = bottom_right
            currentPage = 1
            // let center = [];
            mapCountry.events.add(['zoomchange', 'boundschange'], function (event) {
                let newBounds = event.get('newBounds');

                let top_left = {
                    lat: newBounds[0][0],
                    long: newBounds[0][1]
                };

                let bottom_right = {
                    lat: newBounds[1][0],
                    long: newBounds[1][1]
                };

                getData(top_left, bottom_right);
                currentCoordinateMapLeft = top_left
                currentCoordinateMapRight = bottom_right
                currentPage = 1
                mapCountry.container.fitToViewport()
            });
            mapCountry.events.add('boundschange', function(e){
                if (e.get('newZoom') !== e.get('oldZoom')) {
                }
            })

        }
        let moveWas = 0
        document.querySelector(".city-col__btn-changer") && (document.querySelector(".city-col__btn-changer").onclick = function () {
            this.classList.remove("active");
            document.querySelector(".city-col").classList.remove("active");
            document.querySelector(".map_city__btn-changer").classList.add("active");
            document.querySelector("#map_city").classList.add("show");
            document.querySelector("#map_city").classList.add("map_city_active");
            document.querySelector(".city__content").classList.add("city_map");
            if(!moveWas) {
                var position = mapCountry.getGlobalPixelCenter();
                mapCountry.setGlobalPixelCenter([ position[0] - 1, position[1] ]);
                moveWas = 1
            }
        })
    }

}


            L.length && (k.onclick = function () {
                q.classList.remove("active")
            }), L.length && (A.onclick = function () {
                x.classList.remove("active")
            }), L.length && window.addEventListener("resize", (function (e) {
                window.innerWidth <= 766 && q.classList.contains("active") && (x.classList.add("active"), q.classList.remove("active")), window.innerWidth > 766 && x.classList.contains("active") && (x.classList.remove("active"), q.classList.add("active"))
            })), P(E = window.innerWidth > 1003 ? 0 : 1 / 0), window.addEventListener("resize", (function (e) {
                this.document.querySelectorAll(".city-col__item").length && (window.innerWidth > 1003 && 0 == E && ( P(0), E = 1 / 0), window.innerWidth <= 1003 && E == 1 / 0 && ( P(1 / 0), E = 0))
            }))
        })();


        $(document).ready(function () {
            const currentUrl = window.location.href;
            const url = new URL(currentUrl);
            $('.place__exit').click(function () {

                $(this).closest('.place-w').removeClass('active');
                const placeTopImg = document.querySelector('.place__top-img').querySelector('img')
                const placeLeftCollage = document.querySelector('.place__left-collage')
                placeLeftCollage.innerHtml = ''
                placeTopImg.setAttribute('src', '')
                $('.header-w').removeClass('fixed');
                url.searchParams.delete('object_id');
                // Получение обновленного URL
                var updatedUrl = url.toString();
                // Обновление URL в адресной строке
                window.history.replaceState({}, '', updatedUrl);
            });
        });

    </script>
@endsection

@extends('project.includes.layouts')



@section('header')
    @include('project.includes.header')
@endsection



<style>


</style>



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
                        {{__('Недвижимость')}} {{--{{__('в')}} @if(app()->getLocale() == 'en') <?php $country->name = $country->name_en ?> @elseif(app()->getLocale() == 'tr')<?php $country->name = $country->name_tr ?> @endif{{$country->name}}--}}
                    </div>
                    <div class="city-col__filter">
                        <div class="city-cil__filter-title">{{__('Сначала новые')}}</div>
                        <div class="city-col__filter-list"></div>
                    </div>
                    <div class="city-col__subtitle">

                        <!-- {{$count}} {{__('объявлений')}} -->
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
                        <div class="city-col__list">
                            @foreach($get_product as $product)
                                <!-- <div class="city-col__item" data_id="{{$product->id}}">
                                    <div class="city-col__slider">
                                        <div class="city__swiper swiper">
                                            <div class="city__wrapper swiper-wrapper">
                                                @foreach($product->photo as $photo)
                                                    <div class="city__slide swiper-slide">
                                                        <div class="city-col__item-img">
                                                            <img src="{{asset("uploads/".$photo->photo)}}" alt="place">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="city__scrollbar"></div>
                                        </div>
                                    </div>
                                    <div class="city-col__item-text">
                                        <div class="city-col__item-price">
                                            {{ number_format($product->price, 0, '.', ' ') }} €
                                        </div>
                                        <div class="city-col__item-rooms">
                                            {{$product->size}} {{__('кв.м')}}
                                            <span>|</span> @foreach($product->ProductCategory->where('type', 'Спальни') as $spalni)  {{str_replace('+','',$spalni->category->name) }}  @endforeach
                                            {{__('спальни')}}
                                            <span>|</span> @foreach($product->ProductCategory->where('type', 'Ванные') as $spalni)  {{str_replace('+','',$spalni->category->name) }} @endforeach
                                            {{__('ванна')}}
                                        </div>
                                        <div class="city-col__item-address">
                                            {{$product->address}}
                                        </div>
                                    </div>
                                    <?php  $get = \App\Models\favorite::where('user_id', isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null)->where('product_id', $product->id)->first() ?>
                                    <div class="objects__slide-favorites check-favorites {{ $get == null ? '' : 'active' }}" data_id="{{$product->id}}">
                                        <svg class="blue" xmlns="http://www.w3.org/2000/svg" xml:space="preserve"
                                            width="73px" height="64px" version="1.1"
                                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                            viewBox="0 0 2.33 2.04" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="Слой_x0020_1">
                                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                            <path class="fil0 str0"
                                            d="M1.16 1.88c-0.22,-0.16 -0.5,-0.38 -0.77,-0.65 -0.2,-0.19 -0.26,-0.37 -0.26,-0.55 0,-0.31 0.26,-0.55 0.58,-0.55 0.18,0 0.35,0.08 0.45,0.21 0.11,-0.13 0.28,-0.21 0.46,-0.21 0.32,0 0.58,0.24 0.58,0.55 0,0.18 -0.06,0.36 -0.26,0.55 -0.27,0.27 -0.56,0.49 -0.78,0.65z"></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div> -->
                            @endforeach
                        </div>
                        <div class="place-w">
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
                                                    <img src="{{asset('project/img/svg/logo.svg')}}" alt="logo">
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
                                                        <!-- ID: {{$product->id}} -->
                                                    </div>
                                                    <div class="place__address">
                                                        <!-- {{$product->address}} -->
                                                    </div>
                                                    <div class="place__square">
                                                        <!-- <div class="place__square-EUR">{{ number_format(intval((int)$product->price / ((int)$product->size ?: 1)), 0, '.', ' ') }}  €  / кв.м</div>
                                                        <div class="place__square-USD" style="display: none;">{{ number_format(intval((int)$product->price * $exchanges['USD'] / ((int)$product->size ?: 1)), 0, '.', ' ') }}  $  / кв.м</div>
                                                        <div class="place__square-RUB" style="display: none;">{{ number_format(intval((int)$product->price * $exchanges['RUB'] / ((int)$product->size ?: 1)), 0, '.', ' ') }}  ₽  / кв.м</div>
                                                        <div class="place__square-TRY" style="display: none;">{{ number_format(intval((int)$product->price * $exchanges['TRY'] / ((int)$product->size ?: 1)), 0, '.', ' ') }}  <span class="lira"> ₺ </span>  / кв.м</div> -->
                                                    </div>
                                                </div>
                                                <div class="place__buy">
                                                    <div class="place__buy-btn" data_id="{{$product->id}}">
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
                                                                <!-- <script>
                                                                    product_id_is = <?php echo $product->id?>
                                                                    function createYandexMap(latitude, longitude) {
                                                                        let div_id = 'place-map'+product_id_is.toString();

                                                                        ymaps.ready(function() {
                                                                            let map = new ymaps.Map(div_id, {
                                                                                center: [latitude, longitude],
                                                                                zoom: 10,
                                                                            });
                                                                            let placemark = new ymaps.Placemark([latitude, longitude]);
                                                                            map.geoObjects.add(placemark);
                                                                        });
                                                                    }
                                                                    createYandexMap(<?php echo $product->lat.','.$product->long?>);
                                                                </script> -->
                                                                <div id="place-map" style="width: 100%; height: 165px;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kompleks__layout" bis_skin_checked="1">
                                                        <div class="kompleks__layout-content" bis_skin_checked="1">
                                                            <div class="kompleks__layout-title place__title" bis_skin_checked="1">
                                                                {{__('Планировки квартир')}}
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
                                                            @if(app()->getLocale() == 'en') <?php $product->description = $product->description_en ?> @elseif(app()->getLocale() == 'tr') <?php $product->description = $product->description_tr ?> @endif
                                                            {{$product->description}}
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
                                                                        <img src="{{asset('project/img/svg/logo.svg')}}" alt="logo">
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
                                            <img src="{{asset('uploads/'.$product->photo[0]->photo)}}">
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
                            <div class="city-col__bottom-pages">
                                {{ $get_product->appends(Request::all())->links()}}
                            </div>
                            <div class="city-col__pages_m">
                                {{ $get_product->appends(Request::all())->links()}}

                                {{--                            <div class="city-col__item_m favorites__page-number">--}}

                                {{--                                1--}}

                                {{--                            </div>--}}

                                {{--                            <div class="city-col__item_m favorites__page-from">--}}

                                {{--                                из--}}

                                {{--                            </div>--}}

                                {{--                            <div class="city-col__item_m favorites__page-number">--}}

                                {{--                                30--}}

                                {{--                            </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="city-col__foooter">
                        <div class="footer-w">
                            <footer class="footer footer_col">
                                <div class="footer__top">
                                    <a href="{{route('home_page')}}" class="footer__logo">
                                        <img src="{{asset('project/img/svg/logo.svg')}}" alt="logo">
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
        .object__photo {
            display: none;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 165;
        }

        .object__photo.active {
            display: block;
        }

        .object__photo:before {
            content: "";
            background: #000;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            opacity: 0.7;
            z-index: 199;
        }

        .object__photo-popup {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 53px;
            min-height: 100%;
        }

        .object__photo-popup-block {
            width: 100%;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 201;
            opacity: 1;
        }

        .object__photo-popup img {
            position: relative;
            max-width: 1348px;
            margin: 0 auto;
            z-index: 202;
            opacity: 1;
            width: 100%;
        }

        .object__photo-popup-close {
            position: absolute;
            top: 20px;
            right: 5px;
            width: 26px;
            height: 26px;
            z-index: 203;
            cursor: pointer;
            color: #fff;
        }

        @media (max-width: 1364px) {
            .object__photo-popup-close {
                right: 15px;
            }
        }


        .object__photo-popup-close svg {
            z-index: 204;
        }
    </style>
    <section class="object__photo">
        <div class="object__photo-popup">
            <div class="object__photo-popup-block">
                <img src="" alt="Картинка">
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
        // Сортировка

        if ($.query.get('order_by').toString() === "price-desc") {
            $('.city-cil__filter-title').text("Сначала дешёвые");
        }

        if ($.query.get('order_by').toString() === "price-asc") {
            $('.city-cil__filter-title').text("Сначала дорогие");
        }

        if ($.query.get('order_by').toString() === "created_at-desc") {
            $('.city-cil__filter-title').text("Сначала новые");
        }

        if ($.query.get('ot_zastroishika') === "false" || $.query.get('ot_zastroishika') === true) {
            $('.city-col__all').addClass("active");
        } else {
            $('.city-col__btn:not(.city-col__all)').addClass("active");
        }

        $('.city-col__filter-list').append('<div class="city-col__filter-item '+(($.query.get('order_by').toString() === "price-desc") ? 'active' : '')+'" data_id="price-desc">Сначала дешёвые</div>');
        $('.city-col__filter-list').append('<div class="city-col__filter-item '+(($.query.get('order_by').toString() === "price-asc") ? 'active' : '')+'" data_id="price-asc">Сначала дорогие</div>');
        $('.city-col__filter-list').append('<div class="city-col__filter-item '+(($.query.get('order_by').toString() === "created_at-desc") ? 'active' : '')+'" data_id="created_at-desc">Сначала новые</div>');

        $('.city-col__filter-item').on('click', function() {
            var value = $(this).attr('data_id');
            var text = $(this).text();

            console.log('text = '+text);
            console.log('value = '+value);

            $('.city-cil__filter-title').text(text);
            history.pushState(null, null, $.query.SET('order_by', value)); // подстановка параметров
        });

        let g = document.querySelectorAll(".kompleks__layout-img"),
            b = document.querySelectorAll(".object__photo");

        g.forEach((item, index) => {
            item.addEventListener('click', () => {
                b[0].classList.add("active");
                console.log(item.dataset.productid);
                console.log(b[0]);
                b[0].childNodes[1].childNodes[1].childNodes[1].src = item.childNodes[1].src;
            })
        })

        document.querySelector('.object__photo-popup-close').addEventListener('click', () => {
            document.querySelector('.object__photo').classList.remove("active");
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

        let queryParams = <?php echo json_encode(request()->all()) ?>;

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');



        (async () => {

            function e(e) {
                for (let t = 0; t < e.length; t++) e[t].classList.remove("active");
                e = 0
            }

            window.addEventListener("resize", (function (e) {
                window.innerWidth > 1199 && (document.querySelector(".header-m").classList.remove("active"), document.querySelector("#nav-icon").classList.remove("open"), document.querySelector(".header-w").classList.remove("fixed")), document.querySelectorAll(".search-nav-w").length && (window.innerWidth > 899 && !document.querySelector(".search-nav__more-dropdown").classList.contains("active") && (document.querySelector(".search-w").classList.remove("active"), document.querySelector(".search-nav__more").classList.remove("active")), window.innerWidth <= 899 && (document.querySelector(".search-nav__more-dropdown").classList.remove("active"), document.querySelector(".search-nav__more").classList.remove("active"), document.querySelector(".search-nav__price-dropdown").classList.remove("active"), document.querySelector(".search-nav__price").classList.remove("active"), document.querySelector(".search-nav__types-dropdown").classList.remove("active"), document.querySelector(".search-nav__types").classList.remove("active")), window.innerWidth <= 1199 && (document.querySelector(".search-nav__rooms-dropdown").classList.remove("active"), document.querySelector(".search-nav__rooms").classList.remove("active"))), document.querySelectorAll(".place-w").length && (window.innerWidth <= 1023 && document.querySelector(".place-w").classList.contains("active") && document.querySelector(".header-w").classList.add("fixed"), window.innerWidth <= 540 && (document.querySelector(".place__currency-preview-item").textContent = "$"), window.innerWidth > 540 && (document.querySelector(".place__currency-preview-item").textContent = "Валюта"))
            })), document.querySelectorAll(".place-w").length && window.innerWidth <= 540 && (document.querySelector(".place__currency-preview-item").textContent = "$"), window.addEventListener("resize", (function (e) {
                document.querySelectorAll("#map_city").length && (window.innerWidth > 1003 && document.querySelector(".city__content").classList.remove("city_map"), window.innerWidth <= 1003 && (document.querySelector("#map_city").style.height = "100%"), window.innerWidth > 1003 && (document.querySelector(".city-col").classList.add("active"), document.querySelector(".map_city__btn-changer").classList.remove("active"), document.querySelector(".city-col__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.remove("map_city_active"), document.querySelector(".city__content").classList.remove("city_map")), window.innerWidth > 1199 && (document.querySelector("#map_city").style.height = window.innerHeight - 18 - 161 + "px"), window.innerWidth <= 1199 && window.innerWidth > 1003 && (document.querySelector("#map_city").style.height = window.innerHeight - 88 - 60 + "px"))
            })), document.querySelector(".header__top-lang").onclick = function () {
                document.querySelector(".header__top-lang-item").classList.toggle("active"), document.querySelector(".header__lang-list-dropdown").classList.toggle("active")
            }, document.querySelector(".header__nav-buy").onclick = function () {
                this.classList.toggle("active"), document.querySelector(".header__buy-dropdown").classList.toggle("active")
            }, document.querySelector(".header__nav-about").onclick = function () {
                this.classList.toggle("active"), document.querySelector(".header__about-dropdown").classList.toggle("active")
            }, document.querySelector(".header__top-phone-menu").onclick = function () {
                document.querySelector(".header-m").classList.toggle("active"), document.querySelector("#nav-icon").classList.toggle("open"), document.querySelector(".header-w").classList.add("fixed"), document.querySelector(".header-m").classList.contains("active") || document.querySelector(".place-w").classList.contains("active") || document.querySelector(".header-w").classList.remove("fixed")
            }, document.querySelector(".header-m__aboute").onclick = function () {
                this.classList.toggle("active"), document.querySelector(".header-m__aboute-list").classList.toggle("active")
            }, document.querySelector(".header-m__buy").onclick = function () {
                this.classList.toggle("active")
            };

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
            }), new Swiper(".objects__swiper", {
                slidesPerView: 4,
                spaceBetween: 20,
                pagination: {
                    el: ".objects__pagination",
                    clickable: !0
                },
                navigation: {
                    nextEl: ".objects__prev",
                    prevEl: ".objects__next"
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    900: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                    1199: {
                        slidesPerView: 4,
                        spaceBetween: 20
                    }
                }
            }), new Swiper(".city__swiper", {
                slidesPerView: 1,
                scrollbar: {
                    el: ".city__scrollbar",
                    hide: !0
                }
            }), document.querySelectorAll(".search-nav__rooms-title").length && (document.querySelector(".search-nav__rooms-title").onclick = function () {
                document.querySelector(".search-nav__rooms").classList.toggle("active"), document.querySelector(".search-nav__rooms-dropdown").classList.toggle("active")
            }), document.querySelectorAll(".search-nav__more-title").length && (document.querySelector(".search-nav__more-title").onclick = function () {
                window.innerWidth > 899 && (document.querySelector(".search-nav__more").classList.toggle("active"), document.querySelector(".search-nav__more-dropdown").classList.toggle("active")), window.innerWidth <= 899 && document.querySelector(".search-w").classList.toggle("active")
            }), document.querySelectorAll(".search-w__close").length && (document.querySelector(".search-w__close").onclick = function () {
                window.innerWidth <= 899 && document.querySelector(".search-w").classList.remove("active")
            });

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

            document.querySelectorAll(".search-nav__types-title").length && (document.querySelector(".search-nav__types-title").onclick = function () {

                document.querySelector(".search-nav__types").classList.toggle("active"), document.querySelector(".search-nav__types-dropdown").classList.toggle("active")

            }), document.querySelectorAll(".search-nav__price-title").length && (document.querySelector(".search-nav__price-title").onclick = function () {

                document.querySelector(".search-nav__price").classList.toggle("active"), document.querySelector(".search-nav__price-dropdown").classList.toggle("active")

            });


// let r = document.querySelectorAll(".search-nav__price-currency-item");

// for (let t = 0; t < s.length; t++) r[t].addEventListener("click", (function (o) {

//     e(r), r[t].classList.add("active")

// }));

//

            let d = document.querySelectorAll(".search-nav__list-item-title"),

                u = document.querySelectorAll(".search-nav__item-dropdown");


            function m() {

                for (let e = 0; e < u.length - 1; e++) u[e].style.zIndex = 5

            }


            for (let e = 0; e < d.length - 1; e++) d[e].addEventListener("click", (function (t) {

                let navItem = d[e].closest('.search-nav__list-item')

                let navItemDropdown = navItem.querySelector('.search-nav__item-dropdown')

                if (navItem.classList.contains('active')) {

                    navItem.classList.remove('active')

                    navItemDropdown.classList.remove('active')

                }

                m(), u[e].style.zIndex = 6

            }));

            document.querySelectorAll(".search-nav__price-title").length && (document.querySelector(".search-nav__price-title").onclick = function () {

                document.querySelector(".search-nav__price").classList.toggle("active"), document.querySelector(".search-nav__price-dropdown").classList.toggle("active")

            }), document.querySelector(".city-col__filter") && (document.querySelector(".city-col__filter").onclick = function () {

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

            let p = document.querySelectorAll(".city-col__btn");
            for (let t = 0; t < p.length; t++) p[t].addEventListener("click", (function (o) {
                console.log(p[t].getAttribute('data_id'));
                var ot_zastroishika = p[t].getAttribute('data_id');
                e(p), p[t].classList.add("active");
                history.pushState(null, null, $.query.SET('ot_zastroishika', ot_zastroishika)); // подстановка параметров
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

                 P(1 / 0), C.container.fitToViewport(), this.classList.remove("active"), document.querySelector(".city-col").classList.remove("active"), document.querySelector(".map_city__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.add("map_city_active"), document.querySelector(".city__content").classList.add("city_map")

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
            }),
            new Swiper(".scheme__swiper", {
                slidesPerView: 1,
                navigation: {
                    nextEl: ".scheme__prev",
                    prevEl: ".scheme__next"
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1
                    },
                    540: {
                        slidesPerView: 2
                    },
                    767: {
                        slidesPerView: 1
                    }
                }
            });

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



            // if (L.length)
            //     for (let e = 0; e < L.length; e++) L[e].addEventListener("click", (function (event) {
            //         const target = event.target
            //         const placeW = target.closest('.place-w')
            //         const id = placeW.getAttribute('data_id')
            //         const placeCollage = document.querySelector('.place-popup-collage[data_id="' + id + '"]');
            //         console.log(placeCollage)
            //         placeCollage.classList.add("active")
            //     }));

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
function P(e) {

    let mapCountry;
    var script;
    var head = document.getElementsByTagName('head')[0];

    let site_url = `{{config('app.url')}}`;
    let locationsCity = [];
    let houseData = {}
    let user_id = {{ isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : time() }}

    const langSite = `{{ app()->getLocale() }}`

    async function getData(topLeft, bottomRight) {
        const queryParams = {
            user_id: user_id,
            top_left: topLeft,
            bottom_right: bottomRight,
            price: $.query.get('price'),
            vanie: $.query.get('vanie'),
            spalni: $.query.get('spalni'),
            kv: $.query.get('kv'),
            address: $.query.get('address'),
        };

        console.log("Отправленные параметры:", queryParams);

            $.ajax({
                url: `/api/houses/by_coordinates/with_filter`,
                method: 'GET',
                dataType: 'json',
                data: {
                    user_id: user_id,
                    top_left: topLeft,
                    bottom_right: bottomRight,
                    price: $.query.get('price'),
                    vanie: $.query.get('vanie'),
                    spalni: $.query.get('spalni'),
                    kv: $.query.get('kv'),
                    address: $.query.get('address'),
                },
                success: function (data) {
                    console.log('data',data);
                    locationsCity.length = 0;
                    houseData.length = 0;
                    houseData = { ...data }
                    checkFavorites(data.data)
                    let site_url = `{{config('app.url')}}`;

                    // setBallons(data.data);

                    setCityItem(data.data);
                    setCountObjectsPerPage(data.data.length)
                    setListenersToOpenPopup();
                    setListenersToAddfavorites()
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
    }

    async function getDataMarks() {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: `/api/houses/all`,
                method: 'GET',
                dataType: 'json',
                data: {
                },
                success: function (data) {
                    resolve(data);
                    console.log(data);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        })
    }

    //отправить запрос с фильтром по кнопке найти страница houses
    if(document.querySelectorAll('.btn-filter-houses').length) {
        const btnFilterHouses = document.querySelector('.btn-filter-houses')
        btnFilterHouses.addEventListener('click', function() {
            getDataMarks()
        })
    }

    let previousSwiperInstance = null;
    let ballons = []
    const dictionary = {
        rooms_bedroom: {
            ru: 'спальни',
            en: 'bedrooms',
            tr: 'yatak odaları',
        },
        rooms_bathroom: {
            ru: 'ванные',
            en: 'bathrooms',
            tr: 'banyolar',
        },
        square_m: {
            ru: 'кв.м.',
            en: 'sq.m.',
            tr: 'metrekare',
        }
    }
    function setCityItem(data) {
        const cityList = document.querySelector('.city-col__list')
        cityList.innerHTML = ''

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

            cityElement.photo.forEach(photo => {
                const slideDiv = document.createElement('div');
                slideDiv.classList.add('city__slide', 'swiper-slide');

                const imgDiv = document.createElement('div');
                imgDiv.classList.add('city-col__item-img');

                const img = document.createElement('img');
                img.setAttribute('src', `${site_url}uploads/${photo.photo}`);
                img.setAttribute('alt', 'place');
                imgDiv.appendChild(img);

                slideDiv.appendChild(imgDiv);
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
            priceDiv.textContent = `${cityElement.price.EUR}`;
            textDiv.appendChild(priceDiv);

            //комнаты в карточке превью
            const roomsDiv = document.createElement('div');
            roomsDiv.classList.add('city-col__item-rooms');

            const spalni = cityElement.spalni
            const vannie = cityElement.vanie


            roomsDiv.innerHTML = `${cityElement.size} кв.м`
            if (spalni && spalni.length > 0) {
                roomsDiv.innerHTML += `<span>|</span> ${spalni.replace('+', '')} ${dictionary.rooms_bedroom[langSite]}`;
            }

            if (vannie && vannie.length > 0) {
                roomsDiv.innerHTML += `<span>|</span> ${vannie.replace('+', '')} ${dictionary.rooms_bathroom[langSite]}`;
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
                });
                currentBallon.balloon.open();
                // setTimeout(() => {
                //     let balloonContentElement = document.querySelector('.balloon-city');
                //     balloonContentElement.addEventListener('click', function () {
                //         setNewPopupHouseData(id)
                //     });
                // }, 0);
            })
            cityItem.addEventListener('mouseout', function() {
                mapCountry.balloon.close()
            })
        });
        previousSwiperInstance = new Swiper(".city__swiper", {
            slidesPerView: 1,
            scrollbar: {
                el: ".city__scrollbar",
                hide: true
            }
        });
    }

    function setCountObjectsPerPage(number) {
        const subtitle = document.querySelector('.city-col__subtitle')
        const span = subtitle.querySelector('span')
        span.innerHTML = number
    }

    function setListenersToOpenPopup() {
        const houseItem = document.querySelectorAll('.city-col__item')
        houseItem.forEach(houseCard => {
            houseCard.addEventListener('click', function(e) {
                const id = houseCard.getAttribute('data_id')
                setNewPopupHouseData(id)
            })
        });
    }

    let placeMap = null;
    function setNewPopupHouseData(id) {
        id = parseInt(id)
        const dataExchange = document.querySelector('.place-popup').getAttribute('data-exchange')
        const placeW = document.querySelector('.place-w')
        placeW.classList.add('active')

        let currentHouse = houseData.data.find(obj => obj.id == id);

        const topPic = placeW.querySelector('.place__left-top').querySelector('img')
        topPic.setAttribute('src',`${site_url}uploads/${currentHouse.photo[0].photo}`)

        const leftCollage = placeW.querySelector('.place__left-collage')

        leftCollage.innerHTML = ''
        currentHouse.photo.forEach((photo, index) => {
            if(index === 0) return

            let div = document.createElement('div')
            div.classList.add('place__collage-item', 'place__collage-item_clickable')

            let img = document.createElement('img')
            img.setAttribute('src', `${site_url}uploads/${photo.photo}`)

            div.appendChild(img)
            leftCollage.appendChild(div)
        });


        const placeTopFavorites = document.querySelector('.place__top-favorites')
        const placeHeaderFavorites = document.querySelector('.place__header-favorite')

        placeTopFavorites.setAttribute('data_id', id)
        placeHeaderFavorites.setAttribute('data_id', id)

        if(favotires_house_id.hasOwnProperty(id)) {
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
        Object.keys(currentHouse.price).forEach(function(currencyCode, price) {
            const currencyCodePrice = document.querySelector(`.place__exchange-${currencyCode}`)
            const spanPriceBlock = currencyCodePrice.querySelector('span')
            const bPriceBlock = currencyCodePrice.querySelector('b')


            let currentPrice = currentHouse.price[currencyCode];
            const valuteSymbol = currentPrice[currentPrice.length - 1];
            currentPrice = currentPrice.slice(0, -1);


            spanPriceBlock.innerHTML = currentPrice
            bPriceBlock.innerHTML = valuteSymbol
        })



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
        const div_id = 'place-map'
        if (placeMap) {
            placeMap.destroy(); // Уничтожаем текущую карту, если она существует
        }
        ymaps.ready(function() {
            placeMap = new ymaps.Map(div_id, {
                center: [currentHouse.lat, currentHouse.long],
                zoom: 10,
            });
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

        // планировки квартир
        const kompleksLayoutList = document.querySelector('.kompleks__layout-list')
        kompleksLayoutList.innerHTML = ''

        const kompleks__layout = document.querySelector('.kompleks__layout')
        kompleks__layout.style.display = 'none'
        const objects = JSON.parse(currentHouse.objects)

        if(currentHouse.objects !== null && currentHouse.objects !== '[]')
        if(objects.length !== 0) {

            kompleks__layout.style.display = 'block'

            objects.forEach((object, index) => {
                let divItem = document.createElement('div')
                divItem.classList.add('kompleks__layout-item')

                let divInfo = document.createElement('div')
                divInfo.classList.add('kompleks__layout-info')

                let divOption = document.createElement('div')
                divOption.classList.add('kompleks__layout-option')
                divOption.innerHTML = `${object.building} ${object.apartment_layout}`
                divInfo.appendChild(divOption)

                let divPrice = document.createElement('div')
                divPrice.classList.add('kompleks__layout-price')


                Object.entries(object.price).forEach(function([currencyCode, currencyPrice]) {
                    let span = document.createElement('span')
                    span.setAttribute('data-exchange', currencyCode)
                    span.classList.add('valute')
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
                    span.innerHTML = `${((currencyPrice))} ${kvm}`

                    if(currencyCode === dataExchange) {
                        span.classList.add('active')
                    }

                    divMeter.appendChild(span)

                })
                divInfo.appendChild(divMeter)

                let divSquare = document.createElement('div')
                divSquare.classList.add('kompleks__layout-square')
                divSquare.innerHTML = `${object.size} <span>|</span> ${object.apartment_layout}`
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
                    const chemePopup = document.querySelector(".object__photo");
                    const img = chemePopup.querySelector('img')
                    img.setAttribute('src', `${site_url}uploads/${object.apartment_layout_image}`)
                    chemePopup.classList.add('active')
                })


                let divChemeImg = document.createElement('img')
                divChemeImg.setAttribute('src', `${site_url}uploads/${object.apartment_layout_image}`)

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
        img.setAttribute('src', `${site_url}uploads/${house.photo[0].photo}`)

        topPic.appendChild(img)

        const collageList = collage.querySelector('.place-popup-collage__list')
        collageList.innerHTML = ''
        house.photo.forEach((element,index) => {
            if(index === 0 ) return
            const collageListItem = collage.querySelector('.place-popup-collage__item')

            const div = document.createElement('div')
            div.classList.add('place-popup-collage__item')

            const img = document.createElement('img')
            img.setAttribute('src', `${site_url}uploads/${element.photo}`)

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
            img.setAttribute('src', `${site_url}uploads/${images[i].photo}`)

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
                    <div class="balloon-city__img"> <img src="${site_url}uploads/${city.photo[0].photo}"></div>
                </div>`,
                city_id: city.id
            });
        });
        locationsCity.forEach(function (location) {
            var placemark = new ymaps.Placemark(location.coordinates, {
                balloonContent: location.balloonContent
            }, {
                balloonPanelMaxMapArea: 250000,
                balloonShadow: false,
                balloonLayout: t,
                iconLayout: o,
                balloonContentLayout: c,
                hideIconOnBalloonOpen: false,
                balloonOffset: [-110, -50]
            });
            mapCountry.geoObjects.add(placemark);

            placemark.events.add('mouseenter', function (e) {
                placemark.balloon.open(); // Открываем балун при наведении мыши
                setTimeout(function () {
                    var balloonContentElement = document.querySelector('.balloon-city');

                    // document.querySelector('.ballon-city__content').addEventListener('click', function() {
                    //     var city_id = document.querySelector('.balloon-city').id;
                    //     console.log(city_id);
                    //     document.getElementById(`card_object-${city_id}`).scrollIntoView();
                    // });
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
    changeLangMap(mapLang);

    async function init(ymaps) {
        const mapCity = document.querySelector('#map_city')
        mapCity.innerHTML = ''
        if(mapCountry) {
            mapCountry.destroy()
        }
        mapCountry = new ymaps.Map("map_city", {
            center: [<?php echo $country->lat . ',' . $country->long ?>],
            zoom: 6,
            controls: [],
            behaviors: ["default", "scrollZoom"]
        }, {
            searchControlProvider: "yandex#search"
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

        o = ymaps.templateLayoutFactory.createClass('<div class="placemark"></div>', {
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


        let allmarks = await getDataMarks();

        allmarks.forEach(mark => {
            const coordinate = {
                lat: mark.coordinate.split(',')[0],
                long: mark.coordinate.split(',')[1],
            }
            locationsCity.push({
                coordinates: [coordinate.lat, coordinate.long],
                balloonContent: `<div class="balloon-city" id="${mark.id}">
                                    <div class="balloon-city__text">
                                        <div class="balloon-city__price">${mark.price.EUR}</div>
                                        ${mark.spalni !== null && mark.vannie !== null ? `<div class="balloon-city__rooms">${mark.spalni} ${spal}, ${mark.vanie} ${van}</div>` : ''}
                                        <div class="balloon-city__rooms_m">${mark.kv} ${kvm} <span>|</span> ${mark.spalni} спальни <span>|</span> ${mark.vanie} ванна</div>
                                        <div class="balloon-city__address">${mark.address} Balbey, 431. Sk. No:4, 07040 Muratpaşa</div>
                                        <div class="balloon-city__square">${mark.kv} ${kvm}</div>
                                    </div>
                                    <div class="balloon-city__img"> <img src="${mark.image}"></div>
                                </div>`,
                city_id: mark.id
            });
        });

        locationsCity.forEach(function (location) {
            var placemark = new ymaps.Placemark(location.coordinates, {
                balloonContent: location.balloonContent,
            }, {
                balloonPanelMaxMapArea: 250000,
                balloonShadow: false,
                balloonLayout: t,
                iconLayout: o,
                balloonContentLayout: c,
                hideIconOnBalloonOpen: false,
                balloonOffset: [-110, -50]
            });

            mapCountry.geoObjects.add(placemark);
            placemark.house_id = location.city_id
            ballons.push(placemark)
            // Добавляем обработчики событий на метку
            placemark.events.add('mouseenter', function (e) {
                placemark.balloon.open(); // Открываем балун при наведении мыши
                setTimeout(function () {
                    var balloonContentElement = document.querySelector('.balloon-city');
                    if (balloonContentElement) {
                        var mouseLeaveListener = function () {
                            placemark.balloon.close();
                            balloonContentElement.removeEventListener('mouseleave', mouseLeaveListener);
                            balloonContentElement.removeEventListener('click', clickListener);
                        };
                        balloonContentElement.addEventListener('mouseleave', mouseLeaveListener);

                        var clickListener = function (event) {
                            const id = balloonContentElement.getAttribute('id')
                                setNewPopupHouseData(id)
                            // setListenersToOpenPopup();
                            // setListenersToAddfavorites()
                        };
                        balloonContentElement.addEventListener('click', clickListener);
                    }
                }, 0);
            });

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
        console.log('top_left.lat = '+top_left.lat+'\ntop_left.long = '+top_left.long);
        console.log('bottom_right.lat = '+bottom_right.lat+'\ntop_left.long = '+bottom_right.long);

        getData(top_left, bottom_right);


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

        });

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

            $('.place__exit').click(function () {

                $(this).closest('.place-w').removeClass('active');
                $('.header-w').removeClass('fixed');

            });


        });
    </script>
@endsection

<script src="https://api-maps.yandex.ru/2.1/?lang={{ app()->getLocale() }}_RU&amp;apikey=2a0f0e9d-44f3-4f13-8628-12588d752fc3" type="text/javascript"></script>

@extends('project.includes.layouts')
@section('header')
    @include('project.includes.header')
@endsection
@section('content')
    <section class="favorites">
        <div class="favorites__title">
            {{__('Избранное')}}
        </div>
        <div class="favorites__subtitle">
       <span class="count">   {{\App\Models\favorite::where('user_id', isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null)->count()}}</span>      {{__('Объявления')}}
        </div>
        <div class="favorites__content">
            @if(isset($get_product->product))
            <div class="favorites__content-top container">
                <div class="favorites__top-buttons">
                    <div class="favorites__top-filter">
                        <div class="favorites__top-filter-preview">
                            @if(isset($_GET['order_by']))
                                @if($_GET['order_by'] == 'price_asc')
                                    {{__('Сначала дешевые')}}
                                    @elseif($_GET['order_by'] == 'price_desc')
                                    {{__('Сначала дорогие')}}
                                    @elseif($_GET['order_by'] == 'id_desc')
                                    {{__('Сначала новые')}}
                                    @endif
                                @else
                                {{__('Сначала дешевые')}}
                            @endif
                        </div>
                        <div class="favorites__top-filter-list">
                            <div class="favorites__top-filter-item">
                                <form action="{{route('my_favorites')}}" >
                                    <input type="hidden" name="order_by" value="price_asc">
                              <button>{{__('Сначала дешевые')}}</button>
                                </form>
                            </div>
                            <div class="favorites__top-filter-item">
                                <form action="{{route('my_favorites')}}">
                                    <input type="hidden" name="order_by"  value="price_desc">
                             <button>{{__('Сначала дорогие')}}</button>
                                </form>
                            </div>
                            <form action="{{route('my_favorites')}}">
                                <input type="hidden" name="order_by"  value="id_desc">
                           <button><div class="favorites__top-filter-item">
                                {{__('Сначала новые')}}
                            </div>
                           </button>
                            </form>
                        </div>
                    </div>
                    <a href="{{route('delete_my_all_favorite')}}"><div class="favorites__top-delete">
                       {{__('Удалить все')}}
                    </div>
                    </a>
                </div>
            </div>
            @endif
            <div class="favorites__list">
                @foreach($get_product as $product)
                    @if(isset($product->product->photo[0]->photo))
                <div class="favorites__list-item open-place-popup" data_id="{{$product->product->id}}">
                    <div class="favorites__item-img">
                        <img src="{{asset('uploads/'.$product->product->photo[0]->photo)}}" alt="place">
                    </div>
                    <div class="favorites__item-text">
                        <div class="favorites__item-price">
                            @if (!is_null(json_decode($product->product->objects)) && !empty(json_decode($product->product->objects)))
                                @if (isset($product->product->min_price["EUR"]))
                                    @php
                                    $euroPrice = str_replace(' €', '', $product->product->min_price["EUR"]);
                                    @endphp
                                    @if (count(json_decode($product->product->objects)) > 1)
                                        {{ "€ " . $euroPrice . " +" }}
                                    @else
                                        {{ "€ " . $euroPrice }}
                                    @endif
                                @else
                                    {{ "€ " . str_replace(' €', '', $product->product->price["EUR"]) }}
                                @endif
                            @endif
                        </div>
                        <div class="favorites__item-rooms">
                            @if(!is_null(json_decode($product->product->objects)) && count(json_decode($product->product->objects)) > 0 && $product->product->layouts !== "" && $product->product->layouts !== " " && !is_null($product->product->layouts))
                                {{ $product->product->layouts }}
                            @else
                                <?php $category_spalni =  $product->product->ProductCategory->where('type', 'Спальни')?>
                                <?php $category_vannie =  $product->product->ProductCategory->where('type', 'Ванные')?>

                                {{ $product->product->size }} {{__('кв.м')}}<span>|</span>    @foreach($category_spalni as $spalni)
                                    {{__($spalni->category->name )}}
                                @endforeach{{__('Спальни')}} <span>|</span> @foreach($category_vannie as $spalni)  {{__($spalni->category->name)}}

                                @endforeach {{__('Ванна')}}
                            @endif
                        </div>
                        <div class="favorites__item-address">
                           {{$product->product->address}}
                        </div>
                    </div>
                    <div class="favorites__item-exit" data_id="{{$product->product_id}}">
                        <img src="{{asset('project/img/svg/exit_w.svg')}}" alt="exit">
                    </div>
                </div>
                    @endif
                @endforeach
            </div>
            <div class="favorites__bottom container">
                <div class="favorites__bottom-buttons">
{{--                    <div class="favorites__pages-prev">--}}
{{--                        <img src="{{asset('project/img/prev.png')}}" alt="prev-btn">--}}
{{--                        <img src="{{asset('project/img/next.png')}}" alt="prev-btn">--}}
{{--                    </div>--}}
                    <style>

                        .page-item{

                            margin: 0 5px;

                        }

                        .pagination{

                            display: flex;

                            justify-content: space-between;

                            margin: 0 35px;

                        }

                        .page-link{

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

                        .active > span{

                            color: #fff;

                            border: none;

                            background: #508cfa;

                        }
                        </style>
                    <div class="favorites__bottom-pages">
                        {{ $get_product->appends(Request::all())->links()}}
                    </div>
                    <div class="favorites__bottom-pages_m">
                        {{ $get_product->appends(Request::all())->links()}}
                    </div>
{{--                    <div class="favorites__pages-next active">--}}
{{--                        <img src="{{asset('project/img/prev.png')}}" alt="prev-btn">--}}
{{--                        <img src="{{asset('project/img/next.png')}}" alt="next-btn">--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </section>
    <section class="popuuups">
@foreach($get_product as $product)
<div class="place-w" data_id="{{$product->product->id}}">

    <div class="place-popup">

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

                    <div class="place__header-favorite">

                        <div class="place__header-favorites-text">

                            {{__('В избранное')}}


                        </div>

                        <div class="place__header-favorites-logo">

                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve"

                                version="1.1"

                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"

                                viewBox="0 0 2.14 1.86"

                                xmlns:xlink="http://www.w3.org/1999/xlink">

    <g id="Слой_x0020_1">

    <metadata id="CorelCorpID_0Corel-Layer"/>

    <path class="fil0 str0"

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
                                <img src="{{asset('uploads/'.$product->product->photo[0]->photo)}}" alt="object">
                            </div>
                        </div>
                        <div class="place__left-collage">
                            @foreach($product->product->photo->where('id','!=',$product->product->photo[0]->id) as $photo)
                            <div class="place__collage-item place__collage-item_clickable">
                                <img src="{{asset('uploads/'.$photo->photo)}}" alt="object">
                            </div>
                                @endforeach
                        </div>
                    </div>
                    <div class="place__slider">
                        <div class="place__swiper swiper">
                            <div class="place__wrapper swiper-wrapper">
                                @foreach($product->product->photo as $photo)
                                <div class="place__slide swiper-slide place__slide_clickable open-collage">
                                    <img src="{{asset('uploads/'.$photo->photo)}}" alt="object">
                                </div>
                                @endforeach
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

                        <?php  $get_product = \App\Models\favorite::where('user_id', isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null)->where('product_id', $product->product->id)->first() ?>
                        <div class="place__top-favorites check-favorites {{ $get_product == null ? '' : 'active' }}" data_id="{{$product->product->id}}">

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
        <path

            d="M1.07 1.76c-0.21,-0.16 -0.48,-0.37 -0.74,-0.62 -0.2,-0.19 -0.25,-0.36 -0.25,-0.54 0,-0.29 0.25,-0.52 0.55,-0.52 0.18,0 0.34,0.08 0.44,0.2 0.1,-0.12 0.26,-0.2 0.44,-0.2 0.31,0 0.56,0.23 0.56,0.52 0,0.18 -0.06,0.35 -0.25,0.54 -0.26,0.25 -0.54,0.46 -0.75,0.62z"/>

    </g>

    </svg>

                            </div>

                        </div>

                    </div>
                    <div class="place__right-mid">
                        <div class="place__info">
                            <div class="place__price place__price_country">
                                @if (!is_null(json_decode($product->product->objects)) && !empty(json_decode($product->product->objects)) && isset($product->product->min_price) && count(json_decode($product->product->objects)) > 1)
                                    <div
                                        class="place__price-value lira"
                                        data-price-rub="{{ __("от") . " " . $product->product->min_price["RUB"] }}"
                                        data-price-eur="{{ __("от") . " " . $product->product->min_price["EUR"] }}"
                                        data-price-usd="{{ __("от") . " " . $product->product->min_price["USD"] }}"
                                        data-price-try="{{ __("от") . " " . $product->product->min_price["TRY"] }}"
                                    >
                                        {{ __("от") . " " . $product->product->min_price["EUR"] }}
                                @else
                                    <div
                                        class="place__price-value lira"
                                        data-price-rub="{{ $product->product->price["RUB"] }}"
                                        data-price-eur="{{ $product->product->price["EUR"] }}"
                                        data-price-usd="{{ $product->product->price["USD"] }}"
                                        data-price-try="{{ $product->product->price["TRY"] }}"
                                    >
                                        {{ $product->product->price["EUR"] }}
                                @endif
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
                                                <div class="place__currency-item" data-exchange="eur">
                                                    €
                                                </div>
                                                <div class="place__currency-item" data-exchange="usd">
                                                    $
                                                </div>
                                                <div class="place__currency-item" data-exchange="rub">
                                                    ₽
                                                </div>
                                                <div class="place__currency-item" data-exchange="try">
                                        <span class="lira">
                                            ₺
                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="object__id">
                                    ID: {{$product->id}}
                                </div>
                                <div class="place__address">
                                    {{$product->address}}
                                    {{--                                                            Balbey, 431. Sk. No:4, 07040 Muratpaşa--}}
                                </div>
                                <div class="place__square place__square_country lira"
                                     data-price-rub="{{ $product->product->price_size["RUB"] }}"
                                     data-price-eur="{{ $product->product->price_size["EUR"] }}"
                                     data-price-usd="{{ $product->product->price_size["USD"] }}"
                                     data-price-try="{{ $product->product->price_size["TRY"] }}"
                                >
                                    {{ $product->product->price_size["EUR"] }}
                                </div>
                            </div>

                        <div class="place__buy">

                            <div class="place__buy-btn" data_id="{{$product->product->id}}">

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

                                @if($product->product->vnj == 'Да')

                                <div class="place__advantages-item">



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

                                @endif

                                    @if($product->product->cryptocurrency == 'Да')

                                <div class="place__advantages-item">

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

                                    @endif

                                    @if($product->product->commissions == 'Да')

                                <div class="place__advantages-item">

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

                                    @endif

                                    @if($product->product->parking == 'Да')

                                <div class="place__advantages-item">

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

                                        @endif

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
                        @if($product->product->complex_or_not == 'Нет' || $product->product->complex_or_not == null)
                            <div class="object__rooms">
                                <div class="object__rooms-content">
                                    <div class="object__rooms-item">
                                        <div class="object__rooms-subtitle">
                                            {{__('Общая площадь')}}
                                        </div>
                                        <div class="object__rooms-value">
                                        {{$product->product->size}} {{__('кв.м')}}
                                        </div>
                                    </div>
                                    <div class="object__rooms-item">
                                        <div class="object__rooms-subtitle">
                                            {{__('Спален')}}
                                        </div>
                                        <div class="object__rooms-value">
                                        <?php $spalni = \App\Models\ProductCategory::where('type', 'Спальни')->where('product_id', $product->product->id)->first(); ?>
                                            {{str_replace('+','',$spalni->category->name)}}
                                        </div>
                                    </div>
                                    <div class="object__rooms-item">
                                        <div class="object__rooms-subtitle">
                                            {{__('Гостиные')}}
                                        </div>

                                        <div class="object__rooms-value">

                                            <?php $spalni = \App\Models\ProductCategory::where('type', 'Гостиные')->where('product_id', $product->product->id)->first(); ?>

                                            {{str_replace('+','',__($spalni->category->name))}}

                                        </div>

                                    </div>

                                    <div class="object__rooms-item">

                                        <div class="object__rooms-subtitle">

                                            {{__('Ванные')}}


                                        </div>

                                        <div class="object__rooms-value">

                                            <?php $spalni = \App\Models\ProductCategory::where('type', 'Ванные')->where('product_id', $product->product->id)->first(); ?>

                                            {{str_replace('+','', __($spalni->category->name))}}

                                        </div>

                                    </div>

                                </div>

                            </div>
                            @endif

                            <div class="place__location">
                                <div class="place__location-title place__title">
                                    {{__('Расположение и инфраструктура')}}
                                </div>
                                <div class="place__location-info">
                                    @if(app()->getLocale() == 'en') <?php $product->product->disposition = $product->product->disposition_en ?> @elseif(app()->getLocale() == 'tr')  <?php $product->product->disposition = $product->product->disposition_tr ?>  @endif
                                    {{$product->product->disposition}}
                                </div>
                                <div class="place__location-map">
                                    <div class="">
                                        <script>
                                            product_id_is = <?php echo $product->product->id?>
                                            
                                            function createYandexMap(latitude, longitude) {
                                            let div_id = 'place-map'+product_id_is.toString();
                                                ymaps.ready(function() {
                                                    let map = new ymaps.Map(div_id, {
                                                        center: [latitude, longitude],
                                                        zoom: 10,
                                                    });
                                                    map.controls.remove('geolocationControl'); // удаляем геолокацию
                                                    map.controls.remove('searchControl'); // удаляем поиск
                                                    let placemark = new ymaps.Placemark([latitude, longitude]);
                                                    map.geoObjects.add(placemark);
                                                });
                                            }
                                            createYandexMap(<?php echo $product->product->lat.','.$product->product->long?>);
                                        </script>
                                        <div id="place-map{{$product->product->id}}" style="width: 100%; height: 195px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="kompleks__layout" bis_skin_checked="1">
                                <div class="kompleks__layout-content" bis_skin_checked="1">
                                    <div class="kompleks__header">
                                        <div class="kompleks__layout-title place__title" bis_skin_checked="1">
                                            {{__('Планировки квартир')}}
                                        </div>
                                        <div class="kompleks__layout-sort">
                                            @php
                                                $displayedLayouts = [];
                                            @endphp
                                            @foreach(json_decode($product->product->objects) as $object)
                                                @if (!in_array($object->apartment_layout, $displayedLayouts))
                                                    <div class="kompleks__sort-item" data-cheme="{{ $object->apartment_layout }}">
                                                        {{ $object->apartment_layout }}
                                                    </div>
                                                    @php
                                                    $displayedLayouts[] = $object->apartment_layout;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="kompleks__layout-list" bis_skin_checked="1">
                                        @if(!is_null(json_decode($product->product->objects)))
                                            @foreach(json_decode($product->product->objects) as $object)
                                                <div class="kompleks__layout-item" bis_skin_checked="1" data-cheme="{{ $object->apartment_layout }}">
                                                    <div class="kompleks__layout-info" bis_skin_checked="1">
                                                        <div class="kompleks__layout-option" bis_skin_checked="1">
                                                            {{ $object->building }}
                                                        </div>
                                                        <div class="kompleks__layout-price" bis_skin_checked="1">
                                                            <span data-exchange="eur" class="valute active">{{ $object->price->EUR }}</span>
                                                            <span data-exchange="usd" class="valute">{{ $object->price->USD }}</span>
                                                            <span data-exchange="rub" class="valute">{{ $object->price->RUB }}</span>
                                                            <span data-exchange="try" class="valute lira">{{ $object->price->TRY }}</span>
                                                        </div>
                                                        <div class="kompleks__layout-price-meter"bis_skin_checked="1">
                                                            <span data-exchange="eur" class="valute active">{{ $object->price_size->EUR }} / {{ __('кв.м') }}</span>
                                                            <span data-exchange="usd" class="valute">{{ $object->price_size->USD }} / {{ __('кв.м') }}</span>
                                                            <span data-exchange="rub" class="valute">{{ $object->price_size->RUB }} / {{ __('кв.м') }}</span>
                                                            <span data-exchange="try" class="valute lira">{{ $object->price_size->TRY }} / {{ __('кв.м') }}</span>
                                                        </div>
                                                        <div class="kompleks__layout-square" bis_skin_checked="1">
                                                            {{ $object->size }} {{ __('кв.м') }} <span>|</span>  {{ $object->apartment_layout }}

                                                        </div>
                                                        <div class="kompleks__layout-price-month" bis_skin_checked="1">
                                                            $645 / мес.
                                                        </div>
                                                    </div>
                                                    <div class="kompleks__layout-scheme" bis_skin_checked="1">
                                                        <div class="kompleks__layout-img" data-productid="{{ $product->id }}" bis_skin_checked="1">
                                                            @if(isset($object->apartment_layout_image))
                                                                @if(is_countable($object->apartment_layout_image))
                                                                    @foreach($object->apartment_layout_image as $image)
                                                                        <img data-objectid="{{ $object->id }}" style="max-width: 100px;" src="{{ asset('uploads/' . $image) }}" alt="scheme">
                                                                    @endforeach
                                                                @else
                                                                    <img data-objectid="{{ $object->id }}" style="max-width: 100px;" src="{{ asset('uploads/' . $object->apartment_layout_image) }}" alt="scheme">
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        {{--                                                                   <div class="kompleks__layout-item" bis_skin_checked="1">--}}
                                        {{--                                                                       <div class="kompleks__layout-info" bis_skin_checked="1">--}}
                                        {{--                                                                           <div class="kompleks__layout-option" bis_skin_checked="1">--}}
                                        {{--                                                                               B--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-price" bis_skin_checked="1">--}}
                                        {{--                                                                               $95 000--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-price-meter" bis_skin_checked="1">--}}
                                        {{--                                                                               $1254 / кв.м--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-square" bis_skin_checked="1">--}}
                                        {{--                                                                               100 кв.м  <span>|</span>  2+1--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-price-month" bis_skin_checked="1">--}}
                                        {{--                                                                               $936 / мес.--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                       </div>--}}
                                        {{--                                                                       <div class="kompleks__layout-scheme" bis_skin_checked="1">--}}
                                        {{--                                                                           <div class="kompleks__layout-img" bis_skin_checked="1">--}}
                                        {{--                                                                               <img src="./img/scheme-2.png" alt="scheme">--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                       </div>--}}
                                        {{--                                                                   </div>--}}
                                        {{--                                                                   <div class="kompleks__layout-item" bis_skin_checked="1">--}}
                                        {{--                                                                       <div class="kompleks__layout-info" bis_skin_checked="1">--}}
                                        {{--                                                                           <div class="kompleks__layout-option" bis_skin_checked="1">--}}
                                        {{--                                                                               C--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-price" bis_skin_checked="1">--}}
                                        {{--                                                                               $120 000--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-price-meter" bis_skin_checked="1">--}}
                                        {{--                                                                               $1857 / кв.м--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-square" bis_skin_checked="1">--}}
                                        {{--                                                                               156 кв.м  <span>|</span>  3+1--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-price-month" bis_skin_checked="1">--}}
                                        {{--                                                                               $1 176 / мес.--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                       </div>--}}
                                        {{--                                                                       <div class="kompleks__layout-scheme" bis_skin_checked="1">--}}
                                        {{--                                                                           <div class="kompleks__layout-img" bis_skin_checked="1">--}}
                                        {{--                                                                               <img src="./img/scheme-3.png" alt="scheme">--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                       </div>--}}
                                        {{--                                                                   </div>--}}
                                        {{--                                                                   <div class="kompleks__layout-item" bis_skin_checked="1">--}}
                                        {{--                                                                       <div class="kompleks__layout-info" bis_skin_checked="1">--}}
                                        {{--                                                                           <div class="kompleks__layout-option" bis_skin_checked="1">--}}
                                        {{--                                                                               D--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-price" bis_skin_checked="1">--}}
                                        {{--                                                                               $120 000--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-price-meter" bis_skin_checked="1">--}}
                                        {{--                                                                               $1857 / кв.м--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-square" bis_skin_checked="1">--}}
                                        {{--                                                                               156 кв.м  <span>|</span>  4+2 penthouse--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-price-month" bis_skin_checked="1">--}}
                                        {{--                                                                               $1 276 / мес.--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                       </div>--}}
                                        {{--                                                                       <div class="kompleks__layout-scheme kompleks__layout-scheme-swiper" bis_skin_checked="1">--}}
                                        {{--                                                                           <div class="scheme__swiper swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden" bis_skin_checked="1">--}}
                                        {{--                                                                               <div class="scheme__wrapper swiper-wrapper" id="swiper-wrapper-da3a6813d6c6e79a" aria-live="polite" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);" bis_skin_checked="1">--}}
                                        {{--                                                                                   <div class="scheme__slide swiper-slide swiper-slide-active" bis_skin_checked="1" role="group" aria-label="1 / 3" style="width: 243px;">--}}
                                        {{--                                                                                       <div class="scheme__slide-img" bis_skin_checked="1">--}}
                                        {{--                                                                                           <img src="./img/scheme-4.png" alt="scheme">--}}
                                        {{--                                                                                       </div>--}}
                                        {{--                                                                                       <div class="scheme__slide-floor" bis_skin_checked="1">--}}
                                        {{--                                                                                           1 этаж--}}
                                        {{--                                                                                       </div>--}}
                                        {{--                                                                                   </div>--}}
                                        {{--                                                                                   <div class="scheme__slide swiper-slide swiper-slide-next" bis_skin_checked="1" role="group" aria-label="2 / 3" style="width: 243px;">--}}
                                        {{--                                                                                       <div class="scheme__slide-img" bis_skin_checked="1">--}}
                                        {{--                                                                                           <img src="./img/scheme-5.png" alt="scheme">--}}
                                        {{--                                                                                       </div>--}}
                                        {{--                                                                                       <div class="scheme__slide-floor" bis_skin_checked="1">--}}
                                        {{--                                                                                           2 этаж--}}
                                        {{--                                                                                       </div>--}}
                                        {{--                                                                                   </div>--}}
                                        {{--                                                                                   <div class="scheme__slide swiper-slide" bis_skin_checked="1" role="group" aria-label="3 / 3" style="width: 243px;">--}}
                                        {{--                                                                                       <div class="scheme__slide-img" bis_skin_checked="1">--}}
                                        {{--                                                                                           <img src="./img/scheme-1.png" alt="scheme">--}}
                                        {{--                                                                                       </div>--}}
                                        {{--                                                                                       <div class="scheme__slide-floor" bis_skin_checked="1">--}}
                                        {{--                                                                                           3 этаж--}}
                                        {{--                                                                                       </div>--}}
                                        {{--                                                                                   </div>--}}
                                        {{--                                                                               </div>--}}
                                        {{--                                                                               <div class="scheme__prev scheme-btn swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-da3a6813d6c6e79a" aria-disabled="true" bis_skin_checked="1">--}}
                                        {{--                                                                                   <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35px" height="60px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.5 0.86" xmlns:xlink="http://www.w3.org/1999/xlink">--}}
                                        {{--															<g id="Слой_x0020_1">--}}
                                        {{--                                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>--}}
                                        {{--                                                                <polyline class="fil0 str0" points="0.46,0.04 0.07,0.43 0.46,0.82 "></polyline>--}}
                                        {{--                                                            </g>--}}
                                        {{--														</svg>--}}
                                        {{--                                                                               </div>--}}
                                        {{--                                                                               <div class="scheme__next scheme-btn" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-da3a6813d6c6e79a" aria-disabled="false" bis_skin_checked="1">--}}
                                        {{--                                                                                   <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35px" height="60px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.5 0.86" xmlns:xlink="http://www.w3.org/1999/xlink">--}}
                                        {{--														<g id="Слой_x0020_1">--}}
                                        {{--                                                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>--}}
                                        {{--                                                            <polyline class="fil0 str0" points="0.46,0.04 0.07,0.43 0.46,0.82 "></polyline>--}}
                                        {{--                                                        </g>--}}
                                        {{--													</svg>--}}
                                        {{--                                                                               </div>--}}
                                        {{--                                                                               <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>--}}
                                        {{--                                                                       </div>--}}
                                        {{--                                                                   </div>--}}
                                        {{--                                                                   <div class="kompleks__layout-item" bis_skin_checked="1">--}}
                                        {{--                                                                       <div class="kompleks__layout-info" bis_skin_checked="1">--}}
                                        {{--                                                                           <div class="kompleks__layout-option" bis_skin_checked="1">--}}
                                        {{--                                                                               E--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-price" bis_skin_checked="1">--}}
                                        {{--                                                                               $178 000--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-price-meter" bis_skin_checked="1">--}}
                                        {{--                                                                               $2257 / кв.м--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-square" bis_skin_checked="1">--}}
                                        {{--                                                                               170 кв.м  <span>|</span>  5+2 penthouse--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                           <div class="kompleks__layout-price-month" bis_skin_checked="1">--}}
                                        {{--                                                                               $1 642 / мес.--}}
                                        {{--                                                                           </div>--}}
                                        {{--                                                                       </div>--}}
                                        {{--                                                                       <div class="kompleks__layout-scheme kompleks__layout-scheme-swiper" bis_skin_checked="1">--}}
                                        {{--                                                                           <div class="scheme__swiper swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden" bis_skin_checked="1">--}}
                                        {{--                                                                               <div class="scheme__wrapper swiper-wrapper" id="swiper-wrapper-6eef4dd6ab635e4c" aria-live="polite" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);" bis_skin_checked="1">--}}
                                        {{--                                                                                   <div class="scheme__slide swiper-slide swiper-slide-active" bis_skin_checked="1" role="group" aria-label="1 / 3" style="width: 243px;">--}}
                                        {{--                                                                                       <div class="scheme__slide-img" bis_skin_checked="1">--}}
                                        {{--                                                                                           <img src="./img/scheme-6.png" alt="scheme">--}}
                                        {{--                                                                                       </div>--}}
                                        {{--                                                                                       <div class="scheme__slide-floor" bis_skin_checked="1">--}}
                                        {{--                                                                                           1 этаж--}}
                                        {{--                                                                                       </div>--}}
                                        {{--                                                                                   </div>--}}
                                        {{--                                                                                   <div class="scheme__slide swiper-slide swiper-slide-next" bis_skin_checked="1" role="group" aria-label="2 / 3" style="width: 243px;">--}}
                                        {{--                                                                                       <div class="scheme__slide-img" bis_skin_checked="1">--}}
                                        {{--                                                                                           <img src="./img/scheme-5.png" alt="scheme">--}}
                                        {{--                                                                                       </div>--}}
                                        {{--                                                                                       <div class="scheme__slide-floor" bis_skin_checked="1">--}}
                                        {{--                                                                                           2 этаж--}}
                                        {{--                                                                                       </div>--}}
                                        {{--                                                                                   </div>--}}
                                        {{--                                                                                   <div class="scheme__slide swiper-slide" bis_skin_checked="1" role="group" aria-label="3 / 3" style="width: 243px;">--}}
                                        {{--                                                                                       <div class="scheme__slide-img" bis_skin_checked="1">--}}
                                        {{--                                                                                           <img src="./img/scheme-1.png" alt="scheme">--}}
                                        {{--                                                                                       </div>--}}
                                        {{--                                                                                       <div class="scheme__slide-floor" bis_skin_checked="1">--}}
                                        {{--                                                                                           3 этаж--}}
                                        {{--                                                                                       </div>--}}
                                        {{--                                                                                   </div>--}}
                                        {{--                                                                               </div>--}}
                                        {{--                                                                               <div class="scheme__prev scheme-btn swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-6eef4dd6ab635e4c" aria-disabled="true" bis_skin_checked="1">--}}
                                        {{--                                                                                   <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35px" height="60px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.5 0.86" xmlns:xlink="http://www.w3.org/1999/xlink">--}}
                                        {{--															<g id="Слой_x0020_1">--}}
                                        {{--                                                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>--}}
                                        {{--                                                                <polyline class="fil0 str0" points="0.46,0.04 0.07,0.43 0.46,0.82 "></polyline>--}}
                                        {{--                                                            </g>--}}
                                        {{--														</svg>--}}
                                        {{--                                                                               </div>--}}
                                        {{--                                                                               <div class="scheme__next scheme-btn" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-6eef4dd6ab635e4c" aria-disabled="false" bis_skin_checked="1">--}}
                                        {{--                                                                                   <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35px" height="60px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 0.5 0.86" xmlns:xlink="http://www.w3.org/1999/xlink">--}}
                                        {{--														<g id="Слой_x0020_1">--}}
                                        {{--                                                            <metadata id="CorelCorpID_0Corel-Layer"></metadata>--}}
                                        {{--                                                            <polyline class="fil0 str0" points="0.46,0.04 0.07,0.43 0.46,0.82 "></polyline>--}}
                                        {{--                                                        </g>--}}
                                        {{--													</svg>--}}
                                        {{--                                                                               </div>--}}
                                        {{--                                                                               <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>--}}
                                        {{--                                                                       </div>--}}
                                        {{--                                                                   </div>--}}
                                    </div>
                                </div>
                            </div>



                            <div class="object__peculiarities">

                                <div class="object__peculiarities-title place__title">

                                    {{__('Особенности')}}


                                </div>

                                <div class="object__peculiarities-content">
                                    <?php $osobenosty = \App\Models\ProductCategory::where('type', 'Особенности')->where('product_id', $product->product->id)->get() ?>
                                    @foreach($osobenosty as $osob)
                                    <div class="object__peculiarities-item">
                                {{__($osob->category->name)}}
                                    </div>
                                        @endforeach
                                </div>
                            </div>

                            <div class="object__description">

                                <div class="object__description-title place__title">

                                    {{__('Описание')}}


                                </div>

                                <div class="object__description-text">

                                    @if(app()->getLocale() == 'en') <?php $product->product->description = $product->product->description_en ?> @elseif(app()->getLocale() == 'tr') <?php $product->product->description = $product->product->description_tr ?> @endif
                                    {{$product->product->description}}

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

                                                        <style>.cls-1 {

                                                                fill: url(#linear-gradient);

                                                            }



                                                            .cls-2 {

                                                                fill: #fff;

                                                            }</style>

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
@endforeach
    <div class="place__slider_p">
        <div class="place__slider_p-swiper swiper">
            <div class="place__slider_p-wrapper swiper-wrapper">
                <div class="place__slider_p-slide swiper-slide">
                    <div class="place__slider_p-img">
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
                <div class="place-popup-collage__item">

                </div>
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
</section>
<section class="object__photo">
    <div class="object__photo-popup">
        <div class="object__photo-popup-block">
            <div class="object__photo-content">
                <div class="object__swiper swiper _preload">
                    <div class="object__swiper-wrapper swiper-wrapper">
                        <div class="object__swiper-slide swiper-slide">
                            <img src alt>
                        </div>
                    </div>
                    <!-- <div class="object__swiper-pagination swiper-pagination"></div>
                    <div class="object__swiper-prev object__swiper-nav">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.2893 5.70708C13.8988 5.31655 13.2657 5.31655 12.8751 5.70708L7.98768 10.5993C7.20729 11.3805 7.2076 12.6463 7.98837 13.427L12.8787 18.3174C13.2693 18.7079 13.9024 18.7079 14.293 18.3174C14.6835 17.9269 14.6835 17.2937 14.293 16.9032L10.1073 12.7175C9.71678 12.327 9.71678 11.6939 10.1073 11.3033L14.2893 7.12129C14.6799 6.73077 14.6799 6.0976 14.2893 5.70708Z" fill="#fff"></path> </g></svg>
                    </div>
                    <div class="object__swiper-next object__swiper-nav">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.2893 5.70708C13.8988 5.31655 13.2657 5.31655 12.8751 5.70708L7.98768 10.5993C7.20729 11.3805 7.2076 12.6463 7.98837 13.427L12.8787 18.3174C13.2693 18.7079 13.9024 18.7079 14.293 18.3174C14.6835 17.9269 14.6835 17.2937 14.293 16.9032L10.1073 12.7175C9.71678 12.327 9.71678 11.6939 10.1073 11.3033L14.2893 7.12129C14.6799 6.73077 14.6799 6.0976 14.2893 5.70708Z" fill="#fff"></path> </g></svg>
                    </div> -->
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

@section('footer')

    @include('project.includes.footer')

@endsection




@section('scripts')

    <script>

        let product_count = "<?php echo $get_product->count() ?>";

        let locationsFavorites = [

        ];




        let obect =  "<?php echo __('объектов')?>";









        // getData();

        (async() => {

            "use strict";



            function e(e) {

                for (let t = 0; t < e.length; t++) e[t].classList.remove("active");

                e = 0

            }

            window.addEventListener("resize", (function(e) {


            })), document.querySelectorAll(".place-w").length && window.innerWidth <= 540 &&  window.addEventListener("resize", (function(e) {

                document.querySelectorAll("#map_city").length && (window.innerWidth > 1003 && document.querySelector(".city__content").classList.remove("city_map"), window.innerWidth <= 1003 && (document.querySelector("#map_city").style.height = "100%"), window.innerWidth > 1003 && (document.querySelector(".city-col").classList.add("active"), document.querySelector(".map_city__btn-changer").classList.remove("active"), document.querySelector(".city-col__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.remove("map_city_active"), document.querySelector(".city__content").classList.remove("city_map")), window.innerWidth > 1199 && (document.querySelector("#map_city").style.height = window.innerHeight - 18 - 161 + "px"), window.innerWidth <= 1199 && window.innerWidth > 1003 && (document.querySelector("#map_city").style.height = window.innerHeight - 88 - 60 + "px"))

            })), document.querySelector(".header__top-lang").onclick = function() {

                document.querySelector(".header__top-lang-item").classList.toggle("active"), document.querySelector(".header__lang-list-dropdown").classList.toggle("active")

            }, document.querySelector(".header__nav-buy").onclick = function() {

                this.classList.toggle("active"), document.querySelector(".header__buy-dropdown").classList.toggle("active")

            }, document.querySelector(".header__nav-about").onclick = function() {

                this.classList.toggle("active"), document.querySelector(".header__about-dropdown").classList.toggle("active")

            }, document.querySelector(".header__top-phone-menu").onclick = function() {

                document.querySelector(".header-m").classList.toggle("active"), document.querySelector("#nav-icon").classList.toggle("open"), document.querySelector(".header-w").classList.add("fixed"), document.querySelector(".header-m").classList.contains("active") || document.querySelector(".place-w").classList.contains("active") || document.querySelector(".header-w").classList.remove("fixed")

            }

            let t = document.querySelectorAll(".header-m__langs-item");

            for (let o = 0; o < t.length; o++) t[o].addEventListener("click", (function(c) {

                e(t), t[o].classList.add("active")

            }));

            let o = document.querySelectorAll(".index-map__button");

            for (let t = 0; t < o.length; t++) o[t].addEventListener("click", (function(c) {

                e(o), o[t].classList.add("active")

            }));

            let c, l = document.querySelectorAll(".contact__top-item");

            for (let t = 0; t < l.length; t++) l[t].addEventListener("click", (function(o) {

                e(l), l[t].classList.add("active")

            }));

            document.querySelectorAll(".contact__form-phone-country").length && (document.querySelector(".contact__form-phone-country").onclick = function() {

                this.classList.toggle("active"), document.querySelector(".contact__phone-dropdown").classList.toggle("active")

            }), new Swiper(".objects__swiper", {

                slidesPerView: 4,

                spaceBetween: 20,

                pagination: {

                    el: ".objects__pagination",

                    clickable: !0

                },

                navigation: {

                    nextEl: ".objects__next",

                    prevEl: ".objects__prev"

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

            }), document.querySelectorAll(".search-nav__rooms-title").length && (document.querySelector(".search-nav__rooms-title").onclick = function() {

                document.querySelector(".search-nav__rooms").classList.toggle("active"), document.querySelector(".search-nav__rooms-dropdown").classList.toggle("active")

            }), document.querySelectorAll(".search-nav__more-title").length && (document.querySelector(".search-nav__more-title").onclick = function() {

                window.innerWidth > 899 && (document.querySelector(".search-nav__more").classList.toggle("active"), document.querySelector(".search-nav__more-dropdown").classList.toggle("active")), window.innerWidth <= 899 && document.querySelector(".search-w").classList.toggle("active")

            }), document.querySelectorAll(".search-w__close").length && (document.querySelector(".search-w__close").onclick = function() {

                window.innerWidth <= 899 && document.querySelector(".search-w").classList.remove("active")

            });

            let n = document.querySelectorAll(".search-nav__rooms-dropdown-bedrooms-button");

            for (let t = 0; t < n.length; t++) n[t].addEventListener("click", (function(o) {

                e(n), n[t].classList.add("active")

            }));

            let i = document.querySelectorAll(".search-nav__rooms-dropdown-bathrooms-button");

            for (let t = 0; t < i.length; t++) i[t].addEventListener("click", (function(o) {

                e(i), i[t].classList.add("active")

            }));

            let a = document.querySelectorAll(".search-nav__view-button");

            for (let t = 0; t < a.length; t++) a[t].addEventListener("click", (function(o) {

                e(a), a[t].classList.add("active")

            }));

            let s = document.querySelectorAll(".search-nav__sea-button");

            for (let t = 0; t < s.length; t++) s[t].addEventListener("click", (function(o) {

                e(s), s[t].classList.add("active")

            }));

            document.querySelectorAll(".search-nav__types-title").length && (document.querySelector(".search-nav__types-title").onclick = function() {

                document.querySelector(".search-nav__types").classList.toggle("active"), document.querySelector(".search-nav__types-dropdown").classList.toggle("active")

            }), document.querySelectorAll(".search-nav__price-title").length && (document.querySelector(".search-nav__price-title").onclick = function() {

                document.querySelector(".search-nav__price").classList.toggle("active"), document.querySelector(".search-nav__price-dropdown").classList.toggle("active")

            });

            let r = document.querySelectorAll(".search-nav__price-currency-item");

            // for (let t = 0; t < s.length; t++) r[t].addEventListener("click", (function(o) {

            //     e(r), r[t].classList.add("active")

            // }));

            let d = document.querySelectorAll(".search-nav__list-item-title"),

                u = document.querySelectorAll(".search-nav__item-dropdown");



            function m() {

                for (let e = 0; e < u.length - 1; e++) u[e].style.zIndex = 5

            }

            for (let e = 0; e < d.length - 1; e++) d[e].addEventListener("click", (function(t) {

                m(), u[e].style.zIndex = 6

            }));

            document.querySelectorAll(".search-nav__price-title").length && (document.querySelector(".search-nav__price-title").onclick = function() {

                document.querySelector(".search-nav__price").classList.toggle("active"), document.querySelector(".search-nav__price-dropdown").classList.toggle("active")

            }), document.querySelector(".city-col__filter") && (document.querySelector(".city-col__filter").onclick = function() {

                this.classList.toggle("active"), document.querySelector(".city-col__filter-list").classList.toggle("active")

            }), document.querySelector(".favorites__top-filter") && (document.querySelector(".favorites__top-filter").onclick = function() {

                this.classList.toggle("active"), document.querySelector(".favorites__top-filter-list").classList.toggle("active")

            }), document.querySelector(".place__btns-call-preview") && (document.querySelector(".place__btns-call-preview").onclick = function() {

                document.querySelector(".place__btns-call-list").classList.toggle("active")

            }), document.querySelector(".place__btns-call-preview") && (document.querySelector(".place-w").onscroll = function() {

                window.innerWidth < 640 && (document.querySelector(".place-w").scrollTop > 620 ? document.querySelector(".place__btns").style.position = "fixed" : document.querySelector(".place__btns").style.position = "static")

            }, window.addEventListener("resize", (function(e) {

                window.innerWidth >= 640 && (document.querySelector(".place__btns").style.position = "static")

            })));

            let _ = document.querySelectorAll(".favorites__list-item"),

                y = document.querySelectorAll(".favorites__item-exit");
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            for (let e = 0; e < y.length; e++) y[e].addEventListener("click", (function(t) {
                t.stopPropagation();
                _[e].style.display = "none";

                fetch('/deleteFavorite', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': csrfToken
                    },
                    body: JSON.stringify({ product_id: y[e].getAttribute('data_id') })
                })
                    .then(response => response.json())
                    .then(res => {
                        if (res.status) {
                            document.querySelector('.count').innerHTML = res.counts;
                            document.querySelectorAll('.header__top-favorites-value')[0].innerHTML = res.counts;
                            document.querySelectorAll('.header__top-favorites-value')[1].innerHTML = res.counts;
                        }
                        product_count = product_count - 1
                        if(product_count == 0){
                            location.reload();
                        }

                    })

            }));




            let v = document.querySelectorAll(".favorites__pages-item");

            for (let t = 0; t < v.length; t++) v[t].addEventListener("click", (function(o) {

                e(v), v[t].classList.add("active")

            }));

            let p = document.querySelectorAll(".city-col__btn");

            for (let t = 0; t < p.length; t++) p[t].addEventListener("click", (function(o) {

                e(p), p[t].classList.add("active")

            }));

            let h = document.querySelectorAll(".favorite-item-btn");

            for (let e = 0; e < h.length; e++) h[e].addEventListener("click", (function(t) {

                h[e].classList.toggle("active")

            }));

            let f = document.querySelectorAll(".objects__slide-favorites");

            for (let e = 0; e < f.length; e++) f[e].addEventListener("click", (function(t) {

                f[e].classList.toggle("active")

            }));

            let w = document.querySelectorAll(".city-col__bottom-number");

            for (let t = 0; t < w.length; t++) w[t].addEventListener("click", (function(o) {

                e(w), w[t].classList.add("active")

            }));

            document.querySelector(".city-col__btn-changer") && (document.querySelector(".city-col__btn-changer").onclick = function() {

                C.destroy(), P(1 / 0), C.container.fitToViewport(), this.classList.remove("active"), document.querySelector(".city-col").classList.remove("active"), document.querySelector(".map_city__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.add("map_city_active"), document.querySelector(".city__content").classList.add("city_map")

            }), document.querySelector(".map_city__btn-changer") && (document.querySelector(".map_city__btn-changer").onclick = function() {

                this.classList.remove("active"), document.querySelector(".city-col").classList.add("active"), document.querySelector(".city-col__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.remove("map_city_active"), document.querySelector(".city__content").classList.remove("city_map")

            }), document.querySelectorAll(".place__currency-preview").length && (document.querySelector(".place__currency-preview").onclick = function() {

                document.querySelector(".place__currency").classList.toggle("active")

            }), window.innerWidth > 1003 && document.querySelectorAll(".city").length && document.body.classList.add("scroll_fixed"), window.addEventListener("resize", (function(e) {

                window.innerWidth > 1003 && document.querySelectorAll(".city").length && document.body.classList.add("scroll_fixed"), window.innerWidth <= 1003 && document.querySelectorAll(".city").length && document.body.classList.remove("scroll_fixed")

            }));

            let g = document.querySelectorAll(".city-col__item"),

                b = document.querySelector(".place-w");

            for (let e = 0; e < g.length; e++) g[e].addEventListener("click", (function(e) {

                e.target.classList.contains("favorite-item-btn") || (document.body.classList.add("scroll_fixed"), document.querySelector(".header-w").classList.add("fixed"), b.classList.add("active"))

            }));

            document.querySelectorAll(".place__exit").length && (document.querySelector(".place__exit").onclick = function() {

                document.querySelector(".place-w").classList.remove("active"), document.body.classList.remove("scroll_fixed"), document.querySelector(".header-w").classList.remove("fixed")

            }), document.querySelectorAll(".place__header-exit").length && (document.querySelector(".place__header-exit").onclick = function() {

                document.querySelector(".place-w").classList.remove("active"), document.body.classList.remove("scroll_fixed"), document.querySelector(".header-w").classList.remove("fixed")

            }), new Swiper(".place__swiper", {

                slidesPerView: 2,

                spaceBetween: 4,

                navigation: {

                    nextEl: ".place__next",

                    prevEl: ".place__prev"

                },

                pagination: {

                    el: ".place__pagination",

                    type: "custom",

                    renderCustom: function(e, t, o) {

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

            }), new Swiper(".scheme__swiper", {

                slidesPerView: 1,

                navigation: {

                    nextEl: ".scheme__next",

                    prevEl: ".scheme__prev"

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

            if (S.length)

                for (let e = 0; e < S.length; e++) S[e].addEventListener("click", (function(t) {
                     q.classList.add("active")
                }));

            if (L.length)

                for (let e = 0; e < L.length; e++) L[e].addEventListener("click", (function(e) {

                    x.classList.add("active")

                }));

            var C, E;







            L.length && (k.onclick = function() {

                q.classList.remove("active"), c.destroy(!0, !0)

            }), L.length && (A.onclick = function() {

                x.classList.remove("active")

            }), L.length && window.addEventListener("resize", (function(e) {

                window.innerWidth <= 766 && q.classList.contains("active") && (x.classList.add("active"), q.classList.remove("active")), window.innerWidth > 766 && x.classList.contains("active") && (x.classList.remove("active"), q.classList.add("active"))

            })), document.querySelectorAll("#map-country").length && ymaps.ready((function() {

                var mapCountry;
                var script;


                var head = document.getElementsByTagName('head')[0];
                function changeLangMap(lang) {
                    // Получим значение выбранного языка.
                    // var language = 'en'
                    var language = lang
                    // Если карта уже была создана, то удалим её.
                    if (mapCountry) {
                        mapCountry.destroy();
                    }
                    // Создадим элемент 'script'.
                    script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.charset = 'utf-8';
                    // Запишем ссылку на JS API Яндекс.Карт с выбранным языком в атрибут 'src'.
                    script.src = 'https://api-maps.yandex.ru/2.1/?onload=init_' + language + '&lang=' + language +
                        '_RU&ns=ymaps_' + language;
                    // Добавим элемент 'script' на страницу.
                    head.appendChild(script);
                    // Использование пространства имен позволяет избежать пересечения названий функций
                    // и прочих программных компонентов.
                    window['init_' + language] = function () {
                        init(window['ymaps_' + language]);
                    }
                }
                let mapLang = "<?php echo app()->getLocale() ?>";
                changeLangMap(mapLang)

            }))

        })();











        getData();

    </script>
<script>
    //открытие модалки объекта
    if(document.querySelectorAll('.open-place-popup').length) {
        const openPlacePopupBtn = document.querySelectorAll('.open-place-popup')
        const header = document.querySelector('.header-w')
        //открытие модалки
        openPlacePopupBtn.forEach(blockBtn => {
            blockBtn.addEventListener('click', function() {
                openPlacePopup(this)
                url.searchParams.set('object_id', this.getAttribute('data_id'));
                // Получение обновленного URL
                var updatedUrl = url.toString();
                // Обновление URL в адресной строке
                window.history.replaceState({}, '', updatedUrl);
                if(window.innerWidth < 1023)
                header.classList.add('fixed')
            })
        });
        //функция для открытия модалки
        function openPlacePopup(block) {
            const id = block.getAttribute('data_id')
            const placePopup = document.querySelector('.place-w[data_id="' + id + '"]');
            placePopup.classList.add('active')

            const placeLeftCol = placePopup.querySelector('.place__left-col')
            const placeScrollContent = placePopup.querySelector('.place__scroll-content')

            $(placeLeftCol).animate({ scrollTop: 0 }, "fast");
            $(placeScrollContent).animate({ scrollTop: 0 }, "fast");
        }
        //закрытие модалки по крестику
        $('.place__exit').click(function() {

            $(this).closest('.place-w').removeClass('active');
            url.searchParams.delete('object_id');
            // Получение обновленного URL
            var updatedUrl = url.toString();
            // Обновление URL в адресной строке
            window.history.replaceState({}, '', updatedUrl);
        });
    }
    //открытие галереи обхекта со слайдером
    if(document.querySelectorAll('.place__collage-item_clickable').length) {
        let collageContainer = document.querySelectorAll('.place__content')
        for(let i = 0; i < collageContainer.length; i++) {
            getImagesFromCollage(collageContainer[i])
        }
        function getImagesFromCollage(container) {
            let collageImg = container.querySelectorAll('.place__collage-item_clickable')
            for(let i = 0; i < collageImg.length; i++) {
                collageImg[i].onclick = function(e) {
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
                    renderCustom: function(e, t, o) {
                        return t + " из " + o
                    }
                }
            })
        }
    }
    //закрытие place-w в мобилке по клику на стрелочку
    if(document.querySelectorAll(".place__header-exit").length) {
        const placeExitBtn = document.querySelectorAll(".place__header-exit")
        placeExitBtn.forEach(btn => {
            btn.addEventListener('click', function() {
                const placeW = this.closest('.place-w')
                placeW.classList.remove('active')
            })
        });
    }
    if(document.querySelectorAll(".open-collage").length) {
    //слушатель клика на фотки
    const openCollage = document.querySelectorAll('.open-collage')
    openCollage.forEach(openCollageBtn => {
        openCollageBtn.addEventListener('click', function() {
            setCollageListImages(openCollageBtn)
        })
    });


    function setCollageListImages(imageBtn) {
        //сам блок коллаж
        const collage = document.querySelector('.place-popup-collage')
        //сюда добавляем фотки
        const listImg = collage.querySelector('.place-popup-collage__list')

        listImg.innerHTML = ''
        //здесь берем фотки
        const wrapperSlides = imageBtn.closest('.place__wrapper')
        //сами фотки
        const images = wrapperSlides.querySelectorAll('img')

        images.forEach((image,index) => {
            //создаем блок для фото
            const collageItem = document.createElement('div')
            collageItem.classList.add('place-popup-collage__item')

            //создаем само фото
            const img = document.createElement('img')
            img.setAttribute('src', image.currentSrc)

            if(index === 0) {
                const topItem = collage.querySelector('.place-popup-collage__top')
                topItem.innerHTML = ''
                //создаем блок для фото
                const collageItemTop = document.createElement('div')
                collageItemTop.classList.add('place_popup__top-item')
                //создаем само фото
                const img = document.createElement('img')
                img.setAttribute('src', image.currentSrc)
                topItem.appendChild(img)
                collageItemTop.appendChild(collageItem)
                return
            }
            //добавляем блоки с фото в коллаж
            collageItem.appendChild(img)
            listImg.appendChild(collageItem)
        });
    }

}
</script>
    {{--    <script src="{{asset('project/js/app.js')}} "></script>--}}
<script>
//сохранение url объектов такой же код на странице country удаление из url в app.js при клике на темную область и тут на крестик
// Получение текущего URL
const currentUrl = window.location.href;

// Создание объекта URL
const url = new URL(currentUrl);

// Получение параметров из URL
const searchParams = url.searchParams;

// Получение значения параметра по его имени
const objectIdFromUrl = searchParams.get('object_id');
if(objectIdFromUrl) {
    const popupObject = document.querySelector(`.place-w[data_id="${parseInt(objectIdFromUrl)}"]`)
    if(popupObject) {
        popupObject.classList.add('active')
    }
}
</script>
@endsection

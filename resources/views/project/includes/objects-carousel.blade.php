@if(!empty($products))
    <section class="objects-slider container">
        <div class="objects-slider__title title">
            {{ $title ?? null }}
        </div>
        <div class="objects-slider__content">
            <div class="objects__swiper swiper">
                <div class="objects__wrapper swiper-wrapper">
                    @foreach($products as $product)
                        <div class="objects__slide swiper-slide open-place-popup" data_id="{{$product->id}}" data_slug="{{$product->slug}}">
                            <div class="objects__slide-img">
                                @if($product->photo[0]->preview)
                                    <img src="{{ asset($product->photo[0]->preview) }}" alt="place">
                                @else
                                    <img src="{{ asset('uploads/'.$product->photo[0]->photo) }}" alt="place">
                                @endif
                            </div>
                            <div class="objects__slide-text">
                                <div class="objects__slide-price" @if(app()->getLocale() == 'ar' || app()->getLocale() == 'fa')style="direction: ltr!important; text-align: right;"@endif>
                                    @if (isset($product->layouts))
                                        @if (isset($product->price["EUR"]))
                                            @php
                                                $euroPrice = str_replace(' €', '', $product->price["EUR"]);
                                            @endphp
                                            @if (count($product->layouts) > 1)
                                                {{ "€ " . $euroPrice . " +" }}
                                            @else
                                                {{ "€ " . $euroPrice }}
                                            @endif
                                        @else
                                            {{ "€ " . str_replace(' €', '', $product->price["EUR"]) }}
                                        @endif
                                    @endif
                                </div>
                                <div class="objects__slide-rooms">
                                    @if($product->number_rooms_unique != "")
                                        {{ $product->number_rooms_unique }}
                                    @else
                                        {{ $product->size }} {{__('кв.м')}} <span>|</span> {{ str_replace('+', '', $product->spalni) }} <span>|</span> {{ str_replace('+', '', $product->vanie) }}
                                    @endif
                                </div>
                                <div class="objects__slide-address">
                                    {{$product->address}}
                                    {{--                                Balbey, 431. Sk. No:4, 07040 Muratpaşa--}}
                                </div>
                            </div>
                            @php
                                $user_id = isset($_COOKIE["user_id"]) ? $_COOKIE['user_id'] : null;
                                $fav = $product->favorite->where('user_id', isset($_COOKIE["user_id"]) ? $_COOKIE['user_id'] : null)->where('product_id', $product->id)->all();
                            @endphp
                            <div class="objects__slide-favorites check-favorites {{ count($fav) === 0 ? '' : 'active' }}"  data_id="{{$product->id}}" >
                                <svg class="blue" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="73px" height="64px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                     viewBox="0 0 2.33 2.04"
                                     xmlns:xlink="http://www.w3.org/1999/xlink">
								<g id="Слой_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"/>
                                    <path class="fil0 str0" d="M1.16 1.88c-0.22,-0.16 -0.5,-0.38 -0.77,-0.65 -0.2,-0.19 -0.26,-0.37 -0.26,-0.55 0,-0.31 0.26,-0.55 0.58,-0.55 0.18,0 0.35,0.08 0.45,0.21 0.11,-0.13 0.28,-0.21 0.46,-0.21 0.32,0 0.58,0.24 0.58,0.55 0,0.18 -0.06,0.36 -0.26,0.55 -0.27,0.27 -0.56,0.49 -0.78,0.65z"/>
                                </g>
							</svg>
                            </div>
                            <div class="die__list">
                                @foreach($product->tags as $tag)
                                    <div class="die__list-item">
                                        {{ $tag }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="objects__pagination"></div>
            </div>
            <div class="objects__prev objects__btn">
                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35px" height="60px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                     viewBox="0 0 0.5 0.86"
                     xmlns:xlink="http://www.w3.org/1999/xlink">
					 <g id="Слой_x0020_1">
                         <metadata id="CorelCorpID_0Corel-Layer"/>
                         <polyline class="fil0 str0" points="0.46,0.04 0.07,0.43 0.46,0.82 "/>
                     </g>
					</svg>
            </div>
            <div class="objects__next objects__btn">
                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="35px" height="60px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                     viewBox="0 0 0.5 0.86"
                     xmlns:xlink="http://www.w3.org/1999/xlink">
					 <g id="Слой_x0020_1">
                         <metadata id="CorelCorpID_0Corel-Layer"/>
                         <polyline class="fil0 str0" points="0.46,0.04 0.07,0.43 0.46,0.82 "/>
                     </g>
					</svg>
            </div>
        </div>
    </section>
@endif
<section class="popuuups">
    @foreach($products as $product)
        <div class="place-w" data_id="{{$product->id}}">
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
                            @php
                                $user_id = isset($_COOKIE["user_id"]) ? $_COOKIE['user_id'] : null;
                                $fav = $product->favorite->where('user_id', isset($_COOKIE["user_id"]) ? $_COOKIE['user_id'] : null)->where('product_id', $product->id)->all();
                            @endphp
                            <div class="place__header-favorite check-favorites {{ count($fav) === 0 ? '' : 'active' }}" data_id="{{$product->id}}">
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
                                        @if (isset($product->photo[0]))
                                            <img src="{{asset('uploads/'.$product->photo[0]->photo)}}" alt="object">
                                        @endif
                                    </div>
                                </div>
                                <div class="place__left-collage">
                                    @if (isset($product->preview_image))
                                        @foreach($product->photo as $photo)
                                            <div class="place__collage-item place__collage-item_clickable">
                                                <img src="{{asset('uploads/'.$photo->photo)}}" alt="object">
                                            </div>
                                        @endforeach
                                    @else
                                        @foreach($product->photo->where('id','!=',$product->photo[0]->id)->all() as $photo)
                                            <div class="place__collage-item place__collage-item_clickable">
                                                <img src="{{asset('uploads/'.$photo->photo)}}" alt="object">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="place__slider">
                                <div class="place__swiper swiper">
                                    <div class="place__wrapper swiper-wrapper">
                                        @foreach($product->photo as $photo)
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
                                @php
                                    $user_id = isset($_COOKIE["user_id"]) ? $_COOKIE['user_id'] : null;
                                    $fav = $product->favorite->where('user_id', isset($_COOKIE["user_id"]) ? $_COOKIE['user_id'] : null)->where('product_id', $product->id)->all();
                                @endphp
                                <div class="place__top-favorites check-favorites {{ count($fav) === 0 ? '' : 'active' }}" data_id="{{$product->id}}">
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
                                        @if(app()->getLocale() == 'ar' || app()->getLocale() == 'fa')
                                            <div
                                                style="direction: ltr!important; text-align: right;"
                                                class="place__price-value lira"
                                                data-price-eur="{{ $product->price["EUR"] . " " . __('от') }}"
                                                data-price-usd="{{ $product->price["USD"] . " " . __('от') }}"
                                                data-price-gbp="{{ $product->price["GBP"] . " " . __('от') }}"
                                                data-price-try="{{ $product->price["TRY"] . " " . __('от') }}"
                                                data-price-rub="{{ $product->price["RUB"] . " " . __('от') }}"
                                            >
                                                @if (count($product->layouts) > 1)
                                                    {{ $product->price["EUR"] . " " . __("от") }}
                                                @else
                                                    {{ $product->price["EUR"] }}
                                                @endif
                                            </div>
                                        @else
                                            <div
                                                class="place__price-value lira"
                                                data-price-eur="{{ __("от") . " " . $product->price["EUR"] }}"
                                                data-price-usd="{{ __("от") . " " . $product->price["USD"] }}"
                                                data-price-gbp="{{ __("от") . " " . $product->price["GBP"] }}"
                                                data-price-try="{{ __("от") . " " . $product->price["TRY"] }}"
                                                data-price-rub="{{ __("от") . " " . $product->price["RUB"] }}"
                                            >
                                                @if (count($product->layouts) > 1)
                                                    {{ __("от") . " " . $product->price["EUR"] }}
                                                @else
                                                    {{ $product->price["EUR"] }}
                                                @endif
                                            </div>
                                        @endif
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
                                                <div class="place__currency-item" data-exchange="gbp">
                                                    ₤
                                                </div>
                                                <div class="place__currency-item" data-exchange="try">
                                            <span class="lira">
                                                ₺
                                            </span>
                                                </div>
                                                <div class="place__currency-item" data-exchange="rub">
                                                    ₽
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
                                    <div
                                        @if(app()->getLocale() == 'ar' || app()->getLocale() == 'fa')style="direction: ltr!important; text-align: right;"@endif
                                    class="place__square place__square_country lira"
                                        data-price-eur="{{ $product->price_size["EUR"] }}"
                                        data-price-usd="{{ $product->price_size["USD"] }}"
                                        data-price-gbp="{{ $product->price_size["GBP"] }}"
                                        data-price-try="{{ $product->price_size["TRY"] }}"
                                        data-price-rub="{{ $product->price_size["RUB"] }}"
                                    >
                                        {{ $product->price_size["EUR"] }}
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
                                        @if($product->vnj == 'Да')
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
                                        @if($product->cryptocurrency == 'Да')
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
                                        @if($product->commissions == 'Да')
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
                                        @if($product->parking == 'Да')
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
                                    <div class="remotely">
                                        <div class="remotely__content">
                                            <div class="remotely__pic">
                                                <img src="{{asset('project/img/remotely.png')}}" alt="">
                                            </div>
                                            <div class="remotely__text">
                                                <p>
                                                    Удаленная сделка и онлайн просмотр
                                                </p>
                                                <button class="btn_blue" popup-name="main-form-popup">
                                                    Получить каталог
                                                </button>
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
                                    @if(!is_null($product->locale_fields->where('locale.code', app()->getLocale())->first()))
                                        @if(!is_null($product->locale_fields->where('locale.code', app()->getLocale())->first()->deadline))
                                            <div class="place__deadline">
                                                <div class="place__deadline-content">
                                                    <div class="place__deadline-subtitle place__title">
                                                        {{__('Срок сдачи')}}
                                                    </div>
                                                    <div class="place__deadline-title">{{ $product->locale_fields->where('locale.code', app()->getLocale())->first()->deadline }}</div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    @if($product->complex_or_not == 'Нет' || $product->complex_or_not == null)
                                        <div class="object__rooms">
                                            <div class="object__rooms-content">
                                                <div class="object__rooms-item">
                                                    <div class="object__rooms-subtitle">
                                                        {{__('Общая площадь')}}
                                                    </div>
                                                    <div class="object__rooms-value">
                                                        {{ $product->size }} {{__('кв.м')}}
                                                    </div>
                                                </div>
                                                @if(isset($product->spalni))
                                                    <div class="object__rooms-item">
                                                        <div class="object__rooms-subtitle">
                                                            {{__('Спален')}}
                                                        </div>
                                                        <div class="object__rooms-value">
                                                            {{ str_replace('+', '', $product->spalni) }}
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(isset($product->gostinnie))
                                                    <div class="object__rooms-item">
                                                        <div class="object__rooms-subtitle">
                                                            {{__('Гостиные')}}
                                                        </div>
                                                        <div class="object__rooms-value">
                                                            {{ str_replace('+', '', $product->gostinnie) }}
                                                        </div>
                                                    </div>
                                                @endif
                                                @if(isset($product->vanie))
                                                    <div class="object__rooms-item">
                                                        <div class="object__rooms-subtitle">
                                                            {{__('Ванные')}}
                                                        </div>
                                                        <div class="object__rooms-value">
                                                            {{ str_replace('+', '', $product->vanie) }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="place__location">
                                        <div class="place__location-title place__title">
                                            {{__('Расположение и инфраструктура')}}
                                        </div>
                                        <div class="place__location-info">
                                            @if(app()->getLocale() == 'en') <?php $product->disposition = $product->disposition_en ?> @elseif(app()->getLocale() == 'tr')  <?php $product->disposition = $product->disposition_tr ?>  @endif
                                            {{$product->disposition}}
                                        </div>
                                        <div class="place__location-map">
                                            <div class="">
                                                <script>
                                                    product_id_is = <?php echo $product->id?>

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
                                                    createYandexMap({{ $product->lat }}, {{ $product->long }});
                                                </script>
                                                <div id="place-map{{$product->id}}" style="width: 100%; height: 195px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kompleks__layout" bis_skin_checked="1" @if(count($product->layouts) === 0) style="display: none" @endif>
                                        <div class="kompleks__layout-content" bis_skin_checked="1">
                                            <div class="kompleks__header">
                                                <div class="kompleks__layout-title place__title" bis_skin_checked="1">
                                                    {{__('Планировки квартир')}}
                                                </div>
                                                <div class="kompleks__layout-sort">
                                                    @php
                                                        $displayedLayouts = [];
                                                    @endphp
                                                    @foreach($product->layouts as $layout)
                                                        @if (!in_array($layout->number_rooms, $displayedLayouts))
                                                            <div class="kompleks__sort-item" data-cheme="{{ $layout->number_rooms }}">
                                                                {{ $layout->number_rooms }}
                                                            </div>
                                                            @php
                                                                $displayedLayouts[] = $layout->number_rooms;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="kompleks__layout-list" bis_skin_checked="1">
                                                @if(isset($product->layouts))
                                                    @foreach($product->layouts as $layout)
                                                        <div class="kompleks__layout-item" bis_skin_checked="1" data-cheme="{{ $layout->number_rooms }}">
                                                            <div class="kompleks__layout-info" bis_skin_checked="1">
                                                                <div class="kompleks__layout-option" bis_skin_checked="1">
                                                                    {{ $layout->building }}
                                                                </div>
                                                                @if(app()->getLocale() == 'ar' || app()->getLocale() == 'fa')
                                                                    <div class="kompleks__layout-price" bis_skin_checked="1">
                                                                        <span data-exchange="eur" class="valute active" style="direction: ltr!important; text-align: right;">{{ $layout->price['EUR'] }}</span>
                                                                        <span data-exchange="usd" class="valute" style="direction: ltr!important; text-align: right;">{{ $layout->price['USD'] }}</span>
                                                                        <span data-exchange="gbp" class="valute" style="direction: ltr!important; text-align: right;">{{ $layout->price['GBP'] }}</span>
                                                                        <span data-exchange="try" class="valute lira" style="direction: ltr!important; text-align: right;">{{ $layout->price['TRY'] }}</span>
                                                                        <span data-exchange="rub" class="valute" style="direction: ltr!important; text-align: right;">{{ $layout->price['RUB'] }}</span>
                                                                    </div>
                                                                    <div class="kompleks__layout-price-meter"bis_skin_checked="1">
                                                                        <span data-exchange="eur" class="valute active" style="direction: ltr!important; text-align: right;">{{ __('кв.м') }} / {{ $layout->price_size['EUR'] }}</span>
                                                                        <span data-exchange="usd" class="valute" style="direction: ltr!important; text-align: right;">{{ __('кв.м') }} / {{ $layout->price_size['USD'] }}</span>
                                                                        <span data-exchange="gbp" class="valute" style="direction: ltr!important; text-align: right;">{{ __('кв.м') }} / {{ $layout->price_size['GBP'] }}</span>
                                                                        <span data-exchange="try" class="valute lira" style="direction: ltr!important; text-align: right;">{{ __('кв.м') }} / {{ $layout->price_size['TRY'] }}</span>
                                                                        <span data-exchange="rub" class="valute" style="direction: ltr!important; text-align: right;">{{ __('кв.м') }} / {{ $layout->price_size['RUB'] }}</span>
                                                                    </div>
                                                                    <div class="kompleks__layout-square" bis_skin_checked="1">
                                                                        {{ __('кв.м') }} {{ $layout->total_size }}  <span>|</span>  {{ $layout->number_rooms }}

                                                                    </div>
                                                                    <div class="kompleks__layout-price-month" bis_skin_checked="1" style="direction: ltr!important; text-align: right;">
                                                                        {{ __('мес') }} / {{ $layout->price_credit['EUR'] }}
                                                                    </div>
                                                                @else
                                                                    <div class="kompleks__layout-price" bis_skin_checked="1">
                                                                        <span data-exchange="eur" class="valute active">{{ $layout->price['EUR'] }}</span>
                                                                        <span data-exchange="usd" class="valute">{{ $layout->price['USD'] }}</span>
                                                                        <span data-exchange="gbp" class="valute">{{ $layout->price['GBP'] }}</span>
                                                                        <span data-exchange="try" class="valute lira">{{ $layout->price['TRY'] }}</span>
                                                                        <span data-exchange="rub" class="valute">{{ $layout->price['RUB'] }}</span>
                                                                    </div>
                                                                    <div class="kompleks__layout-price-meter"bis_skin_checked="1">
                                                                        <span data-exchange="eur" class="valute active">{{ $layout->price_size['EUR'] }} / {{ __('кв.м') }}</span>
                                                                        <span data-exchange="usd" class="valute">{{ $layout->price_size['USD'] }} / {{ __('кв.м') }}</span>
                                                                        <span data-exchange="gbp" class="valute">{{ $layout->price_size['GBP'] }} / {{ __('кв.м') }}</span>
                                                                        <span data-exchange="try" class="valute lira">{{ $layout->price_size['TRY'] }} / {{ __('кв.м') }}</span>
                                                                        <span data-exchange="rub" class="valute">{{ $layout->price_size['RUB'] }} / {{ __('кв.м') }}</span>
                                                                    </div>
                                                                    <div class="kompleks__layout-square" bis_skin_checked="1">
                                                                        {{ $layout->total_size }} {{ __('кв.м') }} <span>|</span>  {{ $layout->number_rooms }}

                                                                    </div>
                                                                    <div class="kompleks__layout-price-month" bis_skin_checked="1">
                                                                        {{ $layout->price_credit['EUR'] }} / {{ __('мес') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="kompleks__layout-scheme" bis_skin_checked="1">
                                                                <div class="kompleks__layout-img" data-productid="{{ $product->id }}" bis_skin_checked="1">
                                                                    @if(isset($layout->photos) && count($layout->photos) > 0)
                                                                        @php
                                                                            $photoPaths = [];
                                                                            foreach($layout->photos as $photo) {
                                                                                $photoPaths[] = asset($photo->url);
                                                                            }
                                                                            $jsonPhotoPaths = json_encode($photoPaths);
                                                                        @endphp
                                                                        <div class="srs-for-photos" data-src-photos='{{ $jsonPhotoPaths }}'>
                                                                            @foreach($layout->photos as $photo)
                                                                                <img data-objectid="{{ $layout->id }}" style="max-width: 100px;" src="{{ asset($photo->url) }}" alt="scheme">
                                                                                @break
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="object__peculiarities">
                                        <div class="object__peculiarities-title place__title">
                                            {{__('Особенности')}}
                                        </div>
                                        <div class="object__peculiarities-content">
                                            @if(!is_array($product->peculiarities) && !is_null($product->peculiarities))
                                                @if(!is_null($product->peculiarities->where('type', 'Особенности')))
                                                    @foreach($product->peculiarities->where('type', 'Особенности') as $osob)
                                                        <div class="object__peculiarities-item">
                                                            {{__($osob->name)}}
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @else
                                                {{ __('Нет') }}
                                            @endif
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
                                                        @foreach($get_footer_link as $link)
                                                            <a href="{{ route('about', $link->slug) }}" class="footer__nav-item">
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
                    <form class="default-form form-fio-phone" id="">
                        <div class="title">{{ __('Заявка на бронь') }}</div>
                        <label class="field name input-wrapper" bis_skin_checked="1">
                            <span class="text">
                                {{__('ФИО')}}
                            </span>
                            <input type="text" value="" placeholder="{{ __('Иванов Алексей Петрович') }}" name="fio">
                        </label>
                        <div class="contact__form-phone input-wrapper">
                            <span class="text">
                                {{__('Номер телефона')}}
                            </span>
                            <input class="selector-list-phone" id="phone" name="phone" placeholder="(999) 999-99-99">
                        </div>
                        <label class="contact__form-politic">
                            <input class="contact__form-politic-checkbox contact__form-checkbox " type="checkbox" id="contact__form-politic" checked="">
                            <div class="contact__form-custom-checkbox one_check"></div>
                            <div class="contact__form-checkbox-text">
                                {{__('Ознакомлен с')}} <span>{{__('политикой конфеденциальности')}}</span>
                            </div>
                        </label>
                        <label class="contact__form-data">
                            <input class="contact__form-data-checkbox contact__form-checkbox" type="checkbox" id="contact__form-data">
                            <div class="contact__form-custom-checkbox two_check"></div>
                            <div class="contact__form-checkbox-text">
                                {{__('Согласен на обработку')}} <span>{{__('персональных данных')}}</span>
                            </div>
                        </label>
                        <button type="submit" class="btn">
                            {{ __('Отправить заявку') }}
                        </button>
                        <input type="hidden" name="product_id" value="">
                        <input type="hidden" name="country" value="">
                        <input
                            type="hidden"
                            value="{{ !is_null(Session::get('utm_source')) ? Session::get('utm_source') : null }}"
                            id="utm_source"
                            name="utm_source"
                        >
                        <input
                            type="hidden"
                            value="{{ !is_null(Session::get('utm_medium')) ? Session::get('utm_medium') : null }}"
                            id="utm_medium"
                            name="utm_medium"
                        >
                        <input
                            type="hidden"
                            value="{{ !is_null(Session::get('utm_campaign')) ? Session::get('utm_campaign') : null }}"
                            id="utm_campaign"
                            name="utm_campaign"
                        >
                        <input
                            type="hidden"
                            value="{{ !is_null(Session::get('utm_term')) ? Session::get('utm_term') : null }}"
                            id="utm_term"
                            name="utm_term"
                        >
                        <input
                            type="hidden"
                            value="{{ !is_null(Session::get('utm_content')) ? Session::get('utm_content') : null }}"
                            id="utm_content"
                            name="utm_content"
                        >
                        <input
                            type="hidden"
                            value="{{ request()->url() }}"
                            id="referer"
                            name="referer"
                        >
                        <input
                            type="hidden"
                            value="{{ isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null }}"
                            id="ip"
                            name="ip"
                        >
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

<script src="{{ asset('project/js/url_functions.js') }}"></script>
<script>
const swiperObject = new Swiper(".objects__swiper", {
    slidesPerView: 4,
    spaceBetween: 20,
    pagination: {
        el: ".objects__pagination",
        clickable: !0,
    },
    navigation: {
        nextEl: ".objects__next",
        prevEl: ".objects__prev"
    },
    on: {
        init: function () {
            // swiperObject.update()
        },
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

})
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
                replaceUrlWithObject(window.filter_params_data, blockBtn.getAttribute('data_slug'));
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

            // var urlParams = getValuesFromUrl();
            // var object = checkPosition(urlParams, 'object-');
            // if (object) {
            //     urlParams = deleteUrlParameter(object, urlParams);
            // }
            // updateUrl(window.filter_params_data, urlParams, false);
            history.back();
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
<script>
const currentUrl = window.location.href;
const url = new URL(currentUrl);
const searchParams = url.searchParams;
const objectIdFromUrl = searchParams.get('object');
if(objectIdFromUrl) getObjectById()

async function getObjectById() {
    const currentUrl = window.location.href;
    const url = new URL(currentUrl);
    const searchParams = url.searchParams;
    const objectIdFromUrl = searchParams.get('object');
    $.ajax({
        url: `/api/houses/simple?id=${objectIdFromUrl}`,
        method: 'get',
        success: function (data) {
            setNewPopupHouseData(data);
        }
    });
}
function setNewPopupHouseData(object) {
        replaceUrlWithObject(window.filter_params_data, object.slug);
        console.log(object);

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
        if (currentHouse.size) {
            Object.entries(currentHouse.size).forEach(function ([currencyCode, currencyPrice]) {
                let div = document.createElement('div')
                div.classList.add('place__square-item')
                div.setAttribute('data-exchange', currencyCode)
                div.classList.add('valute')
                div.innerHTML = `${((currencyPrice))} {{ __('кв.м') }}`

                if (currencyCode === dataExchange) {
                    div.classList.add('active')
                }

                divSquare.appendChild(div)
            })
        }

        // цена в попапе
        if (currentHouse.layouts && currentHouse.layouts.length > 0) {
            Object.keys(currentHouse.price).forEach(function (currencyCode, price) {
                const currencyCodePrice = document.querySelector(`.place__exchange-${currencyCode}`)
                const spanPriceBlock = currencyCodePrice.querySelector('span')
                const bPriceBlock = currencyCodePrice.querySelector('b')
                let currentPrice
                const chemes = JSON.parse(currentHouse.objects)
                if(currentHouse.layouts.length > 1) {
                    if(window.locale === 'fa' || window.locale === 'ar') {
                        currentPrice = currentHouse.price[currencyCode] + ` {{ __('от') }}`;
                    } else {
                        currentPrice = `{{ __('от') }} ` + currentHouse.price[currencyCode];
                    }
                } else {
                    currentPrice = currentHouse.price[currencyCode];
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

        // deadline - срок сдачи
        const deadlineBlock = document.querySelector('.place__deadline');

        if(currentHouse.deadline) {
            const deadlineTitle = deadlineBlock.querySelector('.place__deadline-title')
            deadlineTitle.innerHTML = currentHouse.deadline;
        } else {
            deadlineBlock.style.display = 'none';
        }

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
        const objects = [...currentHouse.layouts]

        if(objects.length >= 2) {
            objectRooms.style.display = 'none'
        }

        //карта
        const currentMap = document.querySelector('.current-map')
        const currentMapID = document.querySelector('#place-map')
        const div_id = 'place-map'
        ymaps.ready(function() {
            currentMapID.innerHTML = ''
            placeMap = new ymaps.Map(div_id, {
                center: [currentHouse.lat, currentHouse.long],
                zoom: 10,
            });
            placeMap.controls.remove('geolocationControl'); // удаляем геолокацию
            placeMap.controls.remove('searchControl'); // удаляем поиск
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

            // var localedName = 'name';
            var localedName;
            console.log(window.locale);
            console.log(element.locale_fields);
            if (window.locale) {
                localedName = element.locale_fields.find(x => x.locale.code == window.locale);
            } else {
                localedName = element.locale_fields.find(x => x.locale.code == "ru");
            }
            // if (window.locale) {
            //     if (window.locale !== 'ru') {
            //         localedName += '_'+window.locale;
            //     }
            // }
            console.log(localedName.name);
            div.innerHTML = localedName.name[0].toUpperCase() + localedName.name.substring(1);
            objectPeculiarities.appendChild(div)
        });

        // сортиторвка квартир
        const kompleksLayoutSort = document.querySelector('.kompleks__layout-sort')
        kompleksLayoutSort.innerHTML = ''

        let chemesSet = new Set()
        objects.forEach(object => {
            const div = document.createElement('div')
            div.classList.add('kompleks__sort-item')
            div.innerHTML = object.number_rooms
            div.setAttribute('data-cheme',object.number_rooms)
            if(!chemesSet.has(object.number_rooms)) {
                chemesSet.add(object.number_rooms)
                kompleksLayoutSort.appendChild(div)
            }
        });

        if(chemesSet.size <=1) {
            kompleksLayoutSort.style.display = 'none'
        } else {
            kompleksLayoutSort.style.display = 'flex'
        }
        // планировки квартир
        const kompleksLayoutList = document.querySelector('.kompleks__layout-list')
        kompleksLayoutList.innerHTML = ''

        const kompleks__layout = document.querySelector('.kompleks__layout')
        kompleks__layout.style.display = 'none'
        if(currentHouse.layouts !== null && currentHouse.layouts !== '[]')
        if(currentHouse.layouts.length !== 0) {
            kompleks__layout.style.display = 'block'

            objects.forEach((object, index) => {
                let divItem = document.createElement('div')
                divItem.classList.add('kompleks__layout-item')
                divItem.setAttribute('data-cheme',object.number_rooms)

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

                    if (window.locale === 'ar' || window.locale === 'fa') {
                        span.style.direction = 'ltr';
                        span.style.textAlign = 'right';
                    }

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

                    if(window.locale === 'fa' || window.locale === 'ar') {
                        span.style.textAlign = 'right';
                        span.style.direction = 'ltr';
                        span.innerHTML = `{{ __('кв.м') }} ${((currencyPrice))}`
                    } else {
                        span.innerHTML = `${((currencyPrice))} {{ __('кв.м') }}`
                    }

                    if(currencyCode === dataExchange) {
                        span.classList.add('active')
                    }

                    divMeter.appendChild(span)

                })
                divInfo.appendChild(divMeter)

                let divSquare = document.createElement('div')
                divSquare.classList.add('kompleks__layout-square')

                if(window.locale === 'fa' || window.locale === 'ar') {
                    divSquare.style.textAlign = 'right';
                    divSquare.style.direction = 'ltr';
                    divSquare.innerHTML = `{{ __('кв.м') }} ${object.total_size} <span>|</span> ${object.number_rooms}`
                } else {
                    divSquare.innerHTML = `${object.total_size} {{ __('кв.м') }} <span>|</span> ${object.number_rooms}`
                }
                divInfo.appendChild(divSquare)

                let divMonth = document.createElement('div')
                divMonth.classList.add('kompleks__layout-price-month')
                Object.entries(object.price_credit).forEach(function([currencyCode, currencyPrice]) {
                    let span = document.createElement('span')
                    span.setAttribute('data-exchange', currencyCode)
                    span.classList.add('valute')
                    span.classList.add('lira')

                    if(window.locale === 'fa' || window.locale === 'ar') {
                        span.style.textAlign = 'right';
                        span.style.direction = 'ltr';
                        span.innerHTML = `{{ __('мес') }} / ${((currencyPrice))}`
                    } else {
                        span.innerHTML = `${((currencyPrice))} / {{ __('мес') }}`
                    }

                    if(currencyCode === dataExchange) {
                        span.classList.add('active')
                    }

                    divMonth.appendChild(span)

                })

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
                    object.photos.forEach(photo => {
                        const slide = document.createElement('div')
                        const slidePic = document.createElement('img')

                        if(photo.name) {
                            const floor = document.createElement('div')
                            floor.classList.add('object__swiper-slide-floor')
                            floor.innerHTML = photo.name
                            slide.appendChild(floor)
                        }


                        slide.classList.add('swiper-slide')
                        slide.classList.add('object__swiper-slide')
                        slide.appendChild(slidePic)
                        slidePic.setAttribute('src', `/${photo.url}`)
                        swiperWrapper.appendChild(slide)

                    });

                    if(object.photos.length <= 1) {
                        objectSwiperNav.forEach(btn => {
                            btn.style.display = 'none'
                        });
                    } else {
                        objectSwiperNav.forEach(btn => {
                            btn.style.display = 'flex'
                        });
                    }

                    objectSwiper.update()
                    objectSwiper.updateSlides()
                    objectSwiper.slideTo(0)
                    objectSwiper.updateProgress()
                    const text = document.querySelector(".object__photo-info")
                    const infoForTextBlock = containerItem.querySelector(".kompleks__layout-info")
                    text.innerHTML = infoForTextBlock.innerHTML
                    chemePopup.classList.add('active')

                })


                let divChemeImg = document.createElement('img')
                divChemeImg.setAttribute('src', `/${object.photos[0].url}`)

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
        placeLocationInfo.innerHTML = currentHouse.disposition

        //Описание
        const placeDescription = document.querySelector('.object__description-text')
        placeDescription.innerHTML = currentHouse.description

        setListenersToOpenCollage()
        addNewImagesToSwiper()
        addNewImagesToPlaceSwiper(currentHouse)
        setListenersToOpenCollageBySlide()
        addNewImagesToCollage(currentHouse)
    }
</script>

<script>
//закрытие на темную область
if(document.querySelectorAll('.place-w').length) {
    const placeW = document.querySelectorAll('.place-w')
    const currentUrl = window.location.href;
    const url = new URL(currentUrl);
    placeW.forEach(placeBlock => {
        placeBlock.addEventListener('click', function(e) {
            const target = e.target
            if(target.classList.contains('place-w')) {
                placeBlock.classList.remove('active')
                var urlParams = getValuesFromUrl();
                var object = checkPosition(urlParams, 'object-');
                if (object) {
                    urlParams = deleteUrlParameter(object, urlParams);
                }
                updateUrl(window.filter_params_data, urlParams, false);
            }
            if(target.classList.contains('_country')) {
                const placeTopImg = document.querySelector('.place__top-img').querySelector('img')
                const placeLeftCollage = document.querySelector('.place__left-collage')
                placeLeftCollage.innerHtml = ''
                placeTopImg.setAttribute('src', '')
            }
        })
    });
}

// if(document.querySelectorAll('.kompleks__layout-img').length) {
//     const chemePic = document.querySelectorAll('.kompleks__layout-img')
//     const chemePopup = document.querySelector(".object__photo");

//     const text = document.querySelector(".object__photo-info")

//     const swiperWrapper = document.querySelector(".object__swiper-wrapper");
//     const objectSwiperNav = document.querySelectorAll(".object__swiper-nav");

//     chemePic.forEach(pic => {
//         pic.addEventListener('click', function(e) {
//             swiperWrapper.innerHTML = ''
//             const container = this.closest('.kompleks__layout-item')
//             let srsForPhotos = container.querySelector('.srs-for-photos').getAttribute('data-src-photos')
//             srsForPhotos = JSON.parse(srsForPhotos)

//             srsForPhotos.forEach(photo => {
//                 const slide = document.createElement('div')
//                 const slidePic = document.createElement('img')

//                 if(photo.name) {
//                     const floor = document.createElement('div')
//                     floor.classList.add('object__swiper-slide-floor')
//                     floor.innerHTML = photo.name
//                     slide.appendChild(floor)
//                 }

//                 slide.classList.add('swiper-slide')
//                 slide.classList.add('object__swiper-slide')
//                 slide.appendChild(slidePic)
//                 slidePic.setAttribute('src', photo)
//                 swiperWrapper.appendChild(slide)

//             });

//             if(srsForPhotos.length <= 1) {
//                 objectSwiperNav.forEach(btn => {
//                     btn.style.display = 'none'
//                 });
//             } else {
//                 objectSwiperNav.forEach(btn => {
//                     btn.style.display = 'flex'
//                 });
//             }

//             objectSwiper.update()
//             objectSwiper.updateSlides()
//             objectSwiper.slideTo(0)
//             const text = document.querySelector(".object__photo-info")
//             const infoForTextBlock = container.querySelector(".kompleks__layout-info")
//             text.innerHTML = infoForTextBlock.innerHTML
//             chemePopup.classList.add('active')
//         })
//     });

// }
</script>

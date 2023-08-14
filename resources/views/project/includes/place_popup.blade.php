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
                    <?php  $get = \App\Models\favorite::where('user_id', isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null )->where('product_id', $product->id)->first() ?>
                    <div class="place__header-favorite check-favorites {{ $get == null ? '' : 'active' }}" data_id="{{$product->id}}">
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
                                <img src="{{asset('uploads/'.$product->photo[0]->photo)}}" alt="object">
                            </div>
                        </div>
                        <div class="place__left-collage">
                            @foreach($product->photo->where('id','!=',$product->photo[0]->id) as $photo)
                            <div class="place__collage-item place__collage-item_clickable">
                                <img src="{{asset('uploads/'.$photo->photo)}}" alt="object">
                            </div>
                                @endforeach
                        </div>
                    </div>
                    <div class="place__slider">
                        <div class="place__swiper swiper">
                            <div class="place__wrapper swiper-wrapper">
                                @foreach($product->photo as $photo)
                                <div class="place__slide swiper-slide place__slide_clickable">
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
                        <?php  $get = \App\Models\favorite::where('user_id', isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null )->where('product_id', $product->id)->first() ?>
                        <div class="place__top-favorites check-favorites {{ $get == null ? '' : 'active' }}" data_id="{{$product->id}}">
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
                                    <div class="place__exchange-EUR"><span>{{ number_format($product->price, 0, '.', ' ') }}</span><b> €</b></div>
                                    <div class="place__exchange-USD" style="display: none;"><span>{{ number_format(intval($product->price * $exchanges['USD']), 0, '.', ' ') }}</span><b> $</b></div>
                                    <div class="place__exchange-RUB" style="display: none;"><span>{{ number_format(intval($product->price * $exchanges['RUB']), 0, '.', ' ') }}</span><b> ₽</b></div>
                                    <div class="place__exchange-TRY" style="display: none;"><span>{{ number_format(intval($product->price * $exchanges['TRY']), 0, '.', ' ') }}</span><b class="lira"> ₺</b></div>
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
                                ID: {{$product->id}}
                            </div>
                            <div class="place__address">
                                {{$product->address}}
                            </div>
                            <div class="place__square">
                                <div class="place__square-EUR">{{ number_format(intval((int)$product->price / ((int)$product->size ?: 1)), 0, '.', ' ') }}  €  / кв.м</div>
                                <div class="place__square-USD" style="display: none;">{{ number_format(intval((int)$product->price * $exchanges['USD'] / ((int)$product->size ?: 1)), 0, '.', ' ') }}  $  / кв.м</div>
                                <div class="place__square-RUB" style="display: none;">{{ number_format(intval((int)$product->price * $exchanges['RUB'] / ((int)$product->size ?: 1)), 0, '.', ' ') }}  ₽  / кв.м</div>
                                <div class="place__square-TRY" style="display: none;">{{ number_format(intval((int)$product->price * $exchanges['TRY'] / ((int)$product->size ?: 1)), 0, '.', ' ') }}  <span class="lira"> ₺ </span>  / кв.м</div>
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
                            @if($product->complex_or_not == 'Нет' || !is_null($product->complex_or_not))
                            <div class="object__rooms">
                                <div class="object__rooms-content">
                                    <div class="object__rooms-item">
                                        <div class="object__rooms-subtitle">
                                            {{__('Общая площадь')}}
                                        </div>
                                        <div class="object__rooms-value">
                                        {{$product->size}} {{__('кв.м')}}
                                        </div>
                                    </div>
                                    <div class="object__rooms-item">
                                        <div class="object__rooms-subtitle">
                                            {{__('Спален')}}
                                        </div>
                                        <div class="object__rooms-value">
                                        <?php $spalni = \App\Models\ProductCategory::where('type', 'Спальни')->where('product_id', $product->id)->first(); ?>
                                            {{ str_replace('+','',$spalni->category->name)}}
                                        </div>
                                    </div>
                                    <div class="object__rooms-item">
                                        <div class="object__rooms-subtitle">
                                            {{__('Гостиные')}}
                                        </div>
                                        <div class="object__rooms-value">
                                            <?php $spalni = \App\Models\ProductCategory::where('type', 'Гостиные')->where('product_id', $product->id)->first(); ?>
                                            {{str_replace('+','',__($spalni->category->name))}}
                                        </div>
                                    </div>
                                    <div class="object__rooms-item">
                                        <div class="object__rooms-subtitle">
                                            {{__('Ванные')}}
                                        </div>
                                        <div class="object__rooms-value">
                                            <?php $spalni = \App\Models\ProductCategory::where('type', 'Ванные')->where('product_id', $product->id)->first(); ?>
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
                                                    let placemark = new ymaps.Placemark([latitude, longitude]);
                                                    map.geoObjects.add(placemark);
                                                });
                                            }
                                            createYandexMap(<?php echo $product->lat.','.$product->long?>);
                                        </script>
                                        <div id="place-map{{$product->id}}" style="width: 100%; height: 165px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="kompleks__layout" bis_skin_checked="1">
                                <div class="kompleks__layout-content" bis_skin_checked="1">
                                    <div class="kompleks__layout-title place__title" bis_skin_checked="1">
                                        Планировки квартир
                                    </div>
                                    <div class="kompleks__layout-list" bis_skin_checked="1">
                                        @if(!is_null(json_decode($product->objects)))
                                            @foreach(json_decode($product->objects) as $object)
                                            <div class="kompleks__layout-item" bis_skin_checked="1">
                                                <div class="kompleks__layout-info" bis_skin_checked="1">
                                                    <div class="kompleks__layout-option" bis_skin_checked="1">
                                                        {{ $object->building }}
                                                    </div>
                                                    <div class="kompleks__layout-price" bis_skin_checked="1">
                                                        $ {{ number_format($object->price, 0, '.', ' ') }}
                                                    </div>
                                                    <div class="kompleks__layout-price-meter" bis_skin_checked="1">
                                                        $ {{ number_format(intval((int) $object->price / ((int) $object->size  ?: 1)), 0, '.', ' ') }} / кв.м
                                                    </div>
                                                    <div class="kompleks__layout-square" bis_skin_checked="1">
                                                        {{ $object->size }}  <span>|</span>  {{ $object->apartment_layout }}

                                                    </div>
                                                    <div class="kompleks__layout-price-month" bis_skin_checked="1">
                                                        $645 / мес.
                                                    </div>
                                                </div>
                                                <div class="kompleks__layout-scheme" bis_skin_checked="1">
                                                    <div class="kompleks__layout-img" data-productid="{{ $product->id }}" bis_skin_checked="1">
                                                        @if(isset($object->apartment_layout_image))
                                                            <img data-objectid="{{ $object->id }}" style="max-width: 100px;" src="{{ asset('uploads/'.$object->apartment_layout_image) }}" alt="scheme">
                                                        @else
                                                            <img data-objectid="{{ $object->id }}" style="max-width: 100px;" src="{{ asset('uploads/') }}" alt="scheme">
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
                                    <?php $osobenosty = \App\Models\ProductCategory::where('type', 'Особенности')->where('product_id', $product->id)->get() ?>
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
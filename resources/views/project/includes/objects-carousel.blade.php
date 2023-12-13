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
                                                $euroPrice = str_replace(' €', '', $product->price['EUR']);
                                            @endphp
                                            @if (count($product->layouts) > 1)
                                                {{ "€ " . $euroPrice . " +" }}
                                            @else
                                                {{ "€ " . $euroPrice }}
                                            @endif
                                        @else
                                            {{ "€ " . str_replace(' €', '', $product->price['EUR']) }}
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
function setListenersToOpenPopup() {
    const container = document.querySelector('.objects-slider__content')
    container.addEventListener('click', function(e) {
        const houseCard = e.target.closest('.objects__slide');
        if (!houseCard) return
        const id = houseCard.getAttribute('data_id')
        const object = {
            id: id
        }
        getObjectBySimpleRequest(object)
    })

}
setListenersToOpenPopup()
</script>
@foreach($products as $product)
<div class="city-col__item" id="card_object-{{ $product->id }}" data_id="{{ $product->id }}" data_slug="{{ $product->slug }}" php>
    <div class="city-col__slider">
        <div class="city__swiper swiper">
            <div class="city__wrapper swiper-wrapper">
                @foreach($product->limitPhoto as $photo)
                    <div class="city__slide swiper-slide">
                        <div class="city-col__item-img"><img src="{{ '/uploads/' . $photo->photo }}" alt="place"></div>
                    </div>
                @endforeach
            </div>
            <div class="city__scrollbar">
            </div>
        </div>
    </div>
    <div class="objects__slide-favorites check-favorites @if(count($product->favorite) > 0) active @endif" data_id="{{ $product->id }}">
        <svg class="blue" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="73px" height="64px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 2.33 2.04" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Слой_x0020_1">
                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                <path class="fil0 str0" d="M1.16 1.88c-0.22,-0.16 -0.5,-0.38 -0.77,-0.65 -0.2,-0.19 -0.26,-0.37 -0.26,-0.55 0,-0.31 0.26,-0.55 0.58,-0.55 0.18,0 0.35,0.08 0.45,0.21 0.11,-0.13 0.28,-0.21 0.46,-0.21 0.32,0 0.58,0.24 0.58,0.55 0,0.18 -0.06,0.36 -0.26,0.55 -0.27,0.27 -0.56,0.49 -0.78,0.65z"></path>
            </g>
        </svg>
    </div>
    <div class="die__list">
        @foreach($product->tags as $tag)
            <div class="die__list-item">{{ $tag }}</div>
        @endforeach
    </div>
    <div class="city-col__item-text">
        @if(count($product->layouts) > 1)
            <div class="city-col__item-price">€ {{ number_format($product->min_price, 0, '.', ' ') }}  +</div>
        @else
            <div class="city-col__item-price">€ {{ number_format($product->min_price, 0, '.', ' ') }}</div>
        @endif
        @if(isset($product->number_rooms_unique) && !empty($product->number_rooms_unique))
            <div class="city-col__item-rooms">{{ $product->number_rooms_unique }}</div>
        @else
            <div class="city-col__item-rooms">{{ $product->size }} кв.м | {{ (int)$product->spalni }} спальни | {{ (int)$product->vanie }} ванные</div>
        @endif
        @if(!is_null($product->deadline))<div class="city-col__item-deadline">{{ $product->deadline }}</div>@endif
        <div class="city-col__item-address">{{ $product->address }}</div>
    </div>
</div>
@endforeach


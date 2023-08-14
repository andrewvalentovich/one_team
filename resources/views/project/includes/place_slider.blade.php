<div class="place__slider_p">
    <div class="place__slider_p-swiper swiper">
        <div class="place__slider_p-wrapper swiper-wrapper">
            <div class="place__slider_p-slide swiper-slide">
                <div class="place__slider_p-img">
                    <img src="{{asset('uploads/'.$product->photo[0]->photo)}}">
                </div>
            </div>
            @foreach($product->photo->where('id', '!=', $product->photo[0]->id) as $photos)
            <div class="place__slider_p-slide swiper-slide">
                <div class="place__slider_p-img">
                    <img src="{{asset('uploads/'.$photos->photo)}}">
                </div>
            </div>
            @endforeach
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
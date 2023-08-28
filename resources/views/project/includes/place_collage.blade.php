<div class="place-popup-collage" data_id="{{$product->id}}">
    <div class="place-popup-collage__content">
        <div class="place-popup-collage__top">
            <div class="place_popup__top-item">
                <img src="{{asset('uploads/'.$product->photo[0]->photo)}}" alt="object">
            </div>
        </div>
        <div class="place-popup-collage__list">
            @foreach($product->photo->where('id','!=',$product->photo[0]->id) as $photo)
                <div class="place-popup-collage__item">
                    <img src="{{asset('uploads/'.$photo->photo)}}" alt="object">
                </div>
            @endforeach
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
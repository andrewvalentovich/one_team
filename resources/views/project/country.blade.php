@extends('project.includes.layouts')
<script src="https://api-maps.yandex.ru/2.1/?lang={{ app()->getLocale() }}_RU&amp;apikey=2a0f0e9d-44f3-4f13-8628-12588d752fc3" type="text/javascript"></script>



@section('header')

    @include('project.includes.header')

@endsection



<style>

    /*.objects__slide{*/

    /*    max-height: 360px;*/

    /*}*/

    .objects__wrapper {

        height: auto !important;

    }

</style>



@section('content')
    @if(app()->getLocale() == 'ru')
        <?php $country->name = $country->name ?>
    @elseif(app()->getLocale() == 'en')
        <?php $country->name = $country->name_en ?>

    @elseif(app()->getLocale() == 'tr')
        <?php $country->name = $country->name_tr ?>

    @endif

{{--    @include('project.includes.search_nav_bar')--}}



    <section class="country-map">

        <div class="country-map__content">

            <div id="map-country">

            </div>

        </div>

    </section>

    <section class="realty container">

        <div class="realty__title title">

          {{__('Недвижимость')}}  {{__('в')}}@if($country->name == 'Турция') Турции  @else {{$country->name}} @endif

        </div>

        <div class="realty__subtitle">

          {{__('Всего')}}  {{numbers_graduation($country->product_country->count())}}

        </div>

        <!-- 9 блоков -->
        @if($count >= 8)
        <div class="realty__content" style="display:flex !important">
            <div class="realty__left-col">
                <div class="realty__left-col_1">
                    <div class="realty__item realty__item_b" >
                        <div class="realty__img_b">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[0]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[0]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[0]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[0]->name_de}}  @endif</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                    <div class="realty__left-col_1-footer">
                        <div class="realty__item realty__item_s">
                            <div class="realty__img_s">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}">  <img  src="{{asset("uploads/".$country->cities[1]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[1]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[1]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[1]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[1]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                        <div class="realty__item realty__item_s">
                            <div class="realty__img_s">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}">  <img src="{{asset("uploads/".$country->cities[2]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[2]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[2]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[2]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[2]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}" style="color: white">   {{numbers_graduation($country->cities[2]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__left-col_2" >
                    <div class="realty__left-col_2-top" >
                        <div class="realty__item realty__item_s" >
                            <div class="realty__img_s">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[3]->id])}}">      <img  src="{{asset('uploads/'.$country->cities[3]->photo)}}" alt="{{$country->cities[3]->name}}"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[3]->id])}}" style="color: white">   @if( app()->getLocale()  == 'ru' ) {{$country->cities[3]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[3]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[3]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[3]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[3]->id])}}" style="color: white">   {{numbers_graduation($country->cities[3]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                        <div class="realty__item realty__item_s" >
                            <div class="realty__img_s">
                                <a href="{{ route('houses.index', ['city_id' => $country->cities[4]->id])}}">
                                    <img src="{{asset('uploads/'.$country->cities[4]->photo)}}" alt="{{$country->cities[4]->name}}">
                                </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[4]->id])}}" style="color: white">@if( app()->getLocale()  == 'ru' ) {{$country->cities[4]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[4]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[4]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[4]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[4]->id])}}" style="color: white">   {{numbers_graduation($country->cities[4]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realty__item realty__item_m" >
                        <div class="realty__img_m">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[5]->id])}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>
                        </div>
                        <div class="realty__img_m realty__img_mob">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[5]->id])}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[5]->id])}}" style="color: white">       @if( app()->getLocale()  == 'ru' ) {{$country->cities[5]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[5]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[5]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[5]->name_de}}  @endif </a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[5]->id])}}" style="color: white">      {{numbers_graduation($country->cities[5]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="realty__right-col">
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['city_id' => $country->cities[6]->id])}}">    <img src="{{asset('uploads/'.$country->cities[6]->photo)}}" alt="{{$country->cities[6]->name}}"> </a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[6]->id])}}" style="color: white">      @if( app()->getLocale()  == 'ru' ) {{$country->cities[6]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[6]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[6]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[6]->name_de}}  @endif </a>
                        </div>
                        <div class="realty__item-text-subtitle">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[6]->id])}}" style="color: white">   {{numbers_graduation($country->cities[6]->product_city->count())}}  </a>
                        </div>
                    </div>
                </div>
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['city_id' => $country->cities[7]->id])}}">  <img src="{{asset('uploads/'.$country->cities[7]->photo)}}" alt="{{$country->cities[7]->name}}"> </a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[7]->id])}}" style="color: white">  @if( app()->getLocale()  == 'ru' ) {{$country->cities[7]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[7]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[7]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[7]->name_de}}  @endif</a>
                        </div>
                        <div class="realty__item-text-subtitle">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[7]->id])}}" style="color: white">  {{numbers_graduation($country->cities[7]->product_city->count())}} </a>
                        </div>
                    </div>
                </div>
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['country_id' => $country->id])}}">  <img  src="{{asset('uploads/'.$country->cities[0]->photo)}}" alt="All-Turkey"></a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{ route('houses.index', ['country_id' => $country->id]) }}" style="color: white"> {{__('Вся')}} @if( app()->getLocale()  == 'ru' ) {{$country->name}} @elseif(app()->getLocale() == 'en') {{$country->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->name_de}}  @endif</a>
                        </div>
                        <div class="realty__item-text-subtitle">
                            <a href="{{ route('houses.index', ['country_id' => $country->id]) }}" style="color: white">      {{numbers_graduation($country->product_country->count())}} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- 8 блоков -->
        @if($count == 7)
        <div class="realty__content">
            <div class="realty__left-col">
                <div class="realty__left-col_1">
                    <div class="realty__item realty__item_b" >
                        <div class="realty__img_b">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[0]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[0]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[0]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[0]->name_de}}  @endif</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                    <div class="realty__left-col_1-footer">
                        <div class="realty__item realty__item_s">
                            <div class="realty__img_s">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}">  <img  src="{{asset("uploads/".$country->cities[1]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[1]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[1]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[1]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[1]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                        <div class="realty__item realty__item_s">
                            <div class="realty__img_s">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}">  <img src="{{asset("uploads/".$country->cities[2]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[2]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[2]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[2]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[2]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}" style="color: white">   {{numbers_graduation($country->cities[2]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__left-col_2" >
                    <div class="realty__left-col_2-top" >
                        <div class="realty__item realty__item_s" >
                            <div class="realty__img_s">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[3]->id])}}">      <img  src="{{asset('uploads/'.$country->cities[3]->photo)}}" alt="{{$country->cities[3]->name}}"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[3]->id])}}" style="color: white">   @if( app()->getLocale()  == 'ru' ) {{$country->cities[3]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[3]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[3]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[3]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[3]->id])}}" style="color: white">   {{numbers_graduation($country->cities[3]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                        <div class="realty__item realty__item_s" >
                            <div class="realty__img_s">
                                <a href="{{ route('houses.index', ['city_id' => $country->cities[4]->id])}}">
                                    <img src="{{asset('uploads/'.$country->cities[4]->photo)}}" alt="{{$country->cities[4]->name}}">
                                </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[4]->id])}}" style="color: white">@if( app()->getLocale()  == 'ru' ) {{$country->cities[4]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[4]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[4]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[4]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[4]->id])}}" style="color: white">   {{numbers_graduation($country->cities[4]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realty__item realty__item_m" >
                        <div class="realty__img_m">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[5]->id])}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>
                        </div>
                        <div class="realty__img_m realty__img_mob">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[5]->id])}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[5]->id])}}" style="color: white">       @if( app()->getLocale()  == 'ru' ) {{$country->cities[5]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[5]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[5]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[5]->name_de}}  @endif </a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[5]->id])}}" style="color: white">      {{numbers_graduation($country->cities[5]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="realty__right-col">
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['city_id' => $country->cities[6]->id])}}">    <img src="{{asset('uploads/'.$country->cities[6]->photo)}}" alt="{{$country->cities[6]->name}}"> </a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[6]->id])}}" style="color: white">      @if( app()->getLocale()  == 'ru' ) {{$country->cities[6]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[6]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[6]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[6]->name_de}}  @endif </a>
                        </div>
                        <div class="realty__item-text-subtitle">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[6]->id])}}" style="color: white">   {{numbers_graduation($country->cities[6]->product_city->count())}}  </a>
                        </div>
                    </div>
                </div>
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['country_id' => $country->id])}}">  <img  src="{{asset('uploads/'.$country->cities[0]->photo)}}" alt="All-Turkey"></a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white"> {{__('Вся')}} @if( app()->getLocale()  == 'ru' ) {{$country->name}} @elseif(app()->getLocale() == 'en') {{$country->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->name_de}}  @endif</a>
                        </div>
                        <div class="realty__item-text-subtitle">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- 7 блоков -->
        @if($count == 6)
        <div class="realty__content">
            <div class="realty__left-col">
                <div class="realty__left-col_1">
                    <div class="realty__item realty__item_b" >
                        <div class="realty__img_b">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[0]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[0]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[0]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[0]->name_de}}  @endif</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                    <div class="realty__left-col_1-footer">
                        <div class="realty__item realty__item_s">
                            <div class="realty__img_s">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}">  <img  src="{{asset("uploads/".$country->cities[1]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[1]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[1]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[1]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[1]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                        <div class="realty__item realty__item_s">
                            <div class="realty__img_s">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}">  <img src="{{asset("uploads/".$country->cities[2]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[2]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[2]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[2]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[2]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}" style="color: white">   {{numbers_graduation($country->cities[2]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__left-col_2" >
                    <div class="realty__left-col_2-top" >
                        <div class="realty__item realty__item_s" >
                            <div class="realty__img_s">
                                <a href="{{ route('houses.index', ['city_id' => $country->cities[4]->id])}}">
                                    <img src="{{asset('uploads/'.$country->cities[4]->photo)}}" alt="{{$country->cities[4]->name}}">
                                </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[4]->id])}}" style="color: white">@if( app()->getLocale()  == 'ru' ) {{$country->cities[4]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[4]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[4]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[4]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[4]->id])}}" style="color: white">   {{numbers_graduation($country->cities[4]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realty__item realty__item_m" >
                        <div class="realty__img_m">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[5]->id])}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>
                        </div>
                        <div class="realty__img_m realty__img_mob">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[5]->id])}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[5]->id])}}" style="color: white">       @if( app()->getLocale()  == 'ru' ) {{$country->cities[5]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[5]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[5]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[5]->name_de}}  @endif </a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[5]->id])}}" style="color: white">      {{numbers_graduation($country->cities[5]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="realty__right-col">
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['city_id' => $country->cities[6]->id])}}">    <img src="{{asset('uploads/'.$country->cities[6]->photo)}}" alt="{{$country->cities[6]->name}}"> </a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[6]->id])}}" style="color: white">      @if( app()->getLocale()  == 'ru' ) {{$country->cities[6]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[6]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[6]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[6]->name_de}}  @endif </a>
                        </div>
                        <div class="realty__item-text-subtitle">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[6]->id])}}" style="color: white">   {{numbers_graduation($country->cities[6]->product_city->count())}}  </a>
                        </div>
                    </div>
                </div>
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['country_id' => $country->id])}}">  <img  src="{{asset('uploads/'.$country->cities[0]->photo)}}" alt="All-Turkey"></a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white"> {{__('Вся')}} @if( app()->getLocale()  == 'ru' ) {{$country->name}} @elseif(app()->getLocale() == 'en') {{$country->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->name_de}}  @endif</a>
                        </div>
                        <div class="realty__item-text-subtitle">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- 6 блоков -->
        @if($count == 5)
        <div class="realty__content">
            <div class="realty__left-col">
                <div class="realty__left-col_1">
                    <div class="realty__item realty__item_b" >
                        <div class="realty__img_b">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}"><img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[0]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[0]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[0]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[0]->name_de}}  @endif</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                    <div class="realty__left-col_1-footer">
                        <div class="realty__item realty__item_s">
                            <div class="realty__img_s">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}">  <img  src="{{asset("uploads/".$country->cities[1]->photo)}}" alt="antalya"></a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[1]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[1]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[1]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[1]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__left-col_2" >
                    <div class="realty__left-col_2-top" >
                        <div class="realty__item realty__item_s" >
                            <div class="realty__img_s">
                                <a href="{{ route('houses.index', ['city_id' => $country->cities[2]->id])}}">
                                    <img src="{{asset('uploads/'.$country->cities[2]->photo)}}" alt="{{$country->cities[2]->name}}">
                                </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}" style="color: white">@if( app()->getLocale()  == 'ru' ) {{$country->cities[2]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[2]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[2]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[2]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}" style="color: white">   {{numbers_graduation($country->cities[2]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realty__item realty__item_m" >
                        <div class="realty__img_m">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[3]->id])}}">     <img src="{{asset('uploads/'.$country->cities[3]->photo)}}" alt="{{$country->cities[3]->name}}"> </a>
                        </div>
                        <div class="realty__img_m realty__img_mob">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[3]->id])}}">     <img src="{{asset('uploads/'.$country->cities[3]->photo)}}" alt="{{$country->cities[3]->name}}"> </a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[3]->id])}}" style="color: white">       @if( app()->getLocale()  == 'ru' ) {{$country->cities[3]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[3]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[3]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[3]->name_de}}  @endif </a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[3]->id])}}" style="color: white">      {{numbers_graduation($country->cities[3]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="realty__right-col">
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['city_id' => $country->cities[4]->id])}}">    <img src="{{asset('uploads/'.$country->cities[4]->photo)}}" alt="{{$country->cities[4]->name}}"> </a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[4]->id])}}" style="color: white">      @if( app()->getLocale()  == 'ru' ) {{$country->cities[4]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[4]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[4]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[4]->name_de}}  @endif </a>
                        </div>
                        <div class="realty__item-text-subtitle">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[4]->id])}}" style="color: white">   {{numbers_graduation($country->cities[4]->product_city->count())}}  </a>
                        </div>
                    </div>
                </div>
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['country_id' => $country->id])}}">  <img  src="{{asset('uploads/'.$country->cities[0]->photo)}}" alt="All-Turkey"></a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white"> {{__('Вся')}} @if( app()->getLocale()  == 'ru' ) {{$country->name}} @elseif(app()->getLocale() == 'en') {{$country->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->name_de}}  @endif</a>
                        </div>
                        <div class="realty__item-text-subtitle">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- 5 блоков -->
        @if($count == 4)
        <div class="realty__content">
            <div class="realty__left-col">
                <div class="realty__left-col_1">
                    <div class="realty__item realty__item_b" >
                        <div class="realty__img_b">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[0]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[0]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[0]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[0]->name_de}}  @endif</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__left-col_2" >
                    <div class="realty__left-col_2-top" >
                        <div class="realty__item realty__item_s" >
                            <div class="realty__img_s">
                                <a href="{{ route('houses.index', ['city_id' => $country->cities[1]->id])}}">
                                    <img src="{{asset('uploads/'.$country->cities[1]->photo)}}" alt="{{$country->cities[1]->name}}">
                                </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">@if( app()->getLocale()  == 'ru' ) {{$country->cities[1]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[1]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[1]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[1]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realty__item realty__item_m" >
                        <div class="realty__img_m">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}">     <img src="{{asset('uploads/'.$country->cities[2]->photo)}}" alt="{{$country->cities[2]->name}}"> </a>
                        </div>
                        <div class="realty__img_m realty__img_mob">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}">     <img src="{{asset('uploads/'.$country->cities[2]->photo)}}" alt="{{$country->cities[2]->name}}"> </a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}" style="color: white">       @if( app()->getLocale()  == 'ru' ) {{$country->cities[2]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[2]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[2]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[2]->name_de}}  @endif </a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}" style="color: white">      {{numbers_graduation($country->cities[2]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="realty__right-col">
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['city_id' => $country->cities[3]->id])}}">    <img src="{{asset('uploads/'.$country->cities[3]->photo)}}" alt="{{$country->cities[3]->name}}"> </a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[3]->id])}}" style="color: white">      @if( app()->getLocale()  == 'ru' ) {{$country->cities[3]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[3]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[3]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[3]->name_de}}  @endif </a>
                        </div>
                        <div class="realty__item-text-subtitle">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[3]->id])}}" style="color: white">   {numbers_graduation({$country->cities[3]->product_city->count())}}  </a>
                        </div>
                    </div>
                </div>
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['country_id' => $country->id])}}">  <img  src="{{asset('uploads/'.$country->cities[0]->photo)}}" alt="All-Turkey"></a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white"> {{__('Вся')}} @if( app()->getLocale()  == 'ru' ) {{$country->name}} @elseif(app()->getLocale() == 'en') {{$country->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->name_de}}  @endif</a>
                        </div>
                        <div class="realty__item-text-subtitle">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- 4 блоков -->
        @if($count == 3)
        <div class="realty__content">
            <div class="realty__left-col">
                <div class="realty__left-col_1">
                    <div class="realty__item realty__item_b" >
                        <div class="realty__img_b">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[0]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[0]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[0]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[0]->name_de}}  @endif</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__left-col_2" >
                    <div class="realty__left-col_2-top" >
                        <div class="realty__item realty__item_s" >
                            <div class="realty__img_s">
                                <a href="{{ route('houses.index', ['city_id' => $country->cities[1]->id])}}">
                                    <img src="{{asset('uploads/'.$country->cities[1]->photo)}}" alt="{{$country->cities[1]->name}}">
                                </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">@if( app()->getLocale()  == 'ru' ) {{$country->cities[1]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[1]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[1]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[1]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="realty__item realty__item_m" >
                        <div class="realty__img_m">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}">     <img src="{{asset('uploads/'.$country->cities[2]->photo)}}" alt="{{$country->cities[2]->name}}"> </a>
                        </div>
                        <div class="realty__img_m realty__img_mob">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}">     <img src="{{asset('uploads/'.$country->cities[2]->photo)}}" alt="{{$country->cities[2]->name}}"> </a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}" style="color: white">       @if( app()->getLocale()  == 'ru' ) {{$country->cities[2]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[2]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[2]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[2]->name_de}}  @endif </a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[2]->id])}}" style="color: white">      {{numbers_graduation($country->cities[2]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="realty__right-col">
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['country_id' => $country->id])}}">  <img  src="{{asset('uploads/'.$country->cities[0]->photo)}}" alt="All-Turkey"></a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white"> {{__('Вся')}} @if( app()->getLocale()  == 'ru' ) {{$country->name}} @elseif(app()->getLocale() == 'en') {{$country->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->name_de}}  @endif</a>
                        </div>
                        <div class="realty__item-text-subtitle">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- 3 блоков -->
        @if($count == 2)
        <div class="realty__content">
            <div class="realty__left-col">
                <div class="realty__left-col_1">
                    <div class="realty__item realty__item_b" >
                        <div class="realty__img_b">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[0]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[0]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[0]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[0]->name_de}}  @endif</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}} </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="realty__left-col_2" >
                    <div class="realty__left-col_2-top" >
                        <div class="realty__item realty__item_s" >
                            <div class="realty__img_s">
                                <a href="{{ route('houses.index', ['city_id' => $country->cities[1]->id])}}">
                                    <img src="{{asset('uploads/'.$country->cities[1]->photo)}}" alt="{{$country->cities[1]->name}}">
                                </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">@if( app()->getLocale()  == 'ru' ) {{$country->cities[1]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[1]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[1]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[1]->name_de}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('houses.index', ['city_id' => $country->cities[1]->id])}}" style="color: white">   {{numbers_graduation($country->cities[1]->product_city->count())}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="realty__right-col">
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['country_id' => $country->id])}}">  <img  src="{{asset('uploads/'.$country->cities[0]->photo)}}" alt="All-Turkey"></a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white"> {{__('Вся')}} @if( app()->getLocale()  == 'ru' ) {{$country->name}} @elseif(app()->getLocale() == 'en') {{$country->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->name_de}}  @endif</a>
                        </div>
                        <div class="realty__item-text-subtitle">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- 2 блоков -->
        @if($count == 1)
        <div class="realty__content">
            <div class="realty__left-col">
                <div class="realty__left-col_1">
                    <div class="realty__item realty__item_b" >
                        <div class="realty__img_b">
                            <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[0]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[0]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[0]->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->cities[0]->name_de}}  @endif</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['city_id' => $country->cities[0]->id])}}" style="color: white">   {{numbers_graduation($country->cities[0]->product_city->count())}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="realty__right-col">
                <div class="realty__item realty__item_s" >
                    <div class="realty__img_s">
                        <a href="{{route('houses.index', ['country_id' => $country->id])}}">  <img  src="{{asset('uploads/'.$country->cities[0]->photo)}}" alt="All-Turkey"></a>
                    </div>
                    <div class="realty__item-text">
                        <div class="realty__item-text-title">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white"> {{__('Вся')}} @if( app()->getLocale()  == 'ru' ) {{$country->name}} @elseif(app()->getLocale() == 'en') {{$country->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->name_de}}  @endif</a>
                        </div>s
                        <div class="realty__item-text-subtitle">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- 1 блоков -->
        @if($count < 1)
        <div class="realty__content">
            <div class="realty__left-col">
                <div class="realty__left-col_1">
                    <div class="realty__item realty__item_b" >
                        <div class="realty__img_b">
                            <a href="{{route('houses.index', ['country_id' => $country->id])}}">  <img  src="{{asset('uploads/'.$country->cities[0]->photo)}}" alt="All-Turkey"></a>
                        </div>
                        <div class="realty__item-text">
                            <div class="realty__item-text-title">
                                <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white"> {{__('Вся')}} @if( app()->getLocale()  == 'ru' ) {{$country->name}} @elseif(app()->getLocale() == 'en') {{$country->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->name_tr}} @elseif(app()->getLocale() == 'de'){{$country->name_de}}  @endif</a>
                            </div>
                            <div class="realty__item-text-subtitle">
                                <a href="{{route('houses.index', ['country_id' => $country->id])}}" style="color: white">      {{numbers_graduation($country->product_country->count())}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </section>


    <section class="citizenship-investments ">

        @if(app()->getLocale() == 'en') <?php $country->div = $country->div_en ?> @elseif(app()->getLocale() == 'tr') <?php $country->div = $country->div_tr ?> @endif
        <?php echo $country->div?>

        <div class="citizenship-investments__footer">

            <div class="citizenship-investments__footer-button">

                {{__('Запросить актуальные проекты')}}


            </div>

        </div>

    </section>

    @if(!$citizenship_product->isEMpty())

    <section class="objects-slider container">

        <div class="objects-slider__title title">

            {{__("Объекты для получения гражданства :name за инвестиции" ,['name' =>$country->name ])}}


        </div>

        <div class="objects-slider__content">

            <div class="objects__swiper swiper">

                <div class="objects__wrapper swiper-wrapper">

                    @foreach($citizenship_product as $product)
                    <div class="objects__slide swiper-slide open-place-popup" data_id="{{$product->id}}">

                        <div class="objects__slide-img">
                            @if(isset($product->photo[0]->preview))
                                <img src="{{ asset('uploads/'.$product->photo[0]->preview) }}" alt="place">
                            @ele
                                <img src="{{ asset('uploads/'.$product->photo[0]->photo) }}" alt="place">
                            @endif
                        </div>

                        <div class="objects__slide-text">

                            <div class="objects__slide-price">
                                @if(isset($product->min_price["EUR"]))
                                    {{ __("от") . " " . $product->min_price["EUR"] . " €" }}
                                @else
                                    {{ $product->price["EUR"] }} €
                                @endif
                            </div>

                            <div class="objects__slide-rooms">
                                @if(!is_null(json_decode($product->objects)) && count(json_decode($product->objects)) > 0 && $product->layouts !== "" && $product->layouts !== " " && !is_null($product->layouts))
                                    {{ $product->layouts }}
                                @else
                                    <?php $category_spalni =  $product->ProductCategory->where('type', 'Спальни')?>
                                    <?php $category_vannie =  $product->ProductCategory->where('type', 'Ванные')?>

                                    {{ $product->size }} {{__('кв.м')}}<span>|</span>    @foreach($category_spalni as $spalni)
                                    {{__($spalni->category->name )}}
                                    @endforeach{{__('Спальни')}} <span>|</span> @foreach($category_vannie as $spalni)  {{__($spalni->category->name)}}

                                    @endforeach {{__('Ванна')}}
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
@foreach($citizenship_product as $product)

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
        <?php  $get = \App\Models\favorite::where('user_id', isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null)->where('product_id', $product->id)->first() ?>
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
                            <div class="place__price">
                                <div
                                    class="place__price-value"
                                    data-price-rub="{{ $product->price["RUB"] }}"
                                    data-price-eur="{{ $product->price["EUR"] }}"
                                    data-price-usd="{{ $product->price["USD"] }}"
                                    data-price-try="{{ $product->price["TRY"] }}"
                                >
                                {{ $product->price["EUR"] }} €
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
                            <div class="place__square"
                                 data-price-rub="{{ $product->price_size["RUB"] }}"
                                 data-price-eur="{{ $product->price_size["EUR"] }}"
                                 data-price-usd="{{ $product->price_size["USD"] }}"
                                 data-price-try="{{ $product->price_size["TRY"] }}"
                            >
                                {{ $product->price_size["EUR"] }} €
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
                        @if($product->complex_or_not == 'Нет' || $product->complex_or_not == null)
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
                                            {{str_replace('+','',$spalni->category->name)}}
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



    {{--                                                                   <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>--}}

    {{--                                                                   <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=2a0f0e9d-44f3-4f13-8628-12588d752fc3" type="text/javascript"></script>--}}



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

    {{--                                                               <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A15349a58da6ee371b08cfe1844f44da9977d839e450577ee6442deeb8dca9bb8&amp;source=constructor"--}}

    {{--                                                                       frameborder="0">--}}

    {{--                                                               </iframe>--}}

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
                                                        <span data-exchange="eur" class="valute active">{{ $object->price->EUR }} €</span>
                                                        <span data-exchange="usd" class="valute">{{ $object->price->USD }} $</span>
                                                        <span data-exchange="rub" class="valute">{{ $object->price->TRY }} ₽</span>
                                                        <span data-exchange="try" class="valute lira">{{ $object->price->RUB }} <span class="lira" style="display:inline-block;">₺</span></span>
                                                    </div>
                                                    <div class="kompleks__layout-price-meter"bis_skin_checked="1">
                                                        <span data-exchange="eur" class="valute active">{{ $object->price->EUR }} € / {{ __('кв.м') }}</span>
                                                        <span data-exchange="usd" class="valute">{{ $object->price->USD }} $ / {{ __('кв.м') }}</span>
                                                        <span data-exchange="rub" class="valute">{{ $object->price->TRY }} ₽ / {{ __('кв.м') }}</span>
                                                        <span data-exchange="try" class="valute lira">{{ $object->price->RUB }} <span class="lira" style="display:inline-block;">₺</span> / {{ __('кв.м') }}</span>
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
                                                            <img data-objectid="{{ $object->id }}" style="max-width: 100px;" src="{{ asset('uploads/'.$object->apartment_layout_image) }}" alt="scheme">
                                                        @else
                                                            <img data-objectid="{{ $object->id }}" style="max-width: 100px;" src="{{ asset('uploads/') }}" alt="scheme">
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


@endsection



@section('footer')

    @include('project.includes.footer')

@endsection





@section('scripts')

    <script>
        // Валюта
        var currency = {
            "eur": `&nbsp;€`,
            "usd": `&nbsp;$`,
            "try": `&nbsp;<span class="lira">₺</span>`,
            "rub": `&nbsp;₽`
        }
        var square_m = {
            "en": `sq.m`,
            "de": `qm`,
            "tr": `metrekare`,
            "ru": `кв.м`
        }
        var current_locale = `{{ app()->getLocale() }}`;

        $(".place__currency-item").on("click", function() {
            var rate = $(this).attr('data-exchange');
            var place_price_el = $('.place-w.active').find('.place__price-value');
            var place_square_el = $('.place-w.active').find('.place__square');
            var kompleks_layout_price_el = $('.place-w.active').find('.kompleks__layout-price');
            kompleks_layout_price_el.children('span').removeClass('active');
            kompleks_layout_price_el.find(`span[data-exchange="${rate}"]`).addClass('active');
            kompleks_layout_price_el.find(`span[data-exchange="${rate}"]`).addClass('lira');

            var kompleks_layout_price_meter_el = $('.place-w.active').find('.kompleks__layout-price-meter');
            kompleks_layout_price_meter_el.children('span').removeClass('active');
            kompleks_layout_price_meter_el.find(`span[data-exchange="${rate}"]`).addClass('active');


            place_price_el.html(place_price_el.attr('data-price-'+rate) + currency[rate]);
            place_square_el.html(place_square_el.attr('data-price-'+rate) + currency[rate]);
            // kompleks_layout_price_el.html(kompleks_layout_price_el.attr('data-price-'+rate) + currency[rate]);
            // kompleks_layout_price_meter_el.html(kompleks_layout_price_meter_el.attr('data-price-'+rate) + currency[rate] + " / " + square_m[current_locale]);
        });




        // let locations = [

        // ];




        let obect =  "<?php echo __('объектов')?>";


        let ids = <?php echo $country->id?>



        async function getData() {

            await fetch(`/city_from_map/${ids}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        data.data.forEach(city => {
                            locations.push({
                                coordinates: city.coordinate.split(',').map(parseFloat),
                                balloonContent: `${city.name}, ${city.count}  ${obect} `,
                                city_id: city.id
                            });

                        });

                    }

                })

                .catch(error => {

                    console.error('Error:', error);

                });

        }





        // getData();

        (async() => {

            "use strict";

            await getData();

            function e(e) {

                for (let t = 0; t < e.length; t++) e[t].classList.remove("active");

                e = 0

            }

            window.addEventListener("resize", (function(e) {

                window.innerWidth > 1199 && (document.querySelector(".header-m").classList.remove("active"), document.querySelector("#nav-icon").classList.remove("open"), document.querySelector(".header-w").classList.remove("fixed")), document.querySelectorAll(".search-nav-w").length && (window.innerWidth > 899 && !document.querySelector(".search-nav__more-dropdown").classList.contains("active") && (document.querySelector(".search-w").classList.remove("active"), document.querySelector(".search-nav__more").classList.remove("active")), window.innerWidth <= 899 && (document.querySelector(".search-nav__more-dropdown").classList.remove("active"), document.querySelector(".search-nav__more").classList.remove("active"), document.querySelector(".search-nav__price-dropdown").classList.remove("active"), document.querySelector(".search-nav__price").classList.remove("active"), document.querySelector(".search-nav__types-dropdown").classList.remove("active"), document.querySelector(".search-nav__types").classList.remove("active")), window.innerWidth <= 1199 && (document.querySelector(".search-nav__rooms-dropdown").classList.remove("active"), document.querySelector(".search-nav__rooms").classList.remove("active"))), document.querySelectorAll(".place-w").length && (window.innerWidth <= 1023 && document.querySelector(".place-w").classList.contains("active") && document.querySelector(".header-w").classList.add("fixed"), window.innerWidth <= 540 && (document.querySelector(".place__currency-preview-item").textContent = "$"), window.innerWidth > 540 && (document.querySelector(".place__currency-preview-item").textContent = "Валюта"))

            })), document.querySelectorAll(".place-w").length && window.innerWidth <= 540 && (document.querySelector(".place__currency-preview-item").textContent = "$"), window.addEventListener("resize", (function(e) {

                document.querySelectorAll("#map_city").length && (window.innerWidth > 1003 && document.querySelector(".city__content").classList.remove("city_map"), window.innerWidth <= 1003 && (document.querySelector("#map_city").style.height = "100%"), window.innerWidth > 1003 && (document.querySelector(".city-col").classList.add("active"), document.querySelector(".map_city__btn-changer").classList.remove("active"), document.querySelector(".city-col__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.remove("map_city_active"), document.querySelector(".city__content").classList.remove("city_map")), window.innerWidth > 1199 && (document.querySelector("#map_city").style.height = window.innerHeight - 18 - 161 + "px"), window.innerWidth <= 1199 && window.innerWidth > 1003 && (document.querySelector("#map_city").style.height = window.innerHeight - 88 - 60 + "px"))

            })), document.querySelector(".header__top-lang").onclick = function() {

                document.querySelector(".header__top-lang-item").classList.toggle("active"), document.querySelector(".header__lang-list-dropdown").classList.toggle("active")

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

            for (let e = 0; e < y.length; e++) y[e].addEventListener("click", (function(t) {

                _[e].style.display = "none"

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





            function P(e) {

                document.querySelectorAll("#map_city").length && ymaps.ready((function() {

                    C = new ymaps.Map("map_city", {

                        center: [<?php echo $country->lat .','.$country->long ?>],

                        zoom: 6,

                        controls: [],

                        behaviors: ["default", "scrollZoom"]

                    }, {

                        searchControlProvider: "yandex#search"

                    });

                    var t = ymaps.templateLayoutFactory.createClass('<div class="popover top"><a class="close" href="#">&times;</a><div class="arrow"></div><div class="popover-inner">$[[options.contentLayout observeSize minWidth=235 maxWidth=235 maxHeight=350]]</div></div>', {

                            build: function() {

                                this.constructor.superclass.build.call(this), this._$element = $(".popover", this.getParentElement()), this.applyElementOffset(), this._$element.find(".close").on("click", $.proxy(this.onCloseClick, this))

                            },

                            clear: function() {

                                this._$element.find(".close").off("click"), this.constructor.superclass.clear.call(this)

                            },

                            onSublayoutSizeChange: function() {

                                t.superclass.onSublayoutSizeChange.apply(this, arguments), this._isElement(this._$element) && (this.applyElementOffset(), this.events.fire("shapechange"))

                            },

                            applyElementOffset: function() {

                                this._$element.css({

                                    left: -this._$element[0].offsetWidth / 2,

                                    top: -(this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight)

                                })

                            },

                            onCloseClick: function(e) {

                                e.preventDefault(), this.events.fire("userclose")

                            },

                            getShape: function() {

                                if (!this._isElement(this._$element)) return t.superclass.getShape.call(this);

                                var e = this._$element.position();

                                return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([

                                    [e.left, e.top],

                                    [e.left + this._$element[0].offsetWidth, e.top + this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight]

                                ]))

                            },

                            _isElement: function(e) {

                                return e && e[0] && e.find(".arrow")[0]

                            }

                        }),

                        o = ymaps.templateLayoutFactory.createClass('<div class="placemark"></div>', {

                            build: function() {

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

                                this.getData().options.set("shape", this.isActive ? l : c), document.addEventListener("click", (function(e) {

                                    if ((e.target.classList.contains("ymaps-2-1-79-balloon__close-button") || e.target.classList.contains("ymaps-2-1-79-user-selection-none")) && window.innerWidth <= 1003) {

                                        var t = document.querySelectorAll(".placemark");

                                        for (let e = 0; e < t.length; e++) t[e].classList.remove("active")

                                    }

                                })), this.inited || (this.inited = !0, this.isActive = !1, this.getData().geoObject.events.add("click", (function(t) {

                                    var o = document.querySelectorAll(".placemark");

                                    if (e.classList.contains("active")) e.classList.remove("active");

                                    else {

                                        for (let e = 0; e < o.length; e++) o[e].classList.remove("active");

                                        e.classList.add("active")

                                    }

                                }), this))

                            }

                        }),

                        c = ymaps.templateLayoutFactory.createClass('<div class="ballon-city__content">$[properties.balloonContent]</div>'),

                        l = window.myPlacemark = new ymaps.Placemark([40.93824, 29.26059], {

                            balloonContent: ['<div class="balloon-city"><div class="balloon-city__text"><div class="balloon-city__price">$250 000</div><div class="balloon-city__rooms">2 спал, 1 ван</div><div class="balloon-city__rooms_m">2 010 кв.м  <span>|</span>  2 спальни  <span>|</span>  1 ванна</div><div class="balloon-city__address">Balbey, 431. Sk. No:4, 07040 Muratpaşa</div><div class="balloon-city__square">1 250 кв.м</div></div><div class="balloon-city__img"> <img src="./img/favorites-2.png"></div></div>'].join("")

                        }, {

                            balloonPanelMaxMapArea: e,

                            balloonShadow: !1,

                            balloonLayout: t,

                            iconLayout: o,

                            balloonContentLayout: c,

                            hideIconOnBalloonOpen: !1,

                            balloonOffset: [-100, -80]

                        }),

                        n = window.myPlacemark = new ymaps.Placemark([38.227547, 27.22873], {

                            balloonContent: ['<div class="balloon-city"><div class="balloon-city__text"><div class="balloon-city__price">$250 000</div><div class="balloon-city__rooms">2 спал, 1 ван</div><div class="balloon-city__rooms_m">2 010 кв.м  <span>|</span>  2 спальни  <span>|</span>  1 ванна</div><div class="balloon-city__address">Balbey, 431. Sk. No:4, 07040 Muratpaşa</div><div class="balloon-city__square">1 250 кв.м</div></div><div class="balloon-city__img"> <img src="./img/favorites-2.png"></div></div>'].join("")

                        }, {

                            balloonPanelMaxMapArea: e,

                            balloonShadow: !1,

                            balloonLayout: t,

                            iconLayout: o,

                            balloonContentLayout: c,

                            hideIconOnBalloonOpen: !1,

                            balloonOffset: [-100, -80]

                        }),

                        i = window.myPlacemark = new ymaps.Placemark([37.256168, 28.286126], {

                            balloonContent: ['<div class="balloon-city"><div class="balloon-city__text"><div class="balloon-city__price">$250 000</div><div class="balloon-city__rooms">2 спал, 1 ван</div><div class="balloon-city__rooms_m">2 010 кв.м  <span>|</span>  2 спальни  <span>|</span>  1 ванна</div><div class="balloon-city__address">Balbey, 431. Sk. No:4, 07040 Muratpaşa</div><div class="balloon-city__square">1 250 кв.м</div></div><div class="balloon-city__img"> <img src="./img/favorites-2.png"></div></div>'].join("")

                        }, {

                            balloonPanelMaxMapArea: e,

                            balloonShadow: !1,

                            balloonLayout: t,

                            iconLayout: o,

                            balloonContentLayout: c,

                            hideIconOnBalloonOpen: !1,

                            balloonOffset: [-100, -80]

                        }),

                        a = window.myPlacemark = new ymaps.Placemark([36.35589, 29.26059], {

                            balloonContent: ['<div class="balloon-city"><div class="balloon-city__text"><div class="balloon-city__price">$250 000</div><div class="balloon-city__rooms">2 спал, 1 ван</div><div class="balloon-city__rooms_m">2 010 кв.м  <span>|</span>  2 спальни  <span>|</span>  1 ванна</div><div class="balloon-city__address">Balbey, 431. Sk. No:4, 07040 Muratpaşa</div><div class="balloon-city__square">1 250 кв.м</div></div><div class="balloon-city__img"> <img src="./img/favorites-2.png"></div></div>'].join("")

                        }, {

                            balloonPanelMaxMapArea: e,

                            balloonShadow: !1,

                            balloonLayout: t,

                            iconLayout: o,

                            balloonContentLayout: c,

                            hideIconOnBalloonOpen: !1,

                            balloonOffset: [-100, -80]

                        }),

                        s = window.myPlacemark = new ymaps.Placemark([36.923977, 30.711918], {

                            balloonContent: ['<div class="balloon-city"><div class="balloon-city__text"><div class="balloon-city__price">$250 000</div><div class="balloon-city__rooms">2 спал, 1 ван</div><div class="balloon-city__rooms_m">2 010 кв.м  <span>|</span>  2 спальни  <span>|</span>  1 ванна</div><div class="balloon-city__address">Balbey, 431. Sk. No:4, 07040 Muratpaşa</div><div class="balloon-city__square">1 250 кв.м</div></div><div class="balloon-city__img"> <img src="./img/favorites-2.png"></div></div>'].join("")

                        }, {

                            balloonPanelMaxMapArea: e,

                            balloonShadow: !1,

                            balloonLayout: t,

                            iconLayout: o,

                            balloonContentLayout: c,

                            hideIconOnBalloonOpen: !1,

                            balloonOffset: [-100, -80]

                        });

                    C.geoObjects.events, C.behaviors.disable("scrollZoom"), C.geoObjects.add(l).add(n).add(i).add(a).add(s)

                }))

            }

            L.length && (k.onclick = function() {

                q.classList.remove("active"), c.destroy(!0, !0)

            }), L.length && (A.onclick = function() {

                x.classList.remove("active")

            }), L.length && window.addEventListener("resize", (function(e) {

                window.innerWidth <= 766 && q.classList.contains("active") && (x.classList.add("active"), q.classList.remove("active")), window.innerWidth > 766 && x.classList.contains("active") && (x.classList.remove("active"), q.classList.add("active"))

            })), P(E = window.innerWidth > 1003 ? 0 : 1 / 0), window.addEventListener("resize", (function(e) {

                this.document.querySelectorAll(".city-col__item").length && (window.innerWidth > 1003 && 0 == E && (C.destroy(), P(0), E = 1 / 0), window.innerWidth <= 1003 && E == 1 / 0 && (C.destroy(), P(1 / 0), E = 0))

            })), document.querySelectorAll("#map-country1").length && ymaps.ready((function() {

                var mapCountry;
                var script;

                function init(ymaps) {

                mapCountry = new ymaps.Map("map-country", {

                        center: [<?php echo $country->lat .','.$country->long?>],

                        zoom: 6,

                        controls: [],

                        behaviors: ["default", "scrollZoom"]

                    }, {

                        searchControlProvider: "yandex#search"

                    }),

                    t = ymaps.templateLayoutFactory.createClass('<div class="popover top"><a class="close" href="#">&times;</a><div class="arrow"></div><div class="popover-inner">$[[options.contentLayout observeSize minWidth=235 maxWidth=235 maxHeight=350]]</div></div>', {

                        build: function() {

                            this.constructor.superclass.build.call(this), this._$element = $(".popover", this.getParentElement()), this.applyElementOffset(), this._$element.find(".close").on("click", $.proxy(this.onCloseClick, this))

                        },

                        clear: function() {

                            this._$element.find(".close").off("click"), this.constructor.superclass.clear.call(this)

                        },

                        onSublayoutSizeChange: function() {

                            t.superclass.onSublayoutSizeChange.apply(this, arguments), this._isElement(this._$element) && (this.applyElementOffset(), this.events.fire("shapechange"))

                        },

                        applyElementOffset: function() {

                            this._$element.css({

                                left: -this._$element[0].offsetWidth / 2,

                                top: -(this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight)

                            })

                        },

                        onCloseClick: function(e) {

                            e.preventDefault(), this.events.fire("userclose")

                        },

                        getShape: function() {

                            if (!this._isElement(this._$element)) return t.superclass.getShape.call(this);

                            var e = this._$element.position();

                            return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([

                                [e.left, e.top],

                                [e.left + this._$element[0].offsetWidth, e.top + this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight]

                            ]))

                        },

                        _isElement: function(e) {

                            return e && e[0] && e.find(".arrow")[0]

                        }

                    }),

                    o = ymaps.templateLayoutFactory.createClass('<div class="placemark"></div>', {

                        build: function() {

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

                            this.getData().options.set("shape", this.isActive ? l : c), this.inited || (this.inited = !0, this.isActive = !1, this.getData().geoObject.events.add("click", (function(t) {

                                var o = document.querySelectorAll(".placemark");

                                if (e.classList.contains("active")) e.classList.remove("active");

                                else {

                                    for (let e = 0; e < o.length; e++) o[e].classList.remove("active");

                                    e.classList.add("active")

                                }

                            }), this))

                        }

                    }),



                    c = ymaps.templateLayoutFactory.createClass('<h3 class="popover-title">$[properties.balloonHeader]</h3><div class="popover-content"><a href="https://dev.one-team.pro/city/city_id=$[properties.city_id]">  $[properties.balloonContent]</a> </div>'),

                    s = window.myPlacemark = new ymaps.Placemark([36.923977, 30.711918], {

                        balloonContent: ["Турция, Анталия123123123123, 236 объектов"].join("")

                    }, {

                        balloonPanelMaxMapArea: 431520,

                        balloonShadow: !1,

                        balloonLayout: t,

                        iconLayout: o,

                        balloonContentLayout: c,

                        hideIconOnBalloonOpen: !1,

                        balloonOffset: [-110, -50]

                    });



                locations.forEach(function (Location) {



                    var placemark = new ymaps.Placemark(Location.coordinates, {

                        balloonContent: Location.balloonContent,

                        city_id:Location.city_id

                    },{

                        balloonPanelMaxMapArea: 431520,

                        balloonShadow: !1,

                        balloonLayout: t,

                        iconLayout: o,

                        balloonContentLayout: c,

                        hideIconOnBalloonOpen: !1,

                        balloonOffset: [-110, -50]

                    });
                    mapCountry.behaviors.disable("scrollZoom"),
                    mapCountry.geoObjects.add(placemark);

                })
            }
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
                if(window.innerWidth < 1023)
                header.classList.add('fixed')
            })
        });
        //функция для открытия модалки
        function openPlacePopup(block) {
            const id = block.getAttribute('data_id')
            const placePopup = document.querySelector('.place-w[data_id="' + id + '"]');
            placePopup.classList.add('active')
        }
        //закрытие модалки по крестику
        $('.place__exit').click(function() {

            $(this).closest('.place-w').removeClass('active');

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

@endsection

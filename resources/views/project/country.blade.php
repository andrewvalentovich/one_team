@extends('project.includes.layouts')



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

          {{__('Всего')}}  {{$country->product_country->count()}} {{__('объявлений')}}

        </div>



        <div class="realty__content">

            <div class="realty__left-col">

                <div class="realty__left-col_1">

                    @if(isset($country->cities[0]) )

                    <div class="realty__item realty__item_b" >

                        <div class="realty__img_b">

                            <a href="{{route('city',$country->cities[0]->id)}}">  <img  src="{{asset("uploads/".$country->cities[0]->photo)}}" alt="antalya"></a>

                        </div>

                        <div class="realty__item-text">

                            <div class="realty__item-text-title">

                                <a href="{{route('city',$country->cities[0]->id)}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[0]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[0]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[0]->name_tr}}  @endif</a>

                            </div>

                            <div class="realty__item-text-subtitle">

                                <a href="{{route('city',$country->cities[0]->id)}}" style="color: white">   {{$country->cities[0]->product_city->count()}} {{__('объявлений')}} </a>

                            </div>

                        </div>

                    </div>

                    @endif





                    <div class="realty__left-col_1-footer">

                        @if(isset($country->cities[1]))

                        <div class="realty__item realty__item_s">

                            <div class="realty__img_s">

                                <a href="{{route('city',$country->cities[1]->id)}}">  <img  src="{{asset("uploads/".$country->cities[1]->photo)}}" alt="antalya"></a>

                            </div>

                            <div class="realty__item-text">

                                <div class="realty__item-text-title">

                                    <a href="{{route('city',$country->cities[1]->id)}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[1]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[1]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[1]->name_tr}}  @endif </a>

                                </div>

                                <div class="realty__item-text-subtitle">

                                    <a href="{{route('city',$country->cities[1]->id)}}" style="color: white">   {{$country->cities[1]->product_city->count()}} {{__('объявлений')}} </a>

                                </div>

                            </div>

                        </div>

                        @endif

                            @if(isset($country->cities[2]))

                        <div class="realty__item realty__item_s">

                            <div class="realty__img_s">

                                <a href="{{route('city',$country->cities[2]->id)}}">  <img src="{{asset("uploads/".$country->cities[2]->photo)}}" alt="antalya"></a>

                            </div>

                            <div class="realty__item-text">

                                <div class="realty__item-text-title">

                                    <a href="{{route('city',$country->cities[2]->id)}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[2]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[2]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[2]->name_tr}}  @endif </a>

                                </div>

                                <div class="realty__item-text-subtitle">

                                    <a href="{{route('city',$country->cities[2]->id)}}" style="color: white">   {{$country->cities[2]->product_city->count()}} {{__('объявлений')}} </a>

                                </div>

                            </div>

                        </div>

                            @endif

                    </div>

                </div>





                <div class="realty__left-col_2" >

                    <div class="realty__left-col_2-top" >

                        @if(isset($country->cities[3]))



                        <div class="realty__item realty__item_s" >

                            <div class="realty__img_s">

                                <a href="{{route('city',$country->cities[3]->id)}}">      <img  src="{{asset('uploads/'.$country->cities[3]->photo)}}" alt="{{$country->cities[3]->name}}"></a>

                            </div>

                            <div class="realty__item-text">

                                <div class="realty__item-text-title">

                                    <a href="{{route('city',$country->cities[3]->id)}}" style="color: white">   @if( app()->getLocale()  == 'ru' ) {{$country->cities[3]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[3]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[3]->name_tr}}  @endif </a>

                                </div>

                                <div class="realty__item-text-subtitle">

                                    <a href="{{route('city',$country->cities[3]->id)}}" style="color: white">   {{$country->cities[3]->product_city->count()}} {{__('объявлений')}} </a>

                                </div>

                            </div>

                        </div>

                        @endif



                        @if(isset($country->cities[4]))

                        <div class="realty__item realty__item_s" >
                            <div class="realty__img_s">
                                <a href="{{ route('city',$country->cities[4]->id)}}">
                                    <img src="{{asset('uploads/'.$country->cities[4]->photo)}}" alt="{{$country->cities[4]->name}}">
                                </a>
                            </div>
                            <div class="realty__item-text">
                                <div class="realty__item-text-title">
                                    <a href="{{route('city',$country->cities[4]->id)}}" style="color: white">@if( app()->getLocale()  == 'ru' ) {{$country->cities[4]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[4]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[4]->name_tr}}  @endif </a>
                                </div>
                                <div class="realty__item-text-subtitle">
                                    <a href="{{route('city',$country->cities[4]->id)}}" style="color: white">   {{$country->cities[4]->product_city->count()}} {{__('объявлений')}} </a>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>

                            @if(isset($country->cities[5]))

                            <div class="realty__item realty__item_m" >

                                <div class="realty__img_m">

                                    <a href="{{route('city',$country->cities[5]->id)}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>

                                </div>

                                <div class="realty__img_m realty__img_mob">

                                    <a href="{{route('city',$country->cities[5]->id)}}">     <img src="{{asset('uploads/'.$country->cities[5]->photo)}}" alt="{{$country->cities[5]->name}}"> </a>

                                </div>

                                <div class="realty__item-text">

                                    <div class="realty__item-text-title">

                                        <a href="{{route('city',$country->cities[5]->id)}}" style="color: white">       @if( app()->getLocale()  == 'ru' ) {{$country->cities[5]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[5]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[5]->name_tr}}  @endif </a>

                                    </div>

                                    <div class="realty__item-text-subtitle">

                                        <a href="{{route('city',$country->cities[5]->id)}}" style="color: white">      {{$country->cities[5]->product_city->count()}} {{__('объявлений')}} </a>

                                    </div>

                                </div>

                            </div>

                        @endif



                </div>



            </div>

            <div class="realty__right-col">

                @if(isset($country->cities[6]))

                <div class="realty__item realty__item_s" >

                    <div class="realty__img_s">

                        <a href="{{route('city',$country->cities[6]->id)}}">    <img src="{{asset('uploads/'.$country->cities[6]->photo)}}" alt="{{$country->cities[6]->name}}"> </a>

                    </div>

                    <div class="realty__item-text">

                        <div class="realty__item-text-title">

                            <a href="{{route('city',$country->cities[6]->id)}}" style="color: white">      @if( app()->getLocale()  == 'ru' ) {{$country->cities[6]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[6]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[6]->name_tr}}  @endif </a>

                        </div>

                        <div class="realty__item-text-subtitle">

                            <a href="{{route('city',$country->cities[6]->id)}}" style="color: white">   {{$country->cities[6]->product_city->count()}}  {{__('объявлений')}} </a>

                        </div>

                    </div>

                </div>

                @endif

                    @if(isset($country->cities[7]) )

                        <div class="realty__item realty__item_s" >

                            <div class="realty__img_s">

                                <a href="{{route('city',$country->cities[7]->id)}}">  <img src="{{asset('uploads/'.$country->cities[7]->photo)}}" alt="{{$country->cities[7]->name}}"> </a>

                            </div>

                            <div class="realty__item-text">


                                <div class="realty__item-text-title">

                                    <a href="{{route('city',$country->cities[7]->id)}}" style="color: white">  @if( app()->getLocale()  == 'ru' ) {{$country->cities[7]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[7]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[7]->name_tr}}  @endif</a>

                                </div>

                                <div class="realty__item-text-subtitle">

                                    <a href="{{route('city',$country->cities[7]->id)}}" style="color: white">  {{$country->cities[7]->product_city->count()}} {{__('объявлений')}} </a>

                                </div>

                            </div>

                        </div>

                    @endif

                    @if(isset($country->cities[8]))

                <div class="realty__item realty__item_s" >

                    <div class="realty__img_s">

                        <a href="{{route('city',$country->cities[8]->id)}}">    <img src="{{asset('uploads/'.$country->cities[8]->photo)}}" alt="{{$country->cities[8]->name}}"> </a>

                    </div>

                    <div class="realty__item-text">

                        <div class="realty__item-text-title">

                            <a href="{{route('city',$country->cities[8]->id)}}" style="color: white">     @if( app()->getLocale()  == 'ru' ) {{$country->cities[8]->name}} @elseif(app()->getLocale() == 'en') {{$country->cities[8]->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->cities[8]->name_tr}}  @endif</a>

                        </div>

                        <div class="realty__item-text-subtitle">

                            <a href="{{route('city',$country->cities[8]->id)}}" style="color: white">   {{$country->cities[8]->product_city->count()}}  {{__('объявлений')}} </a>

                        </div>

                    </div>

                </div>

                @endif



                    @if(isset($country->cities[0]))



                <div class="realty__item realty__item_s" >

                    <div class="realty__img_s">

                        <a href="{{route('country',$country->id)}}">  <img  src="{{asset('uploads/'.$country->cities[0]->photo)}}" alt="All-Turkey"></a>

                    </div>

                    <div class="realty__item-text">

                        <div class="realty__item-text-title">



                            <a href="{{route('country',$country->id)}}" style="color: white"> {{__('Вся')}} @if( app()->getLocale()  == 'ru' ) {{$country->name}} @elseif(app()->getLocale() == 'en') {{$country->name_en}} @elseif(app()->getLocale() == 'tr'){{$country->name_tr}}  @endif</a>

                        </div>

                        <div class="realty__item-text-subtitle">

                            <a href="{{route('country',$country->id)}}" style="color: white">      {{$country->product_country->count()}} {{__('объявлений')}} </a>

                        </div>

                    </div>

                </div>

                        @endif

            </div>

        </div>

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

                    <div class="objects__slide swiper-slide">

                        <div class="objects__slide-img">

                            <img src="{{asset('uploads/'.$product->photo[0]->photo) }}" alt="place">

                        </div>

                        <div class="objects__slide-text">

                            <div class="objects__slide-price">

                                {{$product->price}}

                            </div>

                            <div class="objects__slide-rooms">

                                <?php $category_spalni =  $product->ProductCategory->where('type', 'Спальни')?>

                                <?php $category_vannie =  $product->ProductCategory->where('type', 'Ванные')?>



                              {{$product->size}}  {{__('кв.м')}}<span>|</span>    @foreach($category_spalni as $spalni)

                                        {{__($spalni->category->name )}}

                                    @endforeach{{__('Спальни')}} <span>|</span> @foreach($category_vannie as $spalni)  {{__($spalni->category->name)}}

                                    @endforeach {{__('Ванна')}}

                            </div>

                            <div class="objects__slide-address">

                               {{$product->address}}

{{--                                Balbey, 431. Sk. No:4, 07040 Muratpaşa--}}

                            </div>

                        </div>
                        <?php $fav = App\Models\favorite::where('user_id', $_COOKIE["user_id"])->where('product_id', $product->id)->first() ?>
                        @if($fav == null)
                        <div class="objects__slide-favorites "  data_id="{{$product->id}}" >
                        @else
                                <div data_id="{{$product->id}}"  class="objects__slide-favorites  active" >
                            @endif
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="73px" height="64px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"

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

                            <script>
                                $('.objects__slide-favorites').click(function () {
                                    let site_url = "<?php echo env('APP_URL') ?>";
                                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                                    let data_id = $(this).attr('data_id');

                                    let user_id = "<?php echo $_COOKIE['user_id'];  ?>";
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': csrfToken
                                        }
                                    });

                                    $.ajax({
                                        url:  site_url+'add_or_delete_in_favorite',
                                        type: 'POST',
                                        data: {
                                            user_id: user_id,
                                            product_id: data_id
                                        },
                                        success: function(response) {
                                            if(response.message == 'created'){
                                                if (response.counts == 0) {
                                                    $('.header__top-favorites-value').css('display', 'none');
                                                } else {
                                                    $('.header__top-favorites-value').html(response.counts);
                                                    $('.header__top-favorites-value').css('display', 'block');
                                                }
                                            }else {
                                                if (response.counts == 0) {
                                                    $('.header__top-favorites-value').css('display', 'none');
                                                } else {
                                                    $('.header__top-favorites-value').html(response.counts);
                                                    $('.header__top-favorites-value').css('display', 'block');
                                                }

                                            }
                                        },
                                    });


                                })
                            </script>

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



@endsection



@section('footer')

    @include('project.includes.footer')

@endsection





@section('scripts')

    <script>

        let locations = [

        ];




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

            }, document.querySelector(".header__nav-buy").onclick = function() {

                this.classList.toggle("active"), document.querySelector(".header__buy-dropdown").classList.toggle("active")

            }, document.querySelector(".header__nav-about").onclick = function() {

                this.classList.toggle("active"), document.querySelector(".header__about-dropdown").classList.toggle("active")

            }, document.querySelector(".header__top-phone-menu").onclick = function() {

                document.querySelector(".header-m").classList.toggle("active"), document.querySelector("#nav-icon").classList.toggle("open"), document.querySelector(".header-w").classList.add("fixed"), document.querySelector(".header-m").classList.contains("active") || document.querySelector(".place-w").classList.contains("active") || document.querySelector(".header-w").classList.remove("fixed")

            }, document.querySelector(".header-m__aboute").onclick = function() {

                this.classList.toggle("active"), document.querySelector(".header-m__aboute-list").classList.toggle("active")

            }, document.querySelector(".header-m__buy").onclick = function() {

                this.classList.toggle("active")

            };

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

                    c = new Swiper(".place__slider_p-swiper", {

                        slidesPerView: 1,

                        autoHeight: !0,

                        initialSlide: e,

                        navigation: {

                            nextEl: ".place__slider_p-prev",

                            prevEl: ".place__slider_p-next"

                        },

                        pagination: {

                            el: ".place__slider_p-pagination",

                            type: "custom",

                            renderCustom: function(e, t, o) {

                                return t + " из " + o

                            }

                        }

                    }), q.classList.add("active")

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

            })), document.querySelectorAll("#map-country").length && ymaps.ready((function() {

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

{{--    <script src="{{asset('project/js/app.js')}} "></script>--}}

@endsection

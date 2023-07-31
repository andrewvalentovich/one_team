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

       <span class="count">   {{\App\Models\favorite::where('user_id', $_COOKIE['user_id'])->count()}}</span>      {{__('Объявления')}}
        </div>
        <div class="favorites__content">
            @if(!$get->isEMpty())
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
                @foreach($get as $item)
                    @if(isset($item->product->photo[0]->photo))
                <div class="favorites__list-item">
                    <div class="favorites__item-img">
                        <img src="{{asset('uploads/'.$item->product->photo[0]->photo)}}" alt="place">
                    </div>
                    <div class="favorites__item-text">
                        <div class="favorites__item-price">
                            €  {{$item->product->price}}
                        </div>
                        <div class="favorites__item-rooms">
                            2 010  {{__('кв.м')}}  <span>|</span>  2 {{__('спальни')}} <span>|</span>  1 {{__('Ванна')}}
                        </div>
                        <div class="favorites__item-address">
                           {{$item->product->address}}
                        </div>
                    </div>
                    <div class="favorites__item-exit" data_id="{{$item->product_id}}">
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
                        {{ $get->appends(Request::all())->links()}}
                    </div>
                    <div class="favorites__bottom-pages_m">
                        {{ $get->appends(Request::all())->links()}}
                    </div>
{{--                    <div class="favorites__pages-next active">--}}
{{--                        <img src="{{asset('project/img/prev.png')}}" alt="prev-btn">--}}
{{--                        <img src="{{asset('project/img/next.png')}}" alt="next-btn">--}}
{{--                    </div>--}}
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

        let product_count = "<?php echo $get->count() ?>";

        let locations = [

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
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            for (let e = 0; e < y.length; e++) y[e].addEventListener("click", (function(t) {
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
                        if (res.status == true) {
                            document.querySelector('.count').innerHTML = res.counts
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

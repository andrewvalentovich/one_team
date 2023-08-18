@extends('project.includes.layouts')
<script src="https://api-maps.yandex.ru/2.1/?lang={{ app()->getLocale() }}_RU&amp;apikey=2a0f0e9d-44f3-4f13-8628-12588d752fc3" type="text/javascript"></script>

@section('header')
    @include('project.includes.header')
@endsection

<style>
    /*.popular-locations__item:nth-last-child(-n+6){*/
    /*    display: block !important;*/
    /*}*/
    .popular-locations__item {
        align-items: center;
    }

</style>

@section('content')

    <section class="index-map">
        <div class="index-map__content">
            <div class="index-map__content-buttons">
                <div class="index-map__button active">
                    {{__('Турция')}}
                </div>
                {{--                    <div class="index-map__button">--}}
                {{--                        Кипр--}}
                {{--                    </div>--}}
            </div>
            <div id="map-country">
            </div>
        </div>
    </section>
    <section class="popular-locations container">
        <div class="popular-locations__title title">
            {{__('Популярные локации')}}

        </div>
        <div class="popular-locations__content">
            <div class="popular-locations__list">
                @foreach($all_country as $country)
                    <a href="{{route('country', $country->id)}}" class="popular-locations__item">
                        <div class="popular-locations__item-img">
                            <img style="max-width: 50px" src="{{asset("uploads/$country->photo")}}" alt="gr">
                        </div>
                        <div class="popular-locations__item-text">
                            @if(app()->getLocale() == 'en') <?php $country->name = $country->name_en ?> @elseif(app()->getLocale() == 'tr') <?php $country->name = $country->name_tr ?> @endif
                            {{$country->name}}
                            <span>{{$country->product_country->count()}}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="popular-locations__footer">
            <div class="popular-locations__button">
                <a href="{{route('all_location')}}">{{__('Все локации')}}</a>
            </div>
        </div>
    </section>

    <?php echo $citizenship_div->div ?>
    {{--   {{}}--}}
    <div class="citizenship__footer">
        <div class="citizenship__footer-button">
            {{__('Узнать больше')}}

        </div>
    </div>
    </section>
    <form action="" id="index_page_form">
        <section class="contact">
            <div class="contact__title title">
                {{__('Свяжитесь с нами')}}

            </div>
            <div class="contact__subtitle container">
                <span>{{__('Если у вас есть вопросы')}},</span>{{__('оставьте свои контактные данные, и мы свяжемся с вами в самое ближайшее время')}}
            </div>
            <div class="contact__form selection-phone">
                <div class="contact__form-top">
                    <div class="contact__top-item active">
                        WhatsApp
                    </div>
                    <div class="contact__top-item">
                        Viber
                    </div>
                    <div class="contact__top-item">
                        Telegram
                    </div>
                </div>

                <input type="hidden" name="contact_type" value="WhatsApp">

                <div class="contact__form-phone input-wrapper">
                    <div class="contact__form-phone-country">
                        <div class="contact__form-country-item">
                            <div class="contact__form-country-item-img">
                                <img src="{{asset('project/img/countries/ru.png')}}" alt="ru">
                            </div>
                        </div>
                    </div>
                    <span class="text">
                        Номер телефона
                    </span>
                    <input data-phone-pattern="+7 (___) ___-__-__" class="contact__form-phone-input contact__phone-input"
                           placeholder="{{__('Ваш телефон')}} {{__('в')}} whatsApp" name="phone">

                    <div class="contact__phone-dropdown ">
                        <div class="contact__phone-list">
                            <div class="contact__phone-list-item" mask="+7 (___) ___-__-__">
                                <div class="contact__phone-img">
                                    <img src="{{asset('project/img/countries/ru.png')}}" alt="ru">
                                </div>
                                <div class="contact__phone-title">
                                    Россия (Russia) <span>+7</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+1 (___) ___-__-__">
                                <div class="contact__phone-img">
                                    <img src="{{asset('project/img/countries/us.png')}}" alt="us">
                                </div>
                                <div class="contact__phone-title">
                                    США (United States) <span>+1</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+49 (___) ____-____">
                                <div class="contact__phone-img">
                                    <img src="{{asset('project/img/countries/gr.png')}}" alt="gr">
                                </div>
                                <div class="contact__phone-title">
                                    Германия (Germany) <span>+49</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+48 (___) ___-___">
                                <div class="contact__phone-img">
                                    <img src="{{asset('project/img/countries/pl.png')}}" alt="pl">
                                </div>
                                <div class="contact__phone-title">
                                    Польша (Poland) <span>+48</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+46 (___) ___-____">
                                <div class="contact__phone-img">
                                    <img src="{{asset('project/img/countries/sw.png')}}" alt="sw">
                                </div>
                                <div class="contact__phone-title">
                                    Швеция (Sweden) <span>+46</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+39 (___) ___-____">
                                <div class="contact__phone-img">
                                    <img src="{{asset('project/img/countries/it.png')}}" alt="it">
                                </div>
                                <div class="contact__phone-title">
                                    Италия (Italy) <span>+39</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <label class="contact__form-politic">
                    <input class="contact__form-politic-checkbox contact__form-checkbox " type="checkbox"
                           id="contact__form-politic" checked>
                    <div class="contact__form-custom-checkbox one_check"></div>
                    <div class="contact__form-checkbox-text">
                        {{__('Ознакомлен с')}} <span>{{__('политикой конфеденциальности')}} </span>
                    </div>
                </label>
                <label class="contact__form-data">
                    <input class="contact__form-data-checkbox contact__form-checkbox" type="checkbox"
                           id="contact__form-data">
                    <div class="contact__form-custom-checkbox two_check"></div>
                    <div class="contact__form-checkbox-text">
                        {{__('Согласен на обработку')}} <span>{{__('персональных данных')}} </span>
                    </div>
                </label>
                <div class="contact__form-footer">
                    <button style="    width: 100%;" class="contact__form-footer-button">
                        {{__('Связаться')}}
                    </button>

                </div>
            </div>
        </section>
        <input type="hidden" name="contact__phone-title" value="Россия (Russia)">
    </form>

    <script>
        $('.contact__top-item').click(function () {
            $("input[name='contact_type']").val($(this).html())
        })
        $('.contact__phone-title').click(function () {
            $("input[name='contact__phone-title']").val($(this).html())
        });
        $('.contact__form-phone-input').on('keydown', function () {
            $('.contact__form-phone').css('border', '2px solid #508cfa')
        });
        $('#index_page_form').submit(function () {
            event.preventDefault()
            let phone = $("input[name='phone']").val();
            let country = $("input[name='contact__phone-title']").val();
            let messanger = $("input[name='contact_type']").val();
            let phone_val = false;

            if (phone.length == 0) {
                $('.contact__form-phone').css('border', '2px solid red')
            } else {
                phone_val = true;
            }
            let check_one = false;
            if ($('.contact__form-politic-checkbox').not(':checked').length) {
                $('.one_check').css('border', '2px solid red')
            } else {
                check_one = true;
            }
            let check_two = false;
            if ($('.contact__form-data-checkbox').not(':checked').length) {
                $('.two_check').css('border', '2px solid red')
            } else {
                check_two = true;
            }
            if (check_two === true && check_one === true && phone_val === true) {
                let formData = new FormData();
                formData.append('phone', phone);
                formData.append('country', country);
                formData.append('messanger', messanger);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "<?php echo route('send_request') ?>",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // Handle the response from the server
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2500
                        })
                        $("input[name='phone']").val(' ')
                        $('.two_check').css('border', '2px solid #508cfa')
                        $('.one_check').css('border', '2px solid #508cfa')
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        })
    </script>
    <div class="popup popup-modal">
        <div class="popup__body">
            <form class="popup__content">
                <div class="popup__subtitle">
                    {{__('ФИО')}}
                </div>
                <div class="field">
                    <input type="text" value="" placeholder="">
                </div>
                <div class="popup__subtitle">
                    {{__('Номер телефона')}}
                </div>
                <div class="field field-phone selection-phone">
                    <div class="contact__form-phone-country ">
                        <div class="contact__form-country-item">
                            <div class="contact__form-country-item-img">
                                <img src="{{asset('project/img/countries/ru.png')}}" alt="ru">
                            </div>
                        </div>
                    </div>
                    <div class="contact__phone-dropdown ">
                        <div class="contact__phone-list">
                            <div class="contact__phone-list-item" mask="+7 (___) ___-__-__">
                                <div class="contact__phone-img">
                                    <img src="{{asset('project/img/countries/ru.png')}}" alt="ru">
                                </div>
                                <div class="contact__phone-title">
                                    Россия (Russia) <span>+7</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+1 (___) ___-__-__">
                                <div class="contact__phone-img">
                                    <img src="{{asset('project/img/countries/us.png')}}" alt="us">
                                </div>
                                <div class="contact__phone-title">
                                    США (United States) <span>+1</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+49 (___) ____-____">
                                <div class="contact__phone-img">
                                    <img src="{{asset('project/img/countries/gr.png')}}" alt="gr">
                                </div>
                                <div class="contact__phone-title">
                                    Германия (Germany) <span>+49</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+48 (___) ___-___">
                                <div class="contact__phone-img">
                                    <img src="{{asset('project/img/countries/pl.png')}}" alt="pl">
                                </div>
                                <div class="contact__phone-title">
                                    Польша (Poland) <span>+48</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+46 (___) ___-____">
                                <div class="contact__phone-img">
                                    <img src="{{asset('project/img/countries/sw.png')}}" alt="sw">
                                </div>
                                <div class="contact__phone-title">
                                    Швеция (Sweden) <span>+46</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+39 (___) ___-____">
                                <div class="contact__phone-img">
                                    <img src="{{asset('project/img/countries/it.png')}}" alt="it">
                                </div>
                                <div class="contact__phone-title">
                                    Италия (Italy) <span>+39</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input data-phone-pattern class="contact__phone-input" type="text" value="" placeholder="">
                </div>
                <button class="btn">
                    {{__('Перезвонить мне')}}
                </button>
                <div class="popup-close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <script xmlns=""/>
                        <path d="M1 1L13 13" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M13 1L1 13" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
                </а>
        </div>
    </div>

@endsection


@section('footer')
    @include('project.includes.footer')

@endsection


@section('scripts')
    <script>


        // let locations = [];

        // let obect = "<?php echo __('объектов')?>"

        (async () => {
            "use strict";
            await getData();

            function e(e) {
                for (let t = 0; t < e.length; t++) e[t].classList.remove("active");
                e = 0
            }

            window.addEventListener("resize", (function (e) {
                window.innerWidth > 1199 && (document.querySelector(".header-m").classList.remove("active"), document.querySelector("#nav-icon").classList.remove("open"), document.querySelector(".header-w").classList.remove("fixed")), document.querySelectorAll(".search-nav-w").length && (window.innerWidth > 899 && !document.querySelector(".search-nav__more-dropdown").classList.contains("active") && (document.querySelector(".search-w").classList.remove("active"), document.querySelector(".search-nav__more").classList.remove("active")), window.innerWidth <= 899 && (document.querySelector(".search-nav__more-dropdown").classList.remove("active"), document.querySelector(".search-nav__more").classList.remove("active"), document.querySelector(".search-nav__price-dropdown").classList.remove("active"), document.querySelector(".search-nav__price").classList.remove("active"), document.querySelector(".search-nav__types-dropdown").classList.remove("active"), document.querySelector(".search-nav__types").classList.remove("active")), window.innerWidth <= 1199 && (document.querySelector(".search-nav__rooms-dropdown").classList.remove("active"), document.querySelector(".search-nav__rooms").classList.remove("active"))), document.querySelectorAll(".place-w").length && (window.innerWidth <= 1023 && document.querySelector(".place-w").classList.contains("active") && document.querySelector(".header-w").classList.add("fixed"), window.innerWidth <= 540 && (document.querySelector(".place__currency-preview-item").textContent = "$"), window.innerWidth > 540 && (document.querySelector(".place__currency-preview-item").textContent = "Валюта"))
            })), document.querySelectorAll(".place-w").length && window.innerWidth <= 540 && (document.querySelector(".place__currency-preview-item").textContent = "$"), window.addEventListener("resize", (function (e) {
                document.querySelectorAll("#map_city").length && (window.innerWidth > 1003 && document.querySelector(".city__content").classList.remove("city_map"), window.innerWidth <= 1003 && (document.querySelector("#map_city").style.height = "100%"), window.innerWidth > 1003 && (document.querySelector(".city-col").classList.add("active"), document.querySelector(".map_city__btn-changer").classList.remove("active"), document.querySelector(".city-col__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.remove("map_city_active"), document.querySelector(".city__content").classList.remove("city_map")), window.innerWidth > 1199 && (document.querySelector("#map_city").style.height = window.innerHeight - 18 - 161 + "px"), window.innerWidth <= 1199 && window.innerWidth > 1003 && (document.querySelector("#map_city").style.height = window.innerHeight - 88 - 60 + "px"))
            })), document.querySelector(".header__top-lang").onclick = function () {
                document.querySelector(".header__top-lang-item").classList.toggle("active"), document.querySelector(".header__lang-list-dropdown").classList.toggle("active")
            }, document.querySelector(".header__nav-buy").onclick = function () {
                this.classList.toggle("active"), document.querySelector(".header__buy-dropdown").classList.toggle("active")
            }, document.querySelector(".header__nav-about").onclick = function () {
                this.classList.toggle("active"), document.querySelector(".header__about-dropdown").classList.toggle("active")
            }, document.querySelector(".header__top-phone-menu").onclick = function () {
                document.querySelector(".header-m").classList.toggle("active"), document.querySelector("#nav-icon").classList.toggle("open"), document.querySelector(".header-w").classList.add("fixed"), document.querySelector(".header-m").classList.contains("active") || document.querySelector(".place-w").classList.contains("active") || document.querySelector(".header-w").classList.remove("fixed")
            }, document.querySelector(".header-m__aboute").onclick = function () {
                this.classList.toggle("active"), document.querySelector(".header-m__aboute-list").classList.toggle("active")
            }, document.querySelector(".header-m__buy").onclick = function () {
                this.classList.toggle("active")
            };

            let t = document.querySelectorAll(".header-m__langs-item");

            for (let o = 0; o < t.length; o++) t[o].addEventListener("click", (function (c) {
                e(t), t[o].classList.add("active")
            }));

            let o = document.querySelectorAll(".index-map__button");
            for (let t = 0; t < o.length; t++) o[t].addEventListener("click", (function (c) {
                e(o), o[t].classList.add("active")
            }));

            let c, l = document.querySelectorAll(".contact__top-item");
            for (let t = 0; t < l.length; t++) l[t].addEventListener("click", (function (o) {
                e(l), l[t].classList.add("active")
            }));

            document.querySelectorAll(".contact__form-phone-country").length && (document.querySelector(".contact__form-phone-country").onclick = function () {
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
            }), document.querySelectorAll(".search-nav__rooms-title").length && (document.querySelector(".search-nav__rooms-title").onclick = function () {
                document.querySelector(".search-nav__rooms").classList.toggle("active"), document.querySelector(".search-nav__rooms-dropdown").classList.toggle("active")
            }), document.querySelectorAll(".search-nav__more-title").length && (document.querySelector(".search-nav__more-title").onclick = function () {
                window.innerWidth > 899 && (document.querySelector(".search-nav__more").classList.toggle("active"), document.querySelector(".search-nav__more-dropdown").classList.toggle("active")), window.innerWidth <= 899 && document.querySelector(".search-w").classList.toggle("active")
            }), document.querySelectorAll(".search-w__close").length && (document.querySelector(".search-w__close").onclick = function () {
                window.innerWidth <= 899 && document.querySelector(".search-w").classList.remove("active")
            });
            let n = document.querySelectorAll(".search-nav__rooms-dropdown-bedrooms-button");
            for (let t = 0; t < n.length; t++) n[t].addEventListener("click", (function (o) {
                e(n), n[t].classList.add("active")
            }));

            let i = document.querySelectorAll(".search-nav__rooms-dropdown-bathrooms-button");
            for (let t = 0; t < i.length; t++) i[t].addEventListener("click", (function (o) {
                e(i), i[t].classList.add("active")
            }));

            let a = document.querySelectorAll(".search-nav__view-button");
            for (let t = 0; t < a.length; t++) a[t].addEventListener("click", (function (o) {
                e(a), a[t].classList.add("active")
            }));

            let s = document.querySelectorAll(".search-nav__sea-button");
            for (let t = 0; t < s.length; t++) s[t].addEventListener("click", (function (o) {
                e(s), s[t].classList.add("active")
            }));

            document.querySelectorAll(".search-nav__types-title").length && (document.querySelector(".search-nav__types-title").onclick = function () {
                document.querySelector(".search-nav__types").classList.toggle("active"), document.querySelector(".search-nav__types-dropdown").classList.toggle("active")
            }), document.querySelectorAll(".search-nav__price-title").length && (document.querySelector(".search-nav__price-title").onclick = function () {
                document.querySelector(".search-nav__price").classList.toggle("active"), document.querySelector(".search-nav__price-dropdown").classList.toggle("active")
            });

            let r = document.querySelectorAll(".search-nav__price-currency-item");
            for (let t = 0; t < s.length; t++) r[t].addEventListener("click", (function (o) {
                e(r), r[t].classList.add("active")
            }));

            let d = document.querySelectorAll(".search-nav__list-item-title"),
                u = document.querySelectorAll(".search-nav__item-dropdown");

            function m() {
                for (let e = 0; e < u.length - 1; e++) u[e].style.zIndex = 5
            }

            for (let e = 0; e < d.length - 1; e++) d[e].addEventListener("click", (function (t) {
                m(), u[e].style.zIndex = 6
            }));

            document.querySelectorAll(".search-nav__price-title").length && (document.querySelector(".search-nav__price-title").onclick = function () {
                document.querySelector(".search-nav__price").classList.toggle("active"), document.querySelector(".search-nav__price-dropdown").classList.toggle("active")
            }), document.querySelector(".city-col__filter") && (document.querySelector(".city-col__filter").onclick = function () {
                this.classList.toggle("active"), document.querySelector(".city-col__filter-list").classList.toggle("active")
            }), document.querySelector(".favorites__top-filter") && (document.querySelector(".favorites__top-filter").onclick = function () {
                this.classList.toggle("active"), document.querySelector(".favorites__top-filter-list").classList.toggle("active")
            }), document.querySelector(".place__btns-call-preview") && (document.querySelector(".place__btns-call-preview").onclick = function () {
                document.querySelector(".place__btns-call-list").classList.toggle("active")
            }), document.querySelector(".place__btns-call-preview") && (document.querySelector(".place-w").onscroll = function () {
                window.innerWidth < 640 && (document.querySelector(".place-w").scrollTop > 620 ? document.querySelector(".place__btns").style.position = "fixed" : document.querySelector(".place__btns").style.position = "static")
            }, window.addEventListener("resize", (function (e) {
                window.innerWidth >= 640 && (document.querySelector(".place__btns").style.position = "static")
            })));

            let _ = document.querySelectorAll(".favorites__list-item"),
                y = document.querySelectorAll(".favorites__item-exit");
            for (let e = 0; e < y.length; e++) y[e].addEventListener("click", (function (t) {
                _[e].style.display = "none"
            }));

            let v = document.querySelectorAll(".favorites__pages-item");
            for (let t = 0; t < v.length; t++) v[t].addEventListener("click", (function (o) {
                e(v), v[t].classList.add("active")
            }));

            let p = document.querySelectorAll(".city-col__btn");
            for (let t = 0; t < p.length; t++) p[t].addEventListener("click", (function (o) {
                e(p), p[t].classList.add("active")
            }));

            let h = document.querySelectorAll(".favorite-item-btn");
            for (let e = 0; e < h.length; e++) h[e].addEventListener("click", (function (t) {
                h[e].classList.toggle("active")
            }));

            let f = document.querySelectorAll(".objects__slide-favorites");
            for (let e = 0; e < f.length; e++) f[e].addEventListener("click", (function (t) {
                f[e].classList.toggle("active")
            }));

            let w = document.querySelectorAll(".city-col__bottom-number");
            for (let t = 0; t < w.length; t++) w[t].addEventListener("click", (function (o) {
                e(w), w[t].classList.add("active")
            }));

            document.querySelector(".city-col__btn-changer") && (document.querySelector(".city-col__btn-changer").onclick = function () {
                C.destroy(), P(1 / 0), C.container.fitToViewport(), this.classList.remove("active"), document.querySelector(".city-col").classList.remove("active"), document.querySelector(".map_city__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.add("map_city_active"), document.querySelector(".city__content").classList.add("city_map")
            }), document.querySelector(".map_city__btn-changer") && (document.querySelector(".map_city__btn-changer").onclick = function () {
                this.classList.remove("active"), document.querySelector(".city-col").classList.add("active"), document.querySelector(".city-col__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.remove("map_city_active"), document.querySelector(".city__content").classList.remove("city_map")
            }), document.querySelectorAll(".place__currency-preview").length && (document.querySelector(".place__currency-preview").onclick = function () {
                document.querySelector(".place__currency").classList.toggle("active")
            }), window.innerWidth > 1003 && document.querySelectorAll(".city").length && document.body.classList.add("scroll_fixed"), window.addEventListener("resize", (function (e) {
                window.innerWidth > 1003 && document.querySelectorAll(".city").length && document.body.classList.add("scroll_fixed"), window.innerWidth <= 1003 && document.querySelectorAll(".city").length && document.body.classList.remove("scroll_fixed")
            }));

            let g = document.querySelectorAll(".city-col__item"),
                b = document.querySelector(".place-w");

            for (let e = 0; e < g.length; e++) g[e].addEventListener("click", (function (e) {
                e.target.classList.contains("favorite-item-btn") || (document.body.classList.add("scroll_fixed"), document.querySelector(".header-w").classList.add("fixed"), b.classList.add("active"))
            }));

            document.querySelectorAll(".place__exit").length && (document.querySelector(".place__exit").onclick = function () {
                document.querySelector(".place-w").classList.remove("active"), document.body.classList.remove("scroll_fixed"), document.querySelector(".header-w").classList.remove("fixed")
            }), document.querySelectorAll(".place__header-exit").length && (document.querySelector(".place__header-exit").onclick = function () {
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
                    renderCustom: function (e, t, o) {
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
                for (let e = 0; e < S.length; e++) S[e].addEventListener("click", (function (t) {
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
                            renderCustom: function (e, t, o) {
                                return t + " из " + o
                            }
                        }
                    }), q.classList.add("active")
                }));

            if (L.length)
                for (let e = 0; e < L.length; e++) L[e].addEventListener("click", (function (e) {
                    x.classList.add("active")
                }));
            var C, E;

        })();

        function changerActive(list) {
            for (let i = 0; i < list.length; i++) {
                list[i].classList.remove('active')
            }
            list = 0
        }

        // список номеров телефонов
        if (document.querySelectorAll('.field-phone').length) {
            const fieldPhone = document.querySelectorAll('.field-phone')
            let phonesBtn
            fieldPhone.forEach(element => {
                phonesBtn = element.querySelectorAll('.contact__form-phone-country')

            });
            phonesBtn.forEach(btn => {
                btn.addEventListener('click', function () {
                    const paranetField = btn.closest('.field-phone')
                    const dropdownList = paranetField.querySelector('.contact__phone-dropdown')

                    this.classList.toggle('active')
                    dropdownList.classList.toggle('active')
                })
            });
        }
        // if(document.querySelectorAll('.field-phone').length) {
        //     const fieldPhone = document.querySelectorAll('.field-phone')
        //     let phonesBtn
        //     fieldPhone.forEach(element => {
        //         phonesBtn = element.querySelectorAll('.contact__form-phone-country')

        //     });
        //     phonesBtn.forEach(btn => {
        //         btn.addEventListener('click', function() {
        //             const paranetField = btn.closest('.field-phone')
        //             const dropdownList = paranetField.querySelector('.contact__phone-dropdown')

        //             this.classList.toggle('active')
        //             dropdownList.classList.toggle('active')
        //         })
        //     });
        // }

        //Popup close
        document.addEventListener("click", function (event) {
                event = event || window.event;
                let target = event.target

                if (target.classList.contains('popup')) {
                    target.classList.remove('active')
                    //   bodyScrollLock.enableBodyScroll(target);
                }

                //закрытие меню кликом по темной области
                if (target.classList.contains('header-m')) {
                    target.classList.remove('active')
                    //   bodyScrollLock.enableBodyScroll(target);
                    for (let i = 0; i < headerMenuBtn.length; i++) {
                        headerMenuBtn[i].classList.toggle('open')
                    }
                }
            }
        )

        // let popupClose = document.querySelectorAll('.popup-close')
        for (let i = 0; i < popupClose.length; i++) {
            popupClose[i].addEventListener("click",
                function () {
                    let popup = popupClose[i].closest('.popup')
                    if (popup.classList.contains('filter')) {
                        popup.classList.remove('popup')
                    } else {
                        popup.classList.remove('active')
                    }
                    // bodyScrollLock.enableBodyScroll(popup);
                })
        }


        // добавление выбранного кода странцы
        if (document.querySelectorAll('.contact__phone-list').length) {
            const contactPhoneList = document.querySelectorAll('.contact__phone-list')

            contactPhoneList.forEach(list => {
                list.addEventListener('click', function (e) {
                    const target = e.target
                    const parentBlock = target.closest('.selection-phone')
                    const phoneFlag = parentBlock.querySelector('.contact__form-country-item-img').querySelector('img')
                    const input = parentBlock.querySelector('.contact__phone-input')
                    const contactCountry = parentBlock.querySelector('.contact__form-phone-country')
                    const dropdown = parentBlock.querySelector('.contact__phone-dropdown')

                    if (target.classList.contains('contact__phone-list-item') || target.closest('.contact__phone-list-item')) {

                        const selectedPhoneBlock = target.closest('.contact__phone-list-item')
                        const img = selectedPhoneBlock.querySelector('.contact__phone-img').querySelector('img').getAttribute('src')
                        mask = selectedPhoneBlock.getAttribute('mask')
                        // const code = selectedPhoneBlock.querySelector('.contact__phone-title').querySelector('span').innerHTML
                        phoneFlag.setAttribute('src', img)
                        input.setAttribute('data-phone-pattern', mask)
                        input.value = ''
                        contactCountry.classList.remove('active')
                        dropdown.classList.remove('active')
                    }
                })
            });
        }

        //маска номера телефона
        document.addEventListener("DOMContentLoaded", function () {
            var eventCalllback = function (e) {
                var el = e.target,
                    clearVal = el.dataset.phoneClear,
                    pattern = el.dataset.phonePattern,
                    matrix_def = "+7(___) ___-__-__",
                    matrix = pattern ? pattern : matrix_def,
                    i = 0,
                    def = matrix.replace(/\D/g, ""),
                    val = e.target.value.replace(/\D/g, "");
                if (clearVal !== 'false' && e.type === 'blur') {
                    if (val.length < matrix.match(/([\_\d])/g).length) {
                        e.target.value = '';
                        return;
                    }
                }
                if (def.length >= val.length) val = def;
                e.target.value = matrix.replace(/./g, function (a) {
                    return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a
                });
            }
            var phone_inputs = document.querySelectorAll('[data-phone-pattern]');
            for (let elem of phone_inputs) {
                for (let ev of ['input', 'blur', 'focus']) {
                    elem.addEventListener(ev, eventCalllback);
                }
            }
        });
        getData();
    </script>
@endsection

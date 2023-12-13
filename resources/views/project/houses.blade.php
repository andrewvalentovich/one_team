@extends('project.includes.layouts')
@section('header')
    @include('project.includes.header')
@endsection
@section('content')
    @include('project.includes.search_nav_bar')
    <section class="city with-filter">
        <div class="city__content">
            <div id="map_city" class="">
            </div>
            <div class="map_city__btn-changer">
                <svg
                    class="map_city__btn-changer-img"
                    xmlns="http://www.w3.org/2000/svg"
                    xml:space="preserve"
                    width="24px"
                    height="24px"
                    version="1.1"
                    style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                    viewBox="0 0 0.6 0.6"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                >
								<g id="Слой_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"/>
                                    <path class="fil0 str0"
                                          d="M0.07 0.02l0.45 0c0.03,0 0.05,0.03 0.05,0.05l0 0.45c0,0.03 -0.02,0.05 -0.05,0.05l-0.45 0c-0.02,0 -0.05,-0.02 -0.05,-0.05l0 -0.45c0,-0.02 0.03,-0.05 0.05,-0.05z"/>
                                    <path class="fil0 str0"
                                          d="M0.2 0.17l-0.05 0m0.3 0l-0.2 0m0.2 0.25l-0.2 0m0.2 -0.12l-0.2 0m-0.05 0.12l-0.05 0m0.05 -0.12l-0.05 0"/>
                                </g>
							</svg>
                <div class="map_city__btn-changer-text">
                    {{__('Список')}}
                </div>
            </div>
            <div class="city-col active">
                <div class="city-col__top">
                    <div class="city-col__title title">

                            {{ __('Вся недвижимость') }}
                    </div>
                    <div class="city-col__filter">
                        <input type="hidden" name="order">
                        <div class="city-cil__filter-title">{{__('Сначала новые')}}</div>
                        <div class="city-col__filter-list"></div>
                    </div>
                    <div class="city-col__subtitle">
                        <span>
                        </span>
                        {{__('объявлений')}}
                    </div>

                    <div class="city-col__btns" style="font-size:16px;">
                        <div class="city-col__btn city-col__all" data_id="">
                            {{__('Все')}}
                        </div>
                        <div  class="city-col__btn city-col__not_secondary" data_id="new">
                            {{__('От застройщика')}}
                        </div>
                        <div  class="city-col__btn city-col__is_secondary" data_id="secondary">
                            {{__('Вторичка')}}
                        </div>
                        <input type="hidden" name="is_secondary">
                    </div>
                </div>
                    <div class="city-col__content">
                        <div class="nothing">
                            {{__('Объявлений не найдено')}}
                        </div>
                        <div class="city-col__list first-list">
                            @include('project.includes.object-template', ['products' => $products_first_list])
                        </div>
                        <div class="catalog-w catalog-w_mini catalog-middle" style="display: @if($products_second_list) block @else none @endif">
                            <section class="catalog">
                                <div class="catalog__content">
                                    <div class="catalog__text-w">
                                        <div class="catalog__text-bg">

                                        </div>
                                        <div class="catalog__text">
                                            <div class="catalog__text-body">
                                                <a href="{{route('home_page')}}" class="catalog__logo">
                                                    <img src="{{asset('project/img/svg/new_logo.svg')}}" alt="logo">
                                                </a>
                                                <p class="catalog__title">
                                                    Каталог строящихся прокетов на побережье средиземного моря
                                                </p>
                                                <p class="catalog__subtitle">
                                                    Работаем без комиссии для покупателя по ценам напрямую от застройщика
                                                </p>
                                                <img class="catalog__pic" src="{{asset('project/img/catalog-index.webp')}}" alt="">
                                                <div class="catalog__pdf">
                                                    <svg width="49" height="59" viewBox="0 0 49 59" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.8967 37.9589C11.8967 36.979 11.2168 36.3947 10.0172 36.3947C9.52737 36.3947 9.19562 36.4431 9.02209 36.4893L9.02209 39.633C9.22756 39.6793 9.48013 39.6947 9.82828 39.6947C11.1069 39.6947 11.8967 39.0487 11.8967 37.9589Z" fill="white"/>
                                                        <path d="M19.3227 36.4276C18.7855 36.4276 18.4384 36.474 18.233 36.5221L18.233 43.4845C18.4385 43.5328 18.7702 43.5328 19.0702 43.5328C21.2495 43.5482 22.6708 42.3486 22.6708 39.8067C22.6862 37.5963 21.3911 36.4276 19.3227 36.4276Z" fill="white"/>
                                                        <path d="M33.1201 2.1935e-07L9.42321 6.24088e-08C5.96132 3.94811e-08 3.14372 2.81956 3.14372 6.27949L3.14372 29.4999L2.53039 29.4999C1.13316 29.4999 -2.02872e-07 30.632 -2.12134e-07 32.0305L-3.13768e-07 47.3763C-3.23029e-07 48.7747 1.13304 49.9066 2.53039 49.9066L3.14372 49.9066L3.14372 52.7205C3.14372 56.1842 5.96132 59 9.4232 59L41.7565 59C45.2162 59 48.0342 56.1841 48.0342 52.7205L48.0342 14.8619L33.1201 2.1935e-07ZM6.63828 34.7998C7.37985 34.6745 8.42221 34.5801 9.89079 34.5801C11.3749 34.5801 12.4327 34.8634 13.1434 35.4324C13.8223 35.9686 14.2805 36.8537 14.2805 37.8953C14.2805 38.9367 13.9333 39.8221 13.3016 40.4218C12.48 41.1952 11.265 41.5424 9.84367 41.5424C9.52734 41.5424 9.24381 41.5267 9.02207 41.496L9.02207 45.3013L6.63828 45.3013L6.63828 34.7998ZM41.7565 55.1544L9.42321 55.1544C8.08275 55.1544 6.9912 54.0628 6.9912 52.7205L6.9912 49.9066L37.1325 49.9066C38.53 49.9066 39.663 48.7747 39.663 47.3763L39.663 32.0305C39.663 30.632 38.53 29.4999 37.1325 29.4999L6.9912 29.4999L6.9912 6.27949C6.9912 4.94099 8.08287 3.84944 9.42321 3.84944L31.6813 3.82619L31.6813 12.0536C31.6813 14.4567 33.6312 16.4084 36.0362 16.4084L44.0958 16.3853L44.1865 52.7204C44.1865 54.0628 43.0969 55.1544 41.7565 55.1544ZM15.8176 45.253L15.8176 34.7998C16.7017 34.6591 17.8541 34.5801 19.0702 34.5801C21.0913 34.5801 22.4019 34.9426 23.4289 35.7159C24.534 36.5375 25.2282 37.8471 25.2282 39.7274C25.2282 41.764 24.4866 43.17 23.4596 44.0378C22.339 44.9693 20.6333 45.411 18.5494 45.411C17.3015 45.411 16.4173 45.332 15.8176 45.253ZM33.0508 39.0641L33.0508 41.0216L29.2291 41.0216L29.2291 45.3013L26.8135 45.3013L26.8135 34.6591L33.3188 34.6591L33.3188 36.632L29.2291 36.632L29.2291 39.0641L33.0508 39.0641Z" fill="white"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="catalog__text-footer">
                                                Все актуальные предложения от застройщиков
                                            </div>
                                        </div>
                                    </div>
                                    <div class="catalog__info">
                                        <p class="catalog__info-title">
                                            Получить каталог, если нет времени на поиски
                                        </p>
                                        <button class="catalog__btn-get" popup-name="main-form-popup">
                                            Получить каталог
                                        </button>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="city-col__list second-list">
                            @include('project.includes.object-template', ['products' => $products_second_list])
                        </div>
                        <script>
                            const cityColItemPhp = document.querySelectorAll('.city-col__item')
                            cityColItemPhp.forEach(el => {
                                const objectSwiper = el.querySelector('.city__swiper')
                                const previousSwiperInstance = new Swiper(objectSwiper, {
                                    slidesPerView: 1,
                                    scrollbar: {
                                        el: ".city__scrollbar",
                                        hide: true
                                    }
                                });
                                el.addEventListener('mouseleave', function() {
                                    previousSwiperInstance.slideTo(0, 400)
                                })
                                addHoverMouseSwiper(previousSwiperInstance)
                            });

                            //свайп при ховере мышки
                            function addHoverMouseSwiper(swiper) {
                                if(!swiper) return
                                const slidesLength = swiper.slides.length
                                const width = 1 / slidesLength * 100
                                if(!swiper.el.querySelectorAll('i').length)
                                    for(let i = 0; i < slidesLength; i++) {
                                        let newDiv = document.createElement("i");
                                        newDiv.classList.add('i')
                                        swiper.el.append(newDiv)
                                        newDiv.style.width = width + '%'
                                        newDiv.style.left = width * i + '%'
                                        newDiv.addEventListener('mouseover', function() {
                                            swiper.slideTo(i, 400)
                                        })
                                    }
                            }

                        </script>
                        <div class="catalog-w catalog-w_mini catalog-w_footer">
                            <section class="catalog">
                                <div class="catalog__content">
                                    <img class="catalog__footer-pic" src="{{asset('project/img/questions-index.webp')}}" alt="">
                                    <div class="catalog__text-w">
                                        <div class="catalog__text-bg">

                                        </div>
                                        <div class="catalog__text">
                                            <div class="catalog__text-body">
                                                <!-- <a href="{{route('home_page')}}" class="catalog__logo">
                                                    <img src="{{asset('project/img/svg/new_logo.svg')}}" alt="logo">
                                                </a>
                                                <p class="catalog__title">
                                                    Каталог строящихся прокетов на побережье средиземного моря
                                                </p>
                                                <p class="catalog__subtitle">
                                                    Работаем без комиссии для покупателя по ценам напрямую от застройщика
                                                </p>
                                                <img class="catalog__pic" src="{{asset('project/img/questions-index.jpg')}}" alt="">
                                                <div class="catalog__pdf">
                                                    <svg width="49" height="59" viewBox="0 0 49 59" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.8967 37.9589C11.8967 36.979 11.2168 36.3947 10.0172 36.3947C9.52737 36.3947 9.19562 36.4431 9.02209 36.4893L9.02209 39.633C9.22756 39.6793 9.48013 39.6947 9.82828 39.6947C11.1069 39.6947 11.8967 39.0487 11.8967 37.9589Z" fill="white"/>
                                                        <path d="M19.3227 36.4276C18.7855 36.4276 18.4384 36.474 18.233 36.5221L18.233 43.4845C18.4385 43.5328 18.7702 43.5328 19.0702 43.5328C21.2495 43.5482 22.6708 42.3486 22.6708 39.8067C22.6862 37.5963 21.3911 36.4276 19.3227 36.4276Z" fill="white"/>
                                                        <path d="M33.1201 2.1935e-07L9.42321 6.24088e-08C5.96132 3.94811e-08 3.14372 2.81956 3.14372 6.27949L3.14372 29.4999L2.53039 29.4999C1.13316 29.4999 -2.02872e-07 30.632 -2.12134e-07 32.0305L-3.13768e-07 47.3763C-3.23029e-07 48.7747 1.13304 49.9066 2.53039 49.9066L3.14372 49.9066L3.14372 52.7205C3.14372 56.1842 5.96132 59 9.4232 59L41.7565 59C45.2162 59 48.0342 56.1841 48.0342 52.7205L48.0342 14.8619L33.1201 2.1935e-07ZM6.63828 34.7998C7.37985 34.6745 8.42221 34.5801 9.89079 34.5801C11.3749 34.5801 12.4327 34.8634 13.1434 35.4324C13.8223 35.9686 14.2805 36.8537 14.2805 37.8953C14.2805 38.9367 13.9333 39.8221 13.3016 40.4218C12.48 41.1952 11.265 41.5424 9.84367 41.5424C9.52734 41.5424 9.24381 41.5267 9.02207 41.496L9.02207 45.3013L6.63828 45.3013L6.63828 34.7998ZM41.7565 55.1544L9.42321 55.1544C8.08275 55.1544 6.9912 54.0628 6.9912 52.7205L6.9912 49.9066L37.1325 49.9066C38.53 49.9066 39.663 48.7747 39.663 47.3763L39.663 32.0305C39.663 30.632 38.53 29.4999 37.1325 29.4999L6.9912 29.4999L6.9912 6.27949C6.9912 4.94099 8.08287 3.84944 9.42321 3.84944L31.6813 3.82619L31.6813 12.0536C31.6813 14.4567 33.6312 16.4084 36.0362 16.4084L44.0958 16.3853L44.1865 52.7204C44.1865 54.0628 43.0969 55.1544 41.7565 55.1544ZM15.8176 45.253L15.8176 34.7998C16.7017 34.6591 17.8541 34.5801 19.0702 34.5801C21.0913 34.5801 22.4019 34.9426 23.4289 35.7159C24.534 36.5375 25.2282 37.8471 25.2282 39.7274C25.2282 41.764 24.4866 43.17 23.4596 44.0378C22.339 44.9693 20.6333 45.411 18.5494 45.411C17.3015 45.411 16.4173 45.332 15.8176 45.253ZM33.0508 39.0641L33.0508 41.0216L29.2291 41.0216L29.2291 45.3013L26.8135 45.3013L26.8135 34.6591L33.3188 34.6591L33.3188 36.632L29.2291 36.632L29.2291 39.0641L33.0508 39.0641Z" fill="white"/>
                                                    </svg>
                                                </div> -->
                                            </div>
                                            <!-- <div class="catalog__text-footer">
                                                Все актуальные предложения от застройщиков
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="catalog__info">
                                        <p class="catalog__info-title">
                                            Не нашли что нужно - напишите
                                        </p>
                                        <button class="catalog__btn-get" popup-name="main-form-popup">
                                            Связаться
                                        </button>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="city-col__bottom">
                        <div class="city-col__bottom-btns">
                            <style>
                                .page-item {
                                    margin: 0 5px;
                                }
                                .pagination {
                                    display: flex;
                                    justify-content: space-between;
                                    margin: 0 35px;
                                }
                                .page-link {
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
                                .active > span {
                                    color: #fff;
                                    border: none;
                                    background: #508cfa;
                                }
                            </style>
                            <div class="city-col__bottom-pages" style="display:none">

                            </div>
                        </div>
                    </div>
                    <div class="city-col__foooter">
                        <div class="footer-w">
                            <footer class="footer footer_col">
                                <div class="footer__top">
                                    <a href="{{route('home_page')}}" class="footer__logo">
                                        <img src="{{asset('project/img/svg/new_logo.svg')}}" alt="logo">
                                    </a>
                                </div>
                                <div class="footer__nav">
                                    <div class="footer__nav-list">
                                        <?php $get_footer_link = \App\Models\CompanySelect::orderby('status', 'asc')->orderby('updated_at', 'desc')->get(); ?>
                                        @foreach($get_footer_link as $link)
                                            <a href="{{route('about', $link->slug)}}" class="footer__nav-item">
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
                    <div class="city-col__btn-changer active">
                        <svg class="city-col__btn-changer-img xmlns=" http://www.w3.org/2000/svg" xml:space="preserve" width="27px" height="25px" version="1.1"
                            style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision;
                            image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                            viewBox="0 0 0.81 0.75"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Слой_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"/>
                                <polygon class="fil0 str0"
                                         points="0.03,0.71 0.28,0.63 0.53,0.71 0.78,0.63 0.78,0.04 0.53,0.13 0.28,0.04 0.28,0.04 0.03,0.13 "/>
                                <line class="fil0 str0" x1="0.28" y1="0.63" x2="0.28" y2="0.04"/>
                                <line class="fil0 str0" x1="0.53" y1="0.71" x2="0.53" y2="0.13"/>
                            </g>
                        </svg>
                        <div class="city-col__btn-changer-text">
                            {{__('Карта')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
    .zoom-control{padding:4px}.zoom-control__group{border-radius:12px;box-shadow:0 var(--shadow-y) var(--shadow-blur) 0 var(--shadow-color)}.zoom-control__group:hover{box-shadow:0 var(--shadow-y) 10px 0 var(--shadow-color)}.zoom-control__icon{width:100%;height:100%;pointer-events:none;background-position:50%;background-repeat:no-repeat}._mobile .zoom-control{padding:0}._mobile .zoom-control__group{border-radius:0;box-shadow:none}._mobile .zoom-control__zoom-in{margin-bottom:12px}
    </style>
@endsection
@section('scripts')
    <script>
        handleIsSecondary();
        handleOrder('{{ __('Сначала дешёвые') }}', '{{ __('Сначала дорогие') }}', '{{ __('Сначала новые') }}');

        function changerActive(list) {
            for(let i = 0; i < list.length; i++) {
                list[i].classList.remove('active')
            }
            list = 0
        }


        let g = document.querySelectorAll(".kompleks__layout-img"),
            b = document.querySelectorAll(".object__photo");

        g.forEach((item, index) => {
            item.addEventListener('click', () => {
                b[0].classList.add("active");
                b[0].childNodes[1].childNodes[1].childNodes[1].src = item.childNodes[1].src;
            })
        })

        let spal = "{{ __('спал') }}";
        let van = "{{ __('ван') }}";
        let kvm = "{{ __('кв.м') }}";

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        (async () => {

            function e(e) {
                for (let t = 0; t < e.length; t++) e[t].classList.remove("active");
                e = 0
            }

            window.addEventListener("resize", (function (e) {
            })), document.querySelectorAll(".place-w").length && window.innerWidth <= 540 && window.addEventListener("resize", (function (e) {
                document.querySelectorAll("#map_city").length && (window.innerWidth > 1003 && document.querySelector(".city__content").classList.remove("city_map"), window.innerWidth <= 1003 && (document.querySelector("#map_city").style.height = "100%"), window.innerWidth > 1003 && (document.querySelector(".city-col").classList.add("active"), document.querySelector(".map_city__btn-changer").classList.remove("active"), document.querySelector(".city-col__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.remove("show"), document.querySelector("#map_city").classList.remove("map_city_active"), document.querySelector(".city__content").classList.remove("city_map")), window.innerWidth > 1199 && (document.querySelector("#map_city").style.height = window.innerHeight - 18 - 161 + "px"), window.innerWidth <= 1199 && window.innerWidth > 1003 && (document.querySelector("#map_city").style.height = window.innerHeight - 88 - 60 + "px"))
            })),document.querySelector(".header__top-phone-menu").onclick = function () {
                document.querySelector(".header-m").classList.toggle("active"), document.querySelector("#nav-icon").classList.toggle("open"), document.querySelector(".header-w").classList.add("fixed"), document.querySelector(".header-m").classList.contains("active") || document.querySelector(".place-w").classList.contains("active") || document.querySelector(".header-w").classList.remove("fixed")
            }
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
            })

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

            function m() {

                for (let e = 0; e < u.length - 1; e++) u[e].style.zIndex = 5

            }

 document.querySelector(".city-col__filter") && (document.querySelector(".city-col__filter").onclick = function () {

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

            let h = document.querySelectorAll(".favorite-item-btn");

            for (let e = 0; e < h.length; e++) h[e].addEventListener("click", (function (t) {

                h[e].classList.toggle("active")

            }));

            let f = document.querySelectorAll(".objects__slide-favorites");

            let w = document.querySelectorAll(".city-col__bottom-number");

            for (let t = 0; t < w.length; t++) w[t].addEventListener("click", (function (o) {

                e(w), w[t].classList.add("active")

            }));

            document.querySelector(".city-col__btn-changer") && (document.querySelector(".city-col__btn-changer").onclick = function () {

                 P(1 / 0),  this.classList.remove("active"), document.querySelector(".city-col").classList.remove("active"), document.querySelector(".map_city__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.add("map_city_active"), document.querySelector(".city__content").classList.add("city_map")

            }), document.querySelector(".map_city__btn-changer") && (document.querySelector(".map_city__btn-changer").onclick = function () {

                this.classList.remove("active"), document.querySelector(".city-col").classList.add("active"), document.querySelector(".city-col__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.remove("show"), document.querySelector("#map_city").classList.remove("map_city_active"), document.querySelector(".city__content").classList.remove("city_map")

            }), document.querySelectorAll(".place__currency-preview").length && (document.querySelector(".place__currency-preview").onclick = function () {

                document.querySelector(".place__currency").classList.toggle("active")

            }), window.innerWidth > 1003 && document.querySelectorAll(".city").length && document.body.classList.add("scroll_fixed"), window.addEventListener("resize", (function (e) {

                window.innerWidth > 1003 && document.querySelectorAll(".city").length && document.body.classList.add("scroll_fixed"), window.innerWidth <= 1003 && document.querySelectorAll(".city").length && document.body.classList.remove("scroll_fixed")

            }));



            for (let e = 0; e < g.length; e++) g[e].addEventListener("click", (function (e) {
                e.target.classList.contains("favorite-item-btn") || (document.body.classList.add("scroll_fixed"), document.querySelector(".header-w").classList.add("fixed"))
            }));

            document.querySelectorAll(".place__exit").length && (document.querySelector(".place__exit").onclick = function () {
                const cityCol = document.querySelector('.city-col')
                cityCol.style.display = '';
                document.querySelector(".place-w").classList.remove("active"), document.body.classList.remove("scroll_fixed"), document.querySelector(".header-w").classList.remove("fixed")
            }), document.querySelectorAll(".place__header-exit").length && (document.querySelector(".place__header-exit").onclick = function () {
                document.querySelector(".place-w").classList.remove("active"), document.body.classList.remove("scroll_fixed"), document.querySelector(".header-w").classList.remove("fixed")
            })

            let S = document.querySelectorAll(".place__collage-item_clickable"),
                L = document.querySelectorAll(".place__slide_clickable"),
                q = document.querySelector(".place__slider_p"),
                k = document.querySelector(".place__slider_p-exit"),
                x = document.querySelector(".place-popup-collage"),
                A = document.querySelector(".place-popup-collage__exit");

            if (document.querySelectorAll(".place__header-exit").length) {
                const placeExitBtn = document.querySelectorAll(".place__header-exit")
                placeExitBtn.forEach(btn => {
                    btn.addEventListener('click', function () {
                        const placeW = this.closest('.place-w')
                        placeW.classList.remove('active')

                        history.back();

                        const cityCol = document.querySelector('.city-col')
                        cityCol.style.display = '';
                    })
                });
            }

            if (document.querySelectorAll('.place-popup-collage__exit').length) {
                const placeCollageExitBtn = document.querySelectorAll('.place-popup-collage__exit')
                placeCollageExitBtn.forEach(btn => {
                    btn.addEventListener('click', function () {
                        const placeCollage = this.closest('.place-popup-collage')
                        placeCollage.classList.remove('active')
                    })
                });
            }
            var C, E;

// динамический массив для заполнения точек на карте map_city
let firstCall = 1
function P(e) {
    // Получение текущего URL
    const currentUrl = window.location.href;
    // Создание объекта URL
    const url = new URL(currentUrl);
    // Получение параметров из URL
    const searchParams = url.searchParams;
    let currentCoordinateMapLeft = null
    let currentCoordinateMapRight = null
    let currentPage = 0
    let lustPageReached = false
    let mapCountry;
    var script;
    var head = document.getElementsByTagName('head')[0];

    let site_url = `{{ config('app.url') }}`;
    let locationsCity = [];
    let houseData = {}
    let objectsListSet = new Set()
    let objectsListMap = new Map()
    let user_id = {{ isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : time() }}

    const langSite = `{{ app()->getLocale() }}`

    let previousSwiperInstance = null;
    let ballons = []

    const dictionary = {
        rooms_bedroom: {
            ru: 'спальни',
            en: 'bedrooms',
            tr: 'yatak odaları',
            de: 'schlafzimmer',
        },
        rooms_bathroom: {
            ru: 'ванные',
            en: 'bathrooms',
            tr: 'banyolar',
            de: 'badezimmer',
        },
        square_m: {
            ru: 'кв.м.',
            en: 'sq.m.',
            tr: 'metrekare',
            de: 'qm',
        },
        from: {
            ru: 'от',
            en: 'from',
            tr: 'itibaren',
            de: 'aus',
        },
        month: {
            ru: 'мес',
            en: 'month',
            tr: 'aylar',
            de: 'monate',
        }
    }

    function setListenersToOpenPopup() {
        const cityColList = document.querySelectorAll('.city-col__list')
        cityColList.forEach(list => {
            list.addEventListener('click', function(e) {
                const houseCard = e.target.closest('.city-col__item');
                if (!houseCard) return
                const id = houseCard.getAttribute('data_id')
                let object = {...objectsListMap.get(parseInt(id))}
                getObjectBySimpleRequest(object)
            })
        });
    }

    setListenersToOpenPopup()

    let firstClear = false
    function setCityItem(data, clearList) {
        const cityListFirst = document.querySelector('.first-list')
        const cityListSecond = document.querySelector('.second-list')
        const catalogFooter = document.querySelector('.catalog-w_footer')

        if(clearList) {
            if(firstClear === false) {
                firstClear = true
            } else {
                cityListFirst.innerHTML = ''
                cityListSecond.innerHTML = ''
            }
        }
        // Удаление предыдущего экземпляра Swiper, если он есть
        if (previousSwiperInstance) {
            previousSwiperInstance = null;
        }


        data.forEach((cityElement, index) => {
            const inListObject = document.querySelector(`[data_id="${parseInt(cityElement.id)}"]`)
            if(inListObject) {
                return
            }
            const cityItem = document.createElement('div');
            cityItem.classList.add('city-col__item');
            cityItem.setAttribute('id', `card_object-${cityElement.id}`);
            cityItem.setAttribute('data_id', cityElement.id);

            const sliderDiv = document.createElement('div');
            sliderDiv.classList.add('city-col__slider');

            const swiperDiv = document.createElement('div');
            swiperDiv.classList.add('city__swiper', 'swiper');

            const wrapperDiv = document.createElement('div');
            wrapperDiv.classList.add('city__wrapper', 'swiper-wrapper');
            swiperDiv.appendChild(wrapperDiv);

            const maxIterations = 5
            const hasMoreThanFivePhotos = cityElement.photo.length > maxIterations;

            cityElement.photo.slice(0, maxIterations).forEach((photo, index, array) => {
                const slideDiv = document.createElement('div');
                slideDiv.classList.add('city__slide', 'swiper-slide');

                const imgDiv = document.createElement('div');
                imgDiv.classList.add('city-col__item-img');

                const img = document.createElement('img');

                if (photo.preview !== null && photo.preview) {
                    img.setAttribute('src', `/${photo.preview}`);
                } else {
                    img.setAttribute('src', `/uploads/${photo.photo}`);
                }

                img.setAttribute('alt', 'place');
                imgDiv.appendChild(img);

                slideDiv.appendChild(imgDiv);


                // Проверяем, является ли текущий элемент последним
                if (index === array.length - 1 && cityElement.photo_count > 5) {
                    slideDiv.classList.add('last-slide');
                    const span = document.createElement('span');
                    span.classList.add('quantity');
                    span.innerHTML = `+ еще ${cityElement.photo_count - maxIterations} фото`;
                    slideDiv.appendChild(span);
                }

                wrapperDiv.appendChild(slideDiv);
            });




            const scrollbarDiv = document.createElement('div');
            scrollbarDiv.classList.add('city__scrollbar');
            swiperDiv.appendChild(scrollbarDiv);
            sliderDiv.appendChild(swiperDiv);
            cityItem.appendChild(sliderDiv);

            // Создание текстовой части
            const textDiv = document.createElement('div');
            textDiv.classList.add('city-col__item-text');

            // favorite
            const favoriteDiv = document.createElement('div');
            favoriteDiv.classList.add('objects__slide-favorites','check-favorites');
            if(cityElement.favorite.length) {
                favoriteDiv.classList.add('active');
            }
            favoriteDiv.setAttribute('data_id', cityElement.id)
            favoriteDiv.innerHTML =
            `<svg class="blue" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="73px" height="64px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 2.33 2.04" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Слой_x0020_1">
                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                    <path class="fil0 str0" d="M1.16 1.88c-0.22,-0.16 -0.5,-0.38 -0.77,-0.65 -0.2,-0.19 -0.26,-0.37 -0.26,-0.55 0,-0.31 0.26,-0.55 0.58,-0.55 0.18,0 0.35,0.08 0.45,0.21 0.11,-0.13 0.28,-0.21 0.46,-0.21 0.32,0 0.58,0.24 0.58,0.55 0,0.18 -0.06,0.36 -0.26,0.55 -0.27,0.27 -0.56,0.49 -0.78,0.65z"></path>
                </g>
            </svg>`
            cityItem.appendChild(favoriteDiv);

            favoriteDiv.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
            })

            //плашки
            if(cityElement.tags) {
                const die = document.createElement('div');
                die.classList.add('die__list');
                cityElement.tags.forEach(el => {
                    const div = document.createElement('div');
                    div.classList.add('die__list-item');
                    div.innerHTML = el
                    die.appendChild(div)
                });
                cityItem.appendChild(die);
            }


            //цена в карточке превью
            const priceDiv = document.createElement('div');
            priceDiv.classList.add('city-col__item-price');

            if (window.locale == 'ar' || window.locale == 'fa') {
                priceDiv.style.textAlign = "right";
                priceDiv.style.direction = "ltr";
            }

            if (cityElement.layouts_count > 1) {
                priceDiv.textContent = `€ ${cityElement.min_price} +`;
            } else {
                priceDiv.textContent = `€ ${cityElement.min_price}`;
            }

            textDiv.appendChild(priceDiv);

            //комнаты в карточке превью
            const roomsDiv = document.createElement('div');
            roomsDiv.classList.add('city-col__item-rooms');

            const spalni = cityElement.spalni
            const vannie = cityElement.vanie

            if (cityElement.layouts_count > 0) {
                roomsDiv.innerHTML = `${cityElement.number_rooms_unique}`
                // let list = new Set();
                // layouts.forEach((layout, index) => {
                //     if (list.has(layout.number_rooms)) {
                //
                //     } else {
                //         list.add(layout.number_rooms);
                //         if (index === 0 ) {
                //             roomsDiv.innerHTML += `${layout.number_rooms}`;
                //         } else if (index === layouts.length - 1) {
                //             roomsDiv.innerHTML += `, ${layout.number_rooms}`;
                //         } else {
                //             roomsDiv.innerHTML += `, ${layout.number_rooms}`;
                //         }
                //     }
                // });
            } else {
                roomsDiv.innerHTML = `${cityElement.size}` + ' {{ __('кв.м') }}'

                if (spalni && spalni.length > 0) {
                    roomsDiv.innerHTML += `<span>|</span> ${spalni.replace('+', '')} ${dictionary.rooms_bedroom[langSite]}`;
                }

                if (vannie && vannie.length > 0) {
                    roomsDiv.innerHTML += `<span>|</span> ${vannie.replace('+', '')} ${dictionary.rooms_bathroom[langSite]}`;
                }
            }


            textDiv.appendChild(roomsDiv);

            const deadlineDiv = document.createElement('div');
            deadlineDiv.classList.add('city-col__item-deadline');
            deadlineDiv.textContent = cityElement.deadline;
            textDiv.appendChild(deadlineDiv);

            const addressDiv = document.createElement('div');
            addressDiv.classList.add('city-col__item-address');
            addressDiv.textContent = cityElement.address;
            textDiv.appendChild(addressDiv);

            cityItem.appendChild(textDiv);

            // Добавление элемента в контейнер
            const elementsInFirstList = cityListFirst.querySelectorAll('.city-col__item')



            let quantityObjects
            if(window.innerWidth <= 1003 && window.innerWidth > 899) {
                quantityObjects = 2
            } else if(window.innerWidth <= 899) {
                quantityObjects = 3
            } else {
                quantityObjects = 3
            }
            if(elementsInFirstList.length <= quantityObjects && index <= quantityObjects) {
                cityListFirst.appendChild(cityItem);
            } else {
                cityListSecond.appendChild(cityItem);
            }
            cityItem.addEventListener('mouseenter', function() {
                console.log('test')
                const id = cityItem.getAttribute('data_id')
                let currentBallon
                ballons.forEach(element => {
                    if(element.house_id == id) currentBallon = element
                });
                // marks.forEach(element => {
                //     element.classList.remove('active')
                // });
                const marks = document.querySelectorAll(`[mark-id]`);
                const mark = document.querySelector(`[mark-id="${id}"]`);
                mark.classList.add('active')
                if(window.innerWidth >= 1004) {
                    currentBallon.balloon.open();
                }
            })
            const objectSwiper = cityItem.querySelector('.city__swiper')
            const previousSwiperInstance = new Swiper(objectSwiper, {
                slidesPerView: 1,
                scrollbar: {
                    el: ".city__scrollbar",
                    hide: true
                }
            });
            addHoverMouseSwiper(previousSwiperInstance)
            cityItem.addEventListener('mouseleave', function() {
                mapCountry.balloon.close()
                const marks = document.querySelectorAll(`[mark-id]`);
                const swiperWrapper = this.querySelector('.city__wrapper')
                const idSwiper = swiperWrapper.getAttribute('id')
                marks.forEach(element => {
                    element.classList.remove('active')
                });
                previousSwiperInstance.slideTo(0, 400)
            })
        });

        const middleCatalog = document.querySelector('.catalog-middle')
        const footerCatalog = document.querySelector('.catalog-w_footer')
        const quantityObjectsAll = document.querySelectorAll('.city-col__item')
        if (quantityObjectsAll.length >= 6) {
            middleCatalog.style.display = 'block'
        } else {
            middleCatalog.style.display = 'none'
        }
        if (quantityObjectsAll.length === 0) {
            footerCatalog.style.display = 'none'
        } else {
            footerCatalog.style.display = 'block'
        }

        if(data.length !== 0) {
            addHoverMouseSwiper(previousSwiperInstance)
        }
    }

    //свайп при ховере мышки
    function addHoverMouseSwiper(swiper) {
        if(!swiper) return
        const slidesLength = swiper.slides.length
        const width = 1 / slidesLength * 100
        if(!swiper.el.querySelectorAll('i').length)
        for(let i = 0; i < slidesLength; i++) {
            let newDiv = document.createElement("i");
            newDiv.classList.add('i')
            swiper.el.append(newDiv)
            newDiv.style.width = width + '%'
            newDiv.style.left = width * i + '%'
            newDiv.addEventListener('mouseover', function() {
                swiper.slideTo(i, 400)
            })
        }
    }

    function setPagination(data) {
        if (data.last_page !== 1) {
            var pagination = getPagination(data);
            $(".city-col__bottom-pages").html(pagination);
            $(".city-col__pages_m").html(pagination);
        }
    }

    function getPagination(data) {
        // Пагинация
        var pagination = `<nav>
        <ul class="pagination">`;

        if (data.current_page === 1) {
            pagination +=  `<li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                <span class="page-link" aria-hidden="true">&lsaquo;</span>
                            </li>`;
        } else {
            pagination +=  `<li class="page-item">
                                    <a class="page-link" href="${data.prev_page_url}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                </li>`;
        }
        $.each(data.links, function (page, link) {
            if(page === 0 || page === (data.last_page+1)) {
                return;
            } else {
                if (link.active === true) {
                    pagination += `<li class="page-item active" aria-current="page"><span class="page-link">${page}</span></li>`;
                } else {
                    let url = "";
                    let params = window
                    .location
                    .search
                    .replace('?','')
                    .split('&')
                    .reduce(
                        function(p,e){
                            var a = e.split('=');
                            p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                            return p;
                        },
                        {}
                    );

                    if (window.location.search.indexOf("?") !== -1) {
                        if (params['page'] === undefined) {
                            url = window.location + "&page=" + page;
                        } else {
                            let search_str = "page="+data.current_page;
                            let page_str = "page=";
                            let win_loc_str = window.location.toString();

                            let pos = window.location.toString().indexOf(search_str);
                            let search_len = data.current_page.toString().length;

                            url = win_loc_str.substr(0, pos + page_str.length) + page + win_loc_str.substr(pos + page_str.length + search_len);
                        }
                    } else {
                        url = window.location + "?page=" + page;
                    }

                    pagination += `<li class="page-item"><a class="page-link" href="/${url}">${page}</a></li>`;
                }
            }
        });

        if (data.next_page_url !== null) {
            pagination += `<li class="page-item">
                                <a class="page-link" href="${data.next_page_url}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                            </li>`;
        } else {
            pagination += `<li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                <span class="page-link" aria-hidden="true">&rsaquo;</span>
                            </li>`;
        }

        pagination += `</ul>
                    </nav>`;

        return pagination;
    }

    function setCountObjectsPerPage() {
        const nothing = document.querySelector('.nothing')
        const pagination = document.querySelector('.city-col__bottom-btns')
        const objects = document.querySelectorAll('.city-col__item')

        if(objects.length == 0) {
            // nothing.classList.add('active')
            pagination.classList.remove('active')
        } else {
            nothing.classList.remove('active')
            pagination.classList.add('active')
        }
    }

    let placeMap = null;
    // async function getObjectById() {
    //     $.ajax({
    //         url: '/api/houses/filter_params',       /* Куда отправить запрос */
    //         data: {
    //             locale: window.locale,
    //         },
    //         method: 'get',                                              /* Метод запроса (post или get) */
    //         success: function(data) {
    //             window.filter_params_data = data;
    //             var requestData = findObjectParams(data);
    //             requestData.locale = window.locale;

    //             // Выполнение AJAX-запроса с параметрами
    //             $.ajax({
    //                 url: '/api/houses/simple',
    //                 data: requestData,
    //                 method: 'get',
    //                 success: function (data) {
    //                     setNewPopupHouseData(data);
    //                 }
    //             });
    //         }
    //     });
    // }
    let objectIDForSwiper = null

    function checkFavorites(data) {
        favotires_house_id = Object.assign({}, favotires_house_id)
        data.forEach(element => {
            if(element.favorite.length) {
                favotires_house_id[element.id] = true
            }
        });
    }

    function setBallons(houses) {
        var t = ymaps.templateLayoutFactory.createClass('<div class="popover top"><a class="close" href="#">&times;</a><div class="arrow"></div><div class="popover-inner">$[[options.contentLayout observeSize minWidth=235 maxWidth=235 maxHeight=350]]</div></div>', {
            build: function () {
                this.constructor.superclass.build.call(this);
                this._$element = $(".popover", this.getParentElement());
                this.applyElementOffset();
                this._$element.find(".close").on("click", $.proxy(this.onCloseClick, this));
            },
            clear: function () {
                this._$element.find(".close").off("click");
                this.constructor.superclass.clear.call(this);
            },
            onSublayoutSizeChange: function () {
                t.superclass.onSublayoutSizeChange.apply(this, arguments);
                if (this._isElement(this._$element)) {
                    this.applyElementOffset();
                    this.events.fire("shapechange");
                }
            },
            applyElementOffset: function () {
                this._$element.css({
                    left: -this._$element[0].offsetWidth / 2,
                    top: -(this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight)
                });
            },
            onCloseClick: function (e) {
                e.preventDefault();
                this.events.fire("userclose");
            },
            getShape: function () {
                if (!this._isElement(this._$element)) {
                    return t.superclass.getShape.call(this);
                }
                var e = this._$element.position();
                return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                    [e.left, e.top],
                    [e.left + this._$element[0].offsetWidth, e.top + this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight]
                ]));
            },
            _isElement: function (e) {
                return e && e[0] && e.find(".arrow")[0];
            }
        });

        var o = ymaps.templateLayoutFactory.createClass('<div class="placemark"></div>', {
            build: function () {
                o.superclass.build.call(this);
                var e = this.getParentElement().getElementsByClassName("placemark")[0];
                var t = this.isActive ? 60 : 34;
                var c = {
                    type: "Circle",
                    coordinates: [0, 0],
                    radius: t / 2
                };
                var l = {
                    type: "Circle",
                    coordinates: [0, -30],
                    radius: t / 2
                };

                this.getData().options.set("shape", this.isActive ? l : c);
                document.addEventListener("click", function (e) {
                    if ((e.target.classList.contains("ymaps-2-1-79-balloon__close-button") || e.target.classList.contains("ymaps-2-1-79-user-selection-none")) && window.innerWidth <= 1003) {
                        var t = document.querySelectorAll(".placemark");
                        for (var i = 0; i < t.length; i++) {
                            t[i].classList.remove("active");
                        }
                    }
                });
                if (!this.inited) {
                    this.inited = true;
                    this.isActive = false;
                    this.getData().geoObject.events.add("click", function (t) {
                        var o = document.querySelectorAll(".placemark");
                        if (e.classList.contains("active")) {
                            e.classList.remove("active");
                        } else {
                            for (var i = 0; i < o.length; i++) {
                                o[i].classList.remove("active");
                            }
                            e.classList.add("active");
                        }
                    }, this);
                }
            }
        });

        var c = ymaps.templateLayoutFactory.createClass('<div class="ballon-city__content">$[properties.balloonContent]</div>');
        houses.forEach(city => {
            locationsCity.push({
                coordinates: [city.lat, city.long],
                balloonContent: `<div class="balloon-city" id="${city.id}">
                    <div class="balloon-city__text">
                        <div class="balloon-city__price">€ ${city.price}</div>
                        <div class="balloon-city__rooms">${city.spalni} ${spal}, ${city.vannie} ${van}</div>
                        <div class="balloon-city__rooms_m">${city.kv} ${kvm}  <span>|</span> ${city.spalni} спальни  <span>|</span> ${city.vannie} ванна</div>
                        <div class="balloon-city__address">${city.address} Balbey, 431. Sk. No:4, 07040 Muratpaşa</div>
                        <div class="balloon-city__square">${city.kv} ${kvm}</div>
                    </div>
                    <div class="balloon-city__img"> <img src="/uploads/${city.photo}"></div>
                </div>`,
                city_id: city.id,
            });
        });
        locationsCity.forEach(function (location) {
            var placemark = new ymaps.Placemark(location.coordinates, {
                balloonContent: location.balloonContent,
                balloonAutoPan: false,
            }, {
                balloonPanelMaxMapArea: 250000,
                balloonShadow: false,
                balloonLayout: t,
                balloonAutoPan: false,
                iconLayout: o,
                balloonContentLayout: c,
                hideIconOnBalloonOpen: false,
                balloonOffset: [-110, -50],
                iconImageSize: [17,17]
            });
            mapCountry.geoObjects.add(placemark);

            placemark.events.add('mouseenter', function (e) {
                placemark.balloon.open(); // Открываем балун при наведении мыши
                setTimeout(function () {
                    var balloonContentElement = document.querySelector('.balloon-city');
                    if (balloonContentElement) {
                        var mouseLeaveListener = function () {
                            placemark.balloon.close();
                            balloonContentElement.removeEventListener('mouseleave', mouseLeaveListener);
                        };
                        balloonContentElement.addEventListener('mouseleave', mouseLeaveListener);
                    }
                }, 0);
            });
        });
    }

    function changeLangMap(lang) {
        if(!firstCall) return
        firstCall = 0
        var language = lang;
        if (mapCountry) {
            mapCountry.destroy();
        }
        script = document.createElement('script');
        script.type = 'text/javascript';
        script.charset = 'utf-8';
        script.src = 'https://api-maps.yandex.ru/2.1/?onload=init_' + language + '&lang=' + language + '_RU&ns=ymaps_' + language;
        head.appendChild(script);
        window['init_' + language] = function () {
            init(window['ymaps_' + language]);
        };
    }

    let mapLang = "<?php echo app()->getLocale() ?>";
    const userAgent = navigator.userAgent.toLowerCase();

    changeLangMap(mapLang);

    async function init(ymaps) {
        let p = document.querySelectorAll(".city-col__btn");
        for (let t = 0; t < p.length; t++) p[t].addEventListener("click", ( async function (o) {
            $('.city-col__btn').removeClass('active');
            $(this).addClass('active');
            var new_is_secondary = p[t].getAttribute('data_id');

            var prev_is_secondary = $("input[name='is_secondary']").val();
            $("input[name='is_secondary']").val(new_is_secondary);

            var urlParams = handleUrlParams(prev_is_secondary.toLowerCase(), new_is_secondary.toLowerCase());
            updateUrl(window.filter_params_data, urlParams);

            let allMarks = await getDataMarks()
            createMapCity(allMarks)
        }));

        $('.city-col__filter-item').on('click', async function() {
            var new_order = $(this).attr('data_id');
            var text = $(this).text();

            var prev_order = $("input[name='order']").val();
            $("input[name='order']").val(new_order);

            $('.city-cil__filter-title').text(text);

            $('.city-col__filter-item.active').removeClass('active');
            $(this).addClass('active');

            var urlParams = handleUrlParams(prev_order.toLowerCase(), new_order.toLowerCase());
            updateUrl(window.filter_params_data, urlParams);

            let allMarks = await getDataMarks()
            createMapCity(allMarks)
        });

        //отправить запрос с фильтром по кнопке найти страница houses
        if(document.querySelectorAll('.btn-filter-houses').length) {
            const btnFilterHouses = document.querySelector('.btn-filter-houses')
            btnFilterHouses.addEventListener('click', async function() {
                let allMarks = await getDataMarks()
                createMapCity(allMarks)
                changeCountryField()
            })
        }

        function changeCountryField() {
            // Получаем GET параметр country_id из url
            handleCountries(window.filter_params_data);
        }

        function getDataMarks() {
            let params = createParams()
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `/api/houses/all`,
                    method: 'GET',
                    dataType: 'json',
                    data: params,
                    success: function (data) {
                        resolve(data.data);
                        console.log(data.data);
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            })
        }

        function createParams() {
            // let urlParams = new URLSearchParams(window.location.search);
            // let params = {};

            let params = createParamsForFilterFromUrl();
            params.locale = window.locale;

            // urlParams.forEach((value, key) => {
            //     params[key] = value;
            // });

            params.user_id = user_id;
            if (params.country === true) params.country = null;
            if (params.country_id === true) params.country_id = null;
            if (params.city === true) params.city = null;
            if (params.city_id === true) params.city_id = null;
            if (params.type === true) params.type = null;
            if (params.type_id === true) params.type_id = null;
            if (params.price && params.price.min === true) params.price.min = null;
            if (params.price && params.price.max === true) params.price.max = null;
            if (params.bedrooms === true) params.bedrooms = null;
            if (params.bathrooms === true) params.bathrooms = null;
            if (params.view === true) params.view = null;
            if (params.to_sea === true) params.to_sea = null;

            if (params.size && params.size.min === true) params.size.min = null;
            if (params.size && params.size.max === true) params.size.max = null;

            return params;
        }

        let marksFilter = await getDataMarks()

        createMapCity(marksFilter)
        async function getData(topLeft, bottomRight, paramsCustom) {
            let params = createParams()
            if(paramsCustom) {
                params.page = paramsCustom.page
            }
                $.ajax({
                    url: `/api/houses/by_coordinates/with_filter`,
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        ...params,
                        top_left: topLeft,
                        bottom_right: bottomRight,
                    },
                    success: function (data) {
                        locationsCity.length = 0;
                        houseData.length = 0;
                        houseData = { ...data }
                        if(data.data.length !== 12 && paramsCustom) {
                            lustPageReached = true
                        }
                        data.data.forEach(object => {
                            if (!objectsListSet.has(object.id)) {
                                objectsListSet.add(object.id);
                                objectsListMap.set(object.id, object);
                            }
                        });
                        checkFavorites(data.data)
                        let site_url = `{{config('app.url')}}`;

                        // setBallons(data.data);
                        if(!paramsCustom) {
                            setCityItem(data.data, true);
                        } else {
                            setCityItem(data.data, false);
                        }
                        setCountObjectsPerPage()
                        // setListenersToOpenPopup();
                        setListenersToAddfavorites();
                        setPagination(data.data);
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
        }



        // делаем запрос на объекты когда доскролили вниз
        const cityCol = document.querySelector('.city-col');
        const cityColFooter = document.querySelector('.city-col__foooter');
        let canLoadData = true;
        function onScrollToFooter() {
            const cityColTop = cityCol.getBoundingClientRect().top;
            const footerTop = cityColFooter.getBoundingClientRect().top;
            const footerBottom = cityColFooter.getBoundingClientRect().bottom;
            if (footerTop - 800 <= cityColTop && footerBottom >= cityColTop) {
                if (canLoadData && !lustPageReached) {
                    currentPage++
                    canLoadData = false;
                    getData(currentCoordinateMapLeft, currentCoordinateMapRight, { page: currentPage });
                    setTimeout(() => {
                        canLoadData = true;
                    }, 500);
                }
            }
        }

        // Добавляем слушатель события прокрутки к элементу cityCol
        cityCol.addEventListener('scroll', function() {
            onScrollToFooter()
        });

        async function createMapCity(allmarks) {
            const mapCity = document.querySelector('#map_city')
            mapCity.innerHTML = ''
            if(mapCountry) {
                mapCountry.destroy()
            }
            mapCountry = new ymaps.Map("map_city", {
                // По стандарту указаны координаты Турции (если не установлена страна)
                center: {{ isset($region) ? "[" . $region->lat . ", " . $region->long . "]" : "[39, 32]" }},
                zoom: 4,
                controls: [],
                behaviors: ["default", "scrollZoom"],
                autoFitToViewport: 'always'
            }, {
                searchControlProvider: "yandex#search"
            });

            let minLat = Infinity;
            let maxLat = -Infinity;
            let minLon = Infinity;
            let maxLon = -Infinity;

            // Фильтруем объекты по current_region
            var currentmarks = [];
            allmarks.forEach(mark => {
                if (mark.current_region === 1) {
                    currentmarks.push(mark);
                }
            });

            currentmarks.forEach(mark => {
                if (mark.lat && mark.long) {
                    if (!isNaN(mark.lat) && !isNaN(mark.long)) {
                        minLat = Math.min(minLat, mark.lat);
                        maxLat = Math.max(maxLat, mark.lat);
                        minLon = Math.min(minLon, mark.long);
                        maxLon = Math.max(maxLon, mark.long);
                    }
                }
            });
            const subtitle = document.querySelector('.city-col__subtitle')
            const span = subtitle.querySelector('span')
            span.innerHTML = allmarks.length
            span.setAttribute('quantity_objects',allmarks.length)
            const nothing = document.querySelector('.nothing')
            if(allmarks.length == 0) {
                // nothing.classList.add('active')
            } else {
                nothing.classList.remove('active')
            }
            if(allmarks.length) {
                mapCountry.setBounds([[minLat, minLon], [maxLat, maxLon]], {
                    checkZoomRange: true,
                }).then(function() {
                    mapCountry.container.fitToViewport()
                }, function(err) {
                    // Обработка ошибок
                }, this);
            }

            ZoomLayout = ymaps.templateLayoutFactory.createClass('<div class="zoom-control"><div class="zoom-control__group"><div class="zoom-control__zoom-in"><button type="button" class="button _view_air _size_medium  _pin-bottom" aria-haspopup="false" aria-label="Приблизить"><span class="button__icon" aria-hidden="true"><div class="zoom-control__icon"><svg width="30" height="30" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11 5.992c0-.537.448-.992 1-.992.556 0 1 .444 1 .992V11h5.008c.537 0 .992.448.992 1 0 .556-.444 1-.992 1H13v5.008c0 .537-.448.992-1 .992-.556 0-1-.444-1-.992V13H5.992C5.455 13 5 12.552 5 12c0-.556.444-1 .992-1H11V5.992z" fill="currentColor"/></svg></div></span></button></div><div class="zoom-control__zoom-out"><button type="button" class="button _view_air _size_medium _pin-top" aria-haspopup="false" aria-label="Отдалить"><span class="button__icon" aria-hidden="true"><div class="zoom-control__icon"><svg width="30" height="30" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M5 12a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H6a1 1 0 0 1-1-1z" fill="currentColor"/></svg></div></span></button></div></div></div></div></div>', {

                // Переопределяем методы макета, чтобы выполнять дополнительные действия
                // при построении и очистке макета.
                build: function () {
                    // Вызываем родительский метод build.
                    ZoomLayout.superclass.build.call(this);

                    // Привязываем функции-обработчики к контексту и сохраняем ссылки
                    // на них, чтобы потом отписаться от событий.
                    this.zoomInCallback = ymaps.util.bind(this.zoomIn, this);
                    this.zoomOutCallback = ymaps.util.bind(this.zoomOut, this);

                    // Начинаем слушать клики на кнопках макета.
                    $('.zoom-control__zoom-in').bind('click', this.zoomInCallback);
                    $('.zoom-control__zoom-out').bind('click', this.zoomOutCallback);
                },

                clear: function () {
                    // Снимаем обработчики кликов.
                    $('.zoom-control__zoom-in').unbind('click', this.zoomInCallback);
                    $('.zoom-control__zoom-out').unbind('click', this.zoomOutCallback);

                    // Вызываем родительский метод clear.
                    ZoomLayout.superclass.clear.call(this);
                },

                zoomIn: function () {
                    var map = this.getData().control.getMap();
                    map.setZoom(map.getZoom() + 1, {checkZoomRange: true});
                },

                zoomOut: function () {
                    var map = this.getData().control.getMap();
                    map.setZoom(map.getZoom() - 1, {checkZoomRange: true});
                }
            }),
            zoomControl = new ymaps.control.ZoomControl({options: {layout: ZoomLayout}});

            mapCountry.controls.add(zoomControl, {
                position: {
                    right: 20,
                    bottom: 20
                }
            });
            mapCountry.events.add('balloonclose', function (e) {
                var t = document.querySelectorAll(".placemark");
                for (let e = 0; e < t.length; e++) t[e].classList.remove("active")
            });
            var t = ymaps.templateLayoutFactory.createClass('<div class="popover top"><a class="close" href="#">&times;</a><div class="arrow"></div><div class="popover-inner">$[[options.contentLayout observeSize minWidth=235 maxWidth=235 maxHeight=350]]</div></div>', {
                build: function () {
                    this.constructor.superclass.build.call(this), this._$element = $(".popover", this.getParentElement()), this.applyElementOffset(), this._$element.find(".close").on("click", $.proxy(this.onCloseClick, this))
                },

                clear: function () {
                    this._$element.find(".close").off("click"), this.constructor.superclass.clear.call(this)
                },

                onSublayoutSizeChange: function () {
                    t.superclass.onSublayoutSizeChange.apply(this, arguments), this._isElement(this._$element) && (this.applyElementOffset(), this.events.fire("shapechange"))
                },

                applyElementOffset: function () {
                    this._$element.css({
                        left: -this._$element[0].offsetWidth / 2,
                        top: -(this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight)
                    })
                },

                onCloseClick: function (e) {
                    e.preventDefault(), this.events.fire("userclose")
                },

                getShape: function () {
                    if (!this._isElement(this._$element)) return t.superclass.getShape.call(this);
                    var e = this._$element.position();
                    return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([
                        [e.left, e.top],
                        [e.left + this._$element[0].offsetWidth, e.top + this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight]
                    ]))
                },

                _isElement: function (e) {
                    return e && e[0] && e.find(".arrow")[0]
                }
            }),

            o = ymaps.templateLayoutFactory.createClass(`<div class="placemark"></div>`, {
                build: function () {
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

                    this.getData().options.set("shape", this.isActive ? l : c), document.addEventListener("click", (function (e) {
                        if ((e.target.classList.contains("ymaps-2-1-79-balloon__close-button") || e.target.classList.contains("ymaps-2-1-79-user-selection-none")) && window.innerWidth <= 1003) {
                            var t = document.querySelectorAll(".placemark");
                            for (let e = 0; e < t.length; e++) t[e].classList.remove("active")
                        }
                    })), this.inited || (this.inited = !0, this.isActive = !1, this.getData().geoObject.events.add("click", (function (t) {
                        var o = document.querySelectorAll(".placemark");
                        if (e.classList.contains("active")) e.classList.remove("active");
                        else {
                            for (let e = 0; e < o.length; e++) o[e].classList.remove("active");
                            e.classList.add("active")
                        }
                    }), this))
                }
            });



            allmarks.forEach(mark => {
                locationsCity.push({
                    coordinates: [mark.lat, mark.long],
                    balloonContent: `<div class="balloon-city-w">
                                        <div class="balloon-city" id="${mark.id}">
                                            <div class="balloon-city__text">
                                                <div class="balloon-city__price" ${(window.locale == 'ar' || window.locale == 'fa') ? `style="text-align:right;direction: ltr"` : ``}>€ ${mark.price}</div>
                                                ${mark.spalni !== null && mark.vannie !== null ? `<div class="balloon-city__rooms">${mark.spalni} ${spal}, ${mark.vanie} ${van}</div>` : ''}
                                                <div class="balloon-city__rooms_m">${mark.kv} ${kvm} <span>|</span> ${mark.spalni} спальни <span>|</span> ${mark.vanie} ванна</div>
                                                <div class="balloon-city__address">${mark.address} Balbey, 431. Sk. No:4, 07040 Muratpaşa</div>
                                                <div class="balloon-city__square">${mark.kv} ${kvm}</div>
                                            </div>
                                            <div class="balloon-city__img"><img style="height: 54px;" src="/${mark.image}"></div>
                                        </div>
                                    </div>`,
                    city_id: mark.id,
                    current_region: mark.current_region
                });
            });
            let areaForBallon = 250000
            if(window.innerWidth <= 768) areaForBallon = 1000000
            locationsCity.forEach(function (location) {
                var placemarkClass;
                if (location.current_region == 1) {
                    placemarkClass = '';
                } else {
                    placemarkClass = 'placemark__white';
                }
                var balloonOffset = (window.locale == 'ar' || window.locale == 'fa') ? [120, -60] : [-120, -60];
                var placemark = new ymaps.Placemark(location.coordinates, {
                    balloonContent: location.balloonContent,
                }, {
                    balloonPanelMaxMapArea: areaForBallon,
                    balloonShadow: false,
                    balloonLayout: t,
                    iconLayout: ymaps.templateLayoutFactory.createClass(
                    `<div class="placemark ${placemarkClass}" mark-id="${location.city_id}"></div>`, {
                        build: function () {
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

                        this.getData().options.set("shape", this.isActive ? l : c), document.addEventListener("click", (function (e) {

                        // placemark.events.add('mouseenter', function (e) {
                        //     if (userAgent.match(/(android|iphone|ipad|ipod|blackberry|windows phone)/)) return
                        //     placemark.balloon.open(); // Открываем балун при наведении мыши
                        //     setTimeout(function () {
                        //         var balloonContentElement = document.querySelector('.balloon-city');
                        //         const id = balloonContentElement.getAttribute('id')
                        //         const marks = document.querySelectorAll(`.placemark`);
                        //         const mark = document.querySelector(`[mark-id="${id}"]`);
                        //         if(mark.classList.contains('active')) {
                        //             mark.classList.remove('active')
                        //             placemark.balloon.close();
                        //             return
                        //         }
                        //         marks.forEach(mark => {
                        //             mark.classList.remove('active')
                        //         });
                        //         mark.classList.add('active')
                        //         if (balloonContentElement) {
                        //             var mouseLeaveListener = function () {
                        //                 placemark.balloon.close();
                        //                 mark.classList.remove('active')
                        //                 balloonContentElement.removeEventListener('mouseleave', mouseLeaveListener);
                        //                 balloonContentElement.removeEventListener('click', clickListener);
                        //             };
                        //             balloonContentElement.addEventListener('mouseleave', mouseLeaveListener);

                        //             var clickListener = function (event) {
                        //                 const id = balloonContentElement.getAttribute('id')
                        //                 //запрос новый на объект
                        //                 getObjectById(id)
                        //             };
                        //             balloonContentElement.addEventListener('click', clickListener);
                        //         }
                        //     }, 0);
                        // });
                            if ((e.target.classList.contains("ymaps-2-1-79-balloon__close-button") || e.target.classList.contains("ymaps-2-1-79-user-selection-none")) && window.innerWidth <= 1003) {

                                var t = document.querySelectorAll(".placemark");
                                for (let e = 0; e < t.length; e++) t[e].classList.remove("active")
                            }
                        })), this.inited || (this.inited = !0, this.isActive = !1, this.getData().geoObject.events.add("click", (function (t) {
                            const balloonContentElement = document.querySelector('.balloon-city');
                            if(!balloonContentElement) {
                                // const listenerClickBallon = balloonContentElement.addEventListener('click', function() {
                                //     const id = balloonContentElement.getAttribute('id')
                                //     getObjectById(id)
                                // })
                            } else {
                            }
                            var o = document.querySelectorAll(".placemark");
                            if (e.classList.contains("active")) e.classList.remove("active");
                            else {
                                for (let e = 0; e < o.length; e++) o[e].classList.remove("active");
                                e.classList.add("active")
                            }
                        }), this))
                    }
                    }),
                    balloonContentLayout: c,
                    hideIconOnBalloonOpen: false,
                    balloonOffset: balloonOffset,
                });

                mapCountry.geoObjects.add(placemark);
                placemark.house_id = location.city_id
                ballons.push(placemark)
                // Добавляем обработчики событий на метку
                placemark.events.add('mouseenter', function (e) {
                    if (userAgent.match(/(android|iphone|ipad|ipod|blackberry|windows phone)/)) return
                    placemark.balloon.open(); // Открываем балун при наведении мыши
                    setTimeout(function () {
                        var balloonContentElement = document.querySelector('.balloon-city');
                        const id = balloonContentElement.getAttribute('id')
                        const marks = document.querySelectorAll(`.placemark`);
                        const mark = document.querySelector(`[mark-id="${id}"]`);
                        if(mark.classList.contains('active')) {
                            mark.classList.remove('active')
                            placemark.balloon.close();
                            return
                        }
                        marks.forEach(mark => {
                            mark.classList.remove('active')
                        });
                        mark.classList.add('active')
                        if (balloonContentElement) {
                            var mouseLeaveListener = function () {
                                placemark.balloon.close();
                                mark.classList.remove('active')
                                balloonContentElement.removeEventListener('mouseleave', mouseLeaveListener);
                            };
                            balloonContentElement.addEventListener('mouseleave', mouseLeaveListener);
                        }
                    }, 0);
                });
                placemark.events.add('mouseleave', function (e) {
                    const relatedTarget = e.get('domEvent').originalEvent.relatedTarget
                    if(!relatedTarget) {
                        placemark.balloon.close();
                    } else {
                        if(relatedTarget.classList.contains('.ballon-city')) {

                        }
                    }
                })
            });

            const phpObjects = document.querySelectorAll('[php]')
            phpObjects.forEach(el => {
                el.addEventListener('mouseenter', function() {
                    const id = el.getAttribute('data_id')
                    let currentBallon
                    ballons.forEach(element => {
                        if(element.house_id == id) currentBallon = element
                    });
                    const marks = document.querySelectorAll(`[mark-id]`);
                    const mark = document.querySelector(`[mark-id="${id}"]`);
                    // marks.forEach(element => {
                    //     element.classList.remove('active')
                    // });
                    mark.classList.add('active')
                    if(window.innerWidth >= 1004) {
                        currentBallon.balloon.open();
                    }
                })
                el.addEventListener('mouseleave', function() {
                    mapCountry.balloon.close()
                    const marks = document.querySelectorAll(`[mark-id]`);
                    const swiperWrapper = this.querySelector('.city__wrapper')
                    const idSwiper = swiperWrapper.getAttribute('id')
                    marks.forEach(element => {
                        element.classList.remove('active')
                    });
                })
            });





            let startBounds = mapCountry.getBounds();
            let top_left = {
                lat: startBounds[0][0],
                long: startBounds[0][1]
            };

            let bottom_right = {
                lat: startBounds[1][0],
                long: startBounds[1][1]
            };


            // getData(top_left, bottom_right);
            currentCoordinateMapLeft = top_left
            currentCoordinateMapRight = bottom_right
            currentPage = 0
            // let center = [];
            mapCountry.events.add(['zoomchange', 'boundschange'], function (event) {
                let newBounds = event.get('newBounds');

                let top_left = {
                    lat: newBounds[0][0],
                    long: newBounds[0][1]
                };

                let bottom_right = {
                    lat: newBounds[1][0],
                    long: newBounds[1][1]
                };
                getData(top_left, bottom_right);
                currentCoordinateMapLeft = top_left
                currentCoordinateMapRight = bottom_right
                currentPage = 0
                lustPageReached = false
                mapCountry.container.fitToViewport()
            });
            mapCountry.events.add('boundschange', function(e){
                if (e.get('newZoom') !== e.get('oldZoom')) {
                }
            })
            mapCountry.events.add('balloonopen', function(e){
                var balloonContentElement = document.querySelector('.balloon-city');
                balloonContentElement.addEventListener('click', function(e) {
                    const id = balloonContentElement.getAttribute('id')
                    // replaceUrlWithObject(window.filter_params_data, "object-" + id);
                    // getObjectById("object-" + id)
                    const object = {
                        id: id
                    }
                    getObjectBySimpleRequest(object)
                    const cityCol = document.querySelector('.city-col')
                    cityCol.style.display = 'block'
                });
            })
            mapCountry.events.add('balloonclose', function(e){

            })
        }
        let moveWas = 0
        document.querySelector(".city-col__btn-changer") && (document.querySelector(".city-col__btn-changer").onclick = function () {
            this.classList.remove("active");
            document.querySelector(".city-col").classList.remove("active");
            document.querySelector(".map_city__btn-changer").classList.add("active");
            document.querySelector("#map_city").classList.add("show");
            document.querySelector("#map_city").classList.add("map_city_active");
            document.querySelector(".city__content").classList.add("city_map");
            if(!moveWas) {
                var position = mapCountry.getGlobalPixelCenter();
                mapCountry.setGlobalPixelCenter([ position[0] - 1, position[1] ]);
                moveWas = 1
            }
        })
    }

}


            L.length && (k.onclick = function () {
                q.classList.remove("active")
            }), L.length && (A.onclick = function () {
                x.classList.remove("active")
            }), L.length && window.addEventListener("resize", (function (e) {
                window.innerWidth <= 766 && q.classList.contains("active") && (x.classList.add("active"), q.classList.remove("active")), window.innerWidth > 766 && x.classList.contains("active") && (x.classList.remove("active"), q.classList.add("active"))
            })), P(E = window.innerWidth > 1003 ? 0 : 1 / 0), window.addEventListener("resize", (function (e) {
                this.document.querySelectorAll(".city-col__item").length && (window.innerWidth > 1003 && 0 == E && ( P(0), E = 1 / 0), window.innerWidth <= 1003 && E == 1 / 0 && ( P(1 / 0), E = 0))
            }))
        })();

        if(document.querySelectorAll('.place-w').length) {
            const placeW = document.querySelectorAll('.place-w')
            const currentUrl = window.location.href;
            const url = new URL(currentUrl);
            placeW.forEach(placeBlock => {
                placeBlock.addEventListener('click', function(e) {
                    const target = e.target
                    if(target.classList.contains('place-w')) {
                        placeBlock.classList.remove('active')
                        // var urlParams = getValuesFromUrl();
                        // var object = checkPosition(urlParams, 'object-');
                        // if (object) {
                        //     urlParams = deleteUrlParameter(object, urlParams);
                        // }
                        // updateUrl(window.filter_params_data, urlParams, false);
                        history.back();
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
    </script>
@include('project.includes.modal-object')
<script src="{{asset('project/js/tel-input.js')}}"></script>
<script src="{{asset('project/js/filter.js')}}"></script>
@endsection

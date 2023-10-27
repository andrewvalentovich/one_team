<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('lands/files/fonts/stylesheet.css') }}">
	<link href="https://fonts.cdnfonts.com/css/rubik-one" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('lands/css/style.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<title>Регион</title>
</head>
<body>
	<div class="wrapper">
		<main>
			<header class="header-w">
    <div class="header container">
        <div class="header__info">
            <a href="/" class="header__logo">
                <img class="colors" src="{{ asset('lands/img/icons/logo-1.svg') }}" alt="логотип">
                <img class="white" src="{{ asset('lands/img/icons/logo-2.svg') }}" alt="логотип">
            </a>
            <nav class="header__nav nav">
                <a class="header__nav-item scroll" href="#objects">
                    ЖК в продаже
                </a>
                <a class="header__nav-item scroll" href="#map">
                    Инфраструктура
                </a>
                <a class="header__nav-item scroll" href="#about">
                    О регионе
                </a>
            </nav>
        </div>
        <div class="header__action">
            <div class="header__menu ">
                <div class="nav-icon toggle-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <a class="header__phone" href="tel:{{ isset($landing->phone) ? str_replace(" ", "", $landing->phone) : "88007005555" }}">
                <img src="{{ asset('lands/img/icons/phone-call.png') }}" alt="телефон">
                <span>
                    {{ isset($landing->phone) ? $landing->phone : "8 800 700 55 55" }}
                </span>
            </a>
            <button class="header__application-btn btn btn_blue btn_arrow" btn-popup="popup-record">
                Оставить заявку
                <img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
            </button>
        </div>
    </div>
</header>

<div class="header-m">
    <div class="header-m__content">
        <nav class="header-m__nav">
            <a class="header-m__nav-item scroll" href="#objects">
                ЖК в продаже
            </a>
            <a class="header-m__nav-item scroll" href="#map">
                Инфраструктура
            </a>
            <a class="header-m__nav-item scroll" href="#about">
                О регионе
            </a>
        </nav>
        <div class="header-m__close toggle-menu ">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><script xmlns=""/>
                <path d="M1 1L13 13" stroke="#272727" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M13 1L1 13" stroke="#272727" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </div>
    </div>
</div>
			<div class="preview">
				<img class="preview__pic" src="{{ asset($landing->main_photo) }}" alt="">
				<div class="preview__content container">
					<div class="preview__place">
						<div class="preview__title">
                            {{ $landing->main_title ?? null }}
						</div>
						<p class="preview__lead">
                            {!! $landing->main_content ?? null !!}
                        </p>
					</div>
					<form class="preview__form form request__form">
						<div class="preview__form-title">
							Оставить заявку эксперту 1
						</div>
						<label class="field input-wrapper" >
							<span class="text">
							Имя
							</span>
							<input type="text" required="true" name="name" onkeyup="validate(this);">
						</label>
						<label class="field input-wrapper">
							<span class="text">
							Номер телефона
							</span>
							<input type="number" required="true" name="phone" value="" placeholder="+7" >
						</label>
                        <input type="hidden" name="landing_id" value="{{ $landing->id }}">
						<button class="preview__form-submit-btn btn btn_blue btn_arrow" type="submit">
							Оставить заявку
							<img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
						</button>
						<p class="preview__form-agreement">
							Нажимая на кнопку, вы принимаете Согласие на обработку персональных данных
						</p>
					</form>
				</div>
				<div class="preview__info container">
                    @if(isset($landing->main_lists))
                        @foreach(json_decode($landing->main_lists) as $main_list)
                            <div class="preview__info-item">
                                <span>
                                    {{ $main_list->title ?? null }}
                                </span>
                                <p>
                                    {{ $main_list->content ?? null }}
                                </p>
                            </div>
                        @endforeach
                    @endif
				</div>
			</div>
			<div class="building container" id="objects">
                <div class="building__header">
                    <div class="building__title title">
                        {{ $landing->objects_title ?? null }}
                    </div>
                    <div class="sort close-out building__sort">
						<span class="sort__title btn">
							<span class="sort__title-type">
								Тип недвижимости
							</span>
							<img class="arrow" src="{{ asset('lands/img/icons/next.png') }}" alt="стрелочка">
						</span>
                        <div class="sort__list">
                            <div class="sort__list-body">
                                <div class="sort__list-item type" data-id="0">
                                    <span>Все типы</span>
                                </div>
                                @foreach($types as $type)
                                    <div class="sort__list-item type" data-id="{{ $type->id }}">
                                        <span>{{ $type->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
				<div class="building__list" data-count="6">

				</div>
                <div style="display: flex; justify-content: center">
                    <button id="load_objects_btn" class="conditions__item-btn-more" btn-popup="more_building">
                        Показать ещё
                    </button>
                </div>
			</div>
			<div class="conditions container">
				<div class="conditions__title title">
					УСЛОВИЯ ПОКУПКИ
				</div>
                <div class="conditions__list">
                    @if(isset($landing->purchase_terms))
                        @foreach(json_decode($landing->purchase_terms) as $purchase_terms)
                            <div class="conditions__list-item">
                                <div class="conditions__item-info">
                                    <div class="">
                                        <div class="conditions__item-subtitle">
                                            {{ $purchase_terms->title ?? null }}
                                        </div>
                                        <p>{!! $purchase_terms->content ?? null !!}</p>
                                        @if($loop->last)
                                            <button class="conditions__item-btn-more" btn-popup="popup-vnj">
                                                Подробнее о ВНЖ
                                            </button>
                                        @endif
                                    </div>
                                    <button class="conditions__item-btn btn btn_grey-dark btn_arrow" btn-popup="popup-record">
                                        Оставить заявку
                                        <img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
                                    </button>
                                </div>
                                <div class="conditions__item-number">
                                    {{ $loop->iteration }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
			</div>
			<div class="map wrapMap" id="map">
                {!! $landing->map !!}
{{--				<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Afc64a3d223ff913723c16022e4266225030f99a540ffe10915e3499fe62a343b&amp;source=constructor&amp;scroll=false"--}}
{{--					width="100%"--}}
{{--					height="500"--}}
{{--					frameborder="0">--}}
{{--				</iframe>--}}
			</div>
			<div class="about container" id="about">
				<div class="title">
                    {{ $landing->sight_title }}
				</div>
				<div class="about__swiper swiper">
					<div class="about__swiper-wrapper swiper-wrapper">
                        @if(isset($landing->sight_cards))
                            @foreach(json_decode($landing->sight_cards) as $sight_cards)
                                <div class="about__slide swiper-slide">
                                    <div class="about__slide-pic">
                                        <img src="{{ asset($sight_cards->photo) }}" alt="">
                                    </div>
                                    <div class="about__slide-text">
                                        <div class="about__slide-title">
                                            {{ $sight_cards->title ?? null }}
                                        </div>
                                        <p class="about__slide-lead">
                                            {!! $sight_cards->content ?? null !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
					</div>
					<div class="about__swiper-action">
						<div class="about__prev about__swiper-btn">
							<img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка назад">
						</div>
						<div class="about__pagination"></div>
						<div class="about__next about__swiper-btn">
							<img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка вперед">
						</div>
					</div>
				</div>
			</div>
		</main>
		<footer class="footer-w">
    <div class="header container">
        <div class="header__info">
            <div class="header__logo">
                <a href="/">
                    <img src="{{ asset('lands/img/icons/logo-2.svg') }}" alt="логотип">
                </a>
                <span>
                    Copyright, 2023
                </span>
            </div>
            <nav class="header__nav nav">
                <a class="header__nav-item scroll" href="#objects">
                    ЖК в продаже
                </a>
                <a class="header__nav-item scroll" href="#map">
                    Инфраструктура
                </a>
                <a class="header__nav-item scroll" href="#about">
                    О регионе
                </a>
            </nav>
        </div>
        <div class="header__action">
            <div class="header__menu ">
                <div class="nav-icon toggle-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <a class="header__phone" href="tel:{{ isset($landing->phone) ? $landing->phone : "88007005555" }}">
                <img src="{{ asset('lands/img/icons/phone-call.png') }}" alt="телефон">
                <span>
                     {{ isset($landing->phone) ? $landing->phone : "8 800 700 55 55" }}
                </span>
            </a>
            <button class="header__application-btn btn btn_blue btn_arrow" btn-popup="popup-record">
                Оставить заявку
                <img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
            </button>
        </div>
    </div>
    <div class="footer__text container">
        <div class="footer__desc">
            Copyright, 2023
        </div>
        <div class="footer__text-lead">
            Обращаем Ваше внимание на то, что данный интернет-сайт носит исключительно информационный характер и ни при каких условиях не является публичной офертой, определяемой положением ч. 2 ст. 437 Гражданского кодекса Российской Федерации. Для получения подробной информации о стоимости автомобилей, пожалуйста, обращайтесь к менеджеру по продажам. Все цены на сайте указаны с учетом скидок. Предоставляя свои персональные данные и используя настоящий веб-сайт, Вы соглашаетесь с обработкой Ваших персональных данных и принимаете условия их обработки.
        </div>
    </div>
</footer>
@include('landings.includes.modals.modal-build')
@include('landings.includes.modals.modals')
<!-- дефолтная модалка -->
<form class="popup popup-record form request__form">
    <div class="popup__body">
        <div class="popup__content">
            <div class="preview__form">
                <div class="preview__form-title">
                    Оставить заявку эксперту
                </div>
				<label class="field input-wrapper" >
					<span class="text">
					Имя
					</span>
					<input type="text" required="true" name="name" value="" onkeyup="validate(this);">
				</label>
				<label class="field input-wrapper">
					<span class="text">
					Номер телефона
					</span>
					<input type="number" required="true" name="phone" value="" placeholder="+7" >
				</label>
                <input type="hidden" name="landing_id" value="{{ $landing->id }}">
                <button class="preview__form-submit-btn btn btn_blue btn_arrow" type="submit">
                    Оставить заявку
                    <img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
                </button>
                <p class="preview__form-agreement">
                    Нажимая на кнопку, вы принимаете Согласие на обработку персональных данных
                </p>
            </div>
            <div class="popup-close">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><script xmlns=""/>
                    <path d="M1 1L13 13" stroke="#272727" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M13 1L1 13" stroke="#272727" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </div>
</form>


<!-- внж модалка -->
<div class="popup popup-vnj vnj form">
    <div class="popup__body">
        <div class="popup__content">
            <div class="popup__title">
                {{ $landing->vnj_title }}
            </div>
            <div class="vnj__keep">
                <div class="vnj__text">
                    {!! $landing->vnj_content !!}
                </div>
                <form class="preview__form request__form" style="height: fit-content;">
                    <div class="preview__form-title">
                        Оставить заявку эксперту
                    </div>
					<label class="field input-wrapper" >
						<span class="text">
						Имя
						</span>
						<input type="text" required="true" name="name" value="" onkeyup="validate(this);">
					</label>
					<label class="field input-wrapper">
						<span class="text">
						Номер телефона
						</span>
						<input type="number" required="true" name="phone" value="" >
					</label>
                    <input type="hidden" name="landing_id" value="{{ $landing->id }}">
                    <button class="preview__form-submit-btn btn btn_blue btn_arrow" type="submit">
                        Оставить заявку
                        <img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
                    </button>
                </form>
            </div>
            <div class="popup-close popup-close_blue">
                <img src="{{ asset('lands/img/icons/close_blue.svg') }}" alt="крестик">
            </div>
        </div>
    </div>
</div>


<!-- видео модалка -->
<div class="popup popup-video">
    <div class="popup__body">
        <div class="popup__content">
            <iframe class="popup-video__iframe" width="100%" height="100%" src="https://www.youtube.com/embed/__-vp0g_BhA?si=LPDKdGTXLhGtUeHL" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            <div class="popup-close popup-close_blue">
                <img src="{{ asset('lands/img/icons/close_blue.svg') }}" alt="крестик">
            </div>
        </div>
    </div>
</div>

	</div>
	<script src="{{ asset('lands/js/jquery.js') }}"></script>
	<script src="{{ asset('lands/js/bodyScrollLock.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	<!-- <script src="{{ asset('lands/js/allCountries-list.js') }}"></script>
	<script src="{{ asset('lands/js/libphonenumber-validator.js') }}"></script>
	<script src="{{ asset('lands/js/inputPhone.js') }}"></script> -->
    <script src="{{ asset('lands/js/url-query-object.js') }}"></script>
    <script src="{{ asset('lands/js/app.js') }}"></script>
    <script>
        window.domain = `{{ config('app.domain') }}`;

        window.landings_get_with_filter_url = window.domain === "localhost" ? `http://dev.${window.domain}:8879/api/landings/with_filter` : `https://dev.${window.domain}/api/landings/with_filter`;
    </script>
    <script src="{{ asset('lands/js/objects-filter.js') }}"></script>
    <script src="{{ asset('lands/js/forms-submit.js') }}"></script>

</body>
</html>


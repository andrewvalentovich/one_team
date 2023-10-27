<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('lands/files/fonts/stylesheet.css') }}">
	<link href="https://fonts.cdnfonts.com/css/rubik-one" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" /> -->
	<link rel="stylesheet" type="text/css" href="{{ asset('lands/css/style.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<title>{{ $landing->main_title }}</title>
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
                <a class="header__nav-item scroll" href="#about">
                    О комплексе
                </a>
                <a class="header__nav-item scroll" href="#infrastructure">
                    Инфраструктура
                </a>
                <a class="header__nav-item scroll" href="#layouts">
                    Планировки
                </a>
                <a class="header__nav-item scroll" href="#gallery">
                    Галерея
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
</header>

<div class="header-m">
    <div class="header-m__content">
        <nav class="header-m__nav">
            <a class="header-m__nav-item scroll" href="#about">
                О комплексе
            </a>
            <a class="header-m__nav-item scroll" href="#infrastructure">
                Инфраструктура
            </a>
            <a class="header-m__nav-item scroll" href="#layouts">
                Планировки
            </a>
            <a class="header-m__nav-item scroll" href="#gallery">
                Галерея
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
				<img class="preview__pic" src="{{ asset($landing->main_photo ?? null) }}" alt="Главная картинка">
				<div class="preview__content container">
					<div class="preview__place">
						<div class="preview__place-address">
							<img src="{{ asset('lands/img/icons/location.png') }}" alt="локация">
                            {{ $landing->main_location ?? null }}
						</div>
						<div class="preview__title">
                            {{ $landing->main_title ?? null }}
							<span>
                                {{ $landing->main_subtitle ?? null }}
							</span>
						</div>
						<p class="preview__lead">
                            {!! $landing->main_content ?? null !!}
						</p>
					</div>
					<form class="preview__form form request__form">
						<div class="preview__form-title">
							Оставить заявку эксперту
						</div>
						<label class="field input-wrapper" >
							<span class="text">
							Имя
							</span>
							<input name="name" type="text" value="" placeholder="Иванов Алексей Петрович">
						</label>
                        <input type="hidden" name="landing_id" value="{{ $landing->id }}">
						<label class="field input-wrapper">
							<span class="text">
							Номер телефона
							</span>
							<input name="phone" type="number" value="" placeholder="+7" >
						</label>
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
            @if(!is_null($landing->about_description))
                <div class="about container" id="about">
                    <div class="title">
                        {{ $landing->about_title ?? null }}
                    </div>
                    <div class="title title_grey">
                        {{ $landing->about_subtitle ?? null }}
                    </div>
                    <div class="about__swiper swiper">
                        <div class="about__swiper-wrapper swiper-wrapper">
                            @foreach(json_decode($landing->about_description) as $about_description)
                                <div class="about__slide swiper-slide">
                                    <div class="about__slide-pic">
                                        <img src="{{ asset($about_description->photo ?? null) }}" alt="">
                                    </div>
                                    <div class="about__slide-text">
                                        <div class="about__slide-title">
                                            {{ $about_description->title ?? null }}
                                        </div>
                                        <p class="about__slide-lead">
                                            {!! $about_description->content ?? null !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="about__swiper-action">
                            <div class="about__prev about__swiper-btn">
                                <img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка назад">
                            </div>
                            <div class="about__pagination "></div>
                            <div class="about__next about__swiper-btn">
                                <img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка вперед">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
			<div class="infrastructure container" id="infrastructure">
				<div class="title">
					Территория
				</div>
                @if(isset($landing->territory))
				    <img src="{{ asset($landing->territory) }}" alt="территория">
                @else
				    <img src="{{ asset('lands/img/pic/territoriya.png') }}" alt="территория">
                @endif
			</div>
			<div class="layouts container" id="layouts">
				<div class="title">
					КВАРТИРЫ В ПРОДАЖЕ
				</div>
				<div class="layouts__swiper-w">
					<div class="layouts__btn layouts__prev">
						<svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M364.8 106.666667L298.666667 172.8 637.866667 512 298.666667 851.2l66.133333 66.133333L768 512z" fill="#2196F3"></path></svg>
					</div>
					<div class="layouts__btn layouts__next">
						<svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M364.8 106.666667L298.666667 172.8 637.866667 512 298.666667 851.2l66.133333 66.133333L768 512z" fill="#2196F3"></path></svg>
					</div>
					<div class="layouts__swiper swiper">
						<div class="layouts__swiper-wrapper swiper-wrapper">
                            @if(isset($filter->layouts))
                                @foreach($filter->layouts as $layout)
                                    <div class="layouts__slide swiper-slide" btn-popup="popup-house">
                                        <div class="layouts__slide-pic">
                                            @if(isset($layout->photos))
                                                <img src="{{ asset($layout->photos[0]->url ?? null) }}" alt="схема">
                                            @endif
                                        </div>
                                        <div class="layouts__slide-text">
                                            <div class="layouts__slide-price">
                                                {{ $layout->price ?? null }} €
                                            </div>
                                            <div class="layouts__slide-info">
                                                <div class="layouts__slide-lead">
                                                    {{ $layout->total_size ?? null }} кв.м., {{ $layout->number_rooms ?? null }}
                                                </div>
                                                <div class="layouts__slide-btn btn btn_grey">
                                                    <img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
						</div>
						<div class="layouts__pagination swiper__pagination"></div>
					</div>
				</div>
			</div>
			<div class="gallery" id="gallery">
				<div class="container">
					<div class="gallery__title title">
						ГАЛЕРЕЯ
					</div>
					<div class="gallery__filter">
						@if(isset($filter->video))
                            <div class="gallery__item gallery__item_video changeGallery" btn-popup="popup-video">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 16 16" fill="#000000" class="bi bi-play-circle">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
                                </svg>
                                Видео
                            </div>
                        @endif
                        <div class="gallery__item changeGallery active" data-category-id="0">
                            Все
                        </div>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <div class="gallery__item changeGallery" data-category-id="{{ $category->id }}">
                                    {{ $category->name }}
                                </div>
                            @endforeach
                        @endif
						<div class="gallery__all sort close-out " style="width: 200px;">
							<span class="sort__title btn" style="width: 100%;">
								<span>
									Все
								</span>
								<img class="arrow" src="{{ asset('lands/img/icons/next.png') }}" alt="стрелочка">
							</span>
							<div class="sort__list">
								<div class="sort__list-body">
                                    @if(isset($categories))
                                        @foreach($categories as $category)
                                            <div class="sort__list-item changeGallery" data-category-id="{{ $category->id }}">
                                                <span>{{ $category->name }}</span>
                                            </div>
                                        @endforeach
                                    @endif
									<div class="sort__list-item changeGallery" data-category-id="0">
										<span>Все</span>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="gallery__text" style="display:none">
                        Фотографий нет
                    </div>
				</div>
				<div class="gallery__swiper-w">
					<div class="gallery__swiper swiper">
						<div class="gallery__swiper-wrapper swiper-wrapper">
                            @if(isset($filter->photo))
                                @foreach($filter->photo as $photo)
                                    <div class="gallery__slide swiper-slide" data-category-id="{{ !is_null($photo->category) ? $photo->category->id : 0 }}">
                                        <img src="{{ asset('uploads/'.$photo->photo) }}" alt="">
                                    </div>
                                @endforeach
                            @endif
						</div>
					</div>
					<div class="gallery__pagination swiper__pagination"></div>
					<div class="gallery__overlap gallery__overlap_left">
						<span></span>
						<div class="gallery__nav-btn gallery__prev">
							<svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M364.8 106.666667L298.666667 172.8 637.866667 512 298.666667 851.2l66.133333 66.133333L768 512z" fill="#2196F3"/></svg>
						</div>
					</div>
					<div class="gallery__overlap gallery__overlap_right">
						<span></span>
						<div class="gallery__nav-btn gallery__next">
							<svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M364.8 106.666667L298.666667 172.8 637.866667 512 298.666667 851.2l66.133333 66.133333L768 512z" fill="#2196F3"/></svg>
						</div>
					</div>
				</div>
			</div>
			<div class="map wrapMap" id="map">
				<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Afc64a3d223ff913723c16022e4266225030f99a540ffe10915e3499fe62a343b&amp;source=constructor&amp;scroll=false"
					width="100%"
					height="500"
					frameborder="0">
				</iframe>
			</div>
            @if(!is_null($landing->purchase_terms))
                <div class="conditions container">
                    <div class="conditions__title title">
                        УСЛОВИЯ ПОКУПКИ
                    </div>
                    <div class="conditions__list">
                        @foreach(json_decode($landing->purchase_terms) as $purchase_terms)
                            <div class="conditions__list-item">
                                <div class="conditions__item-info">
                                    <div class="">
                                        <div class="conditions__item-subtitle">
                                            {{ $purchase_terms->title ?? null }}
                                        </div>
                                        <p>{!! $purchase_terms->content !!}</p>
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
                    </div>
                </div>
            @endif
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
                <a class="header__nav-item scroll" href="#about">
                    О комплексе
                </a>
                <a class="header__nav-item scroll" href="#infrastructure">
                    Инфраструктура
                </a>
                <a class="header__nav-item scroll" href="#layouts">
                    Планировки
                </a>
                <a class="header__nav-item scroll" href="#gallery">
                    Галерея
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
					<input name="name" type="text" value="" placeholder="Иванов Алексей Петрович">
				</label>
                <input type="hidden" name="landing_id" value="{{ $landing->id }}">
				<label class="field input-wrapper">
					<span class="text">
					Номер телефона
					</span>
					<input name="phone" type="number" value="" placeholder="+7" >
				</label>
                <button class="preview__form-submit-btn btn btn_blue btn_arrow" >
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
                {{ $landing->vnj_title ?? null }}
            </div>
            <div class="vnj__keep">
                <div class="vnj__text">
                    {!! $landing->vnj_content ?? null !!}
                </div>
                <form class="preview__form request__form" style="height: fit-content;">
                    <div class="preview__form-title">
                        Оставить заявку эксперту
                    </div>
					<label class="field input-wrapper" >
						<span class="text">
						Имя
						</span>
						<input name="name" type="text" value="" placeholder="Иванов Алексей Петрович">
					</label>
                    <input type="hidden" name="landing_id" value="{{ $landing->id }}">
					<label class="field input-wrapper">
						<span class="text">
						Номер телефона
						</span>
						<input name="phone" type="number" value="" placeholder="+7" >
					</label>
                    <button class="preview__form-submit-btn btn btn_blue btn_arrow" >
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

<!-- КВАРТИРЫ В ПРОДАЖЕ модалка -->
<form class="popup popup-house form request__form">
    <div class="popup__body">
        <div class="popup__content">
			<div class="popup__house-info">
				<div class="popup__house-pic">
					<img src="">
				</div>
				<div class="popup__house-price">

				</div>
				<div class="popup__house-lead">

				</div>
			</div>
            <div class="preview__form">
                <div class="preview__form-title">
                    Оставить заявку эксперту
                </div>
				<label class="field input-wrapper" >
					<span class="text">
					Имя
					</span>
					<input name="name" type="text" value="" placeholder="Иванов Алексей Петрович">
				</label>
                <input type="hidden" name="landing_id" value="{{ $landing->id }}">
				<label class="field input-wrapper">
					<span class="text">
					Номер телефона
					</span>
					<input name="phone" type="number" value="" placeholder="+7" >
				</label>
                <button class="preview__form-submit-btn btn btn_blue btn_arrow" >
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

<!-- Slider main container -->
<div class="popup popup-gallery form">
	<div class="popup__prev popup__nav-btn">
		<svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" fill="#000000" version="1.1" baseProfile="tiny" id="Layer_1" width="800px" height="800px" viewBox="0 0 42 42" xml:space="preserve">
			<polygon fill-rule="evenodd" points="11,38.32 28.609,21 11,3.68 13.72,1 34,21.01 13.72,41 "/>
		</svg>
	</div>
	<div class="popup__next popup__nav-btn">
		<svg xmlns:x="http://ns.adobe.com/Extensibility/1.0/" xmlns:i="http://ns.adobe.com/AdobeIllustrator/10.0/" xmlns:graph="http://ns.adobe.com/Graphs/1.0/" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" fill="#000000" version="1.1" baseProfile="tiny" id="Layer_1" width="800px" height="800px" viewBox="0 0 42 42" xml:space="preserve">
			<polygon fill-rule="evenodd" points="11,38.32 28.609,21 11,3.68 13.72,1 34,21.01 13.72,41 "/>
		</svg>
	</div>
    <div class="popup__body">
        <div class="popup__content">
			<div class="popup__swiper swiper">
				<div class="popup__swiper-wrapper swiper-wrapper">
				</div>
				<div class="popup__swiper-pagination"></div>
			</div>
		</div>
	</div>
	<div class="popup-close">
		<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><script xmlns=""/>
			<path d="M1 1L13 13" stroke="#272727" stroke-width="1.5" stroke-linecap="round"/>
			<path d="M13 1L1 13" stroke="#272727" stroke-width="1.5" stroke-linecap="round"/>
		</svg>
	</div>
</div>


	</div>

	<script src="{{ asset('lands/js/jquery.js') }}"></script>
	<script src="{{ asset('lands/js/bodyScrollLock.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script> -->
	<!-- <script src="{{ asset('lands/js/allCountries-list.js') }}"></script>
	<script src="{{ asset('lands/js/libphonenumber-validator.js') }}"></script>
	<script src="{{ asset('lands/js/inputPhone.js') }}"></script> -->
	<script src="{{ asset('lands/js/app.js') }}"></script>
    <script>
        window.domain = `{{ config('app.domain') }}`;

        window.landings_get_with_filter_url = window.domain === "localhost" ? `http://dev.${window.domain}:8879/api/landings/with_filter` : `https://dev.${window.domain}/api/landings/with_filter`;
    </script>
    <script src="{{ asset('lands/js/forms-submit.js') }}"></script>

</body>
</html>


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('lands/files/fonts/stylesheet.css') }}">
	<link href="https://fonts.cdnfonts.com/css/rubik-one" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('lands/css/style.css') }}">
	<title>Страна</title>
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
                    О стране
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
            <a class="header__phone" href="tel:88007005555">
                <img src="{{ asset('lands/img/icons/phone-call.png') }}" alt="телефон">
                <span>
                    8 800 700 55 55
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
                О стране
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
				<img class="preview__pic" src="{{ asset('lands/img/pic/country.jpg') }}" alt="">
				<div class="preview__content container">
					<div class="preview__place">
						<div class="preview__title">
							ТУРЦИЯ
						</div>
						<p class="preview__lead">
							Регион, в котором море, солнце, история и природа соединяются в гармонии. Древние города, море, солнце, пляж, лес - компоненты одного прекрасного целого. Мустафа Кемаль Ататюрк описывает Анталью фразой: «Несомненно, Анталья - самое красивое место в мире».
						</p>
					</div>
					<form class="preview__form form">
						<div class="preview__form-title">
							Оставить заявку эксперту
						</div>
						<label class="field input-wrapper" >
							<span class="text">
							Имя
							</span>
							<input type="text" value="" placeholder="Иванов Алексей Петрович">
						</label>
						<label class="field input-wrapper">
							<span class="text">
							Номер телефона
							</span>
							<input type="number" value="" placeholder="+7" >
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
					<div class="preview__info-item">
						<span>
							310
						</span>
						<p>
							Солнечных дней в году
						</p>
					</div>
					<div class="preview__info-item">
						<span>
							50
						</span>
						<p>
							Комплексов в продаже
						</p>
					</div>
					<div class="preview__info-item">
						<span>
							ВНЖ
						</span>
						<p>
							Вид на жительство при покупке
						</p>
					</div>
					<div class="preview__info-item">
						<span>
							15
						</span>
						<p>
							Инвестиционный процент
						</p>
					</div>
				</div>
			</div>
			<div class="building container" id="objects">
				<div class="building__header">
					<div class="building__title title">
						НОВОСТРОЙКИ В ТУРЦИИ
					</div>
					<div class="sort close-out ">
						<span class="sort__title btn">
							<span>
								Тип недвижимости
							</span>
							<img class="arrow" src="{{ asset('lands/img/icons/next.png') }}" alt="стрелочка">
						</span>
						<div class="sort__list">
							<div class="sort__list-body">
								<div class="sort__list-item">
									<span>индивидуальная</span>
								</div>
								<div class="sort__list-item">
									<span>коммерческая</span>
								</div>
								<div class="sort__list-item">
									<span>индивидуальная</span>
								</div>
								<div class="sort__list-item">
									<span>коммерческая</span>
								</div>
								<div class="sort__list-item">
									<span>индивидуальная</span>
								</div>
								<div class="sort__list-item">
									<span>коммерческая</span>
								</div>
								<div class="sort__list-item">
									<span>индивидуальная</span>
								</div>
								<div class="sort__list-item">
									<span>коммерческая</span>
								</div>
								<div class="sort__list-item">
									<span>индивидуальная</span>
								</div>
								<div class="sort__list-item">
									<span>коммерческая</span>
								</div>
								<div class="sort__list-item">
									<span>индивидуальная</span>
								</div>
								<div class="sort__list-item">
									<span>коммерческая</span>
								</div>
							</div>
						</div>
					</div>
					<div class="sort close-out building__all">
						<span class="sort__title btn">
							<span>
								Все регионы
							</span>
							<img class="arrow" src="{{ asset('lands/img/icons/next.png') }}" alt="стрелочка">
						</span>
						<div class="sort__list">
							<div class="sort__list-body">
								<div class="sort__list-item">
									<span>индивидуальная</span>
								</div>
								<div class="sort__list-item">
									<span>коммерческая</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="gallery__filter">
					<div class="gallery__item building-select all active">
						Все
					</div>
					<div class="gallery__item building-select">
						Анталья
					</div>
					<div class="gallery__item building-select">
						Кемер
					</div>
					<div class="gallery__item building-select">
						Станбул
					</div>
					<div class="gallery__item building-select">
						Мерсин
					</div>
					<div class="gallery__item building-select">
						Измир
					</div>
					<div class="gallery__item building-select">
						Аланья
					</div>
					<div class="gallery__item building-select">
						Бодрум
					</div>
				</div>
				<div class="building__list">
					<div class="building__item" open-building-popup="popup-buildings">
						<div class="building__item-top">
							<div class="building__item-swiper swiper">
								<div class="building__item-swiper-wrapper swiper-wrapper">
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-1.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-1.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-1.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-1.png') }}" alt="объект">
									</div>
								</div>
								<div class="building__item-scrollbar swiper-scrollbar"></div>
							</div>
							<div class="building__item-hashtag">
								СЕМЕЙНЫЙ
							</div>
						</div>
						<div class="building__item-info">
							<div class="building__item-desc">
								<div class="building__item-name">
									Sedanka Hills
								</div>
								<div class="building__item-address">
									Altıntaş / Aksu / Antalya
								</div>
								<div class="building__item-price">
									от
									<b>
										165 000 €
									</b>
								</div>
							</div>
							<div class="building__item-lead">
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/dashboard.png') }}" alt="dashboard">
									</div>
									1+1, 2+1, 3+1
								</div>
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/wide.png') }}" alt="wide">
									</div>
									79-121 м2
								</div>
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/wave.png') }}" alt="wave">
									</div>
									500 м
								</div>
							</div>
						</div>
					</div>
					<div class="building__item" open-building-popup="popup-buildings">
						<div class="building__item-top">
							<div class="building__item-swiper swiper">
								<div class="building__item-swiper-wrapper swiper-wrapper">
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-2.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-2.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-2.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-2.png') }}" alt="объект">
									</div>
								</div>
								<div class="building__item-scrollbar swiper-scrollbar"></div>
							</div>
							<div class="building__item-hashtag">
								ВНЖ
							</div>
						</div>
						<div class="building__item-info">
							<div class="building__item-desc">
								<div class="building__item-name">
									Sedanka Hills
								</div>
								<div class="building__item-address">
									Altıntaş / Aksu / Antalya
								</div>
								<div class="building__item-price">
									от
									<b>
										165 000 €
									</b>
								</div>
							</div>
							<div class="building__item-lead">
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/dashboard.png') }}" alt="dashboard">
									</div>
									1+1, 2+1, 3+1
								</div>
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/wide.png') }}" alt="wide">
									</div>
									79-121 м2
								</div>
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/wave.png') }}" alt="wave">
									</div>
									500 м
								</div>
							</div>
						</div>
					</div>
					<div class="building__item" open-building-popup="popup-buildings">
						<div class="building__item-top">
							<div class="building__item-swiper swiper">
								<div class="building__item-swiper-wrapper swiper-wrapper">
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-3.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-3.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-3.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-3.png') }}" alt="объект">
									</div>
								</div>
								<div class="building__item-scrollbar swiper-scrollbar"></div>
							</div>
						</div>
						<div class="building__item-info">
							<div class="building__item-desc">
								<div class="building__item-name">
									Sedanka Hills
								</div>
								<div class="building__item-address">
									Altıntaş / Aksu / Antalya
								</div>
								<div class="building__item-price">
									от
									<b>
										165 000 €
									</b>
								</div>
							</div>
							<div class="building__item-lead">
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/dashboard.png') }}" alt="dashboard">
									</div>
									1+1, 2+1, 3+1
								</div>
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/wide.png') }}" alt="wide">
									</div>
									79-121 м2
								</div>
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/wave.png') }}" alt="wave">
									</div>
									500 м
								</div>
							</div>
						</div>
					</div>
					<div class="building__item building__item_point" open-building-popup="popup-buildings">
						<div class="building__item-top">
							<div class="building__item-swiper swiper">
								<div class="building__item-swiper-wrapper swiper-wrapper">
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-1.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-1.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-1.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-1.png') }}" alt="объект">
									</div>
								</div>
								<div class="building__item-scrollbar swiper-scrollbar"></div>
							</div>
							<div class="building__item-hashtag">
								СЕМЕЙНЫЙ
							</div>
						</div>
						<div class="building__item-info">
							<div class="building__item-desc">
								<div class="building__item-name">
									Sedanka Hills
								</div>
								<div class="building__item-address">
									<img src="{{ asset('lands/img/icons/location_black.png') }}" alt="точка">
									Altıntaş / Aksu / Antalya
								</div>
								<div class="building__item-price">
									от
									<b>
										165 000 €
									</b>
								</div>
							</div>
							<div class="building__item-lead">
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/dashboard.png') }}" alt="dashboard">
									</div>
									1+1, 2+1, 3+1
								</div>
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/wide.png') }}" alt="wide">
									</div>
									79-121 м2
								</div>
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/wave.png') }}" alt="wave">
									</div>
									500 м
								</div>
							</div>
						</div>
					</div>
					<div class="building__item building__item_point" open-building-popup="popup-buildings">
						<div class="building__item-top">
							<div class="building__item-swiper swiper">
								<div class="building__item-swiper-wrapper swiper-wrapper">
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-2.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-2.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-2.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-2.png') }}" alt="объект">
									</div>
								</div>
								<div class="building__item-scrollbar swiper-scrollbar"></div>
							</div>
							<div class="building__item-hashtag">
								ВНЖ
							</div>
						</div>
						<div class="building__item-info">
							<div class="building__item-desc">
								<div class="building__item-name">
									Sedanka Hills
								</div>
								<div class="building__item-address">
									<img src="{{ asset('lands/img/icons/location_black.png') }}" alt="точка">
									Altıntaş / Aksu / Antalya
								</div>
								<div class="building__item-price">
									от
									<b>
										165 000 €
									</b>
								</div>
							</div>
							<div class="building__item-lead">
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/dashboard.png') }}" alt="dashboard">
									</div>
									1+1, 2+1, 3+1
								</div>
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/wide.png') }}" alt="wide">
									</div>
									79-121 м2
								</div>
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/wave.png') }}" alt="wave">
									</div>
									500 м
								</div>
							</div>
						</div>
					</div>
					<div class="building__item building__item_point" open-building-popup="popup-buildings">
						<div class="building__item-top">
							<div class="building__item-swiper swiper">
								<div class="building__item-swiper-wrapper swiper-wrapper">
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-3.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-3.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-3.png') }}" alt="объект">
									</div>
									<div class="building__item-slide swiper-slide">
										<img src="{{ asset('lands/img/pic/building-3.png') }}" alt="объект">
									</div>
								</div>
								<div class="building__item-scrollbar swiper-scrollbar"></div>
							</div>
						</div>
						<div class="building__item-info">
							<div class="building__item-desc">
								<div class="building__item-name">
									Sedanka Hills
								</div>
								<div class="building__item-address">
									<img src="{{ asset('lands/img/icons/location_black.png') }}" alt="точка">
									Altıntaş / Aksu / Antalya
								</div>
								<div class="building__item-price">
									от
									<b>
										165 000 €
									</b>
								</div>
							</div>
							<div class="building__item-lead">
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/dashboard.png') }}" alt="dashboard">
									</div>
									1+1, 2+1, 3+1
								</div>
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/wide.png') }}" alt="wide">
									</div>
									79-121 м2
								</div>
								<div class="building__item-lead-point">
									<div class="icon">
										<img src="{{ asset('lands/img/icons/wave.png') }}" alt="wave">
									</div>
									500 м
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="conditions container">
				<div class="conditions__title title">
					УСЛОВИЯ ПОКУПКИ
				</div>
				<div class="conditions__list">
					<div class="conditions__list-item">
						<div class="conditions__item-info">
							<div class="">
								<div class="conditions__item-subtitle">
									Беспроцентная рассрочка
								</div>
								<p>
									Рассрочка на период строительства
								</p>
								<p>
									Первоначальный платеж 30% от стоимости квартиры
								</p>
								<ul class="list_point">
									<li>
										Возможна удалённая сделка
									</li>
									<li>
										Помощь по вариантам оплаты
									</li>
								</ul>
								<p>
									Вид на жительство можете получить после внесения последнего платежа
								</p>
							</div>
							<button class="conditions__item-btn btn btn_grey-dark btn_arrow" btn-popup="popup-record">
								Оставить заявку
								<img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
							</button>
						</div>
						<div class="conditions__item-number">
							1
						</div>
					</div>
					<div class="conditions__list-item">
						<div class="conditions__item-info">
							<div class="">
								<div class="conditions__item-subtitle">
									Оплата 100%
								</div>
								<ul class="list_point">
									<li>
										Возможна удалённая сделка
									</li>
									<li>
										Помощь по вариантам оплаты
									</li>
								</ul>
								<button class="conditions__item-btn-more" btn-popup="popup-vnj">
									Подробнее о ВНЖ
								</button>
							</div>
							<button class="conditions__item-btn btn btn_grey-dark btn_arrow" btn-popup="popup-record">
								Оставить заявку
								<img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
							</button>
						</div>
						<div class="conditions__item-number">
							2
						</div>
					</div>
				</div>
			</div>
			<div class="map" id="map">
				<!-- <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Afc64a3d223ff913723c16022e4266225030f99a540ffe10915e3499fe62a343b&amp;source=constructor&amp;scroll=false"
					width="100%"
					height="500"
					frameborder="0">
				</iframe> -->
				<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Afc64a3d223ff913723c16022e4266225030f99a540ffe10915e3499fe62a343b&amp;width=100%&amp;height=351&amp;lang=ru_RU&amp;scroll=false&amp;apikey=2a0f0e9d-44f3-4f13-8628-12588d752fc3"></script>
			</div>
			<div class="about container" id="about">
				<div class="title">
					ДОСТОПРИЧАТЕЛЬНОСТИ АНТАЛИИ
				</div>
				<div class="about__swiper swiper">
					<div class="about__swiper-wrapper swiper-wrapper">
						<div class="about__slide swiper-slide">
							<div class="about__slide-pic">
								<img src="{{ asset('lands/img/pic/about-2.png') }}" alt="">
							</div>
							<div class="about__slide-text">
								<div class="about__slide-title">
									Десятки исторических памятников культуры
								</div>
								<p class="about__slide-lead">
									В Анталье расположены десятки исторических памятников культуры, которые непременно стоит увидеть! На протяжении всей своей истории Анталья становилась домом для десятка цивилизаций, сохранила следы этих цивилизаций и сегодня выставляет их для своих посетителей.
								</p>
							</div>
						</div>
						<div class="about__slide swiper-slide">
							<div class="about__slide-pic">
								<img src="{{ asset('lands/img/pic/about-2.png') }}" alt="">
							</div>
							<div class="about__slide-text">
								<div class="about__slide-title">
									Десятки исторических памятников культуры
								</div>
								<p class="about__slide-lead">
									В Анталье расположены десятки исторических памятников культуры, которые непременно стоит увидеть! На протяжении всей своей истории Анталья становилась домом для десятка цивилизаций, сохранила следы этих цивилизаций и сегодня выставляет их для своих посетителей.
								</p>
							</div>
						</div>
						<div class="about__slide swiper-slide">
							<div class="about__slide-pic">
								<img src="{{ asset('lands/img/pic/about-2.png') }}" alt="">
							</div>
							<div class="about__slide-text">
								<div class="about__slide-title">
									Десятки исторических памятников культуры
								</div>
								<p class="about__slide-lead">
									В Анталье расположены десятки исторических памятников культуры, которые непременно стоит увидеть! На протяжении всей своей истории Анталья становилась домом для десятка цивилизаций, сохранила следы этих цивилизаций и сегодня выставляет их для своих посетителей.
								</p>
							</div>
						</div>
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
                    О стране
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
            <a class="header__phone" href="tel:88007005555">
                <img src="{{ asset('lands/img/icons/phone-call.png') }}" alt="телефон">
                <span>
                    8 800 700 55 55
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
<!-- дефолтная модалка -->
<form class="popup popup-record form">
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
					<input type="text" value="" placeholder="Иванов Алексей Петрович">
				</label>
				<label class="field input-wrapper">
					<span class="text">
					Номер телефона
					</span>
					<input type="number" value="" placeholder="+7" >
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
                Вид на жительство в Турции
            </div>
            <div class="vnj__keep">
                <div class="vnj__text">
                    <p>
                        Покупая квартиру в ЖК «Perge Collection: sky blue» вы не только приобретаете жилье в большом курортном городе с отличным климатом, которое можно сдавать в аренду, но и получаете более ценные преимущества, такие, как вид на жительство в Турции или даже гражданство.
                    </p>
                    <p>
                        ВНЖ имеет ряд несомненных плюсов, вы можете круглогодично жить в стране, открыть свой бизнес, бесплатно пользоваться некоторыми государственными услугами, а также претендовать на турецкое гражданство уже через 5 лет после приобретения недвижимости.
                    </p>
                    <p>
                        Турецкий паспорт позволит вам пользоваться всеми привилегиями этого государства, путешествовать в безвизовом режиме более чем по 110 странам, получить право открыть свое дело в США и Великобритании и многое другое.
                    </p>
                    <p>
                        Процесс оформления проходит достаточно быстро и просто, а это значит, что, приобретая квартиру в нашем жилищном комплексе, вы инвестируете в свое будущее.
                    </p>
                </div>
                <form class="preview__form" style="height: fit-content;">
                    <div class="preview__form-title">
                        Оставить заявку эксперту
                    </div>
					<label class="field input-wrapper" >
						<span class="text">
						Имя
						</span>
						<input type="text" value="" placeholder="Иванов Алексей Петрович">
					</label>
					<label class="field input-wrapper">
						<span class="text">
						Номер телефона
						</span>
						<input type="number" value="" placeholder="+7" >
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

	</div>
	<script src="{{ asset('lands/js/jquery.js') }}"></script>
	<script src="{{ asset('lands/js/bodyScrollLock.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	<!-- <script src="{{ asset('lands/js/allCountries-list.js') }}"></script>
	<script src="{{ asset('lands/js/libphonenumber-validator.js') }}"></script>
	<script src="{{ asset('lands/js/inputPhone.js') }}"></script> -->
	<script src="{{ asset('lands/js/app.js') }}"></script>

</body>
</html>


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('lands/files/fonts/stylesheet.css') }}">
	<link href="https://fonts.cdnfonts.com/css/rubik-one" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
	<link rel="stylesheet" type="text/css" href="{{ asset('lands/css/style.css') }}">
	<title>ЖК</title>
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
				<img class="preview__pic" src="{{ asset('lands/img/pic/sky.jpg') }}" alt="">
				<div class="preview__content container">
					<div class="preview__place">
						<div class="preview__place-address">
							<img src="{{ asset('lands/img/icons/location.png') }}" alt="локация">
							Анталья, Турция
						</div>
						<div class="preview__title">
							ЖК SKY BLUE
							<span>
								PERGE COLLECTION
							</span>
						</div>
						<p class="preview__lead">
							Жилой комплекс класса бизнес на берегу моря в новом районе Алтынташ. Это первый район в Анталии с утвержденным проектом планировки территории
						</p>
					</div>
					<form class="preview__form form">
						<div class="preview__form-title">
							Оставить заявку эксперту
						</div>
						<input placeholder="Имя">
						<input data-phone-pattern="+7 (___) ___-__-__" class="validation-phone">
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
							2024
						</span>
						<p>
							I квартал сдача жилого комплекса
						</p>
					</div>
					<div class="preview__info-item">
						<span>
							50
						</span>
						<p>
							Всего квартир в комплексе
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
							2
						</span>
						<p>
							Больших бассейна на территории ЖК
						</p>
					</div>
				</div>
			</div>
			<div class="about container" id="about">
				<div class="title">
					PERGE COLLECTION: SKY BLUE
				</div>
				<div class="title title_grey">
					БИЗНЕС-КЛАСС НА БЕРЕГУ СРЕДИЗЕМНОГО МОРЯ
				</div>
				<div class="about__swiper swiper">
					<div class="about__swiper-wrapper swiper-wrapper">
						<div class="about__slide swiper-slide">
							<div class="about__slide-pic">
								<img src="{{ asset('lands/img/pic/about.png') }}" alt="">
							</div>
							<div class="about__slide-text">
								<div class="about__slide-title">
									Большая закрытая территория с двумя бассейнами
								</div>
								<p class="about__slide-lead">
									5700м2 - идеальная территория для 50 квартир, чтобы чувствовать уединенность и приватность. На территории есть сауна и тренажерный зал. Разноуровневые посадки растений по всей территории по индивидуальному проекту. Спортивная площадка для баскетбола, волейбола или тенниса.
								</p>
							</div>
						</div>
						<div class="about__slide swiper-slide">
							<div class="about__slide-pic">
								<img src="{{ asset('lands/img/pic/about.png') }}" alt="">
							</div>
							<div class="about__slide-text">
								<div class="about__slide-title">
									Большая закрытая территория с двумя бассейнами
								</div>
								<p class="about__slide-lead">
									5700м2 - идеальная территория для 50 квартир, чтобы чувствовать уединенность и приватность. На территории есть сауна и тренажерный зал. Разноуровневые посадки растений по всей территории по индивидуальному проекту. Спортивная площадка для баскетбола, волейбола или тенниса.
								</p>
							</div>
						</div>
						<div class="about__slide swiper-slide">
							<div class="about__slide-pic">
								<img src="{{ asset('lands/img/pic/about.png') }}" alt="">
							</div>
							<div class="about__slide-text">
								<div class="about__slide-title">
									Большая закрытая территория с двумя бассейнами
								</div>
								<p class="about__slide-lead">
									5700м2 - идеальная территория для 50 квартир, чтобы чувствовать уединенность и приватность. На территории есть сауна и тренажерный зал. Разноуровневые посадки растений по всей территории по индивидуальному проекту. Спортивная площадка для баскетбола, волейбола или тенниса.
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
			<div class="infrastructure container" id="infrastructure">
				<div class="title">
					Территория
				</div>
				<img src="{{ asset('lands/img/pic/territoriya.png') }}" alt="инфраструктура">
			</div>
			<div class="layouts container" id="layouts">
				<div class="title">
					КВАРТИРЫ В ПРОДАЖЕ
				</div>
				<div class="layouts__swiper swiper">
					<div class="layouts__swiper-wrapper swiper-wrapper">
						<div class="layouts__slide swiper-slide" btn-popup="popup-record">
							<div class="layouts__slide-pic">
								<img src="{{ asset('lands/img/pic/layout.png') }}" alt="схема">
							</div>
							<div class="layouts__slide-text">
								<div class="layouts__slide-price">
									165 000 €
								</div>
								<div class="layouts__slide-info">
									<div class="layouts__slide-lead">
										50 кв.м., 2 комнаты, 1 ванна, лоджия 12 кв.м.
									</div>
									<div class="layouts__slide-btn btn btn_grey">
										<img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
									</div>
								</div>
							</div>
						</div>
						<div class="layouts__slide swiper-slide" btn-popup="popup-record">
							<div class="layouts__slide-pic">
								<img src="{{ asset('lands/img/pic/layout-2.png') }}" alt="схема">
							</div>
							<div class="layouts__slide-text">
								<div class="layouts__slide-price">
									165 000 €
								</div>
								<div class="layouts__slide-info">
									<div class="layouts__slide-lead">
										50 кв.м., 2 комнаты, 1 ванна, лоджия 12 кв.м.
									</div>
									<div class="layouts__slide-btn btn btn_grey">
										<img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
									</div>
								</div>
							</div>
						</div>
						<div class="layouts__slide swiper-slide" btn-popup="popup-record">
							<div class="layouts__slide-pic">
								<img src="{{ asset('lands/img/pic/layout.png') }}" alt="схема">
							</div>
							<div class="layouts__slide-text">
								<div class="layouts__slide-price">
									165 000 €
								</div>
								<div class="layouts__slide-info">
									<div class="layouts__slide-lead">
										50 кв.м., 2 комнаты, 1 ванна, лоджия 12 кв.м.
									</div>
									<div class="layouts__slide-btn btn btn_grey">
										<img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
									</div>
								</div>
							</div>
						</div>
						<div class="layouts__slide swiper-slide" btn-popup="popup-record">
							<div class="layouts__slide-pic">
								<img src="{{ asset('lands/img/pic/layout-2.png') }}" alt="схема">
							</div>
							<div class="layouts__slide-text">
								<div class="layouts__slide-price">
									165 000 €
								</div>
								<div class="layouts__slide-info">
									<div class="layouts__slide-lead">
										50 кв.м., 2 комнаты, 1 ванна, лоджия 12 кв.м.
									</div>
									<div class="layouts__slide-btn btn btn_grey">
										<img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
									</div>
								</div>
							</div>
						</div>
						<div class="layouts__slide swiper-slide" btn-popup="popup-record">
							<div class="layouts__slide-pic">
								<img src="{{ asset('lands/img/pic/layout.png') }}" alt="схема">
							</div>
							<div class="layouts__slide-text">
								<div class="layouts__slide-price">
									165 000 €
								</div>
								<div class="layouts__slide-info">
									<div class="layouts__slide-lead">
										50 кв.м., 2 комнаты, 1 ванна, лоджия 12 кв.м.
									</div>
									<div class="layouts__slide-btn btn btn_grey">
										<img src="{{ asset('lands/img/icons/right-arrows.png') }}" alt="стрелочка">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="layouts__pagination swiper__pagination"></div>
				</div>
			</div>
			<div class="gallery" id="gallery">
				<div class="container">
					<div class="gallery__title title">
						ГАЛЕРЕЯ
					</div>
					<div class="gallery__filter">
						<div class="gallery__item gallery__item_video" btn-popup="popup-video">
							<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 16 16" fill="#000000" class="bi bi-play-circle">
								<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
								<path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
							</svg>
							Видео
						</div>
						<div class="gallery__item active">
							Все
						</div>
						<div class="gallery__item">
							Интерьер
						</div>
						<div class="gallery__item">
							Экстерьер
						</div>
						<div class="gallery__item">
							Инфраструктура
						</div>
						<div class="gallery__item">
							Лобби
						</div>
						<div class="gallery__item">
							Территория
						</div>
						<div class="gallery__all sort close-out " style="width: 200px;">
							<span class="sort__title btn" style="width: 100%;">
								<span>
									Все
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
				</div>
				<div class="gallery__swiper-w">
					<div class="gallery__swiper swiper">
						<div class="gallery__swiper-wrapper swiper-wrapper">
							<a href="{{ asset('lands/img/pic/gallery-1.png') }}" class="gallery__slide swiper-slide" data-fancybox="gallery">
								<img src="{{ asset('lands/img/pic/gallery-1.png') }}" alt="">
							</a>
							<a href="{{ asset('lands/img/pic/gallery-2.png') }}" class="gallery__slide swiper-slide" data-fancybox="gallery">
								<img src="{{ asset('lands/img/pic/gallery-2.png') }}" alt="">
							</a>
							<a href="{{ asset('lands/img/pic/gallery-3.png') }}" class="gallery__slide swiper-slide" data-fancybox="gallery">
								<img src="{{ asset('lands/img/pic/gallery-3.png') }}" alt="">
							</a>
							<a href="{{ asset('lands/img/pic/gallery-1.png') }}" class="gallery__slide swiper-slide" data-fancybox="gallery">
								<img src="{{ asset('lands/img/pic/gallery-1.png') }}" alt="">
							</a>
							<a href="{{ asset('lands/img/pic/gallery-2.png') }}" class="gallery__slide swiper-slide" data-fancybox="gallery">
								<img src="{{ asset('lands/img/pic/gallery-2.png') }}" alt="">
							</a>
							<a href="{{ asset('lands/img/pic/gallery-3.png') }}" class="gallery__slide swiper-slide" data-fancybox="gallery">
								<img src="{{ asset('lands/img/pic/gallery-3.png') }}" alt="">
							</a>
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
			<div class="map">
				<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Afc64a3d223ff913723c16022e4266225030f99a540ffe10915e3499fe62a343b&amp;source=constructor&amp;scroll=false"
					width="100%"
					height="500"
					frameborder="0">
				</iframe>
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

<!-- дефолтная модалка -->
<form class="popup popup-record form">
    <div class="popup__body">
        <div class="popup__content">
            <div class="preview__form">
                <div class="preview__form-title">
                    Оставить заявку эксперту
                </div>
                <input placeholder="Имя">
                <input data-phone-pattern="+7 (___) ___-__-__" class="validation-phone">
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
                    <input placeholder="Имя">
                    <input data-phone-pattern="+7 (___) ___-__-__" class="validation-phone">
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
	<script src="{{ asset('lands/js/allCountries-list.js') }}"></script>
	<script src="{{ asset('lands/js/libphonenumber-validator.js') }}"></script>
	<script src="{{ asset('lands/js/inputPhone.js') }}"></script>
	<script src="{{ asset('lands/js/app.js') }}"></script>

</body>
</html>

@extends('project.includes.layouts')

@section('header')
    @include('project.includes.header')
@endsection

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
                    @if(count($country->product_country) > 0)
                        <a href="{{route('country', $country->id)}}" class="popular-locations__item">
                            <div class="popular-locations__item-img">
                                <img style="max-width: 50px" src="{{asset("uploads/$country->photo")}}" alt="gr">
                            </div>
                            <div class="popular-locations__item-text">
                                @if(app()->getLocale() == 'en') <?php $country->name = $country->name_en ?> @elseif(app()->getLocale() == 'tr') <?php $country->name = $country->name_tr ?> @elseif(app()->getLocale() == 'de') <?php $country->name = $country->name_de ?> @endif
                                {{$country->name}}
                                <span>{{$country->product_country->count()}}</span>
                            </div>
                        </a>
                    @else
                        <div class="popular-locations__item _close-opening">
                            <div class="popular-locations__item-img">
                                <img style="max-width: 50px" src="{{asset("uploads/$country->photo")}}" alt="gr">
                            </div>
                            <div class="popular-locations__item-text _close-opening">
                                @if(app()->getLocale() == 'en') <?php $country->name = $country->name_en ?> @elseif(app()->getLocale() == 'tr') <?php $country->name = $country->name_tr ?> @elseif(app()->getLocale() == 'de') <?php $country->name = $country->name_de ?> @endif
                                {{$country->name}}
                                <span>({{ __('скоро открытие') }})</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="popular-locations__footer">
            <div class="popular-locations__button">
                <a href="{{route('all_location')}}">{{__('Все локации')}}</a>
            </div>
        </div>
    </section>
    <section class="hello container">
        <div class="hello__title title">
            Приветствую вас, дорогой гость!
        </div>
        <div class="hello__content">
            <img class="hello__content-pic" src="{{asset('uploads/hellow-preview.png')}}" alt="Владелец компании oneteam">
            <div class="hello__text">
                <div class="hello__text-lead">
                    <p>
                        Давайте познакомимся. 
                    </p>
                    <p>
                        Меня зовут Фаиг Ализаде, я — владелец агентства <b>Oneteam.</b>
                    </p>
                    <p>
                        Наша сфера деятельности — сделки с недвижимостью в Турции: мы помогаем клиентам купить, продать, арендовать или сдать в аренду коммерческие и жилые объекты.
                    </p>
                </div>
                <div class="hello__text-lead">
                    <p>
                        Офис агентства расположен в Анталье; зоны нашего особого интереса — это Манавгат, Кемер, Белек, Финике, Сиде, Алания, Махмутлар, Авсаллар, Каргыджак, Кестел. Также мы активно работаем и в других регионах Турецкой Республики, в частности, в Мерсине, Бодруме, Фетхие.
                    </p>
                </div>
                <div class="hello__text-lead">
                    <p>
                    В портфеле Oneteam представлены высоколиквидные объекты, предназначенные для разных целей: для инвестиций, сдачи в аренду и просто для комфортной жизни. Все они поступают к нам напрямую от застройщиков, минуя посредников, и это значит, что мы можем предложить вам лучшие цены на них.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="benefit container">
        <div class="benefit__title title">
            Чем мы будем вам полезны?
        </div>
        <div class="benefit__content">
            <div class="benefit__item">
                Подберем объекты под ваш запрос
            </div>
            <div class="benefit__item">
                Обеспечим юридическое сопровождение на всех этапах сделки
            </div>
            <div class="benefit__item">
                Проконсультируем и поможем оформить все документы
            </div>
            <div class="benefit__item">
                Поможем получить выгодные условия по рассрочке и кредиту
            </div>
            <div class="benefit__item">
                Возьмем вашу недвижимость в управление
            </div>
            <div class="benefit__item">
                Обеспечим постпродажный сервис
            </div>
        </div>
        <div class="benefit__desc">
            <svg width="46" height="45" viewBox="0 0 46 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M23 2C34.598 2 44 11.1782 44 22.5C44 33.8218 34.598 43 23 43C11.402 43 2 33.8218 2 22.5C2 11.1782 11.402 2 23 2Z" stroke="#FA0064" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M13 21.6399L21.2353 29.3334L33 15.6667" stroke="#FA0064" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <p>
            Специалисты Oneteam говорят на русском, турецком, английском, немецком, иранском, арабском языках. Поэтому можете не волноваться: наше с вами сотрудничество не затруднит языковой барьер.
            </p>
        </div>
        <button class="benefit__btn">
            Посмотреть каталог объектов
        </button>
    </section>
    <section class="why container">
        <div class="why__title title">
            Почему клиенты выбирают именно нас?
        </div>
        <div class="why__desc">
            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 45 45" fill="none">
                <g clip-path="url(#clip0_17_222)">
                    <path d="M22.5025 0C10.0757 0 0.00170898 10.0724 0.00170898 22.496C0.00170898 34.926 10.0757 45 22.5025 45C34.9293 45 45.0001 34.9244 45.0001 22.496C45.0001 10.0724 34.9293 0 22.5025 0ZM22.5025 42.6955C11.3454 42.6955 2.30618 33.6514 2.30618 22.4944C2.30618 11.3421 11.3454 2.30126 22.5025 2.30126C33.6564 2.30126 42.6972 11.3421 42.6972 22.4944C42.6956 33.6514 33.6548 42.6955 22.5025 42.6955Z" fill="#FA0064"/>
                    <path d="M25.0708 27.6119L26.0557 7.3689H18.9958L19.9775 27.6119H25.0708Z" fill="#FA0064"/>
                    <path d="M22.5266 29.8455C20.1594 29.8455 18.5034 31.5014 18.5034 33.9105C18.5034 36.2327 20.1111 37.9787 22.4365 37.9787H22.5266C24.9389 37.9787 26.4999 36.2327 26.4999 33.9105C26.458 31.5014 24.8922 29.8455 22.5266 29.8455Z" fill="#FA0064"/>
                </g>
                <defs>
                    <clipPath id="clip0_17_222">
                    <rect width="45" height="45" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
            <p>
                Хороших агентств в Турции много, но у Oneteam есть серьезный козырь.
            </p>
        </div>
        <p class="why__lead">
            Пока другие подбирают объекты недвижимости вручную, мы разработали собственный IT-продукт на базе искусственного интеллекта, который анализирует предложения рынка и помогает не только выбрать из них максимально соответствующие запросу клиента, но и определить наиболее ликвидные.
        </p>
        <button class="why__btn">
            Тестовая версия программы
        </button>
    </section>
    <section class="advantages container">
        <div class="advantages__title title">
            Наши преимущества
        </div>
        <div class="advantages__content">
            <div class="advantages__item">
                <div class="advantages__item-pic">
                <svg width="82" height="51" viewBox="0 0 82 51" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g clip-path="url(#clip0_15_199)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M63.7075 17.0068V49.0922H2.23071V17.0068H63.7075Z" stroke="#FA0064" stroke-width="4.04437" stroke-miterlimit="22.9256"/>
                    <path d="M8.57153 11.0752H70.0484V41.0035" stroke="#FA0064" stroke-width="1.88737" stroke-miterlimit="22.9256"/>
                    <path d="M13.5337 5.95215H75.0105V36.1501" stroke="#FA0064" stroke-width="1.88737" stroke-miterlimit="22.9256"/>
                    <path d="M18.7717 1.09912H80.2486V31.0274" stroke="#FA0064" stroke-width="1.88737" stroke-miterlimit="22.9256"/>
                    <path d="M28.1449 36.4198V39.116H35.0369C36.9667 39.116 38.6208 37.7679 38.6208 36.1501C38.6208 34.5324 36.9667 33.1843 35.0369 33.1843H31.1774C28.972 33.1843 27.3179 31.8362 27.3179 29.9488C27.3179 28.331 28.972 26.9829 31.1774 26.9829H38.0694V29.6792" stroke="#FA0064" stroke-width="2.96587" stroke-miterlimit="22.9256"/>
                    <path d="M33.3828 26.9829V22.1296" stroke="#FA0064" stroke-width="2.96587" stroke-miterlimit="22.9256"/>
                    <path d="M33.3828 43.9692V39.116" stroke="#FA0064" stroke-width="2.96587" stroke-miterlimit="22.9256"/>
                    <rect x="-453.834" y="0.531494" width="989.743" height="50" fill="url(#pattern0)"/>
                    </g>
                    <defs>
                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_15_199" transform="matrix(0.00103306 0 0 0.0204492 0 -0.0112309)"/>
                    </pattern>
                    <clipPath id="clip0_15_199">
                    <rect width="80.7745" height="51" fill="white" transform="translate(0.301025)"/>
                    </clipPath>
                    <image id="image0_15_199" width="968" height="50" xlink:href="data:image/png;base64,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"/>
                    </defs>
                </svg>
                </div>
                <div class="advantages__item-text">
                    <b>
                        Лучшие цены
                    </b>
                    <p>
                        Мы не просто продаем недвижимость от застройщика в Турции, а имеем личные договоренности со строительными компаниями.
                    </p>
                    <p>
                        Это позволяет предлагать нашим клиентам специальные расценки, которые ниже, чем если бы вы приобретали напрямую у застройщика.
                    </p>
                </div>
            </div>
            <div class="advantages__item">
                <div class="advantages__item-pic">
                    <svg width="71" height="56" viewBox="0 0 71 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.96948 4.55249L14.1406 11.2108L24.1121 9.29875C27.4782 8.65332 30.9278 9.72047 33.5046 12.2044" stroke="#FA0064" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M57.614 39.4946L41.8195 51.9175C38.3477 54.6485 33.708 54.6975 30.1894 52.0409L2.96948 31.491" stroke="#FA0064" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M68.4071 31.3591L57.2315 39.8166L39.8916 24.3105L33.5134 29.4516C30.9199 31.5421 27.2969 30.9789 25.3233 28.1784C23.3543 25.3843 23.7342 21.3657 26.183 19.0838L32.8243 12.8953C36.0073 9.92923 40.1452 8.52949 44.2814 9.01965L54.6321 10.2461L68.4071 2" stroke="#FA0064" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M39.8936 24.3512C44.066 28.4682 49.9831 26.3679 52.1832 23.0071" stroke="#FA0064" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="advantages__item-text">
                    <b>
                        Выгодные условия
                    </b>
                    <p>
                        Благодаря налаженному партнерству с турецкими банками Oneteam осуществляет продажу недвижимости в Турции в рассрочку, в ипотеку (кредит) под минимальные проценты.
                    </p>
                    <p>
                        Покупайте так, как вам удобно!
                    </p>
                </div>
            </div>
            <div class="advantages__item">
                <div class="advantages__item-pic">
                <svg xmlns="http://www.w3.org/2000/svg" width="62" height="60" viewBox="0 0 62 60" fill="none">
                    <path d="M30.3103 44.3748H45.4427C45.2127 44.5748 44.9826 44.7498 44.7525 44.9498L33.8378 52.9498C30.2336 55.5748 24.3545 55.5748 20.7247 52.9498L9.78438 44.9498C7.38159 43.1998 5.41333 39.3248 5.41333 36.3998V17.8747C5.41333 14.8247 7.79058 11.4497 10.7046 10.3747L23.4342 5.69966C25.5303 4.92466 29.0066 4.92466 31.1027 5.69966L43.8068 10.3747C46.2351 11.2747 48.3056 13.7747 48.9446 16.3247H30.2847C29.7224 16.3247 29.2111 16.3497 28.7255 16.3497C23.9966 16.6247 22.7696 18.2997 22.7696 23.5747V37.1495C22.7952 42.8995 24.3033 44.3748 30.3103 44.3748Z" stroke="#FA0064" stroke-width="3.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M22.7954 28.05H56.5365" stroke="#FA0064" stroke-width="3.75" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M56.5365 23.5494V37.4245C56.4854 42.9745 54.9261 44.3492 49.0214 44.3492H30.3106C24.3035 44.3492 22.7954 42.8745 22.7954 37.0995V23.5244C22.7954 18.2744 24.0224 16.5993 28.7514 16.2993C29.237 16.2993 29.7483 16.2744 30.3106 16.2744H49.0214C55.0284 16.2994 56.5365 17.7494 56.5365 23.5494Z" stroke="#FA0064" stroke-width="3.75" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M29.2371 38.1494H32.6367" stroke="#FA0064" stroke-width="3.75" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M38.0044 38.1494H46.363" stroke="#FA0064" stroke-width="3.75" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                </div>
                <div class="advantages__item-text">
                    <b>
                        Полная безопасность
                    </b>
                    <p>
                        Все сделки заключаются в соответствии с турецким законодательством и с применением инструментов минимизации рисков, а мы отчитываемся перед вами по всем производимым операциям — в том числе и финансовым.
                    </p>
                    <p>
                        Приобретая недвижимость в Oneteam, вы ничем не рискуете.
                    </p>
                </div>
            </div>
            <div class="advantages__item">
                <div class="advantages__item-pic">
                    <svg width="57" height="55" viewBox="0 0 57 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.3512 21.6154C25.8895 21.6154 30.3792 17.2243 30.3792 11.8077C30.3792 6.39106 25.8895 2 20.3512 2C14.8129 2 10.3232 6.39106 10.3232 11.8077C10.3232 17.2243 14.8129 21.6154 20.3512 21.6154Z" stroke="#FA0064" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20.3514 49.0769H2.30103V46.9502C2.33296 43.96 3.13927 41.0263 4.64465 38.4237C6.15005 35.8209 8.30539 33.6337 10.9093 32.0665C13.5133 30.4992 16.481 29.6031 19.5351 29.4616C19.8073 29.449 20.0795 29.4424 20.3514 29.4419C20.6233 29.4424 20.8955 29.449 21.1678 29.4616C24.2219 29.6031 27.1895 30.4992 29.7935 32.0665C31.2909 32.9677 32.6399 34.0739 33.8023 35.3462" stroke="#FA0064" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M54.4466 33.3848L38.4018 53.0002L30.3794 47.1155" stroke="#FA0064" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="advantages__item-text">
                    <b>
                        Клиентоориентированность
                    </b>
                    <p>
                        Oneteam подготовит для вас пул доступных вариантов, предоставит переводчика и юриста, и обеспечит бережное сопровождение на каждом этапе сделки.
                    </p>
                    <p>
                        Мы знаем, что сориентироваться в рынке недвижимости другой страны сложно, и заботимся о том, чтобы процесс покупки прошел для вас максимально комфортно.
                    </p>
                </div>
            </div>
        </div>
        <div class="advantages__footer">
            <div class="advantages__pic">
                <img src="{{asset('uploads/advantages-footer.png')}}" alt="Владелец компании oneteam">
            </div>
            <div class="advantages__text">
                <p class="advantages__lead">
                    Покупка недвижимости в Турции — одно из наиболее стабильных направлений для инвестирования: качественные объекты с высокой доходностью здесь можно получить за сравнительно меньшие деньги, нежели в других странах. Также недвижимость в Турции привлекает возможностью оформления гражданства по упрощенной схеме, освобождением от оплаты НДС и получением других льгот.
                </p>
                <p class="desc desc_red">
                    <b>Выбирая Oneteam,</b> вы приобретаете надежного партнера, который разбирается в своеобразном характере турецкого рынка недвижимости, где многое зависит от личных связей, и знает, как обойти «подводные камни» законодательства и защитить вас от мошеннических схем.
                </p>
            </div>
        </div>
    </section>
    <?php echo $citizenship_div->div ?>
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
                    <div class="contact__form-phone-country close-out">
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

                    <div class="contact__phone-dropdown close-out">
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
                    <div class="contact__form-phone-country close-out">
                        <div class="contact__form-country-item">
                            <div class="contact__form-country-item-img">
                                <img src="{{asset('project/img/countries/ru.png')}}" alt="ru">
                            </div>
                        </div>
                    </div>
                    <div class="contact__phone-dropdown close-out">
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

@extends('project.includes.layouts')
<script src="https://api-maps.yandex.ru/2.1/?lang={{ app()->getLocale() }}_RU&amp;apikey=2a0f0e9d-44f3-4f13-8628-12588d752fc3" type="text/javascript"></script>

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

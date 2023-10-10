<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic,700italic&amp;subset=latin,latin-ext">
    <link rel="stylesheet" type="text/css" href="{{asset('project/css/swiper-bundle.min.css')}} ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('project/files/fonts/stylesheet.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('project/css/style.css')}}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>One-team</title>
    <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
    <!-- <script src="https://api-maps.yandex.ru/2.1/?lang={{ app()->getLocale() }}_RU&amp;apikey=2a0f0e9d-44f3-4f13-8628-12588d752fc3" type="text/javascript"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(94888113, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/94888113" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HELZSG76GD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-HELZSG76GD');
    </script>

</head>
<body>
<div class="wrapper">

    @yield('header')

    @yield('content')

    @yield('footer')

    <div class="popup popup-modal" style="z-index: 2005!important;" bis_skin_checked="1">
        <div class="popup__body" bis_skin_checked="1">
            <form class="popup__content" id="city_form">
                <!-- <div class="popup__subtitle" bis_skin_checked="1">
                    ФИО
                </div> -->
                <label class="field name input-wrapper" bis_skin_checked="1">
                    <span class="text">
                        ФИО
                    </span>
                    <input type="text" value="" placeholder="Иванов Алексей Петрович" name="fio">
                </label>
                <!-- <div class="popup__subtitle" bis_skin_checked="1">
                    Номер телефона
                </div> -->
                <div class="field field-phone selection-phone input-wrapper" bis_skin_checked="1">
                    <div class="contact__form-phone-country close-out" bis_skin_checked="1">
                        <div class="contact__form-country-item" bis_skin_checked="1">
                            <div class="contact__form-country-item-img" bis_skin_checked="1">
                                <img src="https://dev.one-team.pro/project/img/countries/ru.png" alt="ru">
                            </div>
                        </div>
                    </div>
                    <div class="contact__phone-dropdown close-out" bis_skin_checked="1">
                        <div class="contact__phone-list" bis_skin_checked="1">
                            <div class="contact__phone-list-item" mask="+7 (___) ___-__-__" bis_skin_checked="1">
                                <div class="contact__phone-img" bis_skin_checked="1">
                                    <img src="https://dev.one-team.pro/project/img/countries/ru.png" alt="ru">
                                </div>
                                <div class="contact__phone-title" bis_skin_checked="1">
                                    Россия (Russia) <span>+7</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+1 (___) ___-__-__" bis_skin_checked="1">
                                <div class="contact__phone-img" bis_skin_checked="1">
                                    <img src="https://dev.one-team.pro/project/img/countries/us.png" alt="us">
                                </div>
                                <div class="contact__phone-title" bis_skin_checked="1">
                                    США (United States)  <span>+1</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+49 (___) ____-____" bis_skin_checked="1">
                                <div class="contact__phone-img" bis_skin_checked="1">
                                    <img src="https://dev.one-team.pro/project/img/countries/gr.png" alt="gr">
                                </div>
                                <div class="contact__phone-title" bis_skin_checked="1">
                                    Германия (Germany) <span>+49</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+48 (___) ___-___" bis_skin_checked="1">
                                <div class="contact__phone-img" bis_skin_checked="1">
                                    <img src="https://dev.one-team.pro/project/img/countries/pl.png" alt="pl">
                                </div>
                                <div class="contact__phone-title" bis_skin_checked="1">
                                    Польша (Poland) <span>+48</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+46 (___) ___-____" bis_skin_checked="1">
                                <div class="contact__phone-img" bis_skin_checked="1">
                                    <img src="https://dev.one-team.pro/project/img/countries/sw.png" alt="sw">
                                </div>
                                <div class="contact__phone-title" bis_skin_checked="1">
                                    Швеция (Sweden) <span>+46</span>
                                </div>
                            </div>
                            <div class="contact__phone-list-item" mask="+39 (___) ___-____" bis_skin_checked="1">
                                <div class="contact__phone-img" bis_skin_checked="1">
                                    <img src="https://dev.one-team.pro/project/img/countries/it.png" alt="it">
                                </div>
                                <div class="contact__phone-title" bis_skin_checked="1">
                                    Италия (Italy) <span>+39</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="text">
                        Номер телефона
                    </span>
                    <input data-phone-pattern="+7 (___) ___-__-__" class="contact__phone-input" type="text" value="" placeholder="" name="phone">
                </div>
                <button type="submit" class="btn">
                    Перезвонить мне
                </button>
                <div class="popup-close" bis_skin_checked="1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><script xmlns=""></script>
                        <path d="M1 1L13 13" stroke="white" stroke-width="1.5" stroke-linecap="round"></path>
                        <path d="M13 1L1 13" stroke="white" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                </div>
                <input type="hidden" name="product_id" value="">
                <input type="hidden" name="country" value="">
                <!--а-->
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="{{asset('project/js/app.js')}} "></script>
@yield('scripts')
<script>
    $('.place__currency-item').bind('click', function () {
        $('.place__price-value div').css('display', 'none');
        $('.place__exchange-'+$(this).data('exchange')).css('display', 'block');
        $('.place__square div').css('display', 'none');
        $('.place__square-'+$(this).data('exchange')).css('display', 'block');
        $('.place__currency').removeClass('open');
        const popupBlock = this.closest('.place-popup')
        const exchange = this.getAttribute('data-exchange')
        popupBlock.setAttribute('data-exchange', exchange)
        if(popupBlock.querySelectorAll('.valute').length) {
            const kompleksBlockPrice = popupBlock.querySelectorAll('.kompleks__layout-price')

            const kompleksBlockMeterPrice = popupBlock.querySelectorAll('.kompleks__layout-price-meter')

            const kompleksBlockPriceSquare = popupBlock.querySelectorAll('.place__square')

            const kompleksBlockPriceSquarePrice = popupBlock.querySelector('.place__price_country')
            if(kompleksBlockPriceSquarePrice) {
                const price = kompleksBlockPriceSquarePrice.querySelector('.place__price-value')
                const valute = price.getAttribute(`data-price-${exchange}`)
                price.innerHTML = valute
            }

            const placeSquareCountry = popupBlock.querySelector('.place__square_country')
            if(placeSquareCountry) {
                const valute = placeSquareCountry.getAttribute(`data-price-${exchange}`)
                placeSquareCountry.innerHTML = valute
            }

            if(kompleksBlockPrice !== null)
            kompleksBlockPrice.forEach(block => {
                changeExchange(block, exchange)
            });

            if(kompleksBlockMeterPrice !== null)
            kompleksBlockMeterPrice.forEach(block => {
                changeExchange(block, exchange)
            });

            if(kompleksBlockPriceSquare !== null)
            kompleksBlockPriceSquare.forEach(block => {
                changeExchange(block, exchange)
            });



        }
    });

    $(".place__currency-preview").bind('click', function () {
        console.log($(".place__currency"))
        $(".place__currency").toggleClass("open");
    });



    $('.place__buy-btn, .place__order-btn, .place__btns-item, .citizenship-investments__footer-button').click(function () {
        $('.popup-modal').addClass('active');
        $("input[name='product_id']").val($(this).attr('data_id'));
    });
    $('.contact__phone-title').click(function () {
        $("input[name='contact__phone']").val($(this).html())
    });

    $('.popup-close').click(function () {
        $('.popup-modal').removeClass('active');
        $("input[name='phone']").val(' ')
        $("input[name='fio']").val(' ')
        $("input[name='contact__phone']").val('Россия (Russia)')
    });


    $('#city_form').submit(function () {
        event.preventDefault()
        let name =  $("input[name='fio']").val();
        let phone =   $("input[name='phone']").val()
        let phoneInput =   $("input[name='phone']")
        let name_valid = false;
        if (name.length == 0){
            $('.name').closest('.input-wrapper').addClass('border');
        }else{
            name_valid = true;
        }

        let phone_valid = false

        const lengthPhone = phoneInput.data('phone-pattern').length;
        if(lengthPhone !== phone.length) {
        console.log(lengthPhone)
            $('.field-phone').closest('.input-wrapper').addClass('border');
        }
        else {
            phone_valid = true;
        }
        if (phone_valid == true && name_valid == true){
            let formData = new FormData();
            formData.append('phone', phone);
            formData.append('name', name);
            formData.append('product_id', $("input[name='product_id']").val());
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
                success: function(response) {
                    $(".popup-close").click();
                    // Handle the response from the server
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2500,

                    })
                    $("input[name='phone']").val(' ')
                    $("input[name='name']").val(' ')

                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    })

function changeExchange (blockPrice, currentExchange) {
    const prices = blockPrice.querySelectorAll('[data-exchange]')
    console.log(prices)
    prices.forEach(element => {
        element.classList.remove('active')
        element.style.display = ('none')
    });
    const currentPrice = blockPrice.querySelector(`[data-exchange="${currentExchange}"]`);
    currentPrice.classList.add('active')
    currentPrice.style.display = ('block')
}
</script>
<script>
//анимация инпутов
const inputWrappers = document.querySelectorAll('.input-wrapper');

function toggleInput(input) {
    const parentWrapper = input.parentElement.closest('.input-wrapper');
    if (input === document.activeElement || parentWrapper.classList.contains('active')) {
        parentWrapper.classList.add('active');
    } else if (input.value !== '') {
        parentWrapper.classList.remove('active');
    }
}

inputWrappers.forEach(function(wrapper) {
    const input = wrapper.querySelector('input');
    toggleInput(input);
    input.addEventListener('input', function() {
        toggleInput(input);
    });
});

inputWrappers.forEach(function(wrapper) {
    const input = wrapper.querySelector('input');
    input.addEventListener('focus', function() {
        inputWrappers.forEach(function(label) {
            const labelInput = label.querySelector('input');
            if (!labelInput.value) {
                label.classList.remove('active');
                label.classList.remove('confirm');
            }
        });
        wrapper.classList.add('active');
    });
});

inputWrappers.forEach(function(wrapper) {
    const input = wrapper.querySelector('input');
    input.addEventListener('click', function() {
        wrapper.classList.add('active');
    });
});

inputWrappers.forEach(function(wrapper) {
    const input = wrapper.querySelector('input');
    input.addEventListener('blur', function() {
        if(input.value) {
            if(input.getAttribute('name') === 'phone') {
                const lengthPhone = input.getAttribute('data-phone-pattern').length
                if(lengthPhone !== input.value.length) {
                    wrapper.classList.remove('confirm');
                    return
                }
            }
            wrapper.classList.add('confirm');
        } else {
            wrapper.classList.add('border');
        }
    });
});

document.addEventListener('click', function(event) {
    if (!event.target.closest('.input-wrapper')) {
        inputWrappers.forEach(function(wrapper) {
            const input = wrapper.querySelector('input');
            if (!input.value) {
                wrapper.classList.remove('active');
            }
        });
    }
});

</script>
<script>
//добавление удаление из избранного
<?php $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : time();  ?>
let user_id = "<?php echo $user_id;  ?>";
function setListenersToAddfavorites() {
    $('.check-favorites').off('click').click(function (e) {
        e.stopPropagation();
        let data_id = $(this).attr('data_id');
        let site_url = `{{ config('app.url') }}`;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        let thiss =  $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:  '/add_or_delete_in_favorite',
            type: 'POST',
            data: {
                user_id: user_id,
                product_id: data_id
            },
            beforeSend: function (data){
                console.log(data);
            },
            success: function(response) {
                if(response.message == 'created'){
                    $('.check-favorites[data_id="' + data_id + '"]').addClass('active');
                    favotires_house_id[data_id] = true
                    if (response.counts == 0) {
                        $('.header__top-favorites-value').css('display', 'none');
                    } else {
                        $('.header__top-favorites-value').html(response.counts);
                        $('.header__top-favorites-value').css('display', 'flex');
                    }
                }else {
                    if (response.counts == 0) {
                        $('.header__top-favorites-value').css('display', 'none');
                    } else {
                        $('.header__top-favorites-value').html(response.counts);
                        $('.header__top-favorites-value').css('display', 'flex');
                    }
                    $('.check-favorites[data_id="'+ data_id + '"]').removeClass('active');
                    delete favotires_house_id[data_id]

                }
            },
        });
    });
}
setListenersToAddfavorites()
</script>
</body>
</html>



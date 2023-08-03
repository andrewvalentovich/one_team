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
    <link rel="stylesheet" type="text/css" href="{{asset('project/css/swiper-bundle.min.css')}} ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('project/files/fonts/stylesheet.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('project/css/style.css')}}">
    <title>One-team</title>
    <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=2a0f0e9d-44f3-4f13-8628-12588d752fc3" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<div class="wrapper">

    @yield('header')

    @yield('content')

    @yield('footer')

    <div class="popup popup-modal" style="z-index: 2005!important;" bis_skin_checked="1">
        <div class="popup__body" bis_skin_checked="1">
            <form class="popup__content" id="city_form">
                <div class="popup__subtitle" bis_skin_checked="1">
                    ФИО
                </div>
                <div class="field name" bis_skin_checked="1">
                    <input type="text" value="" placeholder="" name="fio">
                </div>
                <div class="popup__subtitle" bis_skin_checked="1">
                    Номер телефона
                </div>
                <div class="field field-phone selection-phone" bis_skin_checked="1">
                    <div class="contact__form-phone-country " bis_skin_checked="1">
                        <div class="contact__form-country-item" bis_skin_checked="1">
                            <div class="contact__form-country-item-img" bis_skin_checked="1">
                                <img src="https://dev.one-team.pro/project/img/countries/ru.png" alt="ru">
                            </div>
                        </div>
                    </div>
                    <div class="contact__phone-dropdown " bis_skin_checked="1">
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
                    <input data-phone-pattern="" class="contact__phone-input" type="text" value="" placeholder="" name="phone">
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

{{--<script src="{{asset('project/js/app.min.js')}} "></script>--}}
<script src="{{asset('project/js/app.js')}} "></script>
@yield('scripts')
<script>
    $('.place__currency-item').bind('click', function () {
        $('.place__price-value div').css('display', 'none');
        $('.place__exchange-'+$(this).data('exchange')).css('display', 'block');
        $('.place__square div').css('display', 'none');
        $('.place__square-'+$(this).data('exchange')).css('display', 'block');
        $('.place__currency').removeClass('active');
    });

    $(".place__currency-preview").bind('click', function () {
        $(".place__currency").toggleClass("active");
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
        let name_valid = false;
        if (name.length == 0){
            $('.name').css('border' , '2px solid red')
        }else{
            name_valid = true;
        }

        let phone_valid = false
        if(phone.length == 0){
            $('.field-phone').css('border' , '2px solid red');
        }else {
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

</script>
</body>
</html>

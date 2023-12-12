<div class="popup popup-modal popup-questions" style="z-index: 2005!important;" bis_skin_checked="1">
    <div class="popup__body" bis_skin_checked="1">
        <div class="popup__content default-form" id="city_form">
            <div class="popup-close" bis_skin_checked="1">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none"><script xmlns=""></script>
                    <path d="M1 1L13 13" stroke="white" stroke-width="1.5" stroke-linecap="round"></path>
                    <path d="M13 1L1 13" stroke="white" stroke-width="1.5" stroke-linecap="round"></path>
                </svg>
            </div>
            <div class="questions-w">
                <section class="questions">
                    <div class="questions__content">
                        <div class="questions__pic">
                            <img src="http://localhost:8879/project/img/questions-index.webp" alt="">
                        </div>
                        <div class="questions__form-w">
                            <div class="questions__form">
                                <p class="questions__title">
                                    Остались вопросы?
                                </p>
                                <p class="questions__subtitle">
                                    Оставьте заявку и мы Вам перезвоним
                                </p>
                                <label class="field name input-wrapper" bis_skin_checked="1">
                                    <span class="text">
                                        {{__('ФИО')}}
                                    </span>
                                    <input type="text" value="" placeholder="Иванов Алексей Петрович" name="fio">
                                </label>
                                <div class="contact__form-phone input-wrapper">
                                    <span class="text">
                                        {{__('Номер телефона')}}
                                    </span>
                                    <input class="selector-list-phone" id="phone" name="phone">
                                </div>
                                <label class="contact__form-politic">
                                    <input class="contact__form-politic-checkbox contact__form-checkbox " type="checkbox" id="contact__form-politic" checked="">
                                    <div class="contact__form-custom-checkbox one_check"></div>
                                    <div class="contact__form-checkbox-text">
                                        {{__('Ознакомлен с')}} <span>{{__('политикой конфеденциальности')}}</span>
                                    </div>
                                </label>
                                <label class="contact__form-data">
                                    <input class="contact__form-data-checkbox contact__form-checkbox" type="checkbox" id="contact__form-data">
                                    <div class="contact__form-custom-checkbox two_check"></div>
                                    <div class="contact__form-checkbox-text">
                                        {{__('Согласен на обработку')}} <span>{{__('персональных данных')}}</span>
                                    </div>
                                </label>
                                <button type="submit" class="btn">
                                    {{ __('Отправить заявку') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
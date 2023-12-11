<div class="questions-w">
    <section class="questions">
        <div class="questions__content">
            <div class="questions__pic">
                <img src="{{asset('project/img/questions-index.jpg')}}" alt="">
            </div>
            <div class="questions__form-w">
                <form class="questions__form form-fio-phone" bis_skin_checked="1">
                    <p class="questions__title">
                        Остались вопросы?
                    </p>
                    <p class="questions__subtitle">
                        Оставьте заявку и мы Вам перезвоним
                    </p>
                    <label class="field name input-wrapper" bis_skin_checked="1">
                            <span class="text">
                                ФИО
                            </span>
                        <input type="text" value="" placeholder="Иванов Алексей Петрович" name="fio">
                    </label>
                    <div class="contact__form-phone input-wrapper">
                            <span class="text">
                                {{__('Номер телефона')}}
                            </span>
                        <input class="selector-list-phone" id="phone" name="phone">
                        <input
                            type="hidden"
                            value="{{ !is_null(Session::get('utm_source')) ? Session::get('utm_source') : null }}"
                            id="utm_source"
                            name="utm_source"
                        >
                        <input
                            type="hidden"
                            value="{{ !is_null(Session::get('utm_medium')) ? Session::get('utm_medium') : null }}"
                            id="utm_medium"
                            name="utm_medium"
                        >
                        <input
                            type="hidden"
                            value="{{ !is_null(Session::get('utm_campaign')) ? Session::get('utm_campaign') : null }}"
                            id="utm_campaign"
                            name="utm_campaign"
                        >
                        <input
                            type="hidden"
                            value="{{ !is_null(Session::get('utm_term')) ? Session::get('utm_term') : null }}"
                            id="utm_term"
                            name="utm_term"
                        >
                        <input
                            type="hidden"
                            value="{{ !is_null(Session::get('utm_content')) ? Session::get('utm_content') : null }}"
                            id="utm_content"
                            name="utm_content"
                        >
                        <input
                            type="hidden"
                            value="{{ request()->url() }}"
                            id="referer"
                            name="referer"
                        >
                        <input
                            type="hidden"
                            value="{{ isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null }}"
                            id="ip"
                            name="ip"
                        >
                    </div>
                    <label class="contact__form-politic">
                        <input class="contact__form-politic-checkbox contact__form-checkbox " type="checkbox" id="contact__form-politic" checked="">
                        <div class="contact__form-custom-checkbox one_check"></div>
                        <div class="contact__form-checkbox-text">
                            Ознакомлен с <span>политикой конфеденциальности</span>
                        </div>
                    </label>
                    <label class="contact__form-data">
                        <input class="contact__form-data-checkbox contact__form-checkbox" type="checkbox" id="contact__form-data">
                        <div class="contact__form-custom-checkbox two_check"></div>
                        <div class="contact__form-checkbox-text">
                            Согласен на обработку <span>персональных данных</span>
                        </div>
                    </label>
                    <button type="submit" class="btn btn_blue">
                        Отправить заявку
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>

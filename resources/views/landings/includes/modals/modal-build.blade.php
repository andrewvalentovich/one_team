<!-- НОВОСТРОЙКИ В модалка -->
<form class="popup popup-building form request__form">
    <div class="popup__body">
        <div class="popup__content">
			<div class="popup__building-info">

			</div>
            <div class="preview__form">
                <div class="preview__form-title">
                    Оставить заявку эксперту
                </div>
				<label class="field input-wrapper" >
					<span class="text">
					Имя
					</span>
					<input type="text" name="name" value="" placeholder="Иванов Алексей Петрович">
				</label>
				<label class="field input-wrapper">
					<span class="text">
					Номер телефона
					</span>
					<input type="number" name="phone" value="" placeholder="+7" >
				</label>
                <input type="hidden" name="landing_id" value="{{ $landing->id }}">
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

  function initPhoneContainer() {
    //создаем контйнер со списком стран и инпутом
    const phoneInputs = document.querySelectorAll('.validation-phone');

    phoneInputs.forEach(function(phoneInput) {
      const container = document.querySelector('.phone-input-container.toClone')
      const cloneContainer = container.cloneNode(true);
      cloneContainer.classList.remove('toClone')
      phoneInput.replaceWith(cloneContainer);

      cloneContainer.addEventListener('click', function(e) {
        const target = e.target

        //если выбрана страна
        if(target.classList.contains('.country-code__item') || target.closest('.country-code__item')) {
          const countryItem = target.closest('.country-code__item')
          const phoneInputContainer = countryItem.closest('.phone-input-container')
          const currentBlock = phoneInputContainer.querySelector('.country-code__current')
          const currentBlockFlag = currentBlock.querySelector('.iti__flag')
          const phoneInput = phoneInputContainer.querySelector('input')


          phoneInputContainer.classList.remove('active')
          currentBlockFlag.classList = []
          currentBlockFlag.classList.add('iti__flag', `iti__${countryItem.getAttribute('country-name')}`)
          currentBlockFlag.setAttribute('phone-mask', countryItem.getAttribute('mask'))
          phoneInput.setAttribute('data-phone-pattern', countryItem.getAttribute('mask'))
          phoneInput.value = ''
          
        }
        //если клик по currentCountry
        if(target.classList.contains('.country-code__current') || target.closest('.country-code__current')) {
          cloneContainer.classList.toggle('active')
        }

      })

    });

  }

  function createContainerPhoneInput() {
      // Создаем новый блок-контейнер
      const container = document.createElement('div');
      container.className = 'phone-input-container';
      container.classList.add('close-out')

      // Создаем выпадающий блок со списоком стран
      const countryCodeSelect = document.createElement('div');
      countryCodeSelect.className = 'country-code';

      //создаем текущий выбранный код страны
      const countryCodeCurrent = document.createElement('div');
      countryCodeCurrent.className = 'country-code__current';
      countryCodeSelect.appendChild(countryCodeCurrent);
      
      //создаем код страны для текущего кода
      const countryCurrentFlag = document.createElement('div');
      countryCurrentFlag.classList.add('iti__flag', 'iti__ru');
      countryCurrentFlag.setAttribute('phone-mask','+7 (___) ___-__-__')

      countryCodeCurrent.appendChild(countryCurrentFlag)

      //создаем стрелочку
      const countryCurrentArrow = document.createElement('div');
      countryCurrentArrow.classList.add('iti__arrow');

      countryCodeCurrent.appendChild(countryCurrentArrow)

      //создаем список стран
      const countryCodeListW = document.createElement('div');
      countryCodeListW.className = 'country-code__list-w';
      const countryCodeList = document.createElement('div');
      countryCodeList.className = 'country-code__list';
      countryCodeListW.appendChild(countryCodeList);
      countryCodeSelect.appendChild(countryCodeListW);

      //создаем избранные номера
      const favoriteNumbers = ['ru','tr']

      const favotiveNumbersDiv = document.createElement('div');
      favotiveNumbersDiv.className = 'country-code__favorite'
      countryCodeList.appendChild(favotiveNumbersDiv);


      // Добавляем опции в выпадающий список на основе allCountries
      allCountries.forEach(country => {
        const option = document.createElement('div');
        option.classList.add('country-code__item')
        option.setAttribute('code',country.dialCode)
        option.setAttribute('country-name',country.iso2)
        option.setAttribute('mask',country.mask)
        option.innerHTML = `${country.name} (+${country.dialCode})`;


        const flag = document.createElement('div')
        flag.classList.add(`iti__flag`,`iti__${country.iso2}`)

        option.appendChild(flag);
        //добавляем в избранное если страна в избранном
        if(favoriteNumbers.includes(country.iso2)) {
          favotiveNumbersDiv.appendChild(option)
          return
        }
        countryCodeList.appendChild(option);
      });

      // Создаем инпут для номера телефона
      const phoneInputField = document.createElement('input');
      phoneInputField.type = 'text';
      phoneInputField.setAttribute('data-phone-pattern','+7 (___) ___-__-__')
      phoneInputField.setAttribute('country-name','RU')

      // Добавляем выпадающий список и инпут в контейнер
      container.appendChild(countryCodeSelect);
      container.appendChild(phoneInputField);
      container.classList.add('toClone')
      document.querySelector('body').appendChild(container)
    
  }

  //добавляем маску
  function createPhoneMask() {
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
      for (let ev of ['input', '', 'focus']) {
          elem.addEventListener(ev, eventCalllback);
      }
    }

  }

  //проверка телефона по кнопке submit в форме
  function testForm() {

    const formsValidation = document.querySelectorAll('.form')

    formsValidation.forEach(form => {
      form.addEventListener('submit', function(e) {
        
        e.preventDefault()
        const container = form.querySelector('.phone-input-container');
        const phoneInput = container.querySelector('input'); // Найти инпут внутри контейнера
        let phoneNumber = phoneInput.value
        const phoneCountryCode = phoneInput.getAttribute('country-name')
  
        phoneNumber = phoneNumber.replace(/\D/g, '');

        if(phoneNumber.length <= 2) phoneNumber = '11'
        let number = libphonenumber.parsePhoneNumber(phoneNumber, phoneCountryCode)

        if(!number.isValid()) {
          container.classList.add('error')
        } else {
          container.classList.remove('error')
        }
      })
    });
    
  }
  
  createContainerPhoneInput()
  initPhoneContainer()
  createPhoneMask()
  testForm()








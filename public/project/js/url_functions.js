function addUrlParameter(new_param, urlParams) {
    if (new_param !== "") {
        urlParams.push(new_param);
    }
    return urlParams;
}

function deleteUrlParameter(preview_param, urlParams) {
    var included_value = urlParams.includes(preview_param);
    // Если предыдущее значение найдено
    if (included_value) {
        // И если новое значение существует, удаляем старое и добавляем новое
        urlParams.forEach(function (v, i) {
            if (v === preview_param) {
                urlParams.splice(i, 1);
            }
        });
    }

    return urlParams;
}

function handleUrlParams(prev_value, new_value) {
    var urlParams = getValuesFromUrl();

    urlParams = deleteUrlParameter(prev_value, urlParams);
    urlParams = addUrlParameter(new_value, urlParams);

    return urlParams;
}

function handleUrlNumParams(new_value, separator = '-') {
    var urlParams = getValuesFromUrl();

    var num_value_arr = new_value.split(separator);

    // Если нет числа
    if (isNaN(parseInt(num_value_arr[1]))) {
        var prev_value = checkPosition(urlParams, num_value_arr[0]);
        urlParams = deleteUrlParameter(prev_value, urlParams);
    } else {
        var prev_value = checkPosition(urlParams, num_value_arr[0]);

        urlParams = deleteUrlParameter(prev_value, urlParams);
        urlParams = addUrlParameter(new_value, urlParams);
    }

    return urlParams;
}

function findObjectParams(data) {
    var urlValues = getValuesFromUrl();

    var params = {
        price: {}
    };

    var country = getMatchSlug(urlValues, data.countries);
    if (country) {
        params.country = country;
    }

    var city = getMatchSlug(urlValues, data.cities);
    if (city) {
        params.city = city;
    }

    var min_price = checkPosition(urlValues, "minprice");
    if (min_price) {
        params.price.min = min_price;
    }

    var max_price = checkPosition(urlValues, "maxprice");
    if (max_price) {
        params.price.max = max_price;
    }

    var currency = getMatchCurrency(urlValues, data.currency);
    if (currency) {
        params.price.currency = currency;
    }

    var object = checkPosition(urlValues, "object-");
    if (object) {
        var tmpArr = object.split('-');
        params.id = parseInt(tmpArr[1]);
    }

    return params;
}

function replaceUrlWithObject(data, object) {
    var urlValues = getValuesFromUrl();
    var url = "";

    var locale = getMatchCode(urlValues, data.locales);
    if (locale) {
        url += "/"+locale;
    }

    var locations = checkPosition(urlValues, "locations");
    if (locations) {
        url += "/" + locations;
    }

    var country = getMatchSlug(urlValues, data.countries);
    if (country) {
        url += "/"+country;
    }

    if (object) {
        url += "/"+object;
    }

    window.history.pushState(null, null, url);
}

function checkObjectParamsInUrl() {
    var urlValues = getValuesFromUrl();

    return checkPosition(urlValues, "object-");
}

function updateUrl(data, urlValues, page_with_filter = true) {
    // Шаблон - /country/buy/city/type/2bedroom/price/size/peculiarities/to_sea/ и пр.
    var url = "";

    var locale = getMatchCode(urlValues, data.locales);

    if (urlValues.length == 1 && locale) {
        url += "/" + locale;

        if (page_with_filter) {
            url += "/all";
        }
        window.history.pushState(null, null, url);
    } else {
        if (locale) {
            url += "/" + locale;
        }

        var locations = checkPosition(urlValues, "locations");
        if (locations) {
            url += "/" + locations;
        }

        var commercial = checkPosition(urlValues, "commercial");
        if (commercial) {
            url += "/" + commercial;
        }

        var country = getMatchSlug(urlValues, data.countries);
        if (country) {
            url += "/" + country;
        }

        var object = checkPosition(urlValues, "object-");
        if (object) {
            url += "/" + object;
        }

        var buy = false;
        urlValues.forEach(function (value, index) {
            if (value === "buy") {
                buy = value;
            }
            if (value === "sale") {
                buy = value;
            }
            if (value === "rent") {
                buy = value;
            }
        })
        if (buy) {
            url += (buy == "sale") ? "/buy" : "/" + buy;
        }

        var city = getMatchSlug(urlValues, data.cities);
        if (city) {
            url += "/" + city;
        }

        var type = getMatch(urlValues, data.types);
        if (type) {
            url += "/" + type;
        }

        var bedroom = getMatch(urlValues, data.bedrooms, "bedroom");
        if (bedroom) {
            url += "/" + bedroom;
        }

        var bathroom = getMatch(urlValues, data.bathrooms, "bathroom");
        if (bathroom) {
            url += "/" + bathroom;
        }

        var peculiarities = getMatches(urlValues, data.peculiarities);
        if (peculiarities.length > 0) {
            for (var i = 0; i < peculiarities.length; i++) {
                url += "/" + peculiarities[i];
            }
        }

        var view = getMatch(urlValues, data.views);
        if (view) {
            url += "/" + view;
        }

        var to_sea = getMatch(urlValues, data.to_sea);
        if (to_sea) {
            url += "/" + to_sea;
        }

        var min_price = checkPosition(urlValues, "minprice");
        if (min_price) {
            url += "/" + min_price;
        }

        var max_price = checkPosition(urlValues, "maxprice");
        if (max_price) {
            url += "/" + max_price;
        }

        var currency = getMatchCurrency(urlValues, data.currency);
        if (currency) {
            url += "/" + currency;
        }

        var min_size = checkPosition(urlValues, "minsize");
        if (min_size) {
            url += "/" + min_size;
        }

        var max_size = checkPosition(urlValues, "maxsize");
        if (max_size) {
            url += "/" + max_size;
        }

        if (urlValues.includes("new")) {
            url += "/new";
        }
        if (urlValues.includes("secondary")) {
            url += "/secondary";
        }

        if (urlValues.includes("new-first")) {
            url += "/new-first";
        }
        if (urlValues.includes("cheap-first")) {
            url += "/cheap-first";
        }
        if (urlValues.includes("expensive-first")) {
            url += "/expensive-first";
        }
    }

    window.history.pushState(null, null, url);
}

function convertToCategoryValue(data) {
    var categories = [];

    $.each(data.countries, function (index, value) {
        categories.push({category: "country", value: value.slug});
    });

    categories.push({category: "sale_or_rent", value: "sale"});
    categories.push({category: "sale_or_rent", value: "rent"});

    $.each(data.cities, function (index, value) {
        categories.push({category: "city", value: value.slug});
    });
    $.each(data.types, function (index, value) {
        categories.push({category: "type", value: value.slug});
    });
    $.each(data.bedrooms, function (index, value) {
        categories.push({category: "bedrooms", value: value.slug});
    });
    $.each(data.bathrooms, function (index, value) {
        categories.push({category: "bathrooms", value: value.slug});
    });
    $.each(data.peculiarities, function (index, value) {
        categories.push({category: "peculiarities", value: value.slug});
    });
    $.each(data.to_sea, function (index, value) {
        categories.push({category: "to_sea", value: value.slug});
    });
    $.each(data.views, function (index, value) {
        categories.push({category: "view", value: value.slug});
    });
    $.each(data.locales, function (index, value) {
        categories.push({category: "locales", value: value.code});
    });


    return categories;
}

function getMatchCode(first, second) {
    var match = false;
    for (var i = 0; i < first.length; i++) { //проходимся по первому масиву
        for (var j = 0; j < second.length; j++) { // ищем соотвествия во втором массиве
            // alert(first[i].toLowerCase() + " - " + second[j].name_en.toLowerCase());
            if(first[i] === second[j].code) {
                match = first[i]; // если совпадаем делаем что либо с этим значением
            }
        }
    }

    return match;
}

function getMatch(first, second) {
    var match = false;
    for (var i = 0; i < first.length; i++) { //проходимся по первому масиву
        for (var j = 0; j < second.length; j++) { // ищем соотвествия во втором массиве
            // alert(first[i].toLowerCase() + " - " + second[j].name_en.toLowerCase());
            if(first[i] === second[j].slug) {
                match = first[i]; // если совпадаем делаем что либо с этим значением
            }
        }
    }

    return match;
}

function getMatchSlug(first, second) {
    var match = false;

    for (var i = 0; i < first.length; i++) { //проходимся по первому масиву
        for (var j = 0; j < second.length; j++) { // ищем соотвествия во втором массиве
            // alert(first[i].toLowerCase() + " - " + second[j].name_en.toLowerCase());
            if(first[i] === second[j].slug){
                match = first[i]; // если совпадаем делаем что либо с этим значением
            }
        }
    }

    return match;
}

function getMatchCurrency(first, second) {
    var match = false;

    for (var i = 0; i < first.length; i++) { //проходимся по первому масиву
        for (var j = 0; j < second.length; j++) { // ищем соотвествия во втором массиве
            // alert(first[i].toLowerCase() + " - " + currency[j].name_en.toLowerCase());
            if(first[i] === second[j].currency.toLowerCase()){
                match = first[i]; // если совпадаем делаем что либо с этим значением
            }
        }
    }

    return match;
}

function getMatches(first, second) {
    var matches = [];

    for (var i = 0; i < first.length; i++) { //проходимся по первому масиву
        for (var j = 0; j < second.length; j++) { // ищем соотвествия во втором массиве
            // alert(first[i].toLowerCase() + " - " + second[j].name_en.toLowerCase());
            if(first[i] === second[j].slug){
                matches.push(first[i]); // если совпадаем делаем что либо с этим значением
            }
        }
    }

    return matches;
}

function checkPosition(first, second) {
    var match = false;

    for (var i = 0; i < first.length; i++) { //проходимся по масиву
        if (typeof first[i] === "string"){
            if (first[i].indexOf(second) !== -1) {
                match = first[i]; // если совпадаем делаем что либо с этим значением
            }
        }
    }

    return match;
}

// Получаем значения из url ввиде массива
function getValuesFromUrl() {
    var location_host = window.location.host;
    var location_href = window.location.href;

    var link = location_href.slice(location_href.indexOf(location_host) + location_host.length, location_href.length);
    var split = link.split('/');
    return split.filter(element => element != '');
}

function handleCurrency(data) {
    // Выводим валюту в dropdown
    $('.search-nav__price-filter-currency').html("");
    $.each(data.currency, function (index, value) {
        if (getValuesFromUrl().includes(value.currency.toLowerCase())) {
            $("input[name='currency']").val(value.currency.toLowerCase());
        }
        $('.search-nav__price-filter-currency').append('<div class="search-nav__price-currency-item ' + (getValuesFromUrl().includes(value.currency.toLowerCase()) ? 'active' : '') + ' currency_type '+ (value.currency == "TRY" ? 'lira' : '') +'" currency_type="' + value.currency + '">' + value.symbol + '</div>');
    });

    var currency =  $("input[name='currency']").val();
    if (currency === "") {
        $('.search-nav__price-currency-item[currency_type="EUR"]').addClass("active");
    }

    // Вешаем событие на добавленные элементы в dropdown
    $(".search-nav__price-currency-item").each(function (index) {
        $(this).on("click", function () {
            var new_currency = $(this).attr('currency_type');

            $(".search-nav__price-currency-item").removeClass("active");
            $(this).addClass("active");

            var prev_currency = $("input[name='currency']").val();
            $("input[name='currency']").val(new_currency.toLowerCase());

            var urlParams = handleUrlParams(prev_currency.toLowerCase(), new_currency.toLowerCase());
            updateUrl(data, urlParams);
        });
    });
}

function handleMinPrice(data) {
    var min_price = checkPosition(getValuesFromUrl(), "minprice");

    // Подстановка минимальной цены в input
    if (min_price !== false) {
        var min_price_arr = min_price.split('-');
        $('input[name="price[min]"]').val(min_price !== false ? min_price_arr[1] : "");
    }

    // При изменении минимальной цены
    $('input[name="price[min]"]').on('change input', function () {
        var min_price = $(this).val();

        var urlParams = handleUrlNumParams("minprice-"+min_price);
        updateUrl(data, urlParams);
    })
}

function handleMaxPrice(data) {
    // Подстановка максимальной цены в input
    var max_price = checkPosition(getValuesFromUrl(), "maxprice");

    if (max_price !== false) {
        var max_price_arr = max_price.split('-');
        $('input[name="price[max]"]').val(max_price !== false ? max_price_arr[1] : "");
    }

    // При изменении максимальной цены
    $('input[name="price[max]"]').on('change input', function () {
        var max_price = $(this).val();

        var urlParams = handleUrlNumParams("maxprice-"+max_price);
        updateUrl(data, urlParams);
    })
}

function handleTypes(data) {
    // если указан тип в url
    var type_slug = getMatch(getValuesFromUrl(), data.types);

    if (type_slug) {
        $("input[name='type_id']").val(type_slug);
    }

    $('.search-nav__types-list').html("");
    // Выводим пункт Все типы в dropdown с data_id=""
    $('.search-nav__types-list,.search__filter-types-list').append('<label data_id="" class="search-nav__types-item type closert_div checkbox _custom-radio"><input name="type_object" type="radio" checked> <span class="radio"></span>' + data.dictionary.all_types + '</label>');

    // Выводим название типа при загрузке страницы
    $(".type_select").text(type_slug !== false ? data.types.find(x => x.slug == type_slug).name : data.dictionary.all_types);

    // Выводим типы в dropdown
    $.each(data.types, function (index, value) {
        $('.search-nav__types-list,.search__filter-types-list').append('<label data_id="' + value.slug + '" class="search-nav__types-item type closert_div checkbox _custom-radio"> <input name="type_object" type="radio"> <span class="radio"></span>' + value.name + '</label>');
    });

    // Вешаем событие на добавленные элементы в dropdown
    $('.type').click(function (e) {
        if(!this.classList.contains('checkbox')) {
            e.preventDefault();
            e.stopPropagation();
        }
        $(this).addClass('active');
        $('.search-nav__item-dropdown').removeClass('active');
        $('.search-nav__types').removeClass('active');

        var new_type = $(this).attr('data_id');
        var prev_type = $("input[name='type_id']").val();
        $("input[name='type_id']").val(new_type);

        var urlParams = handleUrlParams(prev_type, new_type);
        updateUrl(data, urlParams);

        var html = $(this).html();
        $('.type_select').html(html);

        const parentBlock = this.closest('.search-nav__list-item')
        const dropDown = this.closest('.search-nav__item-dropdown')

        parentBlock.classList.remove('active')
        dropDown.classList.remove('active')
    });
}

function handleCountries(data) {
    // если указана страна в url, то выводим регионы
    var country_slug = getMatchSlug(getValuesFromUrl(), data.countries);

    if (country_slug !== false) {
        $('.search-nav__list-item[data_id="city"]').show();
        $('.search-nav__list-item[data_id="country"]').hide();

        // Выводим регионы при загрузке страницы
        var country = data.countries.find(x => x.slug == country_slug);
        var cities_array = data.cities.filter(x => x.parent_id === country.id);

        var city_slug = getMatchSlug(getValuesFromUrl(), cities_array);

        var city_name = city_slug !== false ? data.cities.find(x => x.slug == city_slug).name : data.dictionary.all_regions;

        $(".city_select").text(city_name);
        $("input[name='city_id']").val(city_slug);

        // Выводим страны в dropdown
        $('.search-nav__cities-list').html("");
        // Выводим пункт все регионы с data_id=""
        $('.search-nav__cities-list').append('<div data_id="" class="search_city search-nav__types-item dropdown__selector other-element search__filter-title">' + data.dictionary.all_regions + '</div>');
        $.each(cities_array, function (index, value) {
            $('.search-nav__cities-list').append('<div data_id="' + value.slug + '" class="search_city search-nav__types-item dropdown__selector other-element">' + value.name + '</div>');
        });

        // Вешаем событие на добавленные элементы в dropdown
        $('.search_city').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            var new_city = $(this).attr('data_id');
            var prev_city = $("input[name='city_id']").val();
            $("input[name='city_id']").val(new_city);

            var urlParams = handleUrlParams(prev_city.toLowerCase(), new_city.toLowerCase());
            updateUrl(data, urlParams);

            var html = $(this).html();
            $('.city_select').html(html);

            const parentBlock = this.closest('.search-nav__list-item')
            const dropDown = this.closest('.search-nav__item-dropdown')

            parentBlock.classList.remove('active')
            dropDown.classList.remove('active')
        });

    } else {
        $('.search-nav__list-item[data_id="city"]').hide();
        $('.search-nav__list-item[data_id="country"]').show();

        // Выводим название страны при загрузке страницы
        $(".country_select").text(data.dictionary.all_countries);
        $("input[name='country_id']").val(country_slug);

        // Выводим страны в dropdown
        $('.search-nav__countries-list').html("");
        // Выводим страны в dropdown
        $.each(data.countries, function (index, value) {
            $('.search-nav__countries-list').append('<div data_id="' + value.slug + '" class="search_country search-nav__types-item dropdown__selector other-element">' + value.name + '</div>');
        });

        // Вешаем событие на добавленные элементы в dropdown
        $('.search_country').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            var new_country = $(this).attr('data_id');
            var prev_country = $("input[name='country_id']").val();
            $("input[name='country_id']").val(new_country);

            var urlParams = handleUrlParams(prev_country.toLowerCase(), new_country.toLowerCase());
            updateUrl(data, urlParams);

            var html = $(this).html();
            $('.country_select').html(html);

            const parentBlock = this.closest('.search-nav__list-item')
            const dropDown = this.closest('.search-nav__item-dropdown')

            parentBlock.classList.remove('active')
            dropDown.classList.remove('active')
        });
    }
}

function handleBedrooms(data) {
    var find_bedroom = false;

    $('.search-nav__rooms-dropdown-bedrooms-buttons').html("");
    // Выводим спальни в dropdown
    $.each(data.bedrooms, function (index, value) {
        if (getValuesFromUrl().includes(value.slug)) {
            find_bedroom = value.slug;
            $("input[name='bedroom']").val(find_bedroom);
        }
        $('.search-nav__rooms-dropdown-bedrooms-buttons').append('<div data_id="'+value.slug+'" class="bedrooms search-nav__rooms-dropdown-bedrooms-button '+(getValuesFromUrl().includes(value.slug) ? 'active' : '')+'">'+value.name+'</div>');
    });
    // Выводим пункт НЕВАЖНО в спальни в dropdown
    $('.search-nav__rooms-dropdown-bedrooms-buttons').append('<div data_id="" class="bedrooms search-nav__rooms-dropdown-bedrooms-button '+(find_bedroom === false ? 'active' : '')+'">'+data.dictionary.doesnt_matter+'</div>');

    // Вешаем событие на добавленные элементы в dropdown
    $('.bedrooms').click(function () {
        var new_bedroom = $(this).attr('data_id');
        $('.bedrooms.search-nav__rooms-dropdown-bedrooms-button.active').removeClass('active');
        $(this).addClass('active');

        var prev_bedroom = $("input[name='bedroom']").val();
        $("input[name='bedroom']").val(new_bedroom);

        var urlParams = handleUrlParams(prev_bedroom, new_bedroom);
        updateUrl(data, urlParams);
    })
}

function handleBathrooms(data) {
    var find_bathroom = false;

    $('.search-nav__rooms-dropdown-bathrooms-buttons').html("");
    // Выводим ванные в dropdown
    $.each(data.bathrooms, function (index, value) {
        if (getValuesFromUrl().includes(value.slug)) {
            find_bathroom = value.slug;
        }
        $('.search-nav__rooms-dropdown-bathrooms-buttons').append('<div data_id="'+value.slug+'" class="bathrooms search-nav__rooms-dropdown-bathrooms-button '+(getValuesFromUrl().includes(value.slug) ? 'active' : '')+'">'+value.name+'</div>');
    });
    $('.search-nav__rooms-dropdown-bathrooms-buttons').append('<div data_id="" class="bathrooms search-nav__rooms-dropdown-bathrooms-button '+(find_bathroom === false ? 'active' : '')+'">'+data.dictionary.doesnt_matter+'</div>');

    // Вешаем событие на добавленные элементы в dropdown
    $('.bathrooms').click(function () {
        var new_bathroom = $(this).attr('data_id');
        $('.bathrooms.search-nav__rooms-dropdown-bathrooms-button.active').removeClass('active');
        $(this).addClass('active');

        var prev_bathroom = $("input[name='bathroom']").val();
        $("input[name='bathroom']").val(new_bathroom);

        var urlParams = handleUrlParams(prev_bathroom, new_bathroom);
        updateUrl(data, urlParams);
    })
}

function handlePeculiarities(data) {
    // Выводим особенности в dropdown
    $('.more-dropdown__peculiarities-list').html("");
    $.each(data.peculiarities, function (index, value) {
        $('.more-dropdown__peculiarities-list').append('<div class="more-dropdown__peculiarities-item">'+
            '<label class="more-dropdown__peculiarities peculiarities">'+
            '<input data-name="'+value.slug+'" name="peculiarities['+value.slug+']" '+
            'class="more-dropdown__peculiarities-tv-checkbox more-dropdown__peculiarities-checkbox" type="checkbox" '+
            (getValuesFromUrl().includes(value.slug) ? 'checked' : '')+'>'+
            '<div class="more-dropdown-custom-checkbox"></div>'+
            '<div class="more-dropdown-checkbox-text">'+value.name+'</div>'+
            '</label>'+
            '</div>');
    });

    // Вешаем событие на добавленные элементы в dropdown
    $('.more-dropdown__peculiarities-checkbox').change(function () {
        var checked = $(this).prop('checked');
        var name = $(this).attr('data-name');

        var prev_peculiarity = !checked ? name : "";
        var new_peculiarity = checked ? name : "";

        var urlParams = handleUrlParams(prev_peculiarity, new_peculiarity);
        updateUrl(data, urlParams);
    })
}

function handleViews(data) {
    // Выводим виды в dropdown
    $('.more-dropdown__view-item').html("");
    $.each(data.views, function (index, value) {
        if (getValuesFromUrl().includes(value.slug)) {
            $("input[name='view']").val(value.slug);
        }
        $('.more-dropdown__view-item').append('<div data_id="'+value.slug+'" class="view search-nav__dropdown-button search-nav__view-button '+(getValuesFromUrl().includes(value.slug) ? 'active' : '')+'">'+value.name+'</div>');
    });

    // Вешаем событие на добавленные элементы в dropdown
    $('.view').click(function () {
        var new_view = $(this).attr('data_id');
        $('.view.search-nav__dropdown-button.search-nav__view-button.active').removeClass('active');

        var prev_view = $("input[name='view']").val();
        var urlParams;

        if (prev_view === new_view) {
            $("input[name='view']").val("");
            urlParams = getValuesFromUrl();
            deleteUrlParameter(prev_view.toLowerCase(), urlParams);
        } else {
            $(this).addClass('active');
            $("input[name='view']").val(new_view);
            urlParams = handleUrlParams(prev_view.toLowerCase(), new_view.toLowerCase());
        }
        updateUrl(data, urlParams);
    });
}

function handleToSea(data) {
    // Выводим до моря в dropdown
    $('.more-dropdown__sea-item').html("");
    $.each(data.to_sea, function (index, value) {
        if (getValuesFromUrl().includes(value.slug)) {
            $("input[name='to_sea']").val(value.slug);
        }
        $('.more-dropdown__sea-item').append('<div data_id="'+value.slug+'" class="to_sea search-nav__dropdown-button search-nav__sea-button ts '+(getValuesFromUrl().includes(value.slug) ? 'active' : '')+'">'+value.name+'</div>');
    });

    // Вешаем событие на добавленные элементы в dropdown
    $('.to_sea').click(function () {
        var new_to_sea = $(this).attr('data_id');
        $('.to_sea.search-nav__dropdown-button.search-nav__sea-button.ts.active').removeClass('active');

        var prev_to_sea = $("input[name='to_sea']").val();
        var urlParams;

        if (prev_to_sea === new_to_sea) {
            $("input[name='to_sea']").val("");
            urlParams = getValuesFromUrl();
            deleteUrlParameter(prev_to_sea.toLowerCase(), urlParams);
        } else {
            $(this).addClass('active');
            $("input[name='to_sea']").val(new_to_sea);
            urlParams = handleUrlParams(prev_to_sea.toLowerCase(), new_to_sea.toLowerCase());
        }
        updateUrl(data, urlParams);
    })
}

function handleSizeMin(data) {
    var min_size = checkPosition(getValuesFromUrl(), "minsize");

    // Подстановка минимальной цены в input
    if (min_size !== false) {
        var min_size_arr = min_size.split('-');
        $('input[name="size[min]"]').val(min_size !== false ? min_size_arr[1] : "");
    }

    // При изменении минимальной цены
    $('input[name="size[min]"]').on('change input', function () {
        var min_size = $(this).val();

        var urlParams = handleUrlNumParams("minsize-"+min_size);
        updateUrl(data, urlParams);
    })
}

function handleSizeMax(data) {
    var max_size = checkPosition(getValuesFromUrl(), "maxsize");

    // Подстановка минимальной цены в input
    if (max_size !== false) {
        var max_size_arr = max_size.split('-');
        $('input[name="size[max]"]').val(max_size !== false ? max_size_arr[1] : "");
    }

    // При изменении минимальной цены
    $('input[name="size[max]"]').on('change input', function () {
        var max_size = $(this).val();

        var urlParams = handleUrlNumParams("maxsize-"+max_size);
        updateUrl(data, urlParams);
    })
}

// var url = new URL(window.location.href);
//
// alert(url.host);
async function searchBarGetParameters() {
    await $.ajax({
        url: '/api/houses/filter_params',       /* Куда отправить запрос */
        data: {
            locale: window.locale,
        },
        method: 'get',                                              /* Метод запроса (post или get) */
        success: function(data) {
            if(window.filter_params_data !== undefined) return
            window.filter_params_data = data;
            window.sortedCategories = convertToCategoryValue(data);

            var buy = "";
            getValuesFromUrl().forEach(function (value, index) {
                if (data.sale_or_rent.includes(value)) {
                    buy = value;
                }
            })
            $("input[name='sale_or_rent']").val(buy);
            handleCountries(data);
            handleCurrency(data);
            handleTypes(data);
            handleBedrooms(data);
            handleBathrooms(data);
            handlePeculiarities(data);
            handleViews(data);
            handleToSea(data);
            handleMinPrice(data);
            handleMaxPrice(data);
            handleSizeMin(data);
            handleSizeMax(data);
        }
    });
}

function handleIsSecondary() {
    var urlParams = getValuesFromUrl();
    if (urlParams.includes("secondary")) {
        $("input[name='is_secondary']").val("secondary");
        $('.city-col__is_secondary').addClass("active").closest('city-col__btn').removeClass("active");
    }
    if (urlParams.includes("new")) {
        $("input[name='is_secondary']").val("new");
        $('.city-col__not_secondary').addClass("active").closest('city-col__btn').removeClass("active");
    }
    if (!urlParams.includes("new") && !urlParams.includes("secondary")) {
        $("input[name='is_secondary']").val("");
        $('.city-col__all').addClass("active").closest('city-col__btn').removeClass("active");
    }

    // Обработка вторичка-не вторичка происходит в houses событие click на .city-col__btn
}

function handleOrder(cheap_first, expensive_first, new_first) {
    // Сортировка
    var urlParams = getValuesFromUrl();
    if (urlParams.includes("cheap-first")) {
        $("input[name='order']").val("cheap-first");
        $('.city-cil__filter-title').text(cheap_first);
    }

    if (urlParams.includes("expensive-first")) {
        $("input[name='order']").val("expensive-first");
        $('.city-cil__filter-title').text(expensive_first);
    }

    if (urlParams.includes("new-first")) {
        $("input[name='order']").val("new-first");
        $('.city-cil__filter-title').text(new_first);
    }

    if (!urlParams.includes("cheap-first") && !urlParams.includes("expensive-first") && !urlParams.includes("new-first")) {
        $("input[name='order']").val("");
        $('.city-cil__filter-title').text(new_first);
    }

    $('.city-col__filter-list').append('<div class="city-col__filter-item '+(urlParams.includes("cheap-first") ? 'active' : '')+'" data_id="cheap-first">'+cheap_first+'</div>');
    $('.city-col__filter-list').append('<div class="city-col__filter-item '+(urlParams.includes("expensive-first") ? 'active' : '')+'" data_id="expensive-first">'+expensive_first+'</div>');
    $('.city-col__filter-list').append('<div class="city-col__filter-item '+(urlParams.includes("new-first") ? 'active' : '')+'" data_id="new-first">'+new_first+'</div>');

    // Обработка вторичка-не вторичка происходит в houses событие click на .city-col__btn
}

function createParamsForFilterFromUrl() {
    var params = {
        price: {},
        size: {},
        peculiarities: []
    };

    var categories;
    (async() => {
        while(!window.sortedCategories) // define the condition as you like
            await new Promise(resolve => setTimeout(resolve, 1000));
        categories = window.sortedCategories;

        var urlParams = getValuesFromUrl();

        urlParams.forEach(function (value, index) {
            var val = categories.find(x => x.value === value);
            if (val) {
                if (val.category == "peculiarities") {
                    params.peculiarities.push(val.value);
                } else {
                    params[val.category] = val.value;
                }
            }
            if (value.indexOf("minprice") !== -1) {
                var minprice = value.split('-');
                params.price["min"] = parseInt(minprice[1]);
            }
            if (value.indexOf("maxprice") !== -1) {
                var maxprice = value.split('-');
                params.price["max"] = parseInt(maxprice[1]);
            }

            if (value.indexOf("minsize") !== -1) {
                var minsize = value.split('-');
                params.size.min = parseInt(minsize[1]);
            }
            if (value.indexOf("maxsize") !== -1) {
                var maxsize = value.split('-');
                params.size.max = parseInt(maxsize[1]);
            }

            window.filter_params_data.currency.forEach(function (v, i) {
                if (v.currency.toLowerCase() === value) {
                    params.price["currency"] = value.toUpperCase();
                }
            })

            if (value === "new") {
                params.is_secondary = 0;
            }
            if (value === "secondary") {
                params.is_secondary = 1;
            }

            if (value === "commercial") {
                params.is_commercial = 1;
            }

            if (value === "residential") {
                params.is_commercial = 0;
            }

            if (value == "sale") {
                params.sale_or_rent = "sale";
            }
            if (value == "buy") {
                params.sale_or_rent = "sale";
            }
            if (value == "rent") {
                params.sale_or_rent = "rent";
            }

            if (value === 'new-first') {
                params.order_by = 'new-first';
            }
            if (value === 'cheap-first') {
                params.order_by = 'cheap-first';
            }
            if (value === 'expensive-first') {
                params.order_by = 'expensive-first';
            }
        })
    })();

    return params;
}

function closeObjectModal() {
    var urlParams = getValuesFromUrl();
    var object = checkPosition(urlParams, 'object-');
    if (object) {
        urlParams = deleteUrlParameter(object, urlParams);
    }
    updateUrl(window.filter_params_data, urlParams);
}

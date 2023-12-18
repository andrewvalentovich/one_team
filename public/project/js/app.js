let locations = [];
document.querySelector(".header__top-phone-menu").onclick = function () {
    document.querySelector(".header-m").classList.toggle("active"), document.querySelector("#nav-icon").classList.toggle("open"), document.querySelector(".header-w").classList.add("fixed"), document.querySelector(".header-m").classList.contains("active") || document.querySelector(".header-w").classList.remove("fixed")
    if(document.querySelector(".place-w")) {
        document.querySelector(".place-w").classList.contains("active")
    }
}

// Отправка запроса на количество посещённых пользователем страниц
$.ajax({
    url:  '/api/cookies/page_count/increase',
    type: 'GET',
});

async function getData(locale, idCountry) {
    let url = ``;

    if(idCountry) {
        url = `/api/get_cities?locale=${locale}&country_id=${idCountry}`
        // url = `/city_from_map/`
    } else {
        url = `/api/get_cities?locale=${locale}`
    }

    await fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                data.data.forEach(city => {
                    locations.push({
                        coordinates: city.coordinate,
                        balloonContent: `${city.name}, ${city.count}`,
                        city_id: city.id,
                        link: city.link
                    });
                });
                renderMap();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
async function renderMap() {
    "use strict";
    if(window.innerWidth <=1003) {
        if(document.querySelectorAll("#map_city").length) {
            document.querySelector("#map_city").classList.add("map_city_active");
            document.querySelector(".city__content").classList.add("city_map");
        }
    }
    function e(e) {
        for (let t = 0; t < e.length; t++) e[t].classList.remove("active");
        e = 0
    }
    window.addEventListener("resize", (function (e) {
        vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
        window.innerWidth > 1199 && (document.querySelector(".header-m").classList.remove("active"), document.querySelector("#nav-icon").classList.remove("open"), document.querySelector(".header-w").classList.remove("fixed")), document.querySelectorAll(".search-nav-w").length && (window.innerWidth > 899 && !document.querySelector(".search-nav__more-dropdown").classList.contains("active") && (document.querySelector(".search-w").classList.remove("active"), document.querySelector(".search-nav__more").classList.remove("active")), window.innerWidth <= 899 && (document.querySelector(".search-nav__more-dropdown").classList.remove("active"), document.querySelector(".search-nav__more").classList.remove("active"), document.querySelector(".search-nav__price-dropdown").classList.remove("active"), document.querySelector(".search-nav__price").classList.remove("active"), document.querySelector(".search-nav__types-dropdown").classList.remove("active"), document.querySelector(".search-nav__types").classList.remove("active")), window.innerWidth <= 1199 && (document.querySelector(".search-nav__rooms-dropdown").classList.remove("active"), document.querySelector(".search-nav__rooms").classList.remove("active"))), document.querySelectorAll(".place-w").length && (window.innerWidth <= 1023 && document.querySelector(".place-w").classList.contains("active") && document.querySelector(".header-w").classList.add("fixed"))
    })), document.querySelectorAll(".place-w").length && window.innerWidth <= 540 && window.addEventListener("resize", (function (e) {
        if (document.querySelectorAll("#map_city").length) {
            if (window.innerWidth > 1003) {
                document.querySelector(".city__content").classList.remove("city_map");
                document.querySelector(".city-col").classList.add("active");
                document.querySelector(".map_city__btn-changer").classList.remove("active");
                document.querySelector(".city-col__btn-changer").classList.add("active");
                document.querySelector("#map_city").classList.remove("map_city_active");
                document.querySelector(".city__content").classList.remove("city_map");
                document.querySelector("#map_city").style.height = window.innerWidth > 1199 ?
                    window.innerHeight - 18 - 161 + "px" :
                    window.innerHeight - 88 - 60 + "px";
            } else if (window.innerWidth <= 1003) {
                document.querySelector(".city__content").classList.add("city_map");
                document.querySelector("#map_city").style.height = "100%";
            }
        }
    }))


    let t = document.querySelectorAll(".header-m__langs-item");
    for (let o = 0; o < t.length; o++) t[o].addEventListener("click", (function (c) {
        e(t), t[o].classList.add("active")
    }));
    let o = document.querySelectorAll(".index-map__button");
    for (let t = 0; t < o.length; t++) o[t].addEventListener("click", (function (c) {
        e(o), o[t].classList.add("active")
    }));
    let c, l = document.querySelectorAll(".contact__top-item");
    for (let t = 0; t < l.length; t++) l[t].addEventListener("click", (function (o) {
        e(l), l[t].classList.add("active")
    }));
    document.querySelectorAll(".contact__form-phone-country").length && (document.querySelector(".contact__form-phone-country").onclick = function () {
        this.classList.toggle("active"), document.querySelector(".contact__phone-dropdown").classList.toggle("active")
    }), new Swiper(".city__swiper", {
        slidesPerView: 1,
        scrollbar: {
            el: ".city__scrollbar",
            hide: !0
        }
    })
    let n = document.querySelectorAll(".search-nav__rooms-dropdown-bedrooms-button");
    for (let t = 0; t < n.length; t++) n[t].addEventListener("click", (function (o) {
        e(n), n[t].classList.add("active")
    }));
    let i = document.querySelectorAll(".search-nav__rooms-dropdown-bathrooms-button");
    for (let t = 0; t < i.length; t++) i[t].addEventListener("click", (function (o) {
        e(i), i[t].classList.add("active")
    }));
    let a = document.querySelectorAll(".search-nav__view-button");
    for (let t = 0; t < a.length; t++) a[t].addEventListener("click", (function (o) {
        e(a), a[t].classList.add("active")
    }));
    let s = document.querySelectorAll(".search-nav__sea-button");
    for (let t = 0; t < s.length; t++) s[t].addEventListener("click", (function (o) {
        e(s), s[t].classList.add("active")
    }));
     document.querySelector(".city-col__filter") && (document.querySelector(".city-col__filter").onclick = function () {
        this.classList.toggle("active"), document.querySelector(".city-col__filter-list").classList.toggle("active")
    }), document.querySelector(".favorites__top-filter") && (document.querySelector(".favorites__top-filter").onclick = function () {
        this.classList.toggle("active"), document.querySelector(".favorites__top-filter-list").classList.toggle("active")
    }), document.querySelector(".place__btns-call-preview") && (document.querySelector(".place__btns-call-preview").onclick = function () {
    }), document.querySelector(".place__btns-call-preview") && (document.querySelector(".place-w").onscroll = function () {
        window.innerWidth < 640 && (document.querySelector(".place-w").scrollTop > 620 ? document.querySelector(".place__btns").style.position = "fixed" : document.querySelector(".place__btns").style.position = "static")
    }, window.addEventListener("resize", (function (e) {
        window.innerWidth >= 640 && (document.querySelector(".place__btns").style.position = "static")
    })));
    let v = document.querySelectorAll(".favorites__pages-item");
    for (let t = 0; t < v.length; t++) v[t].addEventListener("click", (function (o) {
        e(v), v[t].classList.add("active")
    }));
    let p = document.querySelectorAll(".city-col__btn");
    for (let t = 0; t < p.length; t++) p[t].addEventListener("click", (function (o) {
        e(p), p[t].classList.add("active")
    }));
    let h = document.querySelectorAll(".favorite-item-btn");

    for (let e = 0; e < h.length; e++) h[e].addEventListener("click", (function (t) {

        h[e].classList.toggle("active")

    }));

    let f = document.querySelectorAll(".objects__slide-favorites");

    for (let e = 0; e < f.length; e++) f[e].addEventListener("click", (function (t) {

        f[e].classList.toggle("active")

    }));

    let w = document.querySelectorAll(".city-col__bottom-number");

    for (let t = 0; t < w.length; t++) w[t].addEventListener("click", (function (o) {

        e(w), w[t].classList.add("active")

    }));

 document.querySelector(".map_city__btn-changer") && (document.querySelector(".map_city__btn-changer").onclick = function () {

        this.classList.remove("active"), document.querySelector(".city-col").classList.add("active"), document.querySelector(".city-col__btn-changer").classList.add("active"), document.querySelector("#map_city").classList.remove("map_city_active"), document.querySelector(".city__content").classList.remove("city_map")
        document.querySelector("#map_city").classList.remove("show");
    }), document.querySelectorAll(".place__currency-preview").length && (document.querySelector(".place__currency-preview").onclick = function () {
        document.querySelector(".place__currency").classList.toggle("active")

    }), window.innerWidth > 1003 && document.querySelectorAll(".city").length && document.body.classList.add("scroll_fixed"), window.addEventListener("resize", (function (e) {

        window.innerWidth > 1003 && document.querySelectorAll(".city").length && document.body.classList.add("scroll_fixed")
        if (window.innerWidth <= 1003 && document.querySelectorAll(".city").length > 0) {
            document.body.classList.remove("scroll_fixed");
            document.querySelector("#map_city").classList.add("map_city_active");
            document.querySelector(".city__content").classList.add("city_map");
        }


    }));

    let g = document.querySelectorAll(".city-col__item"),

        b = document.querySelector(".place-w");

    for (let e = 0; e < g.length; e++) g[e].addEventListener("click", (function (e) {

        e.target.classList.contains("favorite-item-btn") || (document.body.classList.add("scroll_fixed"), document.querySelector(".header-w").classList.add("fixed"), b.classList.add("active"))

    }));

 new Swiper(".place__swiper", {

        slidesPerView: 2,

        spaceBetween: 4,

        navigation: {

            nextEl: ".place__next",

            prevEl: ".place__prev"

        },

        pagination: {

            el: ".place__pagination",

            type: "custom",

            renderCustom: function (e, t, o) {

                return t + " из " + o

            }

        },

        breakpoints: {

            0: {

                slidesPerView: 1

            },

            540: {

                slidesPerView: 2

            }

        }

    }), new Swiper(".scheme__swiper", {

        slidesPerView: 1,

        navigation: {

            nextEl: ".scheme__next",

            prevEl: ".scheme__prev"

        },

        breakpoints: {

            0: {

                slidesPerView: 1

            },

            540: {

                slidesPerView: 2

            },

            767: {

                slidesPerView: 1

            }

        }

    });

    let S = document.querySelectorAll(".place__collage-item_clickable"),

        L = document.querySelectorAll(".place__slide_clickable"),

        q = document.querySelector(".place__slider_p"),

        k = document.querySelector(".place__slider_p-exit"),

        x = document.querySelector(".place-popup-collage"),

        A = document.querySelector(".place-popup-collage__exit");

    if (S.length)

        for (let e = 0; e < S.length; e++) S[e].addEventListener("click", (function (t) {

            q.classList.add("active")
        }));

    if (L.length)

        for (let e = 0; e < L.length; e++) L[e].addEventListener("click", (function (e) {

            x.classList.add("active")

        }));

    var C, E;



    function P(e) {

    }



    L.length && (k.onclick = function () {

        q.classList.remove("active"), c.destroy(!0, !0)

    }), L.length && (A.onclick = function () {

        x.classList.remove("active")

    }), L.length && window.addEventListener("resize", (function (e) {

        window.innerWidth <= 766 && q.classList.contains("active") && (x.classList.add("active"), q.classList.remove("active")), window.innerWidth > 766 && x.classList.contains("active") && (x.classList.remove("active"), q.classList.add("active"))

    })), P(E = window.innerWidth > 1003 ? 0 : 1 / 0), window.addEventListener("resize", (function (e) {

        // this.document.querySelectorAll(".city-col__item").length && (window.innerWidth > 1003 && 0 == E && (C.destroy(), P(0), E = 1 / 0), window.innerWidth <= 1003 && E == 1 / 0 && (C.destroy(), P(1 / 0), E = 0))
        if (this.document.querySelectorAll(".city-col__item").length) {
            if (window.innerWidth > 1003 && E === 0) {
                if (C) {
                    C.destroy();
                }
                P(0);
                E = 1 / 0;
            } else if (window.innerWidth <= 1003 && E === 1 / 0) {
                if (C) {
                    C.destroy();
                }
                P(1 / 0);
                E = 0;
            }
        }
    })), document.querySelectorAll("#map-country").length && ymaps.ready((function () {
        var country = (window.country === undefined) ? {lat: 38.475851, long: 30.815585} : window.country;
        let zoom = 6
        if(window.innerWidth <= 539) {
            zoom = 5
        }
        var e = new ymaps.Map("map-country", {
            center: [country.lat, country.long],
            zoom: zoom,
            controls: [],
            behaviors: ["default", "scrollZoom"]
        }, {
            searchControlProvider: "yandex#search"
        }),

        ZoomLayout = ymaps.templateLayoutFactory.createClass('<div class="zoom-control"><div class="zoom-control__group"><div class="zoom-control__zoom-in"><button  type="button" class="button _view_air _size_medium  _pin-bottom" aria-haspopup="false" aria-label="Приблизить"><span class="button__icon" aria-hidden="true"><div class="zoom-control__icon"><svg width="30" height="30" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11 5.992c0-.537.448-.992 1-.992.556 0 1 .444 1 .992V11h5.008c.537 0 .992.448.992 1 0 .556-.444 1-.992 1H13v5.008c0 .537-.448.992-1 .992-.556 0-1-.444-1-.992V13H5.992C5.455 13 5 12.552 5 12c0-.556.444-1 .992-1H11V5.992z" fill="currentColor"/></svg></div></span></button></div><div class="zoom-control__zoom-out"><button  type="button" class="button _view_air _size_medium  _pin-top" aria-haspopup="false" aria-label="Отдалить"><span class="button__icon" aria-hidden="true"><div class="zoom-control__icon"><svg width="30" height="30" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M5 12a1 1 0 0 1 1-1h12a1 1 0 1 1 0 2H6a1 1 0 0 1-1-1z" fill="currentColor"/></svg></div></span></button></div></div></div></div></div>', {

            // Переопределяем методы макета, чтобы выполнять дополнительные действия
            // при построении и очистке макета.
            build: function () {
                // Вызываем родительский метод build.
                ZoomLayout.superclass.build.call(this);
                // Привязываем функции-обработчики к контексту и сохраняем ссылки
                // на них, чтобы потом отписаться от событий.
                this.zoomInCallback = ymaps.util.bind(this.zoomIn, this);
                this.zoomOutCallback = ymaps.util.bind(this.zoomOut, this);

                // Начинаем слушать клики на кнопках макета.
                $('.zoom-control__zoom-in').bind('click', this.zoomInCallback);
                $('.zoom-control__zoom-out').bind('click', this.zoomOutCallback);
            },

            clear: function () {
                // Снимаем обработчики кликов.

                $('.zoom-control__zoom-in').unbind('click', this.zoomInCallback);
                $('.zoom-control__zoom-out').unbind('click', this.zoomOutCallback);

                // Вызываем родительский метод clear.
                ZoomLayout.superclass.clear.call(this);
            },

            zoomIn: function () {
                var map = this.getData().control.getMap();
                map.setZoom(map.getZoom() + 1, {checkZoomRange: true});
            },

            zoomOut: function () {
                var map = this.getData().control.getMap();
                map.setZoom(map.getZoom() - 1, {checkZoomRange: true});
            }
        }),
        zoomControl = new ymaps.control.ZoomControl({options: {layout: ZoomLayout}});
        e.controls.add(zoomControl, {
            position: {
                right: 20,
                bottom: 20
            }
        });
        t = ymaps.templateLayoutFactory.createClass('<div class="popover top"><a class="close" href="#">&times;</a><div class="arrow"></div><div class="popover-inner">$[[options.contentLayout observeSize minWidth=235 maxWidth=235 maxHeight=350]]</div></div>', {

            build: function () {

                this.constructor.superclass.build.call(this), this._$element = $(".popover", this.getParentElement()), this.applyElementOffset(), this._$element.find(".close").on("click", $.proxy(this.onCloseClick, this))

            },

            clear: function () {

                this._$element.find(".close").off("click"), this.constructor.superclass.clear.call(this)

            },

            onSublayoutSizeChange: function () {

                t.superclass.onSublayoutSizeChange.apply(this, arguments), this._isElement(this._$element) && (this.applyElementOffset(), this.events.fire("shapechange"))

            },

            applyElementOffset: function () {

                this._$element.css({

                    left: -this._$element[0].offsetWidth / 2,

                    top: -(this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight)

                })

            },

            onCloseClick: function (e) {

                e.preventDefault(), this.events.fire("userclose")

            },

            getShape: function () {

                if (!this._isElement(this._$element)) return t.superclass.getShape.call(this);

                var e = this._$element.position();

                return new ymaps.shape.Rectangle(new ymaps.geometry.pixel.Rectangle([

                    [e.left, e.top],

                    [e.left + this._$element[0].offsetWidth, e.top + this._$element[0].offsetHeight + this._$element.find(".arrow")[0].offsetHeight]

                ]))

            },

            _isElement: function (e) {

                return e && e[0] && e.find(".arrow")[0]

            }

        }),

        o = ymaps.templateLayoutFactory.createClass('<div class="placemark"></div>', {
            build: function () {
                o.superclass.build.call(this);
                var e = this.getParentElement().getElementsByClassName("placemark")[0],
                    t = this.isActive ? 60 : 34,
                    c = {
                        type: "Circle",
                        coordinates: [0, 0],
                        radius: t / 2
                    },
                    l = {
                        type: "Circle",
                        coordinates: [0, -30],
                        radius: t / 2
                    };
                this.getData().options.set("shape", this.isActive ? l : c), this.inited || (this.inited = !0, this.isActive = !1, this.getData().geoObject.events.add("click", (function (t) {
                    var o = document.querySelectorAll(".placemark");
                    if (e.classList.contains("active")) e.classList.remove("active");
                    else {
                        for (let e = 0; e < o.length; e++) o[e].classList.remove("active");
                        e.classList.add("active")
                    }
                }), this))
            }
        }),
        c = ymaps.templateLayoutFactory.createClass('<h3 class="popover-title">$[properties.balloonHeader]</h3><div class="popover-content"><a href="$[properties.link]">$[properties.balloonContent]</a> </div>');
        console.log(locations);
        console.log(locations.length);

        locations.forEach(Location => {
            var balloonOffset = (window.locale === 'ar' || window.locale === 'fa') ? [125, -50] : [-110, -50];
            var placemark = new ymaps.Placemark(Location.coordinates, {
                balloonContent: Location.balloonContent,
                link: Location.link,
                city_id: Location.city_id
            }, {
                balloonPanelMaxMapArea: 431520,
                balloonShadow: !1,
                balloonLayout: t,
                iconLayout: o,
                balloonContentLayout: c,
                hideIconOnBalloonOpen: !1,
                balloonOffset: balloonOffset
            });
            e.behaviors.disable("scrollZoom"),
            e.geoObjects.add(placemark);
        });
        // e.behaviors.disable("scrollZoom"), e.geoObjects.add(l).add(n).add(i).add(a).add(s)
    }))
};

function changerActive(list) {
    for(let i = 0; i < list.length; i++) {
        list[i].classList.remove('active')
    }
    list = 0
}

// список номеров телефонов
if(document.querySelectorAll('.field-phone').length) {
    const fieldPhone = document.querySelectorAll('.field-phone')
    let phonesBtn
    fieldPhone.forEach(element => {
        phonesBtn = element.querySelectorAll('.contact__form-phone-country')
    });
    phonesBtn.forEach(btn => {
        btn.addEventListener('click', function() {
            const paranetField = btn.closest('.field-phone')
            const dropdownList = paranetField.querySelector('.contact__phone-dropdown')
            this.classList.toggle('active')
            dropdownList.classList.toggle('active')
        })
    });
}


//Popup close
document.addEventListener("click", function(event) {
    event = event || window.event;
    let target = event.target

    if(target.classList.contains('popup')) {
      target.classList.remove('active')
        if(target.classList.contains('popup-catalog')) {
            sessionStorage.setItem("popupCatalog", "wasCloseByUser");
        }
    }

    //закрытие меню кликом по темной области
    if(target.classList.contains('header-m')) {
      target.classList.remove('active')
    //   bodyScrollLock.enableBodyScroll(target);
      for (let i = 0; i < headerMenuBtn.length; i++) {
        headerMenuBtn[i].classList.toggle('open')
      }
    }


    if(!target.classList.contains('header__nav-title') || !target.classList.closest('.header__nav-title')) {
        $('.header__nav-title').removeClass('active')
        $('.header__nav-item-dropdown').removeClass('active')
    }


    //закрытие блоков close-out по клику вне
    if(!target.classList.contains('search-nav__item-dropdown') && !target.closest('.search-nav__item-dropdown')
     && !target.classList.contains('search-nav__list-item') && !target.closest('.search-nav__list-item')) {
      let closeOutBlock = document.querySelectorAll('.search-nav__list-item')
      let test = document.querySelectorAll('.search-nav__item-dropdown')
      changerActive(closeOutBlock)
      changerActive(test)
    }

    //закрытие блоков close-out по клику вне
    if(!target.classList.contains('close-out') && !target.closest('.close-out')) {
        let closeOutBlock = document.querySelectorAll('.close-out')
        changerActive(closeOutBlock)
        }
  }


)

let popupClose = document.querySelectorAll('.popup-close')
for(let i=0 ; i < popupClose.length ; i++) {
    popupClose[i].addEventListener("click",
    function() {
      let popup = popupClose[i].closest('.popup')
      if(popup.classList.contains('filter')) {
        popup.classList.remove('popup')
      } else {
        popup.classList.remove('active')
      }
        // bodyScrollLock.enableBodyScroll(popup);
    })
}

// добавление выбранного кода странцы
if(document.querySelectorAll('.contact__phone-list').length) {
    const contactPhoneList = document.querySelectorAll('.contact__phone-list')

    contactPhoneList.forEach(list => {
        list.addEventListener('click', function(e) {
            const target = e.target
            const parentBlock = target.closest('.selection-phone')
            const phoneFlag = parentBlock.querySelector('.contact__form-country-item-img').querySelector('img')
            const input = parentBlock.querySelector('.contact__phone-input')
            const contactCountry = parentBlock.querySelector('.contact__form-phone-country')
            const dropdown = parentBlock.querySelector('.contact__phone-dropdown')

            if(target.classList.contains('contact__phone-list-item') || target.closest('.contact__phone-list-item')) {

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
            for (let ev of ['input', '', 'focus']) {
                elem.addEventListener(ev, eventCalllback);
            }
        }
    });


}




///////// для страницы houses
let favotires_house_id = {}


function formatNumberWithSpaces(number) {
    return number.toLocaleString('en-US', { minimumFractionDigits: 0 }).replace(',', ' ');
}

let vh = window.innerHeight * 0.01;
// Then we set the value in the --vh custom property to the root of the document
document.documentElement.style.setProperty('--vh', `${vh}px`);


//открытие dropdown в мобильном меню
const headerMobileBtn = document.querySelectorAll('.header-m__item-btn')
headerMobileBtn.forEach(btn => {
    btn.addEventListener('click', function() {
        btn.classList.toggle('active')
    })
});


if(document.querySelectorAll('.search-nav__more').length) {
    const navMore = document.querySelector('.search-nav__more')
    const searchW = document.querySelector('.search-w')
    const searchWClose = document.querySelector('.search-w__close')
    navMore.addEventListener('click', function() {
        if(window.innerWidth < 900) {
            searchW.classList.add('active')
        }
    })
    searchWClose.addEventListener('click', function() {
        searchW.classList.remove('active')
    })
}
if(document.querySelectorAll('._regions').length) {
    const navRegions = document.querySelector('._regions')
    const dropdown = navRegions.querySelector('.search-nav__item-dropdown')
    const searchWClose = navRegions.querySelector('.search-w__close')
    navRegions.addEventListener('click', function() {
        if(window.innerWidth < 900) {
            dropdown.classList.add('active')
        }
    })
    if(searchWClose)
    searchWClose.addEventListener('click', function() {
        dropdown.classList.remove('active')
    })
}
if(document.querySelectorAll('#map_city').length) {
    const appleExpression = /Apple/i;
    const safariExpression = /Safari/i;

    const isAppleSafari = () => {
        return appleExpression.test(navigator.vendor) &&
            safariExpression.test(navigator.userAgent);
    };
    if (isAppleSafari()) {
        const map = document.querySelector('.city__content')
        const test = document.querySelector('.city-col__btn-changer-text')
        map.classList.add('safari')
    }
}
const appHeight = () => {
    const doc = document.documentElement
    doc.style.setProperty('--app-height', `${window.innerHeight}px`)
}
window.addEventListener('resize', appHeight)
appHeight()


if(document.querySelectorAll('.close-dropdown').length) {
    const closeMenuCountrys = document.querySelectorAll('.close-dropdown')
    closeMenuCountrys.forEach(btn => {
        btn.addEventListener('click', function(event) {
            const dropdown = this.closest('.search-nav__item-dropdown')
            dropdown.classList.remove('active')
            event.stopImmediatePropagation()
        })
    });
}


if(document.querySelectorAll('.kompleks__layout-content').length) {
    const kompleksSort = document.querySelectorAll('.kompleks__layout-sort')
    kompleksSort.forEach(sortBlock => {
        const counterChemes = sortBlock.querySelectorAll('.kompleks__sort-item')
        if(counterChemes.length <= 1) {
            sortBlock.style.display = 'none'
        } else {

        }
    });
}

if(document.querySelectorAll('.object__swiper._preload').length) {
    const objectSwiper = new Swiper('.object__swiper', {
        slidesPerView: 1,
        navigation: {
            nextEl: '.object__swiper-next',
            prevEl: '.object__swiper-prev',
        },
        pagination: {
            el: ".object__swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            320: {

            },
            480: {

            },
            640: {

            }
        }
    })
    if(document.querySelectorAll('.kompleks__layout-img').length) {
        const chemePic = document.querySelectorAll('.kompleks__layout-img')
        const chemePopup = document.querySelector(".object__photo");

        const text = document.querySelector(".object__photo-info")

        const swiperWrapper = document.querySelector(".object__swiper-wrapper");
        const objectSwiperNav = document.querySelectorAll(".object__swiper-nav");

        chemePic.forEach(pic => {
            pic.addEventListener('click', function(e) {
                swiperWrapper.innerHTML = ''
                const container = this.closest('.kompleks__layout-item')
                let srsForPhotos = container.querySelector('.srs-for-photos').getAttribute('data-src-photos')
                srsForPhotos = JSON.parse(srsForPhotos)

                srsForPhotos.forEach(photo => {
                    const slide = document.createElement('div')
                    const slidePic = document.createElement('img')

                    if(photo.name) {
                        const floor = document.createElement('div')
                        floor.classList.add('object__swiper-slide-floor')
                        floor.innerHTML = photo.name
                        slide.appendChild(floor)
                    }

                    slide.classList.add('swiper-slide')
                    slide.classList.add('object__swiper-slide')
                    slide.appendChild(slidePic)
                    slidePic.setAttribute('src', photo)
                    swiperWrapper.appendChild(slide)

                });

                if(srsForPhotos.length <= 1) {
                    objectSwiperNav.forEach(btn => {
                        btn.style.display = 'none'
                    });
                } else {
                    objectSwiperNav.forEach(btn => {
                        btn.style.display = 'flex'
                    });
                }

                objectSwiper.update()
                objectSwiper.updateSlides()
                objectSwiper.slideTo(0)
                const text = document.querySelector(".object__photo-info")
                const infoForTextBlock = container.querySelector(".kompleks__layout-info")
                text.innerHTML = infoForTextBlock.innerHTML
                chemePopup.classList.add('active')
            })
        });

    }
}


//слушатель события на нажатия клаваши
document.addEventListener('keydown', (e) => {
    if(e.key === 'Escape') {
        const placeW = document.querySelector('.place__slider_p.active')
        placeW.classList.remove('active')
    }
})

const openPopupBtn = document.querySelectorAll('[popup-name]');
openPopupBtn.forEach(btn => {
    btn.addEventListener('click', function() {
        const popupName = btn.getAttribute('popup-name')
        const popup = document.querySelector(`.${popupName}`)
        popup.classList.add('active')
    })
});

const popupCatalog = document.querySelector('.popup-catalog')
const popupCatalogClose = document.querySelector('.popup-catalog-close')
popupCatalogClose.addEventListener('click', () => {
    sessionStorage.setItem("popupCatalog", "wasCloseByUser");
})

const popupQuestions = document.querySelector('.popup-questions.Second-modal-call')

if(popupQuestions) {
    popupQuestions.classList.add('active')
} else {
    idleTimer = null;
    idleState = false;
    idleWait = 20000; // задаём время ожидания бездействия

    (function ($) {
        $(document).ready(function () {
            $('*').on('mousemove keydown scroll touchstart touchmove touchend', function () {
                clearTimeout(idleTimer);
                if (idleState == true) {
                }
                idleState = false;
                idleTimer = setTimeout(function () {
                    if (!sessionStorage.getItem("popupCatalog")) {
                        popupCatalog.classList.add('active')
                    } else {
                        // sessionStorage.setItem("popupCatalog", "wasCalled");
                    }
                    idleState = true;
                }, idleWait);
            });

            // Инициализация
            $("body").trigger("mousemove");

        });
    })(jQuery);
    const popupCatalogGetBtn = document.querySelector('.popup-catalog-get-btn')
    popupCatalogGetBtn.addEventListener('click', () => {
        popupCatalog.classList.remove('active')
        sessionStorage.setItem("popupCatalog", "wasCloseByUser");
    })
}


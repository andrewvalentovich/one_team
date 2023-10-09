ymaps = window.ymaps;
ymaps.ready(init);

function init() {
    var long_el = document.getElementById('long');
    var lat_el = document.getElementById('lat');
    if (!lat_el.value || !long_el.value) {
        lat_el.value = 39.0379845041245;
        long_el.value = 32.78392826713207;
    }

    var myPlacemark,
        myMap = new ymaps.Map('set_placemark_map', {
            center: [lat_el.value, long_el.value],
            zoom: 6
        }, {
            searchControlProvider: 'yandex#search'
        });

    var coordinates = [Number(lat_el.value), Number(long_el.value)];
    myPlacemark = createPlacemark(coordinates);
    myMap.geoObjects.add(myPlacemark);
    // Слушаем событие окончания перетаскивания на метке.
    myPlacemark.events.add('dragend', function () {
        getAddress(myPlacemark.geometry.getCoordinates());
    });

    // Слушаем клик на карте.
    myMap.events.add('click', function (e) {
        var coords = e.get('coords');
        console.log(coords);
        $('#lat').val(coords[0]);
        $('#long').val(coords[1]);
        // Если метка уже создана – просто передвигаем ее.
        if (myPlacemark) {
            myPlacemark.geometry.setCoordinates(coords);
        }
        // Если нет – создаем.
        else {
            myPlacemark = createPlacemark(coords);
            myMap.geoObjects.add(myPlacemark);
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark.events.add('dragend', function () {
                getAddress(myPlacemark.geometry.getCoordinates());
            });
        }
        getAddress(coords);
    });

    $('#long, #lat').on('keyup', function (e) {
        var long = $('#long').val();
        var lat = $('#lat').val();

        var coords = [Number(lat), Number(long)];

        // Если метка уже создана – просто передвигаем ее.
        if (myPlacemark) {
            myPlacemark.geometry.setCoordinates(coords);
        }
        // Если нет – создаем.
        else {
            myPlacemark = createPlacemark(coords);
            myMap.geoObjects.add(myPlacemark);
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark.events.add('dragend', function () {
                getAddress(myPlacemark.geometry.getCoordinates());
            });
        }
        getAddress(coords);
    });

    // Создание метки.
    function createPlacemark(coords) {
        return new ymaps.Placemark(coords, {
            iconCaption: 'поиск...'
        }, {
            preset: 'islands#violetDotIconWithCaption',
            draggable: true
        });
    }

    // Определяем адрес по координатам (обратное геокодирование).
    function getAddress(coords) {
        myPlacemark.properties.set('iconCaption', 'поиск...');
        ymaps.geocode(coords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);

            myPlacemark.properties
                .set({
                    // Формируем строку с данными об объекте.
                    iconCaption: [
                        // Название населенного пункта или вышестоящее административно-территориальное образование.
                        firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                        // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                        firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                    ].filter(Boolean).join(', '),
                    // В качестве контента балуна задаем строку с адресом объекта.
                    balloonContent: firstGeoObject.getAddressLine()
                });
        });
    }
}

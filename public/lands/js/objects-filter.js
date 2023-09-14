$(document).ready(function () {
    // При загрузке страницы выводим активные элементы
    var url_city_id = $.query.get('city_id');

    // console.log(111111111111111111);
    // console.log(typeof url_city_id !== "boolean");
    // console.log(url_city_id !== "");
    // console.log(url_city_id !== " ");
    //
    //
    // console.log("url_city_id = " + url_city_id);
    // console.log("тип параметра" + typeof url_city_id);

    if (typeof url_city_id !== "boolean" && url_city_id !== "" && url_city_id !== " ") {
        $('.gallery__filter').find(`[data-id=${url_city_id}]`).addClass('active');
    } else {
        $('.gallery__filter').find(`div[data-id=0]`).addClass('active');
    }

    // При нажатии на страну из фильтра
    $('.gallery__filter div').on('click', function () {
        var offset = 0;
        var limit = 6;
        var get_url_type_id = $.query.get('type');

        $('.building-select').removeClass('active');
        $(this).addClass('active');

        var city_id = Number($(this).attr('data-id'));

        // Получаем параметр из url
        window.history.pushState(null, null, $.query.SET('city_id', city_id));

        $.ajax({
            url: `http://dev.${window.domain}:8879/api/landings/with_filter`,
            method: 'GET',
            dataType: 'json',
            data: {
                city_id: city_id,
                type: (typeof get_url_type_id !== "boolean" && get_url_type_id !== "" && get_url_type_id !== " ") ? Number(get_url_type_id) : 0,
                limit: limit,
                offset: offset,
            },
            success: function (data) {
                $('.building__list').empty();

                $.each(data, function (key, val) {
                    var photos = '';


                    $.each(val.photo, function (i, photo) {
                        photos += '<div class="building__item-slide swiper-slide"><img src="/uploads/' + photo.photo + '" alt="объект"></div>';
                    console.log(photos);
                    });

                    $('.building__list').append('<div class="building__item" open-building-popup="popup-buildings">\n' +
                        '                                <div class="building__item-top">\n' +
                        '                                    <div class="building__item-swiper swiper">\n' +
                        '                                        <div class="building__item-swiper-wrapper swiper-wrapper">' + photos + '</div>\n' +
                        '                                        <div class="building__item-scrollbar swiper-scrollbar"></div>\n' +
                        '                                    </div>\n' +
                        '                                    <div class="building__item-hashtag">\n' +
                        '                                        СЕМЕЙНЫЙ\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                                <div class="building__item-info">\n' +
                        '                                    <div class="building__item-desc">\n' +
                        '                                        <div class="building__item-name">' + val.name + '</div>\n' +
                        '                                        <div class="building__item-address">' + val.address + '</div>\n' +
                        '                                        <div class="building__item-price">\n' +
                        '                                            от\n' +
                        '                                            <b>' + val.price + '</b>\n' +
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '                                    <div class="building__item-lead">\n' +
                        '                                        <div class="building__item-lead-point">\n' +
                        '                                            <div class="icon">\n' +
                        '                                                <img src="/lands/img/icons/dashboard.png" alt="dashboard">\n' +
                        '                                            </div>\n' +
                        '                                            ' + val.layouts + '\n' +
                        '                                        </div>\n' +
                        '                                        <div class="building__item-lead-point">\n' +
                        '                                            <div class="icon">\n' +
                        '                                                <img src="/lands/img/icons/wide.png" alt="wide">\n' +
                        '                                            </div>\n' +
                        '                                            ' + val.size + '\n' +
                        '                                        </div>\n' +
                        '                                        <div class="building__item-lead-point">\n' +
                        '                                            <div class="icon">\n' +
                        '                                                <img src="/lands/img/icons/wave.png" alt="wave">\n' +
                        '                                            </div>\n' +
                        '                                            ' + val.to_sea + '\n' +
                        '                                        </div>\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </div>');
                });
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
});

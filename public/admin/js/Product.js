"use strict";
let DataArray = [];
let OtherDataArray =[];
// Массив для записи данных объектов комплекса
let ObjectsJSONArray =[];
let ObjectsApartmentLayoutImages =[];

// Список валют для цены в аккордеоне
var exchange_rates = [];

$('.other_photo_select').on('change', function () {
    var selectedValue = $(this).val();
    if (selectedValue == 'Да'){
        $('.other_photo').show();
    }else{
        $('.other_photo').hide()
        OtherDataArray =[];
    }
})

$(document).ready(function () {
    exchange_rates = function () {
        var tmp = null;
        $.ajax({
            async: false,
            url: `${window.location.origin}/api/exchange_rates/all`,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                tmp = data;
            },
            error: function(error){
                console.log('error is: ' + error + '\n');
                return error;
            }
        });
        return tmp;
    }();
    $("#other_photo_file").on('change keyup paste', function () {
        var numFiles = $('#other_photo_file')[0].files.length;

        for (var i = 0; i < numFiles; i++) {


            if ($('#other_photo_file')[0].files[i].size > 2000000){
                    alert('Вы привисили лимит  2mb')
            } else {
                let type =$('#other_photo_file')[0].files[i].type.split('/')[0]
                OtherDataArray.push($('#other_photo_file')[0].files[i]);
                var fileUrl = URL.createObjectURL($('#other_photo_file')[0].files[i]);


                $("#newDivqwe3").append(`
                            <div class="PhotoDiv3" style='overflow: visible;position: relative; width: 150px; height: 150px'>
                            <button type="button"  class="ixsButton3 " data-id="${OtherDataArray.length-1}" style='
                                        outline: none;
                                        border: none;
                                    position: relative;
                                    background-color: transparent;
                                    '></button>
                            <img class='sendPhoto' style='width: 150px; height: 150px' src='${fileUrl}'/>
                            </div>`);
            }
        }

        $(".ixsButton3").click(function (event) {
            event.preventDefault()
            let data_id = $(this).attr('data-id')
            $(this).parent('.PhotoDiv3').hide()
            OtherDataArray.splice(data_id,1,undefined)
            let data = OtherDataArray;


            let allUndefined = true;
            $.each(data, function(index, item) {
                if (typeof item !== "undefined") {
                    allUndefined = false;
                    return false;
                }
            });
            if (allUndefined) {
                $("#comment").removeAttr("disabled", 'disabled');
                $("#comment").css("display", 'block');
            }
        })
    });

});


// Если выбран комплекс, то добавляем модуль "добавления квартир/объектов"
$('.objects_module_select').on('change', function () {
    var selectedValue = $(this).val();
    if (selectedValue == 'Да'){
        $('#objects_module').show();
        console.log(selectedValue);
    }else{
        $('#objects_module').hide();
        ObjectsJSONArray = [];
    }
});


// Get Accordion
function getAccordion(id, exchange_rates) {
    var el = displayExchangeRatesSelect(exchange_rates, id);

    return "<div class='accordion' data-identificator='"+ id +"' id='accordion" + id + "'>"+
        "<div class='card'>"+
            "<div class='card-header' id='heading" + id + "'>"+
                "<h5 class='mb-0'>"+
                    "<p class='btn btn-link' data-toggle='collapse' data-target='#collapse" + id + "' aria-expanded='true' aria-controls='collapse" + id + "'>"+
                        "Объект #" + id +
                    "</p>"+
                    "<input name='layouts["+id+"][id]' type='hidden' value='new_"+id+"'>"+
                "</h5>"+
            "</div>"+
            "<div id='collapse" + id + "' class='collapse show' aria-labelledby='heading" + id + "' data-parent='#accordion" + id + "'>"+
                "<div class='card-body'>"+
                    "<div class='form-group' bis_skin_checked='1' style='display: block;'>"+
                        "<div class='form-group' bis_skin_checked='1'>"+
                            "<label for='add_building"+id+"'>Копрус</label>"+
                            "<input name='layouts["+id+"][building]' type='text' class='form-control' id='add_building"+id+"' placeholder='А'>"+
                        "</div>"+
                        "<div class='form-group d-flex' bis_skin_checked='1'>\n" +
                            "<div class='form-group row col-md-6' bis_skin_checked='1'>\n" +
                                "<label for='add_price"+id+"'>Цена</label>"+
                                "<input name='layouts["+id+"][price]' type='number' class='form-control' id='add_price"+id+"' placeholder='Цена' required>\n" +
                            "</div>\n" +
                            "<div class='form-group row col-md-6 ml-2' bis_skin_checked='1'>\n" +
                                "<label>Валюта</label>\n"+
                                el +
                            "</div>\n" +
                        "</div>\n" +
                        "<div class='form-group' bis_skin_checked='1'>"+
                            "<label for='add_size"+id+"'>Общая площадь (кв.м)</label>"+
                            "<input name='layouts["+id+"][total_size]' type='text' class='form-control' id='add_size"+id+"' placeholder='40'>"+
                        "</div>"+
                        "<div class='form-group' bis_skin_checked='1'>"+
                            "<label for='add_apartment_layout"+id+"'>Планировка</label>"+
                            "<input name='layouts["+id+"][number_rooms]' type='text' class='form-control' id='add_apartment_layout"+id+"' placeholder='1+1'>"+
                        "</div>"+
                        "<div class='form-group' bis_skin_checked='1'>"+
                            "<label for='add_floor"+id+"'>Этаж</label>"+
                            "<input name='layouts["+id+"][floor]' type='text' class='form-control' id='add_floor"+id+"' placeholder='5'>"+
                        "</div>"+
                        "<div class='form-group' bis_skin_checked='1'>\n" +
                            "<div class=\"card\">\n" +
                                "<div class=\"card-header d-flex align-content-center\">\n" +
                                    "<div class=\"form-main__label mr-2\" for=\"add_apartment_layout_image\">Прикрепить фотографии планировки</div>\n" +
                                    "<p class=\"btn btn-outline-primary layout_photo_add\" data-id=\""+ id +"\">Добавить фотографию планировки</p>\n" +
                                "</div>\n" +
                            "<div class=\"card-body row photo_parent_block\">\n" +
                                "<div class='form-group col-md-6 col-sm-12 photo_block' data-id=\"0\">\n" +
                                    "<p>Фото 0</p>\n" +
                                    "<label class=\"input-file\">\n" +
                                        "<span class=\"input-file-text form-control files_text\" type=\"text\">\n" +
                                            "Добавить фото\n" +
                                        "</span>\n" +
                                        "<input class=\"add_apartment_layout_image\" type=\"file\" value=\"\" name=\"layouts["+ id +"][photos][0][file]\" accept=\"image/*\" placeholder=\"\">\n" +
                                        "<input class=\"add_apartment_layout_id\" type=\"hidden\" value=\"new_0\" name=\"layouts["+ id +"][photos][0][id]\">\n" +
                                    "</label>\n" +
                                    "<input class=\"add_apartment_layout_name form-control mb-2\" type=\"text\" value=\"\" name=\"layouts["+ id +"][photos][0][name]\" placeholder=\"Название фото\">\n" +
                                    "<p class='d-flex btn btn-outline-danger delete_photo' onclick='deletePhoto(this);' data-identificator=\""+ id +"\">Удалить фото</p>\n" +
                                    "</div>\n" +
                                "</div>\n" +
                            "</div>\n" +
                        "</div>"+
                        "<p class='btn btn-outline-danger delete_accordion' onclick='deleteAccordion(this);' data-identificator='"+ id +"'>Удалить квартиру</p>"+
                    "</div>"+
                "</div>"+
            "</div>"+
        "</div>"+
    "</div>";
}

// Get Accordion
function getPhotoCard(layout_index, id) {
    return "<div class='form-group col-md-6 col-sm-12 photo_block' data-id='"+id+"'>\n" +
                "<p>Фото "+id+"</p>\n" +
                "<label class=\"input-file\">\n" +
                    "<span class=\"input-file-text form-control files_text\" type=\"text\">\n" +
                        "Добавить фото\n" +
                    "</span>\n" +
                    "<input class=\"add_apartment_layout_image\" type=\"file\" value=\"\" name=\"layouts["+layout_index+"][photos]["+id+"][file]\" accept=\"image/*\" placeholder=\"\">\n" +
                    "<input class=\"add_apartment_layout_id\" type=\"hidden\" value=\"new_"+id+"\" name=\"layouts["+layout_index+"][photos]["+id+"][id]\">\n" +
                "</label>\n" +
                "<input class=\"add_apartment_layout_name form-control mb-2\" type=\"text\" value=\"\" name=\"layouts["+layout_index+"][photos]["+id+"][name]\" placeholder=\"Название фото\">\n" +
                "<p class='d-flex btn btn-outline-danger delete_photo' onclick='deletePhoto(this);' data-identificator='"+layout_index+"'>Удалить фото</p>\n" +
            "</div>";
}

// function accordionOnChange(data) {
//     }
//
// // https://learn.javascript.ru/mutation-observer
// // Следим за изменениями в блоке #objects_module_field
// let observer = new MutationObserver(accordionOnChange);
// observer.observe(document.querySelector('#objects_module_field'), {
//     childList: true, // наблюдать за непосредственными детьми
//     subtree: true // и более глубокими потомками
// });

// function accordionsGetData() {
//     let accordions = document.querySelectorAll('.accordion');
//
//     ObjectsJSONArray = [];
//     ObjectsApartmentLayoutImages = [];
//
//     $.each(accordions, function (i) {
//         let file = document.querySelector('#accordion'+i+' input[type="file"]').files[0];
//
//         let object = {
//             building: $('#accordion'+i+' input[name="add_building"]').val(),
//             price: $('#accordion'+i+' input[name="add_price"]').val(),
//             size: $('#accordion'+i+' input[name="add_size"]').val(),
//             apartment_layout: $('#accordion'+i+' input[name="add_apartment_layout"]').val(),
//             floor: $('#accordion'+i+' input[name="add_floor"]').val(),
//             apartment_layout_image: (typeof file != "undefined" && file.size < 2000000) ? file.name : '',
//         };
//
//         // Кладём объект в массив
//         ObjectsJSONArray.push(object);
//
//         // Кладём файл в массив
//         if (typeof file != "undefined" && file.size < 2000000) {
//             ObjectsApartmentLayoutImages.push(file);
//         }
//     });
// }

// objects_module
$('#object_module_add').on('click', function () {
    let accordionCount = $('.accordion').length;
    $('#objects_module_field').append(getAccordion(accordionCount, exchange_rates));

    $('.layout_photo_add').on('click', function () {
        var data_id = $(this).attr('data-id');
        var accordion = $('#accordion' + data_id);
        var photo_parent_block = accordion.find('.photo_parent_block')

        let photo_parent_block_length = photo_parent_block.children().length;
        photo_parent_block.append(getPhotoCard(data_id, photo_parent_block_length));
    });

    $('.add_apartment_layout_image').on('change', function() {
        let file = this.files;
        if (file[0].size > 2000000) {
            $(this).closest('.input-file').find('.files_text').html("Максимальный размер фотографии не должен превышать 2 Мб");
        } else {
            $(this).closest('.input-file').find('.files_text').html(file[0].name);
        }
    });
});

// objects_module
$('.layout_photo_add').on('click', function () {
    var data_id = $(this).attr('data-id');
    var accordion = $('#accordion'+data_id);
    var photo_parent_block = accordion.find('.photo_parent_block')

    let photo_parent_block_length = photo_parent_block.children().length;
    photo_parent_block.append(getPhotoCard(data_id, photo_parent_block_length));

    $('.add_apartment_layout_image').on('change', function() {
        let file = this.files;
        if (file[0].size > 2000000) {
            $(this).closest('.input-file').find('.files_text').html("Максимальный размер фотографии не должен превышать 2 Мб");
        } else {
            $(this).closest('.input-file').find('.files_text').html(file[0].name);
        }
    });
});


$("#file").on('change keyup paste', function () {
    var numFiles = $('#file')[0].files.length;
    let allUndefined = DataArray;
    let myArray = DataArray;



    let filteredArray = myArray.filter(item => item !== undefined);
    let allLenght = numFiles + filteredArray.length;

    $("#comment").attr("disabled", 'disabled');
    $("#comment").css("display", 'none');

    var file = $('#file')[0].files.length;
    let time =  $.now();
    for (var i = 0; i < file; i++) {
        if ($("#file")[0].files[i].size > 2000000){
            alert('Вы привисили лимит  2mb')
        } else {
            let type = $("#file")[0].files[i].type.split('/')[0]
            DataArray.push($("#file")[0].files[i]);

            // Получаем список категорий
            var photo_categories = function () {
                var tmp = null;
                $.ajax({
                    async: false,
                    url: `${window.location.origin}/api/photo_categories/filter_params`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        tmp = data;
                    },
                    error: function(error){
                        console.log('error is: ' + error + '\n');
                        return error;
                    }
                });
                return tmp;
            }();

            var createdEl = null;

            if (type == 'image') {
                var fileUrl = URL.createObjectURL($("#file")[0].files[i]);
                var displaySelect = displayPhoto(photo_categories, DataArray.length-1);

                createdEl = $("#newDivqwe").append(`
                    <div class="PhotoDiv" style='overflow: visible;position: relative; width: 150px; height: 150px'>
                        <button class="ixsButton" data-id="new_${DataArray.length-1}" style='
                                    outline: none;
                                    border: none;
                                position: relative;
                                background-color: transparent;
                                '></button>
                        <img class='sendPhoto' style='width: 150px; height: 150px' src='${fileUrl}'/>
                        ${displaySelect}
                    </div>`);
            } else {
                createdEl = $("#newDivqwe").append("  " +
                    "" +
                    "  <div class='PhotoDiv' style='overflow: visible;position: relative; width: 150px; height: 150px'>\n   " +
                    "                     <button class=\"ixsButton\" data-id="+`${DataArray.length-1}`+" style='\n                                position: relative;\n                                    outline: none;\n                                    border: none;\n                                position: relative;\n                                '></button>" +
                    "<i class=\"fileType fa fa-file fa-3x\" aria-hidden=\"true\"> </i></div>")
            }
        }
    }
    $(".ixsButton").click(function (event) {
        event.preventDefault()
        let data_id = $(this).attr('data-id')
        $(this).parent('.PhotoDiv').remove()
        DataArray.splice(data_id,1,undefined)
        let data = DataArray;

        let allUndefined = true;
        $.each(data, function(index, item) {
            if (typeof item !== "undefined") {
                allUndefined = false;
                return false;
            }
        });
        if (allUndefined) {
            $("#comment").removeAttr("disabled", 'disabled');
            $("#comment").css("display", 'block');
        }
    })

});

$('#create_product').on('submit',function(e) {
    e.preventDefault(); // Prevent the default form submission
    let formData = new FormData(this);

    let filteredArray = DataArray.filter(item => item !== undefined);
    let allLenght = filteredArray.length;

    let OtherDataArrayOtherDataArray = OtherDataArray.filter(item => item !== undefined);


    if (allLenght > 0){
        if (OtherDataArrayOtherDataArray.length > 0){
            OtherDataArrayOtherDataArray.forEach(function(value_asd, index_asd) {
                formData.append('other_photo_two[]', value_asd);
            });
        }

        filteredArray.forEach(function(value, index) {
            formData.append('photo[]', value);
        });

        let objects_count = document.querySelectorAll('.accordion').length;
        formData.append('objects_count', objects_count);

        // console.log("----- formdata -----");
        // for (let [key, value] of formData) {
        //     console.log(`${key} - ${value}`)
        // }
        // console.log("--- end formdata ---");


        var token = $('meta[name="_token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        // Вывод информации при отправке формы
        for (var pair of formData.entries()) {
            console.log(pair[0]+ ', ' + pair[1]);
        }

        $('.submit_button').hide();
        $('.lds-ellipsis').show();

        $.ajax({
            url:  $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('ress--------------',response)
                alert('Добавления успешно завершено');
                window.location.replace(response.url);
            },
            error: function(xhr, status, error) {
                $('.lds-ellipsis').hide();
                $('.submit_button').show();
                alert('Что то пошло не так свяжитесь с разработчиком')
            }
        });
    } else {
        alert('Выберите фотографию')
    }
});


$('#update_product').on('submit',function(e) {
    e.preventDefault(); // Prevent the default form submission
    var formData = new FormData(this);
    let filteredArray = DataArray.filter(item => item !== undefined);
    let allLenght = filteredArray.length;

    filteredArray.forEach(function(value, index) {
        formData.append(`photo[${index}]`, value);
    });

    let objects_count = document.querySelectorAll('.accordion').length;
    formData.append('objects_count', objects_count);

    let OtherDataArrayOtherDataArray = OtherDataArray.filter(item => item !== undefined);

    if (OtherDataArrayOtherDataArray.length > 0){
        OtherDataArrayOtherDataArray.forEach(function(value_asd, index_asd) {
            formData.append('other_photo_two[]', value_asd);
        });
    }

    var token = $('meta[name="_token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    $('.submit_button').hide();
    $('.lds-ellipsis').show();

    // Вывод информации при отправке формы
    for (var pair of formData.entries()) {
        console.log(pair[0]+ ':' + pair[1]);
    }

    $.ajax({
        url:  $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log('ress--------------',response)
            console.log('option_id = ' + formData.get("option_id"));
            alert('Редактирование успешно завершено');
            window.location.replace(response.url);
        },
        error: function(xhr, status, error) {
            $('.lds-ellipsis').hide();
            $('.submit_button').show();
            alert('Что то пошло не так свяжитесь с разработчиком')
        }
    });
});

function displayPhoto(data, select_id) {
    var select = `<select name="photo_categories[new_${select_id}]" style="width: 150px;"><option value="0">Без категории</option>`;
    $.each(data, function (key, value) {
        if ((data.length - 1) === key) {
            select += `<option value="${value.id}">${value.name}</option></select>`;
        } else {
            select += `<option value="${value.id}">${value.name}</option>`;
        }
    })

    return select;
}

function displayExchangeRatesSelect(data, select_id) {
    var select = `<select class='form-control' name="layouts[${select_id}][price_code]" style='color: #e2e8f0'>`;
    $.each(data, function (key, value) {
        if (value.name == "EUR") {
            select += `<option value="${value.name}" selected>${value.name}</option>`;
        } else {
            select += `<option value="${value.name}">${value.name}</option>`;
        }

        if ((data.length - 1) === key) {
            select += `</select>`;
        }
    });

    return select;
}

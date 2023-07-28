
let DataArray = [];
let OtherDataArray =[];
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
    $("#other_photo_file").on('change keyup paste', function () {
        var numFiles = $('#other_photo_file')[0].files.length;

        for (var i = 0; i < numFiles; i++) {


            if ($('#other_photo_file')[0].files[i].size > 2000000){
                    alert('Вы привисили лимит  2mb')
            }else{




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

// var URL = 'https://jcelectronics.justcode.am/admin/';
$(document).ready(function () {
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
            }else {


            let type = $("#file")[0].files[i].type.split('/')[0]
            DataArray.push($("#file")[0].files[i]);

            if (type == 'image') {
                var fileUrl = URL.createObjectURL($("#file")[0].files[i]);
                $("#newDivqwe").append(`
                        <div class="PhotoDiv" style='overflow: visible;position: relative; width: 150px; height: 150px'>
                        <button  class="ixsButton" data-id="${DataArray.length-1}" style='
                                    outline: none;
                                    border: none;
                                position: relative;
                                background-color: transparent;
                                '></button>
                        <img class='sendPhoto' style='width: 150px; height: 150px' src='${fileUrl}'/>
                        </div>`);
            } else {
                $("#newDivqwe").append("  " +
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
            $(this).parent('.PhotoDiv').hide()
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
});

    $('#create_product').on('submit',function(e) {
        e.preventDefault(); // Prevent the default form submission
        var formData = new FormData(this);
        let filteredArray = DataArray.filter(item => item !== undefined);
        let allLenght = filteredArray.length;

        let OtherDataArrayOtherDataArray = OtherDataArray.filter(item => item !== undefined);





        if (allLenght >0 ){


            if (OtherDataArrayOtherDataArray.length > 0){
                OtherDataArrayOtherDataArray.forEach(function(value_asd, index_asd) {
                    formData.append('other_photo_two[]', value_asd);
                });
            }


            filteredArray.forEach(function(value, index) {
                formData.append('photo[]', value);
            });


            var token = $('meta[name="_token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
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
        }else {
            alert('Выберите фотографию')
        }



    });

$('#update_product').on('submit',function(e) {
    e.preventDefault(); // Prevent the default form submission
    var formData = new FormData(this);
    let filteredArray = DataArray.filter(item => item !== undefined);
    let allLenght = filteredArray.length;

        filteredArray.forEach(function(value, index) {
            formData.append('photo[]', value);
        });


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
        $.ajax({
            url:  $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('ress--------------',response)
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
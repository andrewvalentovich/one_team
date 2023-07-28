
$(".country_select").on('change',function (event) {
    var val = $(this).val()
    var formData = {
        country_id:  val,
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: "POST",
        url: $(this).attr('data_url'),
        data: formData,
        dataType: "json",
        encode: true,
        success:function (response) {
                if (response.data.length > 0){
                    var select = $('select[name="city_id"]');
                    select.empty(); // Clear any existing options

                    // Iterate through the response data and append options to the select element
                   let i = 0;
                    $.each(response.data, function(index, city) {
                        i++
                        if (i == 1) {
                            var option = $('<option selected></option>')
                                .attr('value', city.id)
                                .text(city.name);
                        }else {
                            var option = $('<option ></option>')
                                .attr('value', city.id)
                                .text(city.name);
                        }
                        select.append(option);
                    });
                    $('.hide_city_select').show();
            }else {
                    var select = $('select[name="city_id"]');
                    select.empty(); // Clear any existing options
                    $('.hide_city_select').hide();
                }
        },
    });

});






$(document).ready(function () {
    $(".photoModal").click(function (event) {
       var src = $(this).attr("src");
        $('.addMOdal').attr('src', src);
    });
});

$(document).ready(function () {
    $(".clickoption").click(function (event) {

        var additional = $(this).html();
        var data_id = $(this).attr("data-id");
        let  a =  $('.asd');

        $('<input>').attr({
            type: 'hidden',
            id: 'foo',
            name: 'yuix['+data_id +'^'+additional+']',
        }).appendTo('form');
        $('.asd').val();
        $( ".additional" ).append( "<li style='color: #FFB800'>"+additional+"</li>" );

        $(this).css('display', 'none');
    });
});

$(document).ready(function () {
    $(".deleteadditional").click(function (event) {
     
        var formData = {
            additional_id:  $(this).attr("data-id"),
        };
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: "POST",
            url: "https://steach.justcode.am/admin/deleteadditional",
            data: formData,
            dataType: "json",
            encode: true,
            success:function (response) {
                if(response.status == true){
                    window.location.reload(true);
                }
            },
        });
        event.preventDefault();
    });
});


















$(function () {

    $('.input-images-1').imageUploader();

    let preloaded = [

    ];


    $('.input-images-2').imageUploader({
        preloaded: preloaded,
        imagesInputName: 'photos',
        preloadedInputName: 'old'
    });



    $('form').on('submit', function (event) {

        // Stop propagation
        //event.preventDefault();
        event.stopPropagation();


        // Get some vars
        let $form = $(this),
            $modal = $('.modal');

        // Set name and description
        $modal.find('#display-name span').text($form.find('input[id^="name"]').val());
        $modal.find('#display-description span').text($form.find('input[id^="description"]').val());

        // Get the input file
        let $inputImages = $form.find('input[name^="images"]');
        if (!$inputImages.length) {
            $inputImages = $form.find('input[name^="photos"]')
        }

        // Get the new files names
        let $fileNames = $('<ul>');
        for (let file of $inputImages.prop('files')) {
            $('<li>', {text: file.name}).appendTo($fileNames);
            
        }

        // Set the new files names
        $modal.find('#display-new-images').html($fileNames.html());

        // Get the preloaded inputs
        let $inputPreloaded = $form.find('input[name^="old"]');
        if ($inputPreloaded.length) {

            // Get the ids
            let $preloadedIds = $('<ul>');
            for (let iP of $inputPreloaded) {
                $('<li>', {text: '#' + iP.value}).appendTo($preloadedIds);
            }

            // Show the preloadede info and set the list of ids
            $modal.find('#display-preloaded-images').show().html($preloadedIds.html());

        } else {
            // Hide the preloaded info
            $modal.find('#display-preloaded-images').hide();

        }

        // Show the modal
        $modal.css('visibility', 'visible');
    });

    // Input and label handler
    $('input').on('focus', function () {
        $(this).parent().find('label').addClass('active')
    }).on('blur', function () {
        if ($(this).val() == '') {
            $(this).parent().find('label').removeClass('active');
        }
    });



    // Sticky menu
    let $nav = $('nav'),
        $header = $('header'),
        offset = 4 * parseFloat($('body').css('font-size')),
        scrollTop = $(this).scrollTop();

    // Initial verification
    setNav();

    // Bind scroll
    $(window).on('scroll', function () {
        scrollTop = $(this).scrollTop();
        // Update nav
        setNav();
    });

    function setNav() {
        if (scrollTop > $header.outerHeight()) {
            $nav.css({position: 'fixed', 'top': offset});
        } else {
            $nav.css({position: '', 'top': ''});
        }
    }
});


    $(document).ready(function () {
        $(".deletePhoto").click(function (event) {
            var formData = {
                photo_id:  $(this).attr("data-id"),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type: "POST",
                url: "https://steach.justcode.am/admin/deletephoto",
                data: formData,
                dataType: "json",
                encode: true,
                success:function (response) {
                    if(response.status == true){
                        window.location.reload(true);
                    }
                },
            });
            event.preventDefault();
        });
    });



function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blahas').show()
            $('#blahas').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
$("#file-logos").on("change", function () {
    readURL(this);
});


function readURL2(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blaha').show()
            $('#blaha').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
$("#file-logo").on("change", function () {
    readURL2(this);
});




// $( ".chanje" ).change(function() {
//     $('.opensave').show();
// });
//
// $( ".deletbutton" ).click(function() {
//     let img_get_src =  $(this).parent().parent().children('.card-img-top').attr('src');
//
//     $(".atag").attr("href", "http://80.78.246.59/Refectio/public/admin/deleteProductImage/image_id="+$(this).attr("data-id"))
//
//     $(".modalimg").attr("src", img_get_src);
//
//
// });


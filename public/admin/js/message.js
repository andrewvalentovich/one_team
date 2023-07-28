
const FullUrl = 'https://steach.justcode.am/';

$(document).on('keydown','#inputChat',function(event){
    if(event.keyCode == 13) {
        $('#chatSubmit').submit();

    }
});
$(document).ready(function () {
    $("#chatSubmit").submit(function (event) {
        event.preventDefault();
        var token = $('meta[name="csrf-token"]').attr('content');

        // let  file = $('#file')[0].files;
        $('#uploadfile').text(' ');
        $('.form-control').removeAttr('disabled');
        $('.form-control').removeAttr('background-color','#2a3038');


        //
        // var formData = {
        //     receiver_id: $("input[name='receiver_id']").val(),
        //     message: $("input[name='message']").val(),
        //     file: $('#fileMessage')[0].files[0]
        // };

        let file = $("#fileMessage")[0].files[0];
        file = file;


        let message = $("textarea[name='message']").val();
        let receiver_id = $("input[name='receiver_id']").val();
        let formData = new FormData();
        formData.append('file', file);


         formData.append('file',  file);
        formData.append('message', message);
        formData.append('receiver_id', receiver_id);




        let main_div = $('.chatContainerScroll');


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: "POST",
            url: FullUrl+'admin/createMessage',
            data: formData,
            dataType: "json",
            processData: false, // Не позволять jQuery обрабатывать мой file_obj
            contentType: false, // Не позволять jQuery устанавливать запрошенный тип контента
            cache: false,
            encode: true,
            success:function (response) {
                if(response.status == true){

                    $(document).ready(function(){
                        $('.chat-container').animate({
                            scrollTop: $('.chat-container')[0].scrollHeight}, 10);
                    });

                    $('.form-control').val('');
                    $("#fileMessage").remove();
                    $('<input style="display: none"> ').attr({
                        type: 'file',

                        name: 'file',
                        id: 'fileMessage',
                        value: '',
                    }).appendTo('#chatSubmit');

                    if(response.data.data.file == null){
                        main_div.append(`<li class="chat-right">
                                            <div class="chat-hour"> ${response.data.data.created_at}  </div>
                                            <div class="chat-text" style="background: #585f66  !important;  align-items: center !important;  display: flex;"> <p style="">${ response.data.data.message }</p>                                             </div>
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${response.data.data.photo}" alt="Retail Admin">
                                                <div class="chat-name">${response.data.data.name}</div>
                                            </div>
                                        </li>`)
                    }else{
                         let fileType = response.data.data.file.split(".");
                        let type = fileType[fileType.length-1]

                         if(type == 'jpg' || type == 'png' || type == 'gif' || type == 'jpeg' || type == 'tif' || type == 'tiff'){
                             main_div.append(`<li class="chat-right">
                                            <div class="chat-hour"> ${response.data.data.created_at}  </div>
                                            <div class="chat-text" style="background: none !important;  align-items: center !important;  display: flex;">
                                            <a href="https://steach.justcode.am/uploads/${ response.data.data.file }" download><img src="https://steach.justcode.am/uploads/${ response.data.data.file }" style="height: 130px;
    width: 130px;"></img>  </a>                                            </div>
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${response.data.data.photo}" alt="Retail Admin">
                                                <div class="chat-name">${response.data.data.name}</div>
                                            </div>
                                        </li>`)
                         }else{
                             main_div.append(`<li class="chat-right">
                                            <div class="chat-hour"> ${response.data.data.created_at}  </div>
                                            <div class="chat-text" style="background: none !important;  align-items: center !important;  display: flex;">
                                            <a href="https://steach.justcode.am/uploads/${ response.data.data.file }" download><img src="https://steach.justcode.am/icons8-file-download-96.png" style="height: 130px;
    width: 130px;"></img>  </a>                                            </div>
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${response.data.data.photo}" alt="Retail Admin">
                                                <div class="chat-name">${response.data.data.name}</div>
                                            </div>
                                        </li>`)
                         }


                    }
                }
            },
        });

        event.preventDefault();
    });
});


$(document).ready(function () {
    $(".room_id").click(function (event) {
        event.preventDefault();
        let main_div = $('.chatContainerScroll');

        main_div.html(' ');
        let surname = $(this).children().children().find(".surname").val();
        let name = $(this).children().children().find(".name").html();
        $('.users').css('background-color','rgb(25 28 36)');
        $(this).css('background-color','#285687');
        $('.countNewMessage').text(' ');
        $('.SubmitUSer').css('display','none');
        $('.form-control').val(''),
            $("input[name='receiver_id']").remove(),
            $("input[name='receiver_id']").val(' '),
        $('.header_name').html(name+" "+surname)

        var formData = {
            data_id:  $(this).attr("data-id"),
        };


        $(this).children().children().find(".asdasd").css('display','none')
        // document.cookie = "data_id="+$(this).attr("data-id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            type: "post",
            url:  FullUrl+"admin/getRoomId",
            data: formData,
            dataType: "json",
            encode: true,
            success:function (response) {
                if(response.status == true){
                    $('.countNewMessage').text(response.sum);
                    $('.chat-container').css('display', 'block');
                    $(this).children().find('.row_count').css('display', 'none');
                     $(this).children().children().find('.asdasd').css('display', 'none');

                    $('.selected-user').css('display', 'block');
                    $(document).ready(function(){
                        $('.chat-container').animate({

                            scrollTop: $('.chat-container')[0].scrollHeight}, 10);
                    });


                    $.each(response.data, function( index, value ) {

                        if(value.receiver_id != 1){
                            if(value.message == null){
                                let fileType =value.file.split(".");
                                let type = fileType[fileType.length-1]

                                if(type == 'jpg' || type == 'png' || type == 'gif' || type == 'jpeg' || type == 'tif' || type == 'tiff') {
                                    main_div.append(`<li class="chat-right">
                                            <div class="chat-hour"> ${value.time}  </div>
                                       
                                            <div class="chat-text" style="background: none !important; align-items: center !important;  display: flex;" >
                                          <a href="https://steach.justcode.am/uploads/${value.file}" download><img style="    height: 130px;  width: 130px;" src="https://steach.justcode.am/uploads/${value.file}"></img>  </a>                                              </div>
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${value.sender_message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${value.sender_message.name}</div>
                                            </div>
                                        </li>`)
                                }else{
                                    main_div.append(`<li class="chat-right">
                                            <div class="chat-hour"> ${value.time}  </div>
                                       
                                            <div class="chat-text" style="background: none !important; align-items: center !important;  display: flex;" >
                                          <a href="https://steach.justcode.am/uploads/${value.file}" download><img style="    height: 130px;  width: 130px;" src="https://steach.justcode.am/icons8-file-download-96.png"></img>  </a>                                              </div>
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${value.sender_message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${value.sender_message.name}</div>
                                            </div>
                                        </li>`)
                                }
                            }else{
                                main_div.append(`<li class="chat-right">
                                            <div class="chat-hour"> ${value.time}  </div>                               
                                            <div class="chat-text" style="background: #585f66   !important; align-items: center !important;  display: flex;" > <p>${ value.message }</p>                                             </div>
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${value.sender_message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${value.sender_message.name}</div>
                                            </div>
                                        </li>`)
                            }

                        }else{
                            if(index < 1){
                                $('<input>').attr({
                                    type: 'hidden',
                                    name: 'receiver_id',
                                    value: value.sender_message.id
                                }).appendTo('#chatSubmit');
                            }
                            if(value.message == null){
                                let fileType  = value.file.split(".");

                                let type = fileType[fileType.length-1]

                                if(type == 'jpg' || type == 'png' || type == 'gif' || type == 'jpeg' || type == 'tif' || type == 'tiff') {
                                    main_div.append(`<li class="chat-left">
 <a href="https://steach.justcode.am/admin/OnePageGetNewCustomers/user_id=${value.sender_message.id}">
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${value.sender_message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${value.sender_message.name}</div>
                                            </div>
                                            </a>
                                            <div class="chat-text" style="background: none !important;  align-items: center !important;  display: flex;">
                                     <a href="https://steach.justcode.am/uploads/${value.file}" download=""><img src="https://steach.justcode.am/uploads/${value.file}" style="    height: 130px;  width: 130px;"></img></a>        
                                              </div>
                                            <div class="chat-hour">${value.time}  </div>
                                        </li>`)
                                }else{
                                    main_div.append(`<li class="chat-left">
 <a href="https://steach.justcode.am/admin/OnePageGetNewCustomers/user_id=${value.sender_message.id}">
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${value.sender_message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${value.sender_message.name}</div>
                                            </div>
                                            </a>
                                            <div class="chat-text" style="background: none !important;  align-items: center !important;  display: flex;">
                                     <a href="https://steach.justcode.am/uploads/${value.file}" download=""><img src="https://steach.justcode.am/icons8-file-download-96.png" style="    height: 130px;  width: 130px;"></img></a>        
                                              </div>
                                            <div class="chat-hour">${value.time}  </div>
                                        </li>`)
                                }
                            }else{

                                main_div.append(`<li class="chat-left">
 <a href="https://steach.justcode.am/admin/OnePageGetNewCustomers/user_id=${value.sender_message.id}">
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${value.sender_message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${value.sender_message.name}</div>
                                            </div>
                                            </a>
                                            <div class="chat-text" style="background: #285687 !important;  align-items: center !important;  display: flex;"><p>${value.message}</p> 
                                              </div>
                                            <div class="chat-hour">${value.time}  </div>
                                        </li>`)
                            }
                        }
                    });
                }
            },
        });

    });
});



    Pusher.logToConsole = false;




var pusher = new Pusher('b2c068781f9059b3be04', {
    cluster: 'ap2'
});

var channel = pusher.subscribe('newMessage');

channel.bind('pusher:subscription_succeeded', function(members) {
    channel.bind("App\\Events\\NewMessageEvent", function(data) {

        $('.countNewMessage').text(' ');
        $('.countNewMessage').text(data.message.sum);


         console.log(data);

        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', 'https://steach.justcode.am/iphone_notification.mp3');
        audioElement.play();



        if(data.message.sender_id == $("input[name='receiver_id']").val()){
            let main_div = $('.chatContainerScroll');

            $(document).ready(function(){
                $('.chat-container').animate({
                    scrollTop: $('.chat-container')[0].scrollHeight}, 10);
            });


            if(data.message.file == null){
                main_div.append(`<li class="chat-left">
                                         <a href="https://steach.justcode.am/admin/OnePageGetNewCustomers/user_id=${data.message.sender_id}">
                                         <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${data.message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${data.message.name}</div>
                                            </div>
                                            </a>   
                                            <div class="chat-text" style="background: #285687 !important; align-items: center !important;  display: flex;"> <p >${data.message.message}</p> 
                                              </div>
                                            <div class="chat-hour">${data.message.time}  </div>
                                        </li>`)
            }else{
                let  fileType = data.message.file.split(".");

                let type = fileType[fileType.length-1]



                if(type == 'jpg' || type == 'png' || type == 'gif' || type == 'jpeg' || type == 'tif' || type == 'tiff') {
                main_div.append(`<li class="chat-left">
                                <a href="https://steach.justcode.am/admin/OnePageGetNewCustomers/user_id=${data.message.sender_id}">
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${data.message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${data.message.name}</div>
                                            </div>
                                            </a>
                                            <div class="chat-text" style="background: none !important; align-items: center !important;  display: flex;">
                                          <a href="https://steach.justcode.am/uploads/${data.message.file}" download><img style="    height: 130px;
    width: 130px;" src="https://steach.justcode.am/uploads/${data.message.file}"></img> </a>   
                                              </div>
                                            <div class="chat-hour">${data.message.time}  </div>
                                        </li>`)
            }else{
                    main_div.append(`<li class="chat-left">
                                <a href="https://steach.justcode.am/admin/OnePageGetNewCustomers/user_id=${data.message.sender_id}">
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${data.message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${data.message.name}</div>
                                            </div>
                                            </a>
                                            <div class="chat-text" style="background: none !important; align-items: center !important;  display: flex;">
                                          <a href="https://steach.justcode.am/uploads/${data.message.file}" download><img style="    height: 130px;
    width: 130px;" src="https://steach.justcode.am/icons8-file-download-96.png"></img> </a>   
                                              </div>
                                            <div class="chat-hour">${data.message.time}  </div>
                                        </li>`)
                }
            }


        }
    });

});




$(document).on('change','#fileMessage',function(){
    var thisval = $(this).val().replace(/C:\\fakepath\\/i, '');
    $('#uploadfile').text(thisval);
    $('.form-control').val('');
    $('.form-control').attr("disabled", 'disabled');
    $('.form-control').css('background-color','black');
});


$('#someInput').on('input', function() {
    document.getElementsByClassName("submitSearch").clicked == true;
    var formData = {
        name:  $(this).val(),
    };

        let main_div = $('.users-container');
        main_div.html(' ');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        type: "POST",
        url: FullUrl+"admin/SearchLeftUsers",
        data: formData,
        dataType: "json",
        encode: true,
        success:function (response) {
            if(response.status == true){

                $(document).ready(function () {
                    $(".room_id").click(function (event) {
                        event.preventDefault();
                        let main_div = $('.chatContainerScroll');

                        main_div.html(' ');
                        let surname = $(this).children().children().find(".surname").val();
                        let name = $(this).children().children().find(".name").html();
                        $('.users').css('background-color','rgb(25 28 36)');
                        $(this).css('background-color','#285687');
                        $('.countNewMessage').text(' ');
                        $('.SubmitUSer').css('display','none');
                        $('.form-control').val(''),
                            $("input[name='receiver_id']").remove(),
                            $("input[name='receiver_id']").val(' '),
                            $('.header_name').html(name+" "+surname)

                        var formData = {
                            data_id:  $(this).attr("data-id"),
                        };


                        $(this).children().children().find(".asdasd").css('display','none')
                        // document.cookie = "data_id="+$(this).attr("data-id");
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            type: "post",
                            url:  FullUrl+"admin/getRoomId",
                            data: formData,
                            dataType: "json",
                            encode: true,
                            success:function (response) {
                                if(response.status == true){
                                    $('.countNewMessage').text(response.sum);
                                    $('.chat-container').css('display', 'block');
                                    $(this).children().find('.row_count').css('display', 'none');
                                    $(this).children().children().find('.asdasd').css('display', 'none');

                                    $('.selected-user').css('display', 'block');
                                    $(document).ready(function(){
                                        $('.chat-container').animate({

                                            scrollTop: $('.chat-container')[0].scrollHeight}, 10);
                                    });


                                    $.each(response.data, function( index, value ) {

                                        if(value.receiver_id != 1){
                                            if(value.message == null){
                                                let fileType =value.file.split(".");

                                                let type = fileType[fileType.length-1]

                                                if(type == 'jpg' || type == 'png' || type == 'gif' || type == 'jpeg' || type == 'tif' || type == 'tiff') {
                                                    main_div.append(`<li class="chat-right">
                                            <div class="chat-hour"> ${value.time}  </div>
                                       
                                            <div class="chat-text" style="background: none !important; align-items: center !important;  display: flex;" >
                                          <a href="https://steach.justcode.am/uploads/${value.file}" download><img style="    height: 130px;  width: 130px;" src="https://steach.justcode.am/uploads/${value.file}"></img>  </a>                                              </div>
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${value.sender_message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${value.sender_message.name}</div>
                                            </div>
                                        </li>`)
                                                }else{
                                                    main_div.append(`<li class="chat-right">
                                            <div class="chat-hour"> ${value.time}  </div>
                                       
                                            <div class="chat-text" style="background: none !important; align-items: center !important;  display: flex;" >
                                          <a href="https://steach.justcode.am/uploads/${value.file}" download><img style="    height: 130px;  width: 130px;" src="https://steach.justcode.am/icons8-file-download-96.png"></img>  </a>                                              </div>
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${value.sender_message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${value.sender_message.name}</div>
                                            </div>
                                        </li>`)
                                                }
                                            }else{
                                                main_div.append(`<li class="chat-right">
                                            <div class="chat-hour"> ${value.time}  </div>                               
                                            <div class="chat-text" style="background: #585f66   !important; align-items: center !important;  display: flex;" > <p>${ value.message }</p>                                             </div>
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${value.sender_message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${value.sender_message.name}</div>
                                            </div>
                                        </li>`)
                                            }

                                        }else{
                                            if(index < 1){
                                                $('<input>').attr({
                                                    type: 'hidden',
                                                    name: 'receiver_id',
                                                    value: value.sender_message.id
                                                }).appendTo('#chatSubmit');
                                            }
                                            if(value.message == null){
                                                let fileType =value.file.split(".");
                                                let type = fileType[fileType.length-1]

                                                if(type == 'jpg' || type == 'png' || type == 'gif' || type == 'jpeg' || type == 'tif' || type == 'tiff') {
                                                    main_div.append(`<li class="chat-left">
 <a href="https://steach.justcode.am/admin/OnePageGetNewCustomers/user_id=${value.sender_message.id}">
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${value.sender_message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${value.sender_message.name}</div>
                                            </div>
                                            </a>
                                            <div class="chat-text" style="background: none !important;  align-items: center !important;  display: flex;">
                                     <a href="https://steach.justcode.am/uploads/${value.file}" download=""><img src="https://steach.justcode.am/uploads/${value.file}" style="    height: 130px;  width: 130px;"></img></a>        
                                              </div>
                                            <div class="chat-hour">${value.time}  </div>
                                        </li>`)
                                                }else{
                                                    main_div.append(`<li class="chat-left">
 <a href="https://steach.justcode.am/admin/OnePageGetNewCustomers/user_id=${value.sender_message.id}">
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${value.sender_message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${value.sender_message.name}</div>
                                            </div>
                                            </a>
                                            <div class="chat-text" style="background: none !important;  align-items: center !important;  display: flex;">
                                     <a href="https://steach.justcode.am/uploads/${value.file}" download=""><img src="https://steach.justcode.am/icons8-file-download-96.png" style="    height: 130px;  width: 130px;"></img></a>        
                                              </div>
                                            <div class="chat-hour">${value.time}  </div>
                                        </li>`)
                                                }
                                            }else{

                                                main_div.append(`<li class="chat-left">
 <a href="https://steach.justcode.am/admin/OnePageGetNewCustomers/user_id=${value.sender_message.id}">
                                            <div class="chat-avatar">
                                                <img src="https://steach.justcode.am/uploads/${value.sender_message.photo}" alt="Retail Admin">
                                                <div class="chat-name">${value.sender_message.name}</div>
                                            </div>
                                            </a>
                                            <div class="chat-text" style="background: #285687 !important;  align-items: center !important;  display: flex;"><p>${value.message}</p> 
                                              </div>
                                            <div class="chat-hour">${value.time}  </div>
                                        </li>`)
                                            }
                                        }
                                    });
                                }
                            },
                        });

                    });
                });
                // console.log(response.data)
                $.each(response.data, function( index, value ) {
                    main_div.html(' ');
                   $.each(value , function (index, res) {
                      main_div.append(`
                                    <ul  class="users room_id" data-id="${res.room_id}">
                                        <li  class="person" data-chat="person1" >
                                            <div  style="    display: flex;    align-items: center;    justify-content: space-between;">
                                                <div>
                                            <div  class="user">
                                                <img src="https://steach.justcode.am/uploads/${res.user_image}" alt="Retail Admin">
                                            </div>
                                            <p class="name-time">
                                                <span class="name">${res.user_name}</span>
                                                <span class="name">${res.surname}</span>
                                                <input value="${res.surname}" type="hidden" class="surname">
                                              
                                            </p>
                                                </div>
                                               <div class="asdasd" style="background-color: #ee1133; border-radius: 50px; width: 25px; display: block;">
                                                <div class="row_count">
                                                <span  style="display: flex; font-family: system-ui;   justify-content: center;">${res.review}</span>
                                                        </div>
                                                </div>
                                            </div>

                                        </li>
                                    </ul>
                      `)
                       // if(index < 2){
                       //     if(res.review > 0){
                       //         let users = $('.asdasd');
                       //         users.append(`
                       //
                       //                                 `)
                       //     }
                       // }

                   })
                });
            }
        },
    });
    event.preventDefault();
});
$(document).ready(function () {
    $('.selected-user').css('display', 'block');
    $(document).ready(function(){
        $('.chat-container').animate({

            scrollTop: $('.chat-container')[0].scrollHeight}, 10);
    });
});
// let DataArray = [];
// // var URL = 'https://jcelectronics.justcode.am/admin/';
// $(document).ready(function () {
//     $("#file").on('change keyup paste', function () {
//         var numFiles = $('input[type="file"]')[0].files.length;
//         let allUndefined = DataArray;
//         let myArray = DataArray;
//         let filteredArray = myArray.filter(item => item !== undefined);
//         let allLenght = numFiles + filteredArray.length;
//
//         $("#comment").attr("disabled", 'disabled');
//         $("#comment").css("display", 'none');
//
//         var file = $('input[type="file"]')[0].files.length;
//         let time =  $.now();
//         for (var i = 0; i < file; i++) {
//             let type = $("input[type='file']")[0].files[i].type.split('/')[0]
//             DataArray.push($("input[type='file']")[0].files[i]);
//
//             if (type == 'image') {
//                 var fileUrl = URL.createObjectURL($("input[type='file']")[0].files[i]);
//                 $("#newDivqwe").append(`
//                         <div class="PhotoDiv" style='overflow: visible;position: relative; width: 150px; height: 150px'>
//                         <button  class="ixsButton" data-id="${DataArray.length-1}" style='
//                                     outline: none;
//                                     border: none;
//                                 position: relative;
//                                 background-color: transparent;
//                                 '></button>
//                         <img class='sendPhoto' style='width: 150px; height: 150px' src='${fileUrl}'/>
//                         </div>`);
//             } else {
//                 $("#newDivqwe").append("  " +
//                     "" +
//                     "  <div class='PhotoDiv' style='overflow: visible;position: relative; width: 150px; height: 150px'>\n   " +
//                     "                     <button class=\"ixsButton\" data-id="+`${DataArray.length-1}`+" style='\n                                position: relative;\n                                    outline: none;\n                                    border: none;\n                                position: relative;\n                                '></button>" +
//                     "<i class=\"fileType fa fa-file fa-3x\" aria-hidden=\"true\"> </i></div>")
//             }
//         }
//         $(".ixsButton").click(function (event) {
//             event.preventDefault()
//             let data_id = $(this).attr('data-id')
//             $(this).parent('.PhotoDiv').hide()
//             DataArray.splice(data_id,1,undefined)
//             let data = DataArray;
//
//
//             let allUndefined = true;
//             $.each(data, function(index, item) {
//                 if (typeof item !== "undefined") {
//                     allUndefined = false;
//                     return false;
//                 }
//             });
//             if (allUndefined) {
//                 $("#comment").removeAttr("disabled", 'disabled');
//                 $("#comment").css("display", 'block');
//             }
//         })
//
//     });
// });
// $(document).ready(function() {
//     let i = 0;
//     // $('#add-inputs').click(function() {
//     //     i++;
//     //     $('#input-container').append(
//     //     `<input class="form-control" name="data[${i}][key]" style="color: black !important;" type="text" placeholder="Enter text">
//     //     <input name="data[${i}][value]" style="color: black !important;" type="number" placeholder="Enter number">`);
//     // });
//
//     $('#add-inputs').click(function() {
//         i++;
//         $('#input-container').append(
//             `               <div class="form-group" bis_skin_checked="1">
//                                 <div style="display: flex; justify-content: space-between">
//                                 <label for="exampleInputName1">Значения</label>
//                                 <label for="exampleInputName1">Описание</label>
//                                 </div>
//                                 <div style="display: flex; justify-content: space-between">
//                                 <input style="width: 45%" name="data[${i}][key]" type="text" class="form-control data" id="exampleInputName1" placeholder="Значения" >
//                                 <input style="width: 45%" name="data[${i}][value]" type="text" class="form-control data" id="exampleInputName1" placeholder="Описание" >
//                             </div>
//                             </div>`);
//     });
// });
//
// $(document).ready(function () {
//     $("#addproduct").submit(function (event) {
//         event.preventDefault();
//
//         let name = $('[name="name"]').val();
//         let sub_category = $('[name="sub_category"]').val();
//         let made_in = $('[name="made_in"]').val();
//         let price = $('[name="price"]').val();
//         let category = $('[name="category"]').val();
//
//
//
//
//         let filteredArray = DataArray.filter(item => item !== undefined);
//         let allLenght = filteredArray.length;
//
//
//         let formData = new FormData();
//
//         if (allLenght > 0){
//             let DataArrayLenght = DataArray.length;
//             for (var i = 0; i < DataArrayLenght; i++) {
//                 formData.append('file[]', DataArray[i]);
//             }
//
//
//
//
//
//
//
//
//             var zangvac = [];
//             for (var i = 0; i < $(".data").length; i++) {
//                 var currentData = $(".data")[i];
//                 var obj = {};
//                 obj[$(currentData).val()] = $($(".data")[i+1]).val();
//                 if(i % 2 == 0){
//                     zangvac.push(obj);
//                 }
//             }
//
//
//             for (var i = 0; i < zangvac.length; i++) {
//                 formData.append('data[]', JSON.stringify(zangvac[i]));
//             }
//
//             formData.append('name', name);
//             formData.append('price', price);
//
//             formData.append('sub_category', sub_category);
//             formData.append('made_in', made_in);
//             formData.append('price', price);
//             formData.append('category',category );
//
//
//
//
//             let timerInterval
//             Swal.fire({
//                 // title: 'Auto close alert!',
//                 // html: 'I will close in <b></b> milliseconds.',
//                 // timer: 2000,
//                 timerProgressBar: true,
//                 didOpen: () => {
//                     Swal.showLoading()
//                     const b = Swal.getHtmlContainer().querySelector('b')
//                     timerInterval = setInterval(() => {
//                         // b.textContent = Swal.getTimerLeft()
//                     }, 100)
//                 },
//                 willClose: () => {
//                     clearInterval(timerInterval)
//                 }
//             }).then((result) => {
//                 /* Read more about handling dismissals below */
//                 if (result.dismiss === Swal.DismissReason.timer) {
//                     console.log('I was closed by the timer')
//                 }
//             })
//
//             $.ajax({
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//                 },
//
//                 url: 'https://jcelectronics.am/admin/add_products',
//                 type: 'POST',
//                 data: formData,
//                 dataType: "json",
//                 processData: false,
//                 contentType: false,
//                 cache: false,
//                 encode: true,
//
//                 success: function (data) {
//
//                     $('.swal2-container').css('display','none')
//                     if(data.status == true){
//                         alert('Товар Успешно добавлен')
//                         setTimeout(function() {
//                             window.location.replace(data.url);
//                         }, 1000);
//                     }
//                 },
//             });
//         }else{
//             alert('Выберете фотографию')
//         }
//
//
//     });
// });
// $(document).ready(function () {
//     $("#updateProductPhoto").submit(function (event) {
//         event.preventDefault();
//
//         let product_id = $('[name="product_id"]').val();
//         let formData = new FormData();
//         let DataArrayLenght = DataArray.length;
//         for (var i = 0; i < DataArrayLenght; i++) {
//             formData.append('file[]', DataArray[i]);
//         }
//
//
//
//         formData.append('product_id', product_id);
//
//
//
//
//         let timerInterval
//         Swal.fire({
//             // title: 'Auto close alert!',
//             // html: 'I will close in <b></b> milliseconds.',
//             // timer: 2000,
//             timerProgressBar: true,
//             didOpen: () => {
//                 Swal.showLoading()
//                 const b = Swal.getHtmlContainer().querySelector('b')
//                 timerInterval = setInterval(() => {
//                     // b.textContent = Swal.getTimerLeft()
//                 }, 100)
//             },
//             willClose: () => {
//                 clearInterval(timerInterval)
//             }
//         }).then((result) => {
//             /* Read more about handling dismissals below */
//             if (result.dismiss === Swal.DismissReason.timer) {
//                 console.log('I was closed by the timer')
//             }
//         })
//
//         $.ajax({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//             },
//
//             url: 'https://jcelectronics.am/admin/add_new_products_photo',
//             type: 'POST',
//             data: formData,
//             dataType: "json",
//             processData: false,
//             contentType: false,
//             cache: false,
//             encode: true,
//
//             success: function (data) {
//
//                 $('.swal2-container').css('display','none')
//                 if(data.status == true){
//                     console.log(data.url)
//                     alert('Фотографии успешно добавлены')
//                     setTimeout(function() {
//                         window.location.reload()
//                     }, 1000);
//                 }
//             },
//         });
//     });
// });

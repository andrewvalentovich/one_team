$('.request__form').on('submit', function (e) {
    e.preventDefault();

    var landings_lead_url = window.domain === "localhost" ? `http://dev.${window.domain}:8879/api/requests/lead` : `https://dev.${window.domain}/api/requests/lead`;

    let formData = new FormData(this);

    for (const [key, value] of formData.entries()) {
        console.log(key, value);
    }

    $.ajax({
        type: 'POST',
        url: landings_lead_url,
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            $("input[name='name']").val("");
            $("input[name='phone']").val("");
            alert("Ваша заявка успешно отправлена! Мы свяжемся с вами в ближайшее время!");
            location.reload();
        },
        error: function (reject) {
            if( reject.status == 422 ) {
                var errors = $.parseJSON(reject.responseText);
                // console.log(errors);
                $.each(errors.errors, function (key, val) {
                    $("#" + key + "_error").text(val[0]);
                });

                alert("К сожалению, при отправке заявки возникла ошибка! Вы можете связаться с нами по номеру телефона!");
            }
        }
    });
});

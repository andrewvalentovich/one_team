$('.request__form').on('submit', function (e) {
    const form = this
    e.preventDefault();

    var landings_lead_url = window.domain === "localhost" ? `http://dev.${window.domain}:8879/api/requests/lead` : `https://dev.${window.domain}/api/requests/lead`;

    let formData = new FormData(this);

    for (const [key, value] of formData.entries()) {
        console.log(key, value);
    }

    const phoneInput = this.querySelector('input[name="phone"]');


    if(phoneInput.value.length <= 5) {
        return
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
            $('.popup-thanks').addClass('active')
            const popup = form.closest('.popup')
            if(popup) {
                popup.classList.remove('active')
                bodyScrollLock.enableBodyScroll(popup);
            }
            bodyScrollLock.disableBodyScroll($('.popup-thanks'));

        },
        error: function (reject) {
            if( reject.status == 422 ) {
                var errors = $.parseJSON(reject.responseText);
                // console.log(errors);
                $.each(errors.errors, function (key, val) {
                    $("#" + key + "_error").text(val[0]);
                });
                $('.popup-error').addClass('active')
                const popup = form.closest('.popup')
                if(popup) {
                    popup.classList.remove('active')
                    bodyScrollLock.enableBodyScroll(popup);
                }
                bodyScrollLock.disableBodyScroll($('.popup-thanks'));
            }
        }
    });
});

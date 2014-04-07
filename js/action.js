$(function () {
    $('.change-city').click(function () {
        $('.city-dialog').show();
        $('.callback-dialog').hide();
    });

    $('.callback').click(function () {
        $('.callback-dialog').show();
        $('.city-dialog').hide();
    });

    $('.dialog-close').click(function () {
        $('.city-dialog').hide();
        $('.callback-dialog').hide();
    });


    $('#send-callback').click(function () {
        $(this).ajaxFormSubmit(
            //success, complete, validator
            function () {
                alert('Сообщение отправлено');
                $('.callback-dialog').hide();
                $('#form-send-callback input, #form-send-callback textarea').val('');
            },
            function () {

            },
            function () {

            }
        );

    });

});
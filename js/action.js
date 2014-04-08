$(function () {
    $('body').click(function () {
        closePopup();
    });

    $('.city-dialog, .callback-dialog').click(function (e) {
        e.stopPropagation();
    });

    function closePopup() {
        $('.city-dialog').hide();
        $('.callback-dialog').hide();
    }

    $('.change-city').click(function (e) {
        e.stopPropagation();
        closePopup();
        $('.city-dialog').show();
    });

    $('.callback').click(function (e) {
        e.stopPropagation();
        closePopup();

        $('.callback-dialog').show();
    });

    $('.dialog-close').click(function () {
        closePopup();
    });

    $('#send-callback').click(function () {
        $(this).ajaxFormSubmit(
            //success, complete, validator
            function () {
                alert('Сообщение отправлено');
                closePopup();
                $('#form-send-callback input, #form-send-callback textarea').val('');
            },
            function () {

            },
            function () {

            }
        );

    });

    $('#select-city').click(function () {

        alert('1');

    });
    /*
     * слайдер
     */
    if ($('.slider').length > 0)
        $('.slider').mobilyslider({
            transition: 'fade',
            animationSpeed: 800,
            autoplaySpeed: 3000,
            autoplay: true,
            bullets: false,
            arrowsHide: false
        });

});
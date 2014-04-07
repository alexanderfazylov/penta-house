$(function () {
    $('.change-city').click(function () {
        $('.city-dialog').show();
        $('.callback-dialog').hide();
    });
    $('.dialog-close').click(function () {
        $('.city-dialog').hide();
    });

    $('.callback').click(function () {
        $('.callback-dialog').show();
        $('.city-dialog').hide();
    });
    $('.dialog-close').click(function () {
        $('.callback-dialog').hide();
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
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
            function (data) {
                $('.has-error').removeClass('has-error');
                $.each(data.model, function (model, attributes) {
                    $.each(attributes, function (atr, msg) {
                        var name = model + "[" + atr + "]";
                        $('[name="' + name + '"]').parents('.form-group').addClass('has-error');
                    })
                })

            }
        );

    });

    $('#select-city').click(function () {

        var data = $(this).parents('form').serializeArray();
        var select_contact_id = data[0].value;

        if (active_contact_id != select_contact_id) {
            $.ajax({
                url: '/site/selectCity',
                type: 'GET',
                dataType: 'json',
                data: {
                    contact_id: select_contact_id
                },
                success: function (data) {

                }
            });

            $.each(contacts, function (i, contact) {
                if (contact.id == select_contact_id) {
                    $('.aside-header .phone').text(contact.phone);
                    $('.aside-header .city-name').text(contact.city);
                }
            });


        }

        closePopup();


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
        if ($('.collection-img-item').length > 0)
            $(".collection-img-item").lightBox();

    $('.map-chenger').click(function () {

        var latitude = $(this).data('latitude');

        var longitude = $(this).data('longitude');

        var zoom = $(this).data('zoom');

        myMap.setCenter([latitude, longitude ], zoom);
    });

    // PageTransitions.init();
});

function changeModel($el) {
    var animate_nav;
    if ($el.data('location_type') == 'next') {
        animate_nav = 1;
    } else {
        animate_nav = 2;
    }


    $.ajax({
        url: '/site/SearchModel',
        type: 'GET',
        dataType: 'HTML',
        data: {
            page_type: $el.data('page_type'),
            entity_id: $el.data('entity_id'),
            location_type: $el.data('location_type')
        },
        success: function (data) {
            $('#pt-main').append(data);

            var $block = $('.pt-page:not(.pt-page-current)');

            if ($block.find('.slider').length > 0)
                $block.find('.slider').mobilyslider({
                    transition: 'fade',
                    animationSpeed: 800,
                    autoplaySpeed: 3000,
                    autoplay: true,
                    bullets: false,
                    arrowsHide: false
                });
                if ($block.find('.collection-img-item').length > 0)
                    $block.find(".collection-img-item").lightBox();

            //PageTransitions.init();
            PageTransitions.nextPage(animate_nav);
        }
    });
}

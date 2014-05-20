function $_GET(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || null
}
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

    $carousel = $('.carousel').carousel({
        interval: false
    });

    if ($('.collection-img-item').length > 0)
        $(".collection-img-item").lightBox();

    $('.map-chenger').click(function () {

        var latitude = $(this).data('latitude');

        var longitude = $(this).data('longitude');

        var zoom = $(this).data('zoom');

        myMap.setCenter([latitude, longitude ], zoom);
    });
});
startRequest = false;
function changeModel($el) {
    var count = $('.carousel-indicators li').length - 1;
    var active_index = $('.carousel-indicators li.active').index();


    if ($el.data('location_type') == 'prev') {

        if (active_index == 0) {
            changeContentPage($el, function () {
                //$carousel.carousel(count);
                $carousel.find('.carousel-inner .item').removeClass('active');
                $carousel.find('.carousel-indicators li').removeClass('active');
                //
                $carousel.find('.carousel-inner .item').last().addClass('active');
                $carousel.find('.carousel-indicators li').last().addClass('active');
            });
        } else if (active_index == -1) {
            changeContentPage($el, function () {

            });
        } else {
            $carousel.carousel('prev');
        }
    } else if ($el.data('location_type') == 'next') {
        if (active_index == count) {
            changeContentPage($el, function () {
            });
        } else {
            $carousel.carousel('next');
        }
    } else {
        alert('Ошибка');
    }


}

function changeContentPage($el, callback) {
    if (!startRequest) {
        startRequest = true;
        var animate_nav = $el.data('location_type') == 'next' ? 1 : 2;


        $.ajax({
            url: '/site/SearchModel',
            type: 'GET',
            dataType: 'HTML',
            async: false,
            data: {
                page_type: $el.data('page_type'),
                entity_id: $_GET('id'),
                location_type: $el.data('location_type')
            },
            success: function (data) {
                $('#pt-main').append(data);
                var $block = $('.pt-page:not(.pt-page-current)');
                ////////////////////////////////////////////////


                $carousel = $block.find('.carousel').carousel();
                callback();

                $block.find(".collection-img-item").lightBox();

                PageTransitions.nextPage(animate_nav, function () {
                    History.pushState({}, $block.find('#page_title').val(), "?id=" + $block.find('#entity_id').val());
                    startRequest = false;
                    $.each($('#pt-main .pt-page'), function (index, el) {
                        if (!$(el).hasClass('pt-page-current')) {
                            $(el).remove();
                        }
                    });
                });
            }
        });
    }
}
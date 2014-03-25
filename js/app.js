$(function () {
    //$('.default-datapicker').datepicker();
    $(document).on('click', '.btn-popup', function () {
        var id = $(this).data('popup');

        $('#modal-api').html(
            $('#template_' + id).render($(this).data())
        )
        ;
        $('#' + id).modal('show');
    });
});
var button = {
    disable: function ($el) {
        $el.addClass('loading');
        $el.attr('disabled', 'disabled');
    },
    undisable: function ($el) {
        $el.removeClass('loading');
        $el.removeAttr('disabled');
    }
};

$.fn.ajaxFormSubmit = function (success, complete, validator) {


    var data, url, $form, $element;

    //=============================//

    $element = $(this);
    $form = $element.parents('form');

    if ($form.length == 0) {
        $form = $('#form-' + $element.attr('id'));
        if ($form.length == 0) {
            alert('Ошибка в html. Не найдено формы.');
            return false;
        }
    }


    data = $form.serialize();
    url = $form.attr('action')


    button.disable($element);

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function (data) {

            if (data != null)
                if (data.status === 'success') {

                    if (typeof success !== "undefined") {
                        success(data);
                    }

                } else {

                    if (typeof validator !== "undefined") {
                        validator(data);
                    } else {
                        for (key in data.message) {
                            alert(data.message[key]);
                        }
                    }
                }

        },
        complete: function () {
            button.undisable($element);
            if (typeof complete !== "undefined") {
                complete();
            }
        },
        error: function () {
            button.undisable($element);
            alert("Непредвиденная ошибка");
        }

    });

    return $element;

};
$.fn.depends = function ($depends) {
    var $button = $(this);
    if (typeof $depends != 'undefined') {
        if ($depends.length != 0) {
            $button.on('click', function () {
                $button.val($depends.val());
            });
        }
    }
    return $button;
};

$.fn.relationSelect = function ($slave, relation) {
    var $master = $(this);
    $slave.find('option:not(:first-child)').remove();

    $.each(relation, function (k, val) {
        if (val.id == $master.val()) {
            $.each(val.window, function (k, wind) {
                var $option = $('<option></option>').val(wind.id).html(wind.number);
                $slave.append($option);
            });
        }
    });

    $master.on('change', function () {
        $master.relationSelect($slave, relation);
    });

    return $master;
}

function $_GET(name, url) {
    if (typeof url == "undefined") {
        url = location.search;
    }

    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(url);
    return results == null ? null : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function in_array(needle, haystack, strict) {	// Checks if a value exists in an array
    var found = false, key, strict = !!strict;
    for (key in haystack) {
        if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
            found = true;
            break;
        }
    }
    return found;
}


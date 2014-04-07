/* Russian (UTF-8) initialisation for the jQuery UI date picker plugin. */
/* Written by Andrew Stromnov (stromnov@gmail.com). */
jQuery(function ($) {
    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: '&#x3c;Пред',
        nextText: 'След&#x3e;',
        currentText: 'Сегодня',
        monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
            'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
            'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
        dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
        dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
        dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
        weekHeader: 'Не',
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['ru']);
});
//===============

$.views.converters({getUploadItem: function (data) {
    return $('#template_upload-row').render(data);
}});
$.views.converters({notCacheImage: function (file_name) {
    return file_name + '?' + new Date().getTime();
}});
$.views.converters({getUniqId: function () {
    return new Date().getTime();
}});


$.views.converters({metaData: function (data) {
    return $('#template_meta_data').render(data);
}});

$.views.converters({renderUploder: function (upload) {
    return $('#template_uplod_wrap').render({upload: upload});
}});

$.views.converters({renderUploderMiltiple: function (upload) {
    return $('#template_uplod_wrap_miltiple').render({upload: upload});

}});
$.views.converters({getUploadItemMultiple: function (uploads) {
    var response = '';
    if (typeof uploads != 'undefined') {
        $.each(uploads, function (k, value) {

            response = response + $('#template_upload-row').render(value.upload);
        });
    }
    return response;
}});


$.views.converters({checkboxMainePageVisible: function (visible) {

    var cheked = "";
    if (visible == 1) {
        cheked = 'checked="checked"';
    }

    return '<input type="checkbox" ' + cheked + ' name="Brand[maine_page_visible]" >';
}});

$.views.converters({boolCheckbox: function (data) {
    var cheked = "";
    if (data == 1) {
        cheked = 'checked="checked"';
    }

    return cheked;
}});

$.views.converters({getSelectOption: function (brand_id) {
    var options = '';

    $.each(brands, function (i, brand) {
        var selected = "";
        if (brand_id == brand.id) {
            selected = "selected='selected'";
        }
        options = options + '<option ' + selected + ' value="' + brand.id + '">' + brand.name + '</option>'
    });

    return options;
}});
$.views.converters({getCollection: function (data) {
    var response = '';
    if (data.length != 0) {
        $.each(data, function (index, collection) {
            response = response + $('#template_collection_row').render(collection);
        });
    } else {
        response = "Нет прикрепленных коллекций";
    }
    return response;
}});


function getBrands() {
    $.ajax({
        url: '/admin/main/getBrends',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            brands = data;
        }
    });
}

$(function () {

    function initUploders() {
        $('.construct_upload').each(function (k, el) {
            var $uploader = $(el).find('.my_loder');
            if (typeof $uploader.data('init') == 'undefined') {
                $uploader.data('init', true);
                var uploader = new qq.FileUploader({
                    element: $uploader[0],
                    multiple: $(el).data('multiple'),
                    action: $(el).data('action'),
                    onSubmit: function (id, fileName) {
                        if (!$(el).data('multiple')) {
                            $uploader.siblings('.qq-upload-list').html("");
                        }

                    },
                    onComplete: function (id, fileName, response) {
                        $uploader.find('.qq-upload-list li').hide();
                        $uploader.siblings('.qq-upload-list').append(
                            $('#template_upload-row').render(response)
                        );
                        $uploader.find('.qq-picter img').attr('src', '/uploads/thumbs/' + response.file_name);
                        $.jGrowl('Сохраните изменения');
                    }
                });

            }
        });


    }

    function initDatapickers() {
        $('.has-datapicker').each(function (i, el) {
            $(el).datepicker(jQuery.extend({}, jQuery.datepicker.regional['ru'], {'dateFormat': 'dd.mm.yy'}));
        });
    }

    function initSelect($parent) {
        $parent.find('select').each(function (i, select) {
            var value = $(select).data('value');
            if (typeof value != "undefined") {
                $(select).find('[value="' + value + '"]').attr('selected', 'selected ')
            }

        });
    }

    function showCoords(c) {
        $('#x1').val(c.x);
        $('#y1').val(c.y);
        $('#x2').val(c.x2);
        $('#y2').val(c.y2);
        $('#w').val(c.w);
        $('#h').val(c.h);
    }

    $(document).on('click', '#save-model', function () {
        var $el = $(this);

        $(this).ajaxFormSubmit(
            function (data) {
                $.fn.yiiGridView.update("model-grid");
                $.jGrowl("Сохранено");
                $el.parents('.modal').modal('hide');
            },
            function () {
            },
            function (data) {

            }
        );
    });
    $(document).on('click', '#delete-model', function () {
        var $el = $(this),
            id = $el.data('model-id'),
            action = $el.data('action');


        if (confirm("Удалить " + $el.data('name') + " (" + $el.data('unit') + ")")) {
            $.ajax({
                url: action,
                type: 'GET',
                dataType: 'json',
                data: {id: id},
                success: function (data) {
                    $el.parents('.modal').find('.modal-body').hide('clip', function () {
                        $el.parents('.modal').modal('hide');
                        $.fn.yiiGridView.update("model-grid");
                        $.jGrowl(data.message);
                    });
                }
            });
        }
    });

    $(document).on('click', '.btn-popup', function () {
        var id = $(this).data('popup');

        console.log($(this).data());
        $('#modal-api').html(
            $('#template_' + id).render($(this).data())
        );
        $('#' + id).modal('show');

        initUploders();
        initDatapickers();
        initSelect($('#' + id));
    });
    $(document).on('click', '.qq-delete-upload', function () {
        var upload_id = $(this).parents('.qq-upload-success').data('upload-id');
        var $el = $(this);
        if (confirm("Удалить файл?")) {
            $.ajax({
                url: '/server/deleteFile',
                type: 'GET',
                dataType: 'json',
                data: {upload_id: upload_id},
                success: function (data) {
                    $.fn.yiiGridView.update("model-grid");
                    $el.parents('.qq-upload-success').remove();
                }
            });
        }
    });

    $(document).on('click', '.qq-crop-upload', function () {
        //$qq_crop_upload = $(this);
        var upload_id = $(this).parents('.qq-upload-success').data('upload-id');
        var picter_data = $(this).parents('.construct_upload').data();
        var ar = picter_data.width / picter_data.height;
        NProgress.start();

        $.ajax({
            url: '/server/InfoFile',
            type: 'GET',
            dataType: 'json',
            data: {upload_id: upload_id},
            success: function (data) {

                $('#modal-api #modal-crop').remove();
                $('#modal-api').append(
                    $('#template_crop_modal').render(data)
                );

                $('#target').load(function () {
                    $("#modal-crop").modal('show');
                    var jcrop_api,
                        boundx,
                        boundy,
                        xsize = 200,
                        ysize = 100;

                    $('#target').Jcrop({
                        aspectRatio: ar,
                        onSelect: showCoords
                    }, function () {
                        var bounds = this.getBounds();
                        boundx = bounds[0];
                        boundy = bounds[1];
                        jcrop_api = this;
                    });
                });
                NProgress.done();
            }

        });
    });
    $(document).on('click', '#crop-image', function () {
        var $el = $(this);
        $(this).ajaxFormSubmit(
            function (data) {
                $.fn.yiiGridView.update("model-grid");
                $.jGrowl("Сохраните изменения");
                $('#file_upload_' + data.model.id).find('.qq-picter img').attr('src', '/uploads/thumbs/' + data.model.file_name + '?' + getUniq());
                $el.parents('.modal').modal('hide');
            },
            function () {
            },
            function () {
            }
        );

    });

    $(document).on('click', '#about-edit', function () {
        var $el = $(this);
        $el.ajaxFormSubmit(
            function (data) {
                $.jGrowl("Сохранено");
            },
            function () {
            },
            function () {
            }
        );

    });

    $(document).on('click', '#main-edit', function () {
        var $el = $(this);
        $el.ajaxFormSubmit(
            function (data) {
                $.jGrowl("Сохранено");
            },
            function () {
            },
            function () {
            }
        );

    });

});
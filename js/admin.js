$.views.converters({getUploadItem: function (data) {
    return $('#template_upload-row').render(data);
}});
$.views.converters({notCacheImage: function (file_name) {
    return file_name + '?' + new Date().getTime();
}});
$.views.converters({metaData: function (data) {
    return $('#template_meta_data').render(data);
}});
$.views.converters({checkboxMainePageVisible: function (visible) {

    var cheked = "";
    if (visible == 1) {
        cheked = 'checked="checked"';
    }

    return '<input type="checkbox" ' + cheked + ' name="Brand[maine_page_visible]" >';
}});


$(function () {
    function creteBrandUploder(i) {
        var $uploader = $('#file-uploader-' + i);

        var uploader = new qq.FileUploader({
            element: $uploader[0],
            multiple: false,
            action: '/server/UploadBrand' + i,
            onSubmit: function (id, fileName) {
                $uploader.siblings('.qq-upload-list').html("");
            },
            onComplete: function (id, fileName, response) {
                $uploader.find('.qq-upload-list li').remove();
                $uploader.siblings('.qq-upload-list').html(
                    $('#template_upload-row').render(response)
                );
                $uploader.find('.qq-picter img').attr('src', '/uploads/thumbs/' + response.file_name);


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
        $('#modal-api').html(
            $('#template_' + id).render($(this).data())
        );
        $('#' + id).modal('show');

        var index = 1;
        while (index <= 4) {
            creteBrandUploder(index);
            index++;
        }
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
                    $el.parents('.qq-upload-success').remove();
                }
            });
        }
    });

    $(document).on('click', '.qq-crop-upload', function () {
        $qq_crop_upload = $(this);
        var upload_id = $(this).parents('.qq-upload-success').data('upload-id');

        var picter_data = $(this).parents('.qq-upload-list').data();
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
                $qq_crop_upload.parents('.qq-upload-list').html(
                    $('#template_upload-row').render(data.model)
                );
                $el.parents('.modal').modal('hide');
            },
            function () {
            },
            function () {
            }
        );

    });

});
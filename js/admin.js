$(function () {

    $(document).on('click', '#save-brand', function () {
        $(this).ajaxFormSubmit(
            function () {
                $.fn.yiiGridView.update("brand-grid");
            },
            function () {
            },
            function () {
            }
        );
    });
    $(document).on('click', '.btn-popup', function () {
        var id = $(this).data('popup');

        $('#modal-api').html(
            $('#template_' + id).render($(this).data())
        )
        ;
        $('#' + id).modal('show');
    });
});
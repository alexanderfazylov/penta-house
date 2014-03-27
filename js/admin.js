$(function () {

    $(document).on('click', '#save-brand', function () {
        $(this).ajaxFormSubmit();
    });

//    $(document).on('click', '.brand-edit', function () {
//        $(this).data('item')
//    });

    $(document).on('click', '.btn-popup', function () {
        var id = $(this).data('popup');

        $('#modal-api').html(
            $('#template_' + id).render($(this).data())
        )
        ;
        $('#' + id).modal('show');
    });
});
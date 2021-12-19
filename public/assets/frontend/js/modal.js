$(document).ready(function () {
    $('.modal-ajax').on('hidden.bs.modal', function () {
        $(document).find('.datetime-modal').html('');
        $(this).find('.modal-body').html('');
    });
    /** Modal Ajax */
    $(document).on('click', '[data-bs-toggle=modal]', function () {
        var modal = $(this).attr('href');
        var url = $(this).attr('data-url');
        if ($(modal).hasClass('modal-ajax')) {
            $.ajax({
                async: true,
                url: url,
                type: 'GET',
            }).done(function (response) {
                $(modal).find('.modal-body').html(response);
                if ($(modal).find('form').attr('action') === "") {
                    $(modal).find('form').attr('action', url);
                }

                /** Lost jquery */
                $(modal).find(".select2").select2();
            });
        }
    });
});

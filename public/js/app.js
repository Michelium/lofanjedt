$(document).ready(function () {
    $('.DataTable').DataTable({
        pageLength: 25,
    });

    $('.form-modal-button').on('click', function () {
        const id = $(this).data('id');

        $.ajax({
            url: '/entry/get-form',
            data: {
                id: id,
            },
        })
            .done(function (data) {
                let body = $('.modal-body');
                $(body).empty();
                $(body).append(data);

                let form = $(body).find('form');
                $(form).attr('action', '/entry/form/' + id)
            });
    });
});

$('.status-item').each(function () {
    let container = $(this);
    let service = container.data('id');
    $('#status_' + service).on('click', function () {
        let id = $('#status_' + service).data('id');
        let statustext = $('#status_' + service).data('status');
        let status;
        if ($('#status_' + service).is(":checked")) {
            status = 1;
        } else {
            status = 0;
        }
        ajaxFunction(id, statustext, status);
    });
});

function ajaxFunction(id,statustext,status){
    $.ajax({
        url: $('#status-update').val(),
        method:"GET",
        dataType:"json",
        data:{
            'status':status,'id':id,'statustext':statustext,
        },
        success: function(data){
            if (data.status==1) {
                toastr.success(statustext+' Published');
            } else {
                toastr.error(statustext+' Unpublished.');
            }
        },
        error: function (data) {
            alert('Error occur fetch status action.....!!');
        }
    })
}

$('.edit-convert').on('click', function () {
    $('#coin').val($(this).data('coin'));
    $('#currency_id').val($(this).data('currency-id'));
    $('#per_currency').val($(this).data('per-currency'));
    $('.edit-convert-form').attr('action', $('#url').val() + '/' + $(this).data('id'))
    $('#convert-edit').modal('show');
})

$('.edit-reward').on('click', function () {
    $('#name').val($(this).data('name'));
    $('#reward_point').val($(this).data('reward_point'));
    $('.edit-reward-form').attr('action', $('#url').val() + '/' + $(this).data('id'))
    $('#reward-edit').modal('show');
})

$('.edit-currency').on('click', function () {
    $('#name').val($(this).data('name'));
    $('#symbol').val($(this).data('symbol'));
    $('#iso_code').val($(this).data('iso_code'));
    $('.edit-currency-form').attr('action', $('#url').val() + '/' + $(this).data('id'))
    $('#edit-currency').modal('show');
})

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.confirm-action', function (event) {
    event.preventDefault();

    let url = $(this).data('action') ?? $(this).attr('href');
    let method = $(this).data('method') ?? 'POST';
    let icon = $(this).data('icon') ?? 'fas fa-warning';

    $.confirm({
        title: "Heads Up!",
        icon: icon,
        theme: 'modern',
        closeIcon: true,
        animation: 'scale',
        type: 'red',
        scrollToPreviousElement: false,
        scrollToPreviousElementAnimate: false,
        buttons: {
            confirm: {
                btnClass: 'btn-red',
                action: function () {
                    event.preventDefault();
                    $.ajax({
                        type: method,
                        url: url,
                        success: function (response) {
                            if (response.redirect) {
                                window.sessionStorage.hasPreviousMessage = true;
                                window.sessionStorage.previousMessage = response.message ?? null;

                                location.href = response.redirect;
                            } else {
                                Notify('success', response)
                            }
                        },
                        error: function (xhr, status, error) {
                            Notify('error', xhr)
                        }
                    })
                }
            },
            close: {
                action: function () {
                    this.buttons.close.hide()
                }
            }
        },
    });
});

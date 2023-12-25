function getQuestions(id) {
    $.ajax({
        type: "GET",
        url: $('#get-question').val()+'?quiz_id='+id,
        success: function (response) {
            $('.questions-data').html(response.data)
        },
    });
}

$('.view-withdraw').on('click', function() {
    $('.user_name').text($(this).data('name'))
    $('.phone').text($(this).data('phone'))
    $('.township').text($(this).data('township'))
    $('.division').text($(this).data('division'))
    $('.profession').text($(this).data('profession'))
    $('.points').text($(this).data('points'))
    $('.invoice_number').text($(this).data('invoice_number'))
    $('.amount').text($(this).data('amount'))
    $('#qr_image').attr('src', $(this).data('qrimage'))
    $('.created_at').text($(this).data('created_at'))
    var status = $(this).data('status');
    var statusText = '';
    if (status == 0) {
        statusText = `<div class="badge bg-danger">Rejected</div>`;
    } else if (status == 1) {
        statusText = `<div class="badge bg-primary">Processing</div>`;
    } else if (status == 2) {
        statusText = `<div class="badge bg-warning">Pending</div>`;
    } else if (status == 3) {
        statusText = `<div class="badge bg-success">Approved</div>`;
    }
    $('.status').html(statusText)
    $('#withdraw-view-modal').modal('show');
});

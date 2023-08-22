$('.edit-item').each(function () {
    var container = $(this);
    var service = container.data('id');
    $('#currency-convert-' + service).on('click', function () {
        var convertid = $('#currency-convert-' + service).data('id');

        $('#edit_currency_id').val($('#currency-convert-' + service).data('currency-id'));
        $('#edit_par_currency').val($('#currency-convert-' + service).data('par-currency'));
        $('#edit_coin').val($('#currency-convert-' + service).data('coin'));

        var faqForm = $('#convertFrom').attr('action', '');
        var editactionroute = "/currency-convert/update"
        $('#convertFrom').on('submit', function () {
            /*$('#convertFrom').append('<input type="hidden" name="_method" value="PUT">')*/
            $('#convertFrom').attr('action', editactionroute + '/' + convertid);
        })

    })
})

let showPass = document.querySelector('.hide-pass');
showPass.addEventListener('click', function () {
    showPass.classList.toggle("show-pass");
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
})

/**
 *  custom css
 *  */
$(".image-size-alert").css({
    'color': 'red',
    'font-size': '10px',
    'margin-left': '5px'
});

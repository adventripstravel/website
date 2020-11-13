$( document ).ready(function()
{
    $('input[name="customer_phone"]').inputmask("(999) 999-9999");

    $("input[name='pax_adults']").TouchSpin({
        min: 1,
        stepinterval: 1,
        buttondown_class: 'btn btn-secondary',
        buttonup_class: 'btn btn-secondary'
    });

    $("input[name='pax_childrens'],input[name='pax_babys']").TouchSpin({
        min: 0,
        stepinterval: 1,
        buttondown_class: 'btn btn-secondary',
        buttonup_class: 'btn btn-secondary'
    });

    $("input[name='tour_price'], input[name='amount_discount']").TouchSpin({
        min: 0,
        max: null,
        prefix: '$',
        postfix: 'MXN',
        buttondown_class: 'btn btn-secondary',
        buttonup_class: 'btn btn-secondary'
    });

    $("input[name='percentage_discount']").TouchSpin({
        min: 0,
        max: 100,
        postfix: '%',
        buttondown_class: 'btn btn-secondary',
        buttonup_class: 'btn btn-secondary'
    });

    $( document ).on('change', '[name="discount"]', function ()
    {
        $( document ).find('input[name="percentage_discount"]').parents('.form-group').addClass('d-none');
        $( document ).find('input[name="amount_discount"]').parents('.form-group').addClass('d-none');

        if ( $(this).val() === 'percentage' )
            $( document ).find('input[name="percentage_discount"]').parents('.form-group').removeClass('d-none');

        if ( $(this).val() === 'amount' )
            $( document ).find('input[name="amount_discount"]').parents('.form-group').removeClass('d-none');
    });

    // SUBMIT
    $('form[name="reservation"]').ajaxSubmit({
        callback: function ( response )
        {
            swal({
                type: 'success',
                title: 'Reservado',
                html: 'Se agregó una nueva reserva, con el número de folio ' + response.folio,
                showLoaderOnConfirm: true,
                allowOutsideClick: false,
                preConfirm: function ()
                {
                    return new Promise(function (resolve)
                    {
                        window.location.href = response.redirect;

                        setTimeout(function ()
                        {
                            resolve();
                        }, 5000);
                    });
                }
            });
        }
    });
});

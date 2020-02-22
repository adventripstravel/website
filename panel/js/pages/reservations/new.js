"use strict";

$(function ()
{
    var DOM = $( document );

    $('input[name="customer_phone"]').inputmask("(999) 999-9999");

    $("input[name='yacht_pax_adults'], input[name='yacht_pax_childrens']").TouchSpin({
        min: 0,
        stepinterval: 1,
        buttondown_class: 'btn btn-secondary',
        buttonup_class: 'btn btn-secondary'
    });

    $("input[name='yacht_hrs_duration']").TouchSpin({
        min: 1,
        max: 24,
        stepinterval: 1,
        postfix: 'Hrs.',
        buttondown_class: 'btn btn-secondary',
        buttonup_class: 'btn btn-secondary'
    });

    $("input[name='reservation_hrs_extra']").TouchSpin({
        min: 0,
        max: 24,
        stepinterval: 1,
        postfix: 'Hrs.',
        buttondown_class: 'btn btn-secondary',
        buttonup_class: 'btn btn-secondary'
    });

    $("input[name='reservation_percentage_discount']").TouchSpin({
        min: 0,
        max: 100,
        postfix: '%',
        buttondown_class: 'btn btn-secondary',
        buttonup_class: 'btn btn-secondary'
    });

    DOM.on('change', '[name="origin"]', function ()
    {
        DOM.find('input[name="origin_name"]').parents('.form-group').addClass('d-none');
        DOM.find('select[name="partner_name"]').parents('.form-group').addClass('d-none');
        DOM.find('input[name="origin_name"]').val('');
        DOM.find('select[name="partner_name"]').val('');
        DOM.find('input[name="customer_email"]').val('');
        DOM.find('input[name="customer_phone"]').val('');

        if ( $(this).val() != 'direct' && $(this).val() != 'partners' && $(this).val() != 'courtesy' && $(this).val() != 'other' )
        {
            $.post('index.php?c=reservations&m=get_data_origin_reservations',
                { value: $(this).val() },
                function(data, status, jqXHR)
                {
                    if ( data.status == 'OK' )
                    {
                        DOM.find('input[name="customer_email"]').val(data.data.email);
                        DOM.find('input[name="customer_phone"]').val(data.data.phone);
                    }
                });
        }
        else if( $(this).val() === 'partners' )
        {
            DOM.find('select[name="partner_name"]').parents('.form-group').removeClass('d-none');
        }
        else if( $(this).val() === 'other' )
        {
            DOM.find('input[name="origin_name"]').parents('.form-group').removeClass('d-none');
        }
    });

    DOM.on('change', '[name="partner_name"]', function ()
    {
        $.post('index.php?c=reservations&m=get_partners',
            { value: $(this).val() },
            function(data, status, jqXHR)
            {
                if ( data.status == 'OK' )
                {
                    DOM.find('input[name="customer_name"]').val(data.data.name);
                    DOM.find('input[name="customer_email"]').val(data.data.email);
                    DOM.find('input[name="customer_phone"]').val(data.data.phone);
                }
            });
    });

    DOM.on('change', '[name="yacht_name"]', function ()
    {
        DOM.find('input[name="yacht_name_custom"]').val('');

        if ( $(this).val() === 'other' )
        {
            DOM.find('input[name="yacht_name_custom"]').parents('.form-group').removeClass('d-none');
            DOM.find('input[name="yacht_pax_adults"]').val('');
            DOM.find('input[name="yacht_pax_childrens"]').val('');
            DOM.find('input[name="yacht_price"]').val('');
            DOM.find('input[name="reservation_hour_extra_price"]').val(1000);
        }
        else
        {
            $.post('index.php?c=reservations&m=get_boats',
                { value: $(this).val() },
                function(data, status, jqXHR)
                {
                    if ( data.status == 'OK' )
                    {
                        DOM.find('input[name="yacht_name_custom"]').parents('.form-group').addClass('d-none');
                        DOM.find('input[name="yacht_pax_adults"]').val(parseInt(data.data.passengers) - parseInt(2));
                        DOM.find('input[name="yacht_pax_childrens"]').val(parseInt(2));
                        DOM.find('input[name="yacht_price"]').val(data.data.prices.base);
                        DOM.find('input[name="reservation_hour_extra_price"]').val(data.data.prices.hour_extra);
                    }
                });
        }
    });

    DOM.on('change', '[name="reservation_hrs_extra"]', function ()
    {
        DOM.find('input[name="reservation_hour_extra_price"]').parents('.form-group').addClass('d-none');

        if ( $(this).val() > 0 )
            DOM.find('input[name="reservation_hour_extra_price"]').parents('.form-group').removeClass('d-none');
    });

    DOM.on('change', '[name="reservation_discount"]', function ()
    {
        DOM.find('input[name="reservation_percentage_discount"]').parents('.form-group').addClass('d-none');
        DOM.find('input[name="reservation_amount_discount"]').parents('.form-group').addClass('d-none');

        if ( $(this).val() === 'percentage' )
            DOM.find('input[name="reservation_percentage_discount"]').parents('.form-group').removeClass('d-none');

        if ( $(this).val() === 'amount' )
            DOM.find('input[name="reservation_amount_discount"]').parents('.form-group').removeClass('d-none');
    });

    DOM.on('change', '[name="includes[]"][value="others"]', function ()
    {
        DOM.find('textarea[name="includes_others"]').parents('.form-group').addClass('d-none');
        DOM.find('textarea[name="includes_others"]').val('');

        if ( $(this).is(':checked') == true )
            DOM.find('textarea[name="includes_others"]').parents('.form-group').removeClass('d-none');
    });

    DOM.on('change', '[name="reservation_amount_payment"]', function ()
    {
        DOM.find('input[name="coupon"]').parents('.form-group').addClass('d-none');
        DOM.find('input[name="other_payment"]').parents('.form-group').addClass('d-none');
        DOM.find('input[name="coupon"]').val('');
        DOM.find('input[name="other_payment"]').val('');

        if ( $(this).val() === 'coupon' )
            DOM.find('input[name="coupon"]').parents('.form-group').removeClass('d-none');

        if ( $(this).val() === 'other' )
            DOM.find('input[name="other_payment"]').parents('.form-group').removeClass('d-none');
    });

    DOM.on('submit', 'form[name="reservation"]', function ( event )
    {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            beforeSend: function ()
            {
                $('form[name="reservation"]').find('[type="submit"]').attr('disabled', 'disabled');
                $('form[name="reservation"]').find('.form-group.has-danger .form-text.text-muted.has-danger').remove();
                $('form[name="reservation"]').find('.form-group').removeClass('has-danger');
            },
            success: function ( response )
            {
                if ( response.status == 'error' )
                {
                    $('form[name="reservation"]').find('[type="submit"]').removeAttr('disabled');

                    $.each(response.labels, function(i, label)
                    {
                        $('form[name="reservation"]').find('[name="' + $(this)[0] + '"]')
                            .parents('.form-group')
                            .addClass('has-danger')
                            .append( "<div class='offset-sm-3 col-sm-9'><small class='form-text text-muted has-danger'>" + $(this)[1] + "</small></div>" );
                    });
                }
                else
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
            }
        });
    });
});

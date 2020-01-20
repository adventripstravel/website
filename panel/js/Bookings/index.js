'use strict';

$(document).ready(function()
{
    var id;

    /* Table
    ------------------------------------------------------------------------------- */
    $(document).find('table').DataTable({
        dom: 'Bfrtip',
        buttons: [

        ],
        'columnDefs': [
            {
                'orderable': false,
                'targets': '_all'
            },
            {
                'className': 'text-left',
                'targets': '_all'
            }
        ],
        'order': [

        ],
        'searching': true,
        'info': true,
        'paging': true,
        'language': {

        }
    });

    /* Select time
    ------------------------------------------------------------------------------- */
    $('[name="time"]').on('change', function()
    {
        window.location.href = 'index.php?c=bookings&m=index&p=' + $('[name="time"]').val();
    });

    /* Get
    ------------------------------------------------------------------------------- */
    $('[data-action="get"]').on('click', function()
    {
        id = $(this).data('id');

        $.ajax({
            url: '',
            type: 'POST',
            data: 'id=' + id + '&action=get',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    console.log(response.data);

                    $('[name="token"]').val(response.data.token);
                    $('[name="name"]').val(response.data.name);
                    $('[name="email"]').val(response.data.email);
                    $('[name="cellphone"]').val(response.data.cellphone);
                    $('[name="tour"]').val(response.data.tour.es);
                    $('[name="date_booking"]').val(response.data.date_booking);
                    $('[name="paxes"]').val((response.data.paxes.adults + response.data.paxes.children) + ' Paxes' + ' (' + response.data.paxes.adults + ' Adultos, ' + response.data.paxes.children + ' Niños)');
                    $('[name="totals_amount"]').val('$ ' + response.data.totals.amount + ' USD');

                    if (response.data.totals.discount != null)
                    {
                        if (response.data.totals.discount.type == '$')
                            $('[name="totals_discount"]').val('$ ' + response.data.totals.discount.amount + ' USD');
                        else if (response.data.totals.discount.type == '%')
                            $('[name="totals_discount"]').val(response.data.totals.discount.amount + '%');
                    }
                    else
                        $('[name="totals_discount"]').val('Sin descuento');

                    $('[name="payment_method"]').val(response.data.payment.method);
                    $('[name="payment_currency"]').val(response.data.payment.currency);
                    $('[name="language"]').val(response.data.language);
                    $('[name="canceled"]').val(response.data.canceled);
                    $('[name="observations"]').val(response.data.observations);
                    $('[name="date_booked"]').val(response.data.date_booked);
                    $('[name="airbnb"]').val(response.data.airbnb + ' (' + response.data.user + ')');
                    $('[data-modal="datas"]').addClass('view').animate({scrollTop: 0}, 0);
                }
                else if (response.status == 'error')
                {
                    $('[data-modal="alert"] main > p').html(response.message);
                    $('[data-modal="alert"]').addClass('view').animate({scrollTop: 0}, 0);
                }
            }
        });
    });

    /* Modal to edit
    ------------------------------------------------------------------------------- */
    $('[data-modal="datas"]').modal().onSuccess(function()
    {
        $('form[name="datas"]').submit();
    });

    $('[data-modal="datas"]').modal().onCancel(function()
    {
        $('[data-modal="datas"] main > form')[0].reset();
        $('[data-modal="datas"] main > form [name]').parents('.error').find('p.error').remove();
        $('[data-modal="datas"] main > form [name]').parents('.error').removeClass('error');
    });

    /* Edit
    ------------------------------------------------------------------------------- */
    $('form[name="datas"]').on('submit', function(e)
    {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            url: '',
            type: 'POST',
            data: form.serialize() + '&id=' + id + '&action=edit',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkFormValidations(form, response, function()
                {
                    $('[data-modal="datas"]').removeClass('view').animate({scrollTop: 0}, 0);
                    $('[data-modal="success"] main > p').html(response.message);
                    $('[data-modal="success"]').addClass('view').animate({scrollTop: 0}, 0);

                    setTimeout(function() { location.reload() }, 1000);
                });
            }
        });
    });
});

'use strict';

$(document).ready(function()
{
    $('[name="tour"]').on('change', function()
    {
        $.ajax({
            type: 'POST',
            data: 'id=' + $(this).val() + '&action=get_tour_price',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    $('[name="price_child"]').val(response.data.price.child);
                    $('[name="price_adult"]').val(response.data.price.adult);
                }
                else if (response.status == 'error')
                {
                    $('[data-modal="alert"]').addClass('view');
                    $('[data-modal="alert"]').find('main > p').html(response.message);
                }
            }
        });

        get_total();
    });

    $('[name="paxes_childs"]').on('change', function()
    {
        get_total();
    });

    $('[name="paxes_adults"]').on('change', function()
    {
        get_total();
    });

    $('[name="payment_currency"]').on('change', function()
    {
        get_total();
    });

    $('[name="booked_date"]').on('change', function()
    {
        $('[name="payment_date"]').attr('min', $(this).val());
    });

    var id = null;
    var update = false;

    $('[data-modal="create_booking"]').modal().onCancel(function()
    {
        id = null;
        update = false;

        $('[data-modal="create_booking"]').find('header > h3').html('Crear');
        $('[data-modal="create_booking"]').find('form')[0].reset();
        $('[data-modal="create_booking"]').find('[name="token"]').parents('fieldset').addClass('hidden');
        $('[data-modal="create_booking"]').find('[name="request_type"]').parents('fieldset').addClass('hidden');
        $('[data-modal="create_booking"]').find('[name="request_details"]').parents('fieldset').addClass('hidden');
        $('[data-modal="create_booking"]').find('[name="language"]').parent().parent().removeClass('span4');
        $('[data-modal="create_booking"]').find('[name="language"]').parent().parent().addClass('span12');
        $('[data-modal="create_booking"]').find('[name="registration_date"]').parent().parent().addClass('hidden');
        $('[data-modal="create_booking"]').find('[name="status"]').parent().parent().addClass('hidden');
        $('[data-modal="create_booking"]').find('label.error').removeClass('error');
        $('[data-modal="create_booking"]').find('p.error').remove();
    });

    $('[data-modal="create_booking"]').modal().onSuccess(function()
    {
        $('[data-modal="create_booking"]').find('form').submit();
    });

    $('form[name="create_booking"]').on('submit', function(e)
    {
        e.preventDefault();

        var form = $(this);

        if (update == false)
            var data = '&action=create_booking';
        else if (update == true)
            var data = '&id=' + id + '&action=update_booking';

        $.ajax({
            url: '',
            type: 'POST',
            data: form.serialize() + data,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkFormDataErrors(form, response, function()
                {
                    $('[data-modal="create_booking"]').removeClass('view');
                    $('[data-modal="success"]').addClass('view');
                    $('[data-modal="success"]').find('main > p').html(response.message);

                    setTimeout(function() { location.reload(); }, 1500);
                });
            }
        });
    });

    $(document).on('click', '[data-action="update_booking"]', function()
    {
        id = $(this).data('id');
        update = true;

        $.ajax({
            type: 'POST',
            data: 'id=' + id + '&action=get_booking',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    $('[data-modal="create_booking"]').addClass('view');
                    $('[data-modal="create_booking"]').find('header > h3').html('Ver detalles | Actualizar');
                    $('[data-modal="create_booking"]').find('[name="token"]').parents('fieldset').removeClass('hidden');
                    $('[data-modal="create_booking"]').find('[name="token"]').val(response.data.token);
                    $('[data-modal="create_booking"]').find('[name="tour"]').val(response.data.tour);
                    $('[data-modal="create_booking"]').find('[name="price_child"]').val(response.data.price.child);
                    $('[data-modal="create_booking"]').find('[name="price_adult"]').val(response.data.price.adult);
                    $('[data-modal="create_booking"]').find('[name="paxes_childs"]').val(response.data.paxes.childs);
                    $('[data-modal="create_booking"]').find('[name="paxes_adults"]').val(response.data.paxes.adults);
                    $('[data-modal="create_booking"]').find('[name="total"]').val(response.data.total);
                    $('[data-modal="create_booking"]').find('[name="payment_currency"]').val(response.data.payment.currency);
                    $('[data-modal="create_booking"]').find('[name="payment_exchange"]').val(response.data.payment.exchange);
                    $('[data-modal="create_booking"]').find('[name="firstname"]').val(response.data.firstname);
                    $('[data-modal="create_booking"]').find('[name="lastname"]').val(response.data.lastname);
                    $('[data-modal="create_booking"]').find('[name="email"]').val(response.data.email);
                    $('[data-modal="create_booking"]').find('[name="phone_lada"]').val(response.data.phone.lada);
                    $('[data-modal="create_booking"]').find('[name="phone_number"]').val(response.data.phone.number);
                    $('[data-modal="create_booking"]').find('[name="observations"]').val(response.data.observations);
                    $('[data-modal="create_booking"]').find('[name="payment_date"]').val(response.data.payment.date);
                    $('[data-modal="create_booking"]').find('[name="payment_method"]').val(response.data.payment.method);

                    if (response.data.payment.status == true)
                        $('[data-modal="create_booking"]').find('[name="payment_status"]').val('1');
                    else if (response.data.payment.status == false)
                        $('[data-modal="create_booking"]').find('[name="payment_status"]').val('0');

                    if (response.data.request.type == 'update' || response.data.request.type == 'cancel')
                    {
                        $('[data-modal="create_booking"]').find('[name="request_type"]').parents('fieldset').removeClass('hidden');

                        if (response.data.request.type == 'update')
                            $('[data-modal="create_booking"]').find('[name="request_type"]').val('Actualización');
                        else if (response.data.request.type == 'cancel')
                            $('[data-modal="create_booking"]').find('[name="request_type"]').val('Cancelación');

                        $('[data-modal="create_booking"]').find('[name="request_details"]').parents('fieldset').removeClass('hidden');
                        $('[data-modal="create_booking"]').find('[name="request_details"]').val(response.data.request.details);
                    }

                    $('[data-modal="create_booking"]').find('[name="language"]').parent().parent().removeClass('span12');
                    $('[data-modal="create_booking"]').find('[name="language"]').parent().parent().addClass('span4');
                    $('[data-modal="create_booking"]').find('[name="language"]').val(response.data.language);
                    $('[data-modal="create_booking"]').find('[name="registration_date"]').parent().parent().removeClass('hidden');
                    $('[data-modal="create_booking"]').find('[name="registration_date"]').val(response.data.registration_date);
                    $('[data-modal="create_booking"]').find('[name="status"]').parent().parent().removeClass('hidden');

                    if (response.data.canceled == true)
                        $('[data-modal="create_booking"]').find('[name="status"]').val('Cancelada');
                    else if (response.data.canceled == false)
                    {
                        var date = new Date();

                        var months = [
                            '01',
                            '02',
                            '03',
                            '04',
                            '05',
                            '06',
                            '07',
                            '08',
                            '09',
                            '10',
                            '11',
                            '12'
                        ];

                        var today = date.getFullYear() + '-' + months[date.getMonth()] + '-' + date.getDate();

                        if (response.data.booked_date >= today)
                            $('[data-modal="create_booking"]').find('[name="status"]').val('Activa');
                        else if (response.data.booked_date < today)
                            $('[data-modal="create_booking"]').find('[name="status"]').val('Terminada');
                    }
                }
                else if (response.status == 'error')
                {
                    $('[data-modal="error"]').addClass('view');
                    $('[data-modal="error"]').find('main > p').html(response.message);
                }
            }
        });
    });
});

function get_total()
{
    var form = $('form[name="create_booking"]');

    $.ajax({
        type: 'POST',
        data: 'tour=' + $('[name="tour"]').val() + '&paxes_childs=' + $('[name="paxes_childs"]').val() + '&paxes_adults=' + $('[name="paxes_adults"]').val() + '&payment_currency=' + $('[name="payment_currency"]').val() + '&action=get_total',
        processData: false,
        cache: false,
        dataType: 'json',
        success: function(response)
        {
            checkFormDataErrors(form, response, function()
            {
                $('[name="total"]').val(response.data.total);
            });
        }
    });
}

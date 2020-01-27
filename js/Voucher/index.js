'use strict';

$(document).ready(function()
{
    $('[data-modal="request_update_booking"]').modal().onCancel(function()
    {
        $('[data-modal="request_update_booking"]').find('form')[0].reset();
        $('[data-modal="request_update_booking"]').find('label.error').removeClass('error');
        $('[data-modal="request_update_booking"]').find('p.error').remove();
    });

    $('[data-modal="request_update_booking"]').modal().onSuccess(function()
    {
        $('[data-modal="request_update_booking"]').find('form').submit();
    });

    $('form[name="request_update_booking"]').on('submit', function(e)
    {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: 'POST',
            data: form.serialize() + '&action=request_update_booking',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkFormDataErrors(form, response, function()
                {
                    $('[data-modal="success"] main > p').html(response.message);
                    $('[data-modal="success"]').addClass('view');
                    setTimeout(function() { location.reload(); }, 1500);
                });
            }
        });
    });

    $('[data-modal="request_cancel_booking"]').modal().onCancel(function()
    {
        $('[data-modal="request_cancel_booking"]').find('form')[0].reset();
        $('[data-modal="request_cancel_booking"]').find('label.error').removeClass('error');
        $('[data-modal="request_cancel_booking"]').find('p.error').remove();
    });

    $('[data-modal="request_cancel_booking"]').modal().onSuccess(function()
    {
        $('[data-modal="request_cancel_booking"]').find('form').submit();
    });

    $('form[name="request_cancel_booking"]').on('submit', function(e)
    {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: 'POST',
            data: form.serialize() + '&action=request_cancel_booking',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkFormDataErrors(form, response, function()
                {
                    $('[data-modal="success"] main > p').html(response.message);
                    $('[data-modal="success"]').addClass('view');
                    setTimeout(function() { location.reload(); }, 1500);
                });
            }
        });
    });
});

'use strict';

$(document).ready(function()
{
    $('[data-action="request_update_booking"]').on('click', function(e)
    {
        $.ajax({
            type: 'POST',
            data: 'action=request_update_booking',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkFormDataErrors(form, response, function()
                {
                    $('[data-modal="success"] main > p').html(response.message);
                    $('[data-modal="success"]').addClass('view');
                    setTimeout(function() { location.reload(); }, 4000);
                });
            }
        });
    });

    $('[data-action="request_cancel_booking"]').on('click', function(e)
    {
        $.ajax({
            type: 'POST',
            data: 'action=request_cancel_booking',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkFormDataErrors(form, response, function()
                {
                    $('[data-modal="success"] main > p').html(response.message);
                    $('[data-modal="success"]').addClass('view');
                    setTimeout(function() { location.reload(); }, 4000);
                });
            }
        });
    });
});
